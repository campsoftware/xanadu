<?php
///////////////////////////////////////////////////////////
// PHP Settings: /opt/bitnami/php/etc/php.ini;
// PHP Restart: sudo /opt/bitnami/ctlscript.sh restart php-fpm;

// Precompiling PHP
ini_set( "opcache.enable", 0 ); // 0 for dev, 1 for production; default = 1; improves PHP performance by storing precompiled script bytecode in shared memory, thereby removing the need for PHP to load and parse scripts on each request

// Time
date_default_timezone_set( 'UTC' );

///////////////////////////////////////////////////////////
// LoadTime Begin
$pageload_begin = microtime( true );

///////////////////////////////////////////////////////////
// App Domain
define( 'APP_DOMAIN', strtolower( $_SERVER[ 'HTTP_HOST' ] ) );

///////////////////////////////////////////////////////////
if ( false ) {
	
	// Init Constants
	// Database
	define( 'DBS_SERVERNAME', 'db.foo.com' );
	define( 'DBS_SERVERPORT', '3306' );
	define( 'DBS_USERNAME', 'username' );
	define( 'DBS_PASSWORD', 'password' );
	define( 'DBS_DBNAME', 'dbname' );
	
	// Path and URL
	define( 'PATH_ROOT_OS', '/path/to/app/root/' );  // Determine using: dirname( __FILE__ );
	define( 'URL_BASE', 'https://app.foo.com/' );
	
	// Form Obfuscate Key
	define( 'FORM_OBFUSCATE_KEY', '123456' );
	
	// Debug
	define( 'APP_EMAIL_TO_DEBUG', 'dev@foo.com' );
	define( 'APP_SMS_TO_DEBUG', '4075551212' );
	
} else {
	
	// Init File per Domain like: xanadu.xanweb.app
	$init_filename = 'init_' . APP_DOMAIN . '.php'; // File like: init_xanadu.xanweb.app.php
	$init_path =  __DIR__ . '/' . $init_filename;
	if ( file_exists( $init_path ) ) {
		require_once( $init_path ); // Sets the above CONSTANTS. Not shared in Github.
	} else {
		echo '<html><head><title>404 Not Found</title></head><body"><h1>404 Not Found</h1></body></html>';
		return;
	}
	
}


///////////////////////////////////////////////////////////
// Paths Shared: Try to use Relative paths when possible.
define( 'PATH_ROOT_XAN', PATH_ROOT_OS . 'xan/' );
define( 'PATH_ROOT_APP', PATH_ROOT_OS . 'app/' );
define( 'PATH_ROOT_INCLUDE', PATH_ROOT_OS . 'include/' );
define( 'PATH_ROOT_TEMPLATES', PATH_ROOT_OS . 'templates/' );
define( 'PATH_PAGE_RESP', PATH_ROOT_TEMPLATES . 'page-resp.php' );

// URLs Shared
define( 'URL_IMAGES', URL_BASE . 'images/' );
define( 'URL_IMAGES_PLACEHOLDER', URL_IMAGES . 'imagePlaceholder.png' );

// Files per Domain
define( 'PATH_ROOT_FILES', PATH_ROOT_OS . 'files/' . APP_DOMAIN . '/' );
define( 'PATH_ROOT_LOGS', PATH_ROOT_FILES . 'logs/' );
define( 'PATH_ROOT_BRIEF', PATH_ROOT_FILES . 'brief/' );
define( 'PATH_ROOT_BUCKET', PATH_ROOT_FILES . 'bucket/' );

// URLs per Domain
define( 'URL_ROOT_FILES', URL_BASE . 'files/' . APP_DOMAIN . '/' );
define( 'URL_BRIEF', URL_ROOT_FILES . 'brief/' );
define( 'URL_BUCKET', URL_ROOT_FILES . 'bucket/' );
define( 'URL_BUCKET_UPLOAD_PAGE', '/files/' . APP_DOMAIN . '/bucket/upload.php' );

///////////////////////////////////////////////////////////


// Errors
ini_set( 'error_reporting', E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED );
ini_set( 'display_errors', 1 );
ini_set( "log_errors", 1 );
ini_set( "error_log", PATH_ROOT_LOGS . date( 'Ymd' ) . "_Errors.txt" );

// Allow Opening of URLs as Remote Files
ini_set( "allow_url_fopen", 1 );

// Secure Cookies
ini_set( 'session.cookie_httponly', 1 );
ini_set( 'session.cookie_secure', 1 );

// Resources
// ini_set( 'memory_limit', '128M' ); // max php script RAM
// ini_set( 'upload_max_filesize', '100M' ); // max file size upload
// ini_set( 'post_max_size', '100M' ); // max post size [normally > upload_max_filesize]
// ini_set( 'max_execution_time', 0 ); // seconds; 0 = forever


///////////////////////////////////////////////////////////
// Cookies
define( 'APP_COOKIE_SESSION_SECONDS', 60 * 60 * 1 ); // 60 * 60 * 1 = 1 Hour; FORM_TIMEOUT_SECONDS Expires 60 Seconds Later.
define( 'APP_COOKIE_LOGIN_DAYS', 7 );
define( 'APP_COOKIE_REMEMBERME_DAYS', 7 );


