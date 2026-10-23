<?php
/*
 * iTutor functional test battery (PHP 8.x / Symfony 1 port).
 *
 * Runs end-to-end checks against the web container:
 *   - database schema reachable through the mysqli driver
 *   - framework boots, login works, every module renders
 *   - PDF generation, 404 handling, logout
 *   - no PHP warning/notice/deprecation/error markers in any response
 *
 * Environment:
 *   ITUTOR_URL    base URL of the web service (default: http://web)
 *   APP_USER      login user (default: admin)
 *   APP_PASSWORD  login password (default: 12345Abcde)
 *   MYSQL_HOST / MYSQL_DATABASE / MYSQL_USER / MYSQL_PASSWORD
 *                 database connection (optional; DB test skipped if unset)
 */

error_reporting(E_ALL & ~E_DEPRECATED);

$base = rtrim((string) (getenv('ITUTOR_URL') !== false ? getenv('ITUTOR_URL') : 'http://web'), '/');
$user = getenv('APP_USER') ?: 'admin';
$password = getenv('APP_PASSWORD') ?: '12345Abcde';

$results = array();

function check($name, $condition, $detail = '')
{
    global $results;
    $results[] = array($name, (bool) $condition, $detail);
    printf("[%s] %s%s\n", $condition ? 'OK  ' : 'FAIL', $name, $detail !== '' ? "  ($detail)" : '');
}

/**
 * Minimal HTTP client with a cookie jar.
 *
 * @param string $method  GET|POST
 * @param string $url     absolute URL
 * @param array  $data    POST fields
 * @param array  $cookies jar (name => value), updated in place
 *
 * @return array{status:int, body:string, content_type:string, cookies_changed:bool}
 */
function http($method, $url, array $data = array(), array &$cookies = array())
{
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HEADER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, false);
    curl_setopt($ch, CURLOPT_TIMEOUT, 60);
    if ($method === 'POST') {
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    }
    if ($cookies) {
        curl_setopt($ch, CURLOPT_COOKIE, implode('; ', array_map(function ($k, $v) { return "$k=$v"; }, array_keys($cookies), $cookies)));
    }
    $raw = curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    $headerSize = (int) curl_getinfo($ch, CURLINFO_HEADER_SIZE);
    $err = curl_error($ch);
    curl_close($ch);
    if ($raw === false) {
        return array('status' => 0, 'body' => $err, 'content_type' => '', 'cookies_changed' => false);
    }
    $headers = substr($raw, 0, $headerSize);
    $body = substr($raw, $headerSize);
    $contentType = '';
    if (preg_match('/^Content-Type:\s*(.+)$/mi', $headers, $m)) {
        $contentType = trim($m[1]);
    }
    // update the cookie jar
    $cookiesChanged = false;
    foreach (explode("\n", $headers) as $line) {
        if (stripos($line, 'Set-Cookie:') === 0) {
            $cookie = trim(substr($line, strlen('Set-Cookie:')));
            $pair = explode(';', $cookie, 2)[0];
            if (strpos($pair, '=') !== false) {
                list($name, $value) = explode('=', $pair, 2);
                $cookies[trim($name)] = trim($value);
                $cookiesChanged = true;
            }
        }
    }
    return array('status' => $status, 'body' => $body, 'content_type' => $contentType, 'cookies_changed' => $cookiesChanged);
}

function hasErrorMarkers($body)
{
    return (bool) preg_match('/Fatal error|Parse error|Warning:|Notice:|Deprecated:|Stack trace/i', $body);
}

printf("iTutor test battery against %s\n", $base);
printf("================================\n\n");

// ---------------------------------------------------------------------------
// 1. Database (mysqli driver, schema, seed user)
// ---------------------------------------------------------------------------
$mysqlHost = getenv('MYSQL_HOST');
if ($mysqlHost !== false && $mysqlHost !== '') {
    $dbHost = $mysqlHost;
    $dbName = getenv('MYSQL_DATABASE') ?: 'itutor';
    $dbUser = getenv('MYSQL_USER') ?: 'itutor';
    $dbPass = getenv('MYSQL_PASSWORD') ?: '12345Abcde';
    $dbError = '';
    $mysqli = null;
    try {
        $mysqli = new mysqli($dbHost, $dbUser, $dbPass, $dbName);
        if ($mysqli->connect_errno) {
            $dbError = $mysqli->connect_error;
            $mysqli = null;
        }
    } catch (mysqli_sql_exception $e) {
        $dbError = $e->getMessage();
    }
    check('database reachable via mysqli', $mysqli !== null, $dbError);
    if ($mysqli) {
        $tables = array();
        try {
            if ($res = $mysqli->query("SHOW TABLES")) {
                while ($row = $res->fetch_row()) {
                    $tables[] = $row[0];
                }
            }
        } catch (mysqli_sql_exception $e) {
            $dbError = $e->getMessage();
        }
        check('database schema present (alumno, grupo, sf_guard_user)',
            in_array('alumno', $tables) && in_array('grupo', $tables) && in_array('sf_guard_user', $tables),
            implode(',', array_slice($tables, 0, 5)));
        try {
            $res = $mysqli->query(sprintf('SELECT COUNT(*) FROM sf_guard_user WHERE username = \'%s\'', $mysqli->real_escape_string($user)));
            $row = $res ? $res->fetch_row() : array(0);
        } catch (mysqli_sql_exception $e) {
            $row = array(0);
            $dbError = $e->getMessage();
        }
        check(sprintf('seed user "%s" exists', $user), $row && (int) $row[0] > 0, $dbError);
        $mysqli->close();
    }
} else {
    printf("--   database tests skipped (MYSQL_HOST not set)\n");
}

