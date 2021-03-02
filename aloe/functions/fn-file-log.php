<?php

function file_log( $type, $desc1, $desc2, $pageName, $userLogin, $userID )
{
    $path = PATH_ROOT_LOGS . date( "Ymd" ) . ".txt";

    $dateNow = DateTime::createFromFormat( "U.u", microtime( true ) );
    $dateFormatted = $dateNow->format( "Ymd_His.u" );

    file_put_contents( $path, $dateFormatted . "|" . getBrowserIP() . "|" . $type . "|" . $desc1 . "|" . $desc2 . "|" . $pageName . "|" . $userLogin . "|" . $userID . PHP_EOL, FILE_APPEND );
}

function getBrowserIP()
{
    if ( array_key_exists( "HTTP_X_FORWARDED_FOR", $_SERVER ) ) {
        return $_SERVER[ "HTTP_X_FORWARDED_FOR" ];
    } else if ( array_key_exists( "REMOTE_ADDR", $_SERVER ) ) {
        return $_SERVER[ "REMOTE_ADDR" ];
    } else if ( array_key_exists( "HTTP_CLIENT_IP", $_SERVER ) ) {
        return $_SERVER[ "HTTP_CLIENT_IP" ];
    }
    return "";
}

?>