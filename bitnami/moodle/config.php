<?php  // Moodle configuration file

unset($CFG);
global $CFG;
$CFG = new stdClass();

// --- 1. DATABASE CONFIG ---
$CFG->dbtype    = 'mariadb';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'mariadb';
$CFG->dbname    = 'moodle_db';
$CFG->dbuser    = 'moodle_user';
$CFG->dbpass    = 'moodle_password';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array (
  'dbpersist' => 0,
  'dbport' => 3306,
  'dbsocket' => '',
  'dbcollation' => 'utf8mb4_unicode_ci',
);

// --- 2. REVERSE PROXY CONFIG ---
$CFG->reverseproxy = true;
$CFG->reverseproxy_addresses = array(gethostbyname('los-rezagados-proxy'));

// --- 3. DYNAMIC URL DETECTION ---
if (empty($_SERVER['HTTP_HOST'])) {
    $_SERVER['HTTP_HOST'] = 'localhost:8080';
}

// Detect HTTPS from the Proxy Headers
$protocol = 'http';
if (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https') {
    $protocol = 'https';
    $CFG->sslproxy = true; 
} elseif (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
    $protocol = 'https';
}

$CFG->wwwroot = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/moodle';

// --- 4. DATA DIRECTORY ---
$CFG->dataroot  = '/bitnami/moodledata';
$CFG->admin     = 'admin';
$CFG->directorypermissions = 02775;

require_once(__DIR__ . '/lib/setup.php');

// There is no php closing tag in this file,
// it is intentional because it prevents trailing whitespace problems!
