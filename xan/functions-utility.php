<?php

namespace xan;

///////////////////////////////////////////////////////////
// Is
function isEmpty( $value ) {
    if ( $value === '' || $value === null ) {
        return true;
    } else {
        return false;
    }
}

function isNotEmpty( $value ) {
    if ( $value === '' || $value === null ) {
        return false;
    } else {
        return true;
    }
}


///////////////////////////////////////////////////////////
// Strings
function strTagsRemoveScript( $code ) {
    $code = strSubstitute( $code, '<script>', '' );
    return strSubstitute( $code, '</script>', '' );
}

function strSubstitute( $subject, $search, $replace ) { // From http://jonathanstark.com/fm/filemaker-to-php-translation-table.php
    return ( str_replace( $search, $replace, $subject ) );
}

function strPatternCount( $subject, $search ) { // From http://jonathanstark.com/fm/filemaker-to-php-translation-table.php
    return ( substr_count( strtolower( $subject ), strtolower( $search ) ) );
}

// Left Middle Right
function strLeft( $text, $number ) { // From http://jonathanstark.com/fm/filemaker-to-php-translation-table.php
    return ( substr( $text, 0, $number ) );
}

function strMiddle( $text, $start, $numchars ) { // From http://jonathanstark.com/fm/filemaker-to-php-translation-table.php
    return ( substr( $text, $start - 1, $numchars ) );
}

function strRight( $text, $number ) { // From http://jonathanstark.com/fm/filemaker-to-php-translation-table.php
    return ( substr( $text, $number * -1 ) );
}

function strLeftWords( $text, $number ) { // From http://jonathanstark.com/fm/filemaker-to-php-translation-table.php
    return ( implode( ' ', array_slice( str_word_count( $text, 1 ), 0, $number ) ) );
}

function strMiddleWords( $text, $start, $numwords ) { // From http://jonathanstark.com/fm/filemaker-to-php-translation-table.php
    return ( implode( ' ', array_slice( str_word_count( $text, 1 ), $start - 1, $numwords ) ) );
}

function strRightWords( $text, $number ) { // From http://jonathanstark.com/fm/filemaker-to-php-translation-table.php
    return ( implode( ' ', array_slice( str_word_count( $text, 1 ), $number * -1 ) ) );
}

function strFilterKeepAlphanumeric( $text ){
    return preg_replace( '/[^a-zA-Z0-9]/', '', $text );
}

// UUID
function strUUID() {
    return str_replace( '.', '', uniqid( '', true ) );
}

function strUUIDValid( $UUID ) {
    if ( !preg_match( "/^[A-Za-z0-9-]+$/", $UUID ) ) { // Letters, Number, Hyphen
        return false;
    } else {
        return true;
    }
}


///////////////////////////////////////////////////////////
// Numbers
function numDisplay( $num, $decimals = 0 ) {
    return number_format( $num, $decimals, ".", "," );
}

function numBytesToString( $bytes, $dec = 2 ) {
    $size = array( 'B', 'K', 'M', 'G', 'T', 'P', 'E', 'Z', 'Y' );
    $factor = floor( ( strlen( $bytes ) - 1 ) / 3 );
    return sprintf( "%.{$dec}f", $bytes / pow( 1024, $factor ) ) . @$size[ $factor ];
}


///////////////////////////////////////////////////////////
// Date, Timestamp, Time
function dateTimeFromString( $timeString, $format ) {
    // Formats: DATETIME_FORMAT_LOG > 20200105_183747.225600
    // TimeString: now, - 5 hours, 1/7/2020 5pm
    return date( $format, strtotime( $timeString ) );
}

function dateFromSQLDate( $sqlDate ) {
    $date = date_create( $sqlDate );
    return date_format( $date, "n/j/Y" );
}

function dateNowSQL() {
    return date( 'Y-m-d' );
}

function dateTimeNowSQL() {
    return date( 'Y-m-d H:i:s' );
}

function timeNowSQL() {
    return date( 'H:i:s' );
}

function microsecsNow() {
    return microtime( true );
}