// ---------------------------------------------------------------------------
// 2. Framework boots (anonymous access)
// ---------------------------------------------------------------------------
$anon = array();
$r = http('GET', $base . '/', array(), $anon);
check('homepage responds to anonymous users', in_array($r['status'], array(200, 401), true), "status={$r['status']}");
check('homepage renders the application layout', strpos($r['body'], 'Gestión de alumnos') !== false || strpos($r['body'], 'sf_guard') !== false);

// 3. Login page
$r = http('GET', $base . '/login', array(), $anon);
check('login page renders (GET /login)', in_array($r['status'], array(200, 401), true) && strpos($r['body'], 'name="username"') !== false && strpos($r['body'], 'name="password"') !== false, "status={$r['status']}");

// 4. Login with the seeded user
$session = array();
$r = http('POST', $base . '/login', array('username' => $user, 'password' => $password, 'commit' => 'Entrar'), $session);
check('login with valid credentials redirects', in_array($r['status'], array(301, 302, 303), true), "status={$r['status']}");
check('login sets a session cookie', $session !== array(), implode(', ', array_slice(array_keys($session), 0, 3)));

// 5. Authenticated homepage
$r = http('GET', $base . '/', array(), $session);
check('authenticated homepage renders', $r['status'] === 200, "status={$r['status']}");

// 6. Secure module requires authentication
$fresh = array();
$r = http('GET', $base . '/alumno', array(), $fresh);
check('secure module rejects anonymous users', $r['status'] === 401, "status={$r['status']}");

// 7. Every module renders for an authenticated user
$modules = array('principal', 'alumno', 'grupo', 'asignatura', 'profesor', 'horario', 'falta', 'diario', 'evaluacion', 'comportamiento', 'prueba', 'festivo', 'listados');
$moduleBodies = array();
foreach ($modules as $module) {
    $r = http('GET', $base . '/' . $module, array(), $session);
    $moduleBodies[$module] = $r['body'];
    check("module /$module renders", $r['status'] === 200, "status={$r['status']}");
}

// 8. Generated (sfGenerator) module pages render
$subRoutes = array('sfGuardUser/list', 'sfGuardGroup/list', 'sfGuardPermission/list', 'grupoevaluacion/list', 'evaluacion/list', 'grupo/list', 'alumno/list', 'horario/list', 'falta/list', 'prueba/list');
foreach ($subRoutes as $subRoute) {
    $r = http('GET', $base . '/' . $subRoute, array(), $session);
    check("generated/sub-route /$subRoute renders", $r['status'] === 200 && !hasErrorMarkers($r['body']), "status={$r['status']}");
}

// 9. PDF generation (TCPDF)
$r = http('GET', $base . '/pdf/test', array(), $session);
$isPdf = strpos($r['body'], "%PDF") === 0 || strpos($r['content_type'], 'pdf') !== false;
check('PDF generation works (GET /pdf/test)', $r['status'] === 200 && $isPdf, "status={$r['status']} type={$r['content_type']}");

// 10. Dev front controller
$r = http('GET', $base . '/itutor_dev.php', array(), $session);
check('debug front controller responds (itutor_dev.php)', in_array($r['status'], array(200, 401, 302), true), "status={$r['status']}");

// 11. Unknown module
$r = http('GET', $base . '/no-such-module/no-such-action', array(), $session);
check('unknown route is handled without a fatal error', $r['status'] !== 200 && !hasErrorMarkers($r['body']), "status={$r['status']}");

// 11. Bad login
$bad = array();
$r = http('POST', $base . '/login', array('username' => $user, 'password' => 'definitely-wrong', 'commit' => 'Entrar'), $bad);
$r2 = http('GET', $base . '/alumno', array(), $bad);
check('invalid credentials do not grant access', $r2['status'] === 401, "status={$r2['status']}");

// 12. Logout
$r = http('GET', $base . '/logout', array(), $session);
$r2 = http('GET', $base . '/alumno', array(), $session);
check('logout ends the session', in_array($r['status'], array(301, 302, 303), true) && $r2['status'] === 401, "logout={$r['status']} after={$r2['status']}");

// 13. No PHP error/warning markers in any response body
$allBodies = array_merge($moduleBodies, array('homepage' => $anon ? '' : ''));
$markerHits = array();
$probeBodies = array();
$probeBodies['anon_home'] = http('GET', $base . '/', array(), $anon)['body'];
$probeBodies['login_page'] = http('GET', $base . '/login', array(), $anon)['body'];
foreach (array_merge($moduleBodies, $probeBodies) as $label => $body) {
    if (hasErrorMarkers($body)) {
        $markerHits[] = $label;
    }
}
check('no PHP warning/notice/error markers in any response', $markerHits === array(), implode(', ', $markerHits));

// ---------------------------------------------------------------------------
printf("\n================================\n");
$failed = count(array_filter($results, function ($r) { return !$r[1]; }));
printf("%d/%d tests passed\n", count($results) - $failed, count($results));
exit($failed === 0 ? 0 : 1);
