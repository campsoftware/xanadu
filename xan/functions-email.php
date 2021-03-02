<?php

namespace xan;

///////////////////////////////////////////////////////////
// Email
/*

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Email Simple
$emailSend = xanEmail_PHPMailer( "mailgun", true, "from@foo.com", "to@foo.com", "Subject", "BodyHTML", "BodyText", PATH_ROOT_OS . 'app/images/logo.png' ) ;
if ( xan\isNotEmpty( $emailSend ) ) {
    $page[ PAGE_CONTENTAREA ] .= '>' . $emailSend . '<';
}

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
// Email Detailed
$emailSend = xanEmail_PHPMailer( "mailgun" ) ;
try {
    $emailSend->setFrom("hal@campsoftware.com", "Hal Gumbert") ;
    $emailSend->addAddress("hal@campsoftware.com", "Hal Gumbert") ;

    $emailSend->isHTML( true ) ;
    $emailSend->Subject = "Xanadu Email Test" ;
    $emailSend->Body = "This is the HTML message body <b>in bold!</b>" ;
    $emailSend->AltBody = "This is the Text message body without html" ;

    $emailSend->send();
    echo "Email sent.";
} catch (Exception $e) {
    xanLog("Catch", "Email Error: " . $emailSend->ErrorInfo . " Details: " . print_r( $emailSend ), $e->getMessage(), xanSanitize( $_SERVER["PHP_SELF"] ), $_SESSION[ "Login" ] ?? "No", $_SESSION[ 'recsUsersCURRENT' ][ UUIDUSERS ] ?? "No");
    echo "Email Error: ", $emailSend->ErrorInfo;
}
*/

// - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
require_once( PATH_ROOT_INCLUDE . "PHPMailer/6.0.5/src/Exception.php" );
require_once( PATH_ROOT_INCLUDE . "PHPMailer/6.0.5/src/PHPMailer.php" );
require_once( PATH_ROOT_INCLUDE . "PHPMailer/6.0.5/src/SMTP.php" );

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function emailSend( $smtpServerName, $autoSend = false, $messageFrom = "", $messageTo = "", $messageSubject = "", $messageBodyHTML = "", $messageBodyText = "", $messageAttachPath = "" ) {
    // PHP Mailer
    $mail = new PHPMailer( true );                    // Passing `true` enables exceptions
    try {
        //Server settings
        $mail->SMTPDebug = 0;                                 // Enable verbose debug output = 2
        $mail->isSMTP();                                      // Set mailer to use SMTP

        if ( $smtpServerName == "mailgun" ) {
            $mail->Host = SMTP_HOST_MAILGUN;                    // Specify main and backup SMTP servers
            $mail->SMTPAuth = SMTP_USEAUTH_MAILGUN;            // Enable SMTP authentication
            $mail->Username = SMTP_USERNAME_MAILGUN;            // SMTP username
            $mail->Password = SMTP_PASSWORD_MAILGUN;            // SMTP password
            $mail->SMTPSecure = SMTP_SECURE_MAILGUN;            // Enable 'tls' encryption, `ssl` also accepted
            $mail->Port = SMTP_PORT_MAILGUN;                    // TCP port to connect to
        }

        if ( $messageFrom !== "" ) {
            $mail->setFrom( $messageFrom );
        }
        if ( $messageTo !== "" ) {
            $mail->addAddress( $messageTo );
        }
        if ( $messageSubject !== "" ) {
            $mail->Subject = $messageSubject;
        }
        if ( $messageBodyHTML !== "" ) {
            $mail->isHTML( true );
            $mail->Body = $messageBodyHTML;
            $mail->AltBody = $messageBodyText;
        }
        if ( $messageBodyHTML === "" && $messageBodyText !== "" ) {
            $mail->isHTML( false );
            $mail->Body = $messageBodyText;
        }
        if ( $messageAttachPath !== "" ) {
            if ( file_exists( $messageAttachPath ) ) {
                $mail->addAttachment( $messageAttachPath, pathinfo( $messageAttachPath, PATHINFO_FILENAME ) );
            }
        }

        if ( $autoSend ) {
            $mail->send();
        }

        return $mail->ErrorInfo;
    } catch ( Exception $e ) {
        logEventToFile( "Catch", "xanPHPMailer: " . $mail->ErrorInfo, print_r( $e, true ), paramEncode( $_SERVER[ "PHP_SELF" ] ), $_SESSION[ "Login" ] ?? "No", $_SESSION[ 'recsUsersCURRENT' ][ UUIDUSERS ] ?? "No" );
        return "Error: " . print_r( $e, true );
    }
}

function emailSendDebug( $subject, $message ) {
    $emailSend = emailSend( 'mailgun', true, APP_EMAIL_FROM, APP_EMAIL_TO_DEBUG, $subject, '', $message );
    return $emailSend;
}

?>