function microsecsDiff( $pMicrosecs ) {
    return round( ( microsecsNow() - $pMicrosecs ), 4 ) . "s";
}

///////////////////////////////////////////////////////////
// IP Addresses
function ipOfBrowser() {
    if ( array_key_exists( 'HTTP_X_FORWARDED_FOR', $_SERVER ) ) {
        return $_SERVER[ 'HTTP_X_FORWARDED_FOR' ];
    } else if ( array_key_exists( 'REMOTE_ADDR', $_SERVER ) ) {
        return $_SERVER[ 'REMOTE_ADDR' ];
    } else if ( array_key_exists( 'HTTP_CLIENT_IP', $_SERVER ) ) {
        return $_SERVER[ 'HTTP_CLIENT_IP' ];
    }
    return "";
}

function ipOfServerExternal() {
    return file_get_contents( 'https://api.ipify.org' );
}

// URLs
function urlContent( $pURL, $pPostDict = [] ) {
    // Note - Requires: ini_set( "allow_url_fopen", 1 );
    // Calling Example
    if ( false ) {
        $content = urlContent( 'https://xandev.xanweb.app/postTest.php' );
        $content = urlContent( 'https://xandev.xanweb.app/postTest.php', array( 'var1' => 'one', 'var2' => 'two' ) );
    }

    if ( $pPostDict === [] ) {
        // Post = No
        return file_get_contents( $pURL );
    } else {
        // Post = Yes
        $postdata = http_build_query( $pPostDict );
        $opts = array( 'http' =>
            array(
                'method' => 'POST',
                'header' => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $postdata
            )
        );
        $context = stream_context_create( $opts );
        return file_get_contents( $pURL, false, $context );
    }
}


///////////////////////////////////////////////////////////
// Arrays and Dictionaries

// Arrays
function arrayImplodeIndexed( $pArray, $pSeparator ) {
    //    if ( !is_array( $pArray ) ) {
    //        return '';
    //    }
    //    if ( count( $pArray ) < 1 ) {
    //        return '';
    //    }
    return implode( $pSeparator, $pArray );
}

// Dictionaries aka Associative
function arrayImplodeDict( $pDict, $pPrefix, $pMiddle, $pSuffix ) {
    //    if ( !is_array( $pDict ) ) {
    //        return '';
    //    }
    //    if ( count( $pDict ) == 0 ) {
    //        return '';
    //    }
    $string = '';
    foreach ( $pDict as $key => $value ) {
        $string .= "$pPrefix$key$pMiddle$value$pSuffix";
    }
    return $string;
}

function arrayImplodeDictAsCSSStyle( $pDict ) {
    //    if ( !is_array( $pDict ) ) {
    //        return '';
    //    }
    //    if ( count( $pDict ) == 0 ) {
    //        return '';
    //    }
    // Nice for Visual and CSS Styles: NameFirst: Hal; NameLast: Gumbert;
    return arrayImplodeDict( $pDict, '', ': ', '; ' );
}

///////////////////////////////////////////////////////////
// Param Handling
function paramEncode( $data ) {
    // $data = strip_tags( $data );
    $data = htmlspecialchars( $data, ENT_QUOTES, 'UTF-8' );
    $data = trim( $data );
    return $data;
}

function paramDecode( $data ) {
    // $data = strip_tags( $data );
    $data = htmlspecialchars_decode( $data, ENT_QUOTES );
    return $data;
}


///////////////////////////////////////////////////////////
// Value Handling
function valuePOST( $name, $default = '', $sanitize = true ) {
    if ( $sanitize ) {
        return paramEncode( $_POST[ $name ] ?? $default );
    } else {
        return $_POST[ $name ] ?? $default;
    }
}

function valueGET( $name, $default = '', $sanitize = true ) {
    if ( $sanitize ) {
        return paramEncode( $_GET[ $name ] ?? $default );
    } else {
        return $_GET[ $name ] ?? $default;
    }
}

