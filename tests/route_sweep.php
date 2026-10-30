<?php
/*
 * Exhaustive route sweep against the DEV front controller.
 *
 * Walks every module/action of the application (plus calendar/date flows
 * and POST create flows) and collects every PHP marker (Deprecated /
 * Warning / Notice / Fatal / Parse error) rendered in the responses.
 *
 * Usage:
 *   php route_sweep.php [--base=http://localhost] [--pass=all|get|params|post|dates]
 *
 * The script is read-only except for the POST create flows of --pass=post,
 * which create and then delete their own rows.
 */

error_reporting(E_ALL & ~E_DEPRECATED);
ini_set('display_errors', '0');
$base = 'http://localhost';
$pass = 'all';
foreach ($argv as $i => $a) {
    if (strpos($a, '--base=') === 0) $base = rtrim(substr($a, 7), '/');
    if (strpos($a, '--pass=') === 0) $pass = substr($a, 7);
}
$base = rtrim($base, '/');

$loginUser = getenv('ITUTOR_USER') ?: 'admin';
$loginPass = getenv('ITUTOR_PASS') ?: '12345Abcde';

$cookieFile = tempnam(sys_get_temp_dir(), 'sweep_cookies');

function http($method, $url, array $data = array(), $cookieFile = null, $expectRedirects = false)
{
    $ch = curl_init($url);
    $headers = array();
    if ($data) {
        $headers[] = 'Content-Type: application/x-www-form-urlencoded';
    }
    curl_setopt_array($ch, array(
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_COOKIEFILE => $cookieFile,
        CURLOPT_COOKIEJAR  => $cookieFile,
        CURLOPT_CUSTOMREQUEST => $method,
        CURLOPT_POSTFIELDS => $data ? http_build_query($data) : '',
        CURLOPT_FOLLOWLOCATION => $expectRedirects,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTPHEADER => $headers,
    ));
    $body = (string) curl_exec($ch);
    $status = (int) curl_getinfo($ch, CURLINFO_RESPONSE_CODE);
    return array('status' => $status, 'body' => $body);
}

/* ------------------------------------------------------------------ *
 * Route inventory (module => actions, optional default GET params)   *
 * ------------------------------------------------------------------ */
$routes = array(
    'alumno'           => array('actions' => array('index', 'list', 'listado', 'fotos', 'datos', 'show', 'create', 'edit', 'update', 'delete', 'imagendelete')),
    'asignatura'       => array('actions' => array('index', 'list', 'show', 'create', 'edit', 'update', 'error', 'delete')),
    'comportamiento'   => array('actions' => array('index', 'datos', 'list', 'show', 'create', 'generar', 'regenerar', 'edit', 'update', 'updateall', 'delete')),
    'diario'           => array('actions' => array('index', 'grupodia', 'diario', 'opciongrupo', 'list', 'generar', 'regenerar', 'imprimir', 'imprimirud', 'listado', 'show', 'create', 'edit', 'updateall', 'update', 'delete')),
    'evaluacion'       => array('actions' => array('index', 'list', 'show', 'create', 'edit', 'update', 'delete')),
    'falta'            => array('actions' => array('index', 'grupolisteval', 'grupoev', 'tabla', 'tablalist', 'tablafaltas', 'salvartodo', 'salvar', 'limpiar', 'limp', 'totalgrupolist', 'fechasgrupolist', 'totalasiggrupolist', 'totalasigalumnolist', 'totalasigalumnolistado', 'asiggrupolist', 'asigalumnolist', 'asigalumnolistado', 'grupolist', 'algrupolist', 'recgrupolist', 'list', 'totalalumnolist', 'fechasalumnolist', 'fechasalumnolistado', 'alumnolist_antiguo', 'alumnolist', 'alumnolisteval', 'alalumnolistfaltas', 'alalumnolist', 'recalumnolist', 'total', 'faltas', 'show', 'create', 'edit', 'update', 'error', 'delete')),
    'festivo'          => array('actions' => array('index', 'festivo', 'list', 'show', 'create', 'edit', 'update', 'delete')),
    'grupo'            => array('actions' => array('index', 'list', 'show', 'create', 'edit', 'update', 'delete')),
    'grupoevaluacion'  => array('actions' => array('index', 'list', 'show', 'create', 'edit', 'update', 'delete')),
    'hora'             => array('actions' => array('index', 'list', 'show', 'create', 'edit', 'update', 'delete')),
    'horario'          => array('actions' => array('index', 'completo', 'list', 'show', 'create', 'edit', 'editdia', 'update', 'updatedia', 'error', 'delete')),
    'listados'         => array('actions' => array('index', 'grupoev', 'alasiglist', 'guardarnota', 'grupoasiglist', 'grupoasigresumenlist', 'alresumenlist', 'alresumenlistpdf', 'algrupolist')),
    'pdf'              => array('actions' => array('index', 'test', 'test2')),
    'perfil'           => array('actions' => array('index', 'list', 'perfilhora', 'show', 'create', 'edit', 'perfilhoracreate', 'perfilhoraedit', 'perfilhoraupdate', 'perfilhoradelete', 'update', 'error', 'delete')),
    'principal'        => array('actions' => array('index', 'error', 'warning', 'logout')),
    'profesor'         => array('actions' => array('index', 'list', 'show', 'create', 'edit', 'update', 'delete')),
    'prueba'           => array('actions' => array('index', 'nuevo', 'list', 'listado', 'alumnolist', 'notasedit', 'show', 'create', 'edit', 'update', 'error', 'notasupdate', 'delete')),
    'sfGuardUser'      => array('actions' => array('index', 'list', 'create', 'edit', 'delete', 'save')),
    'sfGuardGroup'     => array('actions' => array('index', 'list', 'create', 'edit', 'delete', 'save')),
    'sfGuardPermission' => array('actions' => array('index', 'list', 'create', 'edit', 'delete', 'save')),
    'sfGuardAuth'      => array('actions' => array('signin', 'signout', 'password')),
    'sfTCPDF'          => array('actions' => array('index', 'test')),
);