///////////////////////////////////////////////////////////
// Globally used Primary Keys
define( 'UUIDUSERS', 'UUIDUsers' );


///////////////////////////////////////////////////////////
// Xan Functions
foreach ( glob( PATH_ROOT_XAN . "functions-*.php" ) as $filename ) {
	require_once( $filename );
}

// Xan Classes
foreach ( glob( PATH_ROOT_XAN . "class-*.php" ) as $filename ) {
	require_once( $filename );
}

// App Classes
$mm = [];
foreach ( glob( PATH_ROOT_APP . "zzMetaModules/mm*.php" ) as $filename ) {
	require_once( $filename );
}


///////////////////////////////////////////////////////////
// Schema Init
xan\dbRecsSchemaSet(); // Sets: $GLOBALS[ 'schema' ]


///////////////////////////////////////////////////////////
// Settings Load
$recsSettings = new \xan\recs( $mmSettingsT );
$recsSettings->querySQL = 'SELECT * FROM ' . $mmSettingsT->NameTable . ' WHERE ' . 'Active = ?';
$recsSettings->queryBindNamesA = array( 'Active' );
$recsSettings->queryBindValuesA = array( 'Yes' );
$recsSettings->query();
// Error Check
if ( $recsSettings->errorB ) {
	// $resp->contentHeader .= ' Error: ' . $recsSettings->messageExtra . '; ' . $recsSettings->messageSQL;
} elseif ( $recsSettings->rowCount < 1 ) {
	// $resp->contentHeader .= ' Error: None Found';
} elseif ( $recsSettings->rowCount > 0 ) {
	// Use First Record
}

// App
define( 'APP_NAME', $recsSettings->rowsD[ 0 ][ 'AppName' ] );
define( 'APP_ICON_URL_50', $recsSettings->rowsD[ 0 ][ 'AppIconURL50' ] );
define( 'APP_ICON_URL_1024', $recsSettings->rowsD[ 0 ][ 'AppIconURL1024' ] );
define( 'APP_ICON_URL_LINK', $recsSettings->rowsD[ 0 ][ 'AppIconURLLink' ] );

// Locale
define( 'APP_LANG_CODE', $recsSettings->rowsD[ 0 ][ 'AppLangCode' ] ); // https://en.wikipedia.org/wiki/List_of_ISO_639-1_codes
define( 'APP_COUNTRY_CODE', $recsSettings->rowsD[ 0 ][ 'AppCountryCode' ] ); // https://en.wikipedia.org/wiki/List_of_ISO_3166_country_codes
define( 'APP_LOCALE', APP_LANG_CODE . '_' . APP_COUNTRY_CODE );
define( 'APP_TIMEZONE_ID', $recsSettings->rowsD[ 0 ][ 'AppTimezoneID' ] ); // https://www.php.net/manual/en/timezones.php
define( 'APP_CURRENCY', $recsSettings->rowsD[ 0 ][ 'AppCurrency' ] );

// Formats
define( 'DATETIME_FORMAT_DISPLAY_DATE', $recsSettings->rowsD[ 0 ][ 'FormatDisplayDate' ] );
define( 'DATETIME_FORMAT_DISPLAY_TIMESTAMP', $recsSettings->rowsD[ 0 ][ 'FormatDisplayTS' ] );
define( 'DATETIME_FORMAT_DISPLAY_TIMESTAMP_SECONDS', $recsSettings->rowsD[ 0 ][ 'FormatDisplayTSSecs' ] );
define( 'DATETIME_FORMAT_DISPLAY_TIME', $recsSettings->rowsD[ 0 ][ 'FormatDisplayTime' ] );

// Contact
define( 'APP_EMAIL_FROM', $recsSettings->rowsD[ 0 ][ 'AppEmailFrom' ] );
define( 'TWITTER_SITE', $recsSettings->rowsD[ 0 ][ 'TwitterSite' ] );
define( 'TWITTER_AUTHOR', $recsSettings->rowsD[ 0 ][ 'TwitterAuthor' ] );

// Features
define( 'TWOFACTORAUTH_ENABLED', true );
define( 'CONTENT_LOAD_NOW', true );
define( 'LOGOUT_AUTO_SECONDS', $recsSettings->rowsD[ 0 ][ 'LogoutAutoSeconds' ] );
define( 'APP_PASSWORD_LENGTH_GENERATED', 15 );

// SMTP
define( 'SMTP_HOST_MAILGUN', $recsSettings->rowsD[ 0 ][ 'SMTPHost' ] );
define( 'SMTP_PORT_MAILGUN', $recsSettings->rowsD[ 0 ][ 'SMTPPort' ] );
define( 'SMTP_USERNAME_MAILGUN', $recsSettings->rowsD[ 0 ][ 'SMTPUsername' ] );
define( 'SMTP_PASSWORD_MAILGUN', $recsSettings->rowsD[ 0 ][ 'SMTPPassword' ] );
define( 'SMTP_USEAUTH_MAILGUN', ( $recsSettings->rowsD[ 0 ][ 'SMTPUseAuth' ] === 'Yes' ? true : false ) ); // true or false
define( 'SMTP_SECURE_MAILGUN', $recsSettings->rowsD[ 0 ][ 'SMTPAuthType' ] ); // tls or ssl