///////////////////////////////////////////////////////////
// Files
function fileRead( $file_path ) {
    // Assume that we will not be able to read the file.
    $file = null;

    // If the file exists...
    if ( file_exists( $file_path ) ) {

        // Read the file.
        $file = file_get_contents( $file_path );

    }

    return $file;
}

function fileWrite( $path, $content, $append = false ) {
    $file = null;
    if ( $append ) {
        $file = file_put_contents( $path, $content, FILE_APPEND );
    } else {
        $file = file_put_contents( $path, $content );
    }
    return $file;
}

function dirCreate( $path, $mode = 0755 ) {
    if ( !file_exists( $path ) ) {
        $mkdir = mkdir( $path, $mode, true );
    } else {
        $chmod = chmod( $path, $mode );
    }
    return file_exists( $path );
}

function filesDeleteFromDir( $str ) {
    //$theDir = dirname( __FILE__ ) . $ds . 'Contacts/myID';
    //xanFilesDeleteFromDir( $theDir );

    $files = glob( $str . '/*' );
    foreach ( $files as $file ) {
        if ( is_file( $file ) ) {
            unlink( $file );
        }
    }
}

function filesDeleteRecursive( $str ) {
    //$theDir = dirname( __FILE__ ) . $ds . 'Contacts/myID';
    //xanFilesDeleteRecursive( $theDir );

    // Check for files
    if ( is_file( $str ) ) {

        // If it is file then remove by
        // using unlink function
        return unlink( $str );
    } // If it is a directory.
    elseif ( is_dir( $str ) ) {

        // Get the list of the files in this
        // directory
        $scan = glob( rtrim( $str, '/' ) . '/*' );

        // Loop through the list of files
        foreach ( $scan as $index => $path ) {

            // Call recursive function
            filesDeleteRecursive( $path );
        }

        // Remove the directory itself
        return @rmdir( $str );
    }
}

///////////////////////////////////////////////////////////
// Encrypt / Decrypt / Obfuscate
// From: https://nazmulahsan.me/simple-two-way-function-encrypt-decrypt-string/
// The $secret_iv SHOULD be different for each time something is encrypted.
// We're cheating by using FORM_OBFUSCATE_KEY.

function encrypt( $string, $key, $secret_iv = FORM_OBFUSCATE_KEY ) {
    $secret_key = $key;

    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    $output = base64_encode( openssl_encrypt( $string, $encrypt_method, $key, 0, $iv ) );
    $output = str_replace( '=', '^', $output );

    return $output;
}

function decrypt( $string, $key, $secret_iv = FORM_OBFUSCATE_KEY ) {
    $secret_key = $key;

    $encrypt_method = "AES-256-CBC";
    $key = hash( 'sha256', $secret_key );
    $iv = substr( hash( 'sha256', $secret_iv ), 0, 16 );

    $string = str_replace( '^', '=', $string );
    $output = openssl_decrypt( base64_decode( $string ), $encrypt_method, $key, 0, $iv );

    return $output;
}

function formObfuscate( $string, $time ) {
    if ( FORM_OBFUSCATE ) {
        return encrypt( $string, $time . FORM_OBFUSCATE_KEY );
    } else {
        return $string;
    }
}


///////////////////////////////////////////////////////////
// Request Validation
function isAjax() {
	return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
}


///////////////////////////////////////////////////////////
// Javascript

// Scroll
function jsScrollToTop() {
    ob_start();
    ?>
    $( window ).scrollTop( 0 );
    <?php
    return ob_get_clean();
}

function jsScrollTo( $selector ) {
    ob_start();
    ?>
    $( "<?= $selector ?>" )[ 0 ].scrollIntoView( { behavior: "smooth", block: "center" } );
    <?php
    return ob_get_clean();
}

// Console Append
function jsConsoleMsgAppend( $msg ) {
    return 'xanConsoleMsgs.push( "' . addslashes( $msg ) . '" ); ';
}