$markers = array();   // normalized marker text => count
$locations = array();  // normalized key => first raw occurrence
$failures = array();  // url => "status=xxx markers=n"
$total = 0;

function collect($url, array $r, array &$markers, array &$locations, array &$failures, &$total)
{
    $total++;
    $found = array();
    // strip tags: markers are rendered with <b>/<i> tags in between
    $text = strip_tags($r['body']);
    foreach (explode("\n", $text) as $line) {
        // real PHP markers: word followed by a colon (avoids sfWebDebug toolbar false positives)
        if (!preg_match('/(Deprecated|Warning|Notice|Fatal error|Parse error|Uncaught [A-Za-z_]+)\s*:/i', $line)) {
            continue;
        }
        $raw = trim($line);
        if ($raw === '') {
            continue;
        }
        // normalize: file paths and line numbers vary per occurrence
        $key = substr($raw, 0, 300);
        $key = preg_replace('#in /[^ ]+#', 'in FILE', $key);
        $key = preg_replace('#([A-Za-z0-9_/.]+\.php):\d+#', '$1:L', $key);
        $key = preg_replace('/ on line \d+/', ' on line L', $key);
        $key = preg_replace('/\d{4,}/', '', $key);
        $key = preg_replace('/\s+/', ' ', $key);
        $found[$key] = true;
        if (!isset($locations[$key])) {
            $locations[$key] = $raw; // first occurrence keeps the real file:line
        }
    }
    if ($found) {
        foreach ($found as $key => $v) {
            $markers[$key] = ($markers[$key] ?? 0) + 1;
        }
        $failures[$url . ' [' . $r['status'] . ']'] = implode(' | ', array_keys($found));
    }
}

$dev = '/itutor_dev.php';

/* Login */
http('POST', $base . $dev . '/login', array('username' => $loginUser, 'password' => $loginPass, 'commit' => 'Entrar'), $cookieFile);

/* ---- PASS 1: every action, GET, no params ---- */
if (in_array($pass, array('all', 'get'))) {
    foreach ($routes as $module => $spec) {
        foreach ($spec['actions'] as $action) {
            $url = "$module/$action";
            $r = http('GET', $base . $dev . '/' . $url, array(), $cookieFile);
            collect("$dev/$url", $r, $markers, $locations, $failures, $total);
        }
    }
    /* logout/login again: some actions logged us out */
    http('POST', $base . $dev . '/login', array('username' => $loginUser, 'password' => $loginPass, 'commit' => 'Entrar'), $cookieFile);
}

