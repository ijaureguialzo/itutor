<?php

define('SF_ROOT_DIR',    realpath(dirname(__FILE__).'/..'));
define('SF_APP',         'itutor');
define('SF_ENVIRONMENT', 'prod');
define('SF_DEBUG',       false);

// Security: enforce HTTPS behind the Traefik SSL termination proxy (prod only).
if (defined('SF_ENVIRONMENT') && SF_ENVIRONMENT === 'prod')
{
    if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')
    {
        $_SERVER['HTTPS'] = 'on';
    }
    if (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === 'off')
    {
        $httpsUrl = 'https://'.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'localhost').$_SERVER['REQUEST_URI'];
        header('Location: '.$httpsUrl);
        exit;
    }
}

require_once(SF_ROOT_DIR.DIRECTORY_SEPARATOR.'apps'.DIRECTORY_SEPARATOR.SF_APP.DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'config.php');

sfContext::getInstance()->getController()->dispatch();