///////////////////////////////////////////////////////////
// Environment From
// https://wp-mix.com/php-get-server-information/
function environ_system_cores() {
	$cmd = "uname";
	$OS = strtolower( trim( shell_exec( $cmd ) ) );
	
	switch ( $OS ) {
		case( 'linux' ):
			$cmd = "cat /proc/cpuinfo | grep processor | wc -l";
			break;
		case( 'freebsd' ):
			$cmd = "sysctl -a | grep 'hw.ncpu' | cut -d ':' -f2";
			break;
		default:
			unset( $cmd );
	}
	
	if ( $cmd != '' ) {
		$cpuCoreNo = intval( trim( shell_exec( $cmd ) ) );
	}
	
	return empty( $cpuCoreNo ) ? 1 : $cpuCoreNo;
}

function environ_disk_usage_app() {
	$diskuse = shell_exec( 'du -shc ' . PATH_ROOT_OS . '* | sort -rh' );
	$diskuse = strSubstitute( $diskuse, PATH_ROOT_OS, '/' );
	return $diskuse;
}

function environ_system_load( $coreCount = 2, $interval = 1 ) {
	$rs = sys_getloadavg();
	$interval = $interval >= 1 && 3 <= $interval ? $interval : 1;
	$load = $rs[ $interval ];
	return round( ( $load * 100 ) / $coreCount, 2 );
}

function environ_server_memory_total() {
	$free = shell_exec( 'free' );
	$free = (string)trim( $free );
	$free_arr = explode( "\n", $free );
	$mem = explode( " ", $free_arr[ 1 ] );
	$mem = array_filter( $mem );
	$mem = array_merge( $mem );
	$mem = $mem[ 1 ] * 1024;
	$mem = round( $mem, 2 );
	return $mem;
}

function environ_server_memory_used() {
	$free = shell_exec( 'free' );
	$free = (string)trim( $free );
	$free_arr = explode( "\n", $free );
	$mem = explode( " ", $free_arr[ 1 ] );
	$mem = array_filter( $mem );
	$mem = array_merge( $mem );
	$mem = $mem[ 2 ] * 1024;
	$mem = round( $mem, 2 );
	return $mem;
}

function environ_server_memory_usage() {
	$free = shell_exec( 'free' );
	$free = (string)trim( $free );
	$free_arr = explode( "\n", $free );
	$mem = explode( " ", $free_arr[ 1 ] );
	$mem = array_filter( $mem );
	$mem = array_merge( $mem );
	$memory_usage = $mem[ 2 ] / $mem[ 1 ] * 100;
	$memory_usage = round( $memory_usage, 2 );
	return $memory_usage;
}

function environ_disk_usage() {
	$disktotal = disk_total_space( '/' );
	$diskfree = disk_free_space( '/' );
	$diskuse = round( 100 - ( ( $diskfree / $disktotal ) * 100 ) ) . '%';
	return $diskuse;
}

function environ_server_uptime() {
	$uptime = round( preg_replace( '/\.[0-9]+/', '', file_get_contents( '/proc/uptime' ) ) / 86400, 2 );
	return $uptime;
}

function environ_number_processes() {
	$proc_count = 0;
	$dh = opendir( '/proc' );
	
	while ( $dir = readdir( $dh ) ) {
		if ( is_dir( '/proc/' . $dir ) ) {
			if ( preg_match( '/^[0-9]+$/', $dir ) ) {
				$proc_count++;
			}
		}
	}
	
	return $proc_count;
}

function environ_http_connections() {
	if ( function_exists( 'exec' ) ) {
		$www_total_count = 0;
		@exec( 'netstat -an | egrep \':80|:443\' | awk \'{print $5}\' | grep -v \':::\*\' |  grep -v \'0.0.0.0\'', $results );
		$unique = [];
		$www_unique_count = 0;
		foreach ( $results as $result ) {
			$array = explode( ':', $result );
			$www_total_count++;
			
			if ( preg_match( '/^::/', $result ) ) {
				$ipaddr = $array[ 3 ];
			} else {
				$ipaddr = $array[ 0 ];
			}
			
			if ( !in_array( $ipaddr, $unique ) ) {
				$unique[] = $ipaddr;
				$www_unique_count++;
			}
		}
		unset ( $results );
		return count( $unique );
	}
	return '';
}

?>