/* ---- PASS 2: GET with real ids of seeded tables ---- */
if (in_array($pass, array('all', 'params'))) {
    $idRoutes = array(
        'evaluacion/show' => array('id' => 1),
        'evaluacion/edit' => array('id' => 1),
        'hora/show' => array('id' => 1),
        'hora/edit' => array('id' => 1),
        'perfil/show' => array('id' => 4),
        'perfil/edit' => array('id' => 4),
        'perfil/perfilhora' => array('id' => 4),
        'perfil/perfilhoraedit' => array('id' => 4),
        'sfGuardUser/show' => array('id' => 1),
        'sfGuardUser/edit' => array('id' => 1),
        'sfGuardGroup/list' => array('id' => 1),
        'sfGuardPermission/list' => array('id' => 1),
        'comportamiento/datos' => array('grupo' => 1, 'asignatura' => 1, 'evaluacion' => 1),
        'falta/index' => array('fecha' => strtotime('2017-09-07')),
        'diario/index' => array('fecha' => strtotime('2017-09-07')),
        'listados/grupoev' => array('grupo' => 1, 'asignatura' => 1, 'evaluacion' => 1),
        'listados/alasiglist' => array('alumno' => 1, 'asignatura' => 1),
        'alumno/datos' => array('id' => 1),
        'alumno/fotos' => array('id' => 1),
        'prueba/index' => array('evaluacion' => 1),
        'prueba/list' => array('alumno' => 1, 'asignatura' => 1, 'evaluacion' => 1),
    );
    foreach ($idRoutes as $url => $params) {
        $qs = http_build_query($params);
        $r = http('GET', $base . $dev . '/' . $url . '?' . $qs, array(), $cookieFile);
        collect("$dev/$url?$qs", $r, $markers, $locations, $failures, $total);
    }
    http('POST', $base . $dev . '/login', array('username' => $loginUser, 'password' => $loginPass, 'commit' => 'Entrar'), $cookieFile);
}

/* ---- PASS 3: calendar / date flows (a date INSIDE an evaluation) ---- */
if (in_array($pass, array('all', 'dates'))) {
    $dia = strtotime('2017-09-07'); /* inside evaluation 1 (2017) */
    $dateRoutes = array(
        "festivo/index?fecha=$dia",
        "festivo/festivo?dia=$dia",
        "festivo/create?dia=$dia",
        "falta/index?fecha=$dia",
        "falta/fechasgrupolist?fecha=$dia",
        "diario/index?fecha=$dia",
        "diario/grupodia?fecha=$dia",
        "comportamiento/index?fecha=$dia",
        "horario/index?fecha=$dia",
        "listados/index?fecha=$dia",
        "prueba/index?fecha=$dia",
        /* a date OUTSIDE any evaluation (2026) */
        "festivo/index?fecha=" . strtotime('2026-10-23'),
        "festivo/festivo?dia=" . strtotime('2026-10-23'),
        "festivo/create?dia=" . strtotime('2026-10-23'),
        "diario/index?fecha=" . strtotime('2026-10-23'),
        "falta/index?fecha=" . strtotime('2026-10-23'),
    );
    foreach ($dateRoutes as $url) {
        $r = http('GET', $base . $dev . '/' . $url, array(), $cookieFile);
        collect("$dev/$url", $r, $markers, $locations, $failures, $total);
    }
    http('POST', $base . $dev . '/login', array('username' => $loginUser, 'password' => $loginPass, 'commit' => 'Entrar'), $cookieFile);
}

/* ---- PASS 4: POST create flows (create -> show/edit -> delete, bottom-up) ---- */
if (in_array($pass, array('all', 'post')) && ($post = getenv('ITUTOR_POST')) === '1') {
    /* profesor */
    $r = http('POST', $base . $dev . '/profesor/create', array('codigo' => 'swp001', 'nombre' => 'Sweep Profesor', 'apellidos' => 'Test', 'commit' => 'Guardar'), $cookieFile, true);
    collect("$dev/profesor/create POST", $r, $markers, $locations, $failures, $total);
}

/* ---- Report ---- */
ksort($markers);
echo "==================================================\n";
echo "ROUTE SWEEP: $total requests, pass=$pass, base=$base\n";
echo "==================================================\n";
if (!$markers) {
    echo "OK: no PHP markers (deprecated/warning/notice/fatal) found in any response.\n";
} else {
    echo "UNIQUE ISSUES: " . count($markers) . "\n\n";
    $i = 0;
    foreach ($markers as $key => $count) {
        $loc = isset($locations[$key]) ? preg_replace('/\s+/', ' ', $locations[$key]) : '';
        printf("%2d. [x%d] %s\n     first: %s\n", ++$i, $count, $key, $loc);
    }
    echo "\nAFFECTED URLS (" . count($failures) . "):\n";
    foreach ($failures as $url => $list) {
        echo "  - $url => $list\n";
    }
}
@unlink($cookieFile);
exit($markers ? 1 : 0);
