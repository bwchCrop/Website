<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('_WEBTITLE', 'Brawijaya Hospital & Clinic');
define('_WEBLOGO', 'assets/img/logo/Logo.png');
define('_FAVICON', 'assets/img/favicon-bwch.ico');
define('_WEBLOGOS', 'assets/img/logo/Logo.png');
define('_ADMINWALL', 'assets/img/logo/hauz_back.png');
define('_CUSTOMCOLOR',  FALSE);
define('_COLORADMIN', '#0c4da2');
define('_COLORTHEME', 'skin-black-light');
define('_PREFIX', 'bwch_');
define('_PT', 'BWCH');
define('_YEAR', '2017');
define('_DOMAIN', 'brawijayahospital.com');
define('_USEREMAIL', 'noreply.cuber@gmail.com');
define('_EMAILPASS', 'cubecube123');
define('_ENCRYPTKEY', 'super-secret-key');
define('_AKEY', 'kamargelap11');
define('_CSEMAIL', 'darmawan@designcub3.com');
define('_PROTOCOL', 'mail');

define('_FB', 'https://www.facebook.com/');
define('_FBLOGO', 'assets/img/symbol/facebook.png');
define('_TW', 'https://twitter.com/');
define('_TWLOGO', 'assets/img/symbol/twitter.png');
define('_IG', 'https://www.instagram.com/');
define('_IGLOGO', 'assets/img/symbol/instagram.png');

define('API_AUTH', 'Basic YnJhd2lqYXlhOnBhdGllbnRqb3VybmV5');


// _CUSTOMCOLOR must be TRUE
// _CUSTOMCOLOR must be FALSE ( option : skin-blue , skin-black, skin-black-light, skin-blue-light, ETC. red,yellow,purple)

/**
 * Base url cons
 */
switch (ENVIRONMENT) {
    case 'development':
        define('_ENABLE_PROFILE_DOCTOR', false);
        define('_ENABLE_APPOINTMENT', TRUE);
        define('_ENABLE_APPOINTMENT_ALL', TRUE);
        // define('API_URL', 'https://api-webservice.teramobile.app/api/v1');
        // define('USERNAME_API', 'brawijaya');
        // define('PASSWORD_API', 'braw_cQbDm5dK78');
        // break;
        define('API_URL', 'https://dev-api-webservice.teramobile.app/api/v1');
        define('API_MIDDLEWARE', 'http://sandbox-api.brawijaya.local/api/v1');
        define('USERNAME_API', 'brawijaya_devel');
        define('PASSWORD_API', 'Brawc88KKyxzF');
        define('CACHE_VERSION', date('Ymdhis'));
        break;
    case 'testing':
        define('API_URL', 'http://sandbox-api.brawijaya.local/api/v1');
        define('API_MIDDLEWARE', 'http://sandbox-api.brawijaya.local/api/v1');
        define('USERNAME_API', 'brawijaya_devel');
        define('PASSWORD_API', 'Brawc88KKyxzF');
        define('_ENABLE_PROFILE_DOCTOR', TRUE);
        define('_ENABLE_APPOINTMENT', TRUE);
        define('_ENABLE_APPOINTMENT_ALL', isset($_SERVER['BRAWIJAYA_APPOINTMENT_ALL']) ? $_SERVER['BRAWIJAYA_APPOINTMENT_ALL'] : TRUE);
        define('CACHE_VERSION', date('Ymdhis'));
        break;
    case 'production':
        define('API_URL', 'http://api-webservice.teramobile.app/api/v1');
        define('API_MIDDLEWARE', 'http://api.brawijaya.local/api/v1');
        define('USERNAME_API', 'brawijaya');
        define('PASSWORD_API', 'braw_cQbDm5dK78');
        define('_ENABLE_PROFILE_DOCTOR', FALSE);
        define('_ENABLE_APPOINTMENT', TRUE);
        define('_ENABLE_APPOINTMENT_ALL', isset($_SERVER['BRAWIJAYA_APPOINTMENT_ALL']) ? $_SERVER['BRAWIJAYA_APPOINTMENT_ALL'] : FALSE);
        define('CACHE_VERSION', isset($_SERVER['CI_CACHE_VERSION']) ? $_SERVER['CI_CACHE_VERSION'] : date('Ymd'));
        break;
    default:
        define('API_URL', 'https://dev-api-webservice.teramobile.app/api/v1');
        define('API_MIDDLEWARE', 'http://sandbox-api.brawijaya.local/api/v1');
        define('USERNAME_API', 'brawijaya_devel');
        define('PASSWORD_API', 'Brawc88KKyxzF');
        define('_ENABLE_PROFILE_DOCTOR', FALSE);
        define('_ENABLE_APPOINTMENT', FALSE);
        define('_ENABLE_APPOINTMENT_ALL', FALSE);
        define('CACHE_VERSION', date('Ymdhis'));
        break;
}


/*----------- LOCALHOST ------------

define('CONSUMER_KEY', 'jqsPzLG4ofs1i4cgIMfLknTui');
define('CONSUMER_SECRET', 'MGIfulHT8RqEUpargXKNoHHTfMpHxwnniKB31GlEL6SGYMO8rN');
define('OAUTH_CALLBACK', 'http://localhost/hauz/home/callback_index');

define('CLIENT_ID','104587466474-34toedc9qrkuhhbocu2r3v02b8iicuj7.apps.googleusercontent.com');
define('CLIENT_SECRET','U1WCGJec1IhSn2JfRYzVKErP');
define('REDIRECT_URL', 'http://localhost/hauz');

/*------------ TW APP ---------*/

define('CONSUMER_KEY', 'zOoEEBgNxNHZRq1Dlk9trIrXd');
define('CONSUMER_SECRET', 'YfgvSWAowyT5GnkrCxekX0Ufd52ODM9yS5lWHnMIGkZCQuBQnq');
define('OAUTH_CALLBACK', 'http://ddf.app-show.net/hauz/home/callback_index');

/*------------ G+ APP SHOW --------------*/
define('CLIENT_ID', '104587466474-c090kdbhdmngopggceis66bdqpnogfgb.apps.googleusercontent.com');
define('CLIENT_SECRET', 'pFdZYDgvSylluNucGbS_TJRS');
define('REDIRECT_URL', 'http://ddf.app-show.net/hauz');

/*------------------------------------------------------------------------*/

defined('SHOW_DEBUG_BACKTRACE') or define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  or define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') or define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   or define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  or define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           or define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     or define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       or define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  or define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   or define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              or define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            or define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       or define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        or define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          or define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         or define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   or define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  or define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') or define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     or define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       or define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      or define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      or define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