// Twillow for SMS
define( 'SMS_PHONENUM_TWILLO', $recsSettings->rowsD[ 0 ][ 'TwilloPhoneNumber' ] );
define( 'SMS_APIKEY_TWILLO', $recsSettings->rowsD[ 0 ][ 'TwilloAPIKey' ] );
define( 'SMS_APISECRET_TWILLO', $recsSettings->rowsD[ 0 ][ 'TwilloAPISecret' ] );

// Stripe
define( 'STRIPE_CURRENCY_CODE', $recsSettings->rowsD[ 0 ][ 'StripeCurrencyCode' ] );
define( 'STRIPE_KEY_LIVE_SECRET', $recsSettings->rowsD[ 0 ][ 'StripeKeyLiveSecret' ] );
define( 'STRIPE_KEY_LIVE_PUBLIC', $recsSettings->rowsD[ 0 ][ 'StripeKeyLivePublic' ] );
define( 'STRIPE_KEY_TEST_SECRET', $recsSettings->rowsD[ 0 ][ 'StripeKeyTestSecret' ] );
define( 'STRIPE_KEY_TEST_PUBLIC', $recsSettings->rowsD[ 0 ][ 'StripeKeyTestPublic' ] );
$stripeMode = 'Test'; // Test or Live
if ( $stripeMode === 'Live' ) {
	define( 'STRIPE_KEY_SECRET', $recsSettings->rowsD[ 0 ][ 'StripeKeyLiveSecret' ] );
	define( 'STRIPE_KEY_PUBLIC', $recsSettings->rowsD[ 0 ][ 'StripeKeyLivePublic' ] );
} else {
	define( 'STRIPE_KEY_SECRET', $recsSettings->rowsD[ 0 ][ 'StripeKeyTestSecret' ] );
	define( 'STRIPE_KEY_PUBLIC', $recsSettings->rowsD[ 0 ][ 'StripeKeyTestPublic' ] );
}

// APIs Other
define( 'GOOGLE_MAPS_KEY', $recsSettings->rowsD[ 0 ][ 'GoogleMapsKey' ] );

///////////////////////////////////////////////////////////
// Arrays
define( 'ARRAY_YESNO', array( 'Yes', 'No' ) );

define( 'ARRAY_MONTHS_NAME', array( 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December' ) );
define( 'ARRAY_MONTHS_ABBREV', array( 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec' ) );
define( 'ARRAY_MONTHS_NUM', array( '1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12' ) );

define( 'ARRAY_HOURSOFDAY', array( '8 am', '9 am', '10 am', '10 am', '11 am', 'Noon', '1 pm', '2 pm', '3 pm', '4 pm', '5 pm', '6 pm', '7 pm', '8 pm' ) );

define( 'ARRAY_STATES_NAMES', array( 'Alabama', 'Alaska', 'Arizona', 'Arkansas', 'California', 'Colorado', 'Connecticut', 'Delaware', 'Florida', 'Georgia', 'Hawaii', 'Idaho', 'Illinois', 'Indiana', 'Iowa', 'Kansas', 'Kentucky', 'Louisiana', 'Maine', 'Maryland', 'Massachusetts', 'Michigan', 'Minnesota', 'Mississippi', 'Missouri', 'Montana', 'Nebraska', 'Nevada', 'New Hampshire', 'New Jersey', 'New Mexico', 'New York', 'North Carolina', 'North Dakota', 'Ohio', 'Oklahoma', 'Oregon', 'Pennsylvania', 'Rhode Island', 'South Carolina', 'South Dakota', 'Tennessee', 'Texas', 'Utah', 'Vermont', 'Virginia', 'Washington', 'West Virginia', 'Wisconsin', 'Wyoming' ) );
define( 'ARRAY_STATES_ABBREV', array( 'AK', 'AL', 'AR', 'AS', 'AZ', 'CA', 'CO', 'CT', 'DC', 'DE', 'FL', 'GA', 'GU', 'HI', 'IA', 'ID', 'IL', 'IN', 'KS', 'KY', 'LA', 'MA', 'MD', 'ME', 'MI', 'MN', 'MO', 'MP', 'MS', 'MT', 'NC', 'ND', 'NE', 'NH', 'NJ', 'NM', 'NV', 'NY', 'OH', 'OK', 'OR', 'PA', 'PR', 'RI', 'SC', 'SD', 'TN', 'TX', 'UM', 'UT', 'VA', 'VI', 'VT', 'WA', 'WI', 'WV', 'WY' ) );

define( 'ARRAY_DAYSTOPAY', array( '5', '10', '15', '30', '45', '60', '90' ) );

define( 'ARRAY_SMTP_AUTHTYPE', array( 'tls', 'ssl' ) );
?>