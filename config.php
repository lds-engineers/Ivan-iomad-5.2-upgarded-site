<?php  // Moodle configuration file
unset($CFG);
global $CFG;
$CFG = new stdClass();
ini_set('session.cookie_domain', '.ez-osha.com');
$CFG->dbtype    = 'mysqli';
$CFG->dblibrary = 'native';
$CFG->dbhost    = 'localhost';
$CFG->dbname    = 'staging_learning_new';
$CFG->dbuser    = 'staging';
$CFG->dbpass    = 'Sai%$3358!';
$CFG->prefix    = 'mdl_';
$CFG->dboptions = array(
	'dbpersist' => 0,
	'dbport' => '',
	'dbsocket' => '',
	'dbcollation' => 'utf8mb4_0900_ai_ci',
);
$CFG->dataroot = '/var/www/lmsup-moodledata';
$CFG->cachedirect = '/var/www/cachedataup';
$CFG->defultuseremail = "suneet.sharma695@gmail.com";
// $CFG->defultuseremail = "suneet@ldsengineers.com";
// $CFG->defultuseremail = "udaytomar2512@yopmail.com";
$tenant_urls = [];

require_once(__DIR__ . '/public/blocks/custom_mycourse/tenant_host.php');
// Get the current domain/subdomain
$current_host = $_SERVER['HTTP_HOST'];
if ($current_host != 'lmsup.ez-osha.com') {
	if (array_key_exists($current_host, $tenant_urls)) {
		$CFG->wwwroot = $tenant_urls[$current_host];
		$CFG->cachedir = "/var/www/cachedataup/cache/{$current_host}";
		$CFG->localcachedir = "/var/www/cachedataup/localcache/{$current_host}";
	} else {
		$CFG->cachedir = "/var/www/cachedataup/cache/ez-osha.com";
		$CFG->localcachedir = "/var/www/cachedataup/localcache/ez-osha.com";
		$CFG->wwwroot = 'https://lmsup.ez-osha.com'; // Set to a default or main URL
		// $CFG->sslproxy = true;
	}
} else {
	$CFG->cachedir = "/var/www/cachedataup/cache/ez-osha.com";
	$CFG->localcachedir = "/var/www/cachedataup/localcache/ez-osha.com";
	$CFG->wwwroot = 'https://lmsup.ez-osha.com'; // Set to a default or main URL
	// $CFG->sslproxy = true;
}
$CFG->samlssoroot = 'https://sso.learnshare.com/485/Shibboleth.sso/Login';
$CFG->admin     = 'admin';
$CFG->noemailever = true;
$CFG->local_adminer_secret = 'le@rnpeek#Pdhstar';
//@error_reporting(E_ALL | E_STRICT);
//@ini_set('display_errors', '1');
//$CFG->debug = (E_ALL | E_STRICT);
//$CFG->debugdisplay = 1;

$CFG->directorypermissions = 0777;
// $CFG->usepaypalsandbox = 1;
$CFG->maxfileuploadprofile = 5 * 1024 * 1024;

require_once(__DIR__ . '/lib/setup.php');
