<?php

// Session management functions.

namespace aloe {

    function session_init( $timeout, $regenerate, $info )
    {

        // Call session_init with a $regenerate value of FALSE
        // in cases where you do not want a new session ID
        // generated. For example, when AJAX calls are being made.

        // Change the PHP Session ID cookie name from PHPSESSID.
        session_name( 'aloeSID' );

        // Start a new session, or resume an existing session.
        @session_start();

        // Set Session Data
        $_SESSION[SES_INFO] = $info;
        if (!isset( $_SESSION[SES_BEGIN])){
            $_SESSION[SES_BEGIN] = date( 'Y-m-d H:i:s' );
        }
        $_SESSION[SES_CHANGE] = date( 'Y-m-d H:i:s' );


        // Update the current session's id with a newly generated one,
        // and delete the old associated session file.
        if ( $regenerate === TRUE ) {
            @session_regenerate_id( TRUE );
//            file_log( '>>>Session New<<<', $info, join( ';', $_SESSION), session_id(), '', '' );
//        } else {
//            file_log( '---Session Old---', $info,  join( ';', $_SESSION), session_id(), '', '' );
        }

        // Force the PHP session cookie to expire after "SESSION_TIMEOUT" minutes of inactivity.
        //setcookie( session_name(), session_id(), time() + $timeout, '/', 'campsoftware.com', TRUE, TRUE );
        setcookie( session_name(), session_id(), time() + $timeout, '/' );
    }

    function session_terminate()
    {

        // Destroy the session.
        @session_start();
        @session_unset();
        @session_destroy();

        // Kill the cookie.
        @setcookie( session_name(), session_id(), time() - 3600, '/' );

    }

}

?>