<?php

namespace xan;

// PHPMailer
require_once( PATH_ROOT_INCLUDE . "PHPMailer/6.0.5/src/Exception.php" );
require_once( PATH_ROOT_INCLUDE . "PHPMailer/6.0.5/src/PHPMailer.php" );
require_once( PATH_ROOT_INCLUDE . "PHPMailer/6.0.5/src/SMTP.php" );


class sender {
	// Init
	public $resultSMS = '';
	public $resultEmail = '';
	
	// Constructor
	public function __construct() {
	}
	
	// SMS
	public function sendSMS( $pToPhone, $pText ) {
		// Validate Init
		$ValidationMessage = array();
		
		// Validate ToPhone
		if ( isEmpty( $pToPhone ) ) {
			$ValidationMessage[] = "Phone Number is Blank.";
		}
		
		// Validate Text
		if ( isEmpty( $pToPhone ) ) {
			$ValidationMessage[] = "Text Message is Blank.";
		}
		
		// Invalid Response
		if ( !empty( $ValidationMessage ) ) {
			$this->resultSMS = 'Error: Cannot Send SMS: ' . implode( ", ", $ValidationMessage );
		}
		
		// Init
		$sendResult = '';
		
		// Twillo
		if ( true ) {
			// Number Filter
			$toPhone = \xan\strFilterKeepNumbers( $pToPhone );
			// Prefix with 1
			$toPhone = ( \xan\strLeft( $toPhone, 1 ) === 1 ? $toPhone : '1' . $toPhone );
			
			// Send Message
			$this->resultSMS = \xan\urlContent( 'https://' . SMS_APIKEY_TWILLO . ':' . SMS_APISECRET_TWILLO . '@api.twilio.com/2010-04-01/Accounts/' . SMS_APIKEY_TWILLO . '/Messages.xml', array( 'To' => $toPhone, 'From' => SMS_PHONENUM_TWILLO, 'Body' => $pText ) );
			// Check for Error
			$sendInfo = ( \xan\strPatternCount( $sendResult, '<ErrorCode/>' ) > 0 ? 'Success' : 'Error' );
			\xan\logEventToFile( 'Send Text via Twillo', $sendInfo . '; ' . $toPhone . '; ' . $pText . '; ', $sendResult, \xan\paramEncode( $_SERVER[ 'PHP_SELF' ] ), $_SESSION[ SESS_USER ][ 'EmailAddress' ] ?? '', $_SESSION[ SESS_USER ][ UUIDUSERS ] ?? '' );
		}
		
		// Return
		return $sendResult;
	}
	
	// Email
	public function sendEmail( $pAutoSend, $pFrom, $pTo, $pSubject, $pBodyHTML, $pBodyText, $pAttachPath = "" ) {
		// PHP Mailer
		$mail = new \PHPMailer\PHPMailer\PHPMailer( true );                    // Passing `true` enables exceptions
		try {
			//Server settings
			$mail->SMTPDebug = 0;                                 // Enable verbose debug output = 2
			$mail->isSMTP();                                      // Set mailer to use SMTP
			
			// Mailgun
			if ( true ) {
				$mail->Host = SMTP_HOST_MAILGUN;                    // Specify main and backup SMTP servers
				$mail->SMTPAuth = SMTP_USEAUTH_MAILGUN;            // Enable SMTP authentication
				$mail->Username = SMTP_USERNAME_MAILGUN;            // SMTP username
				$mail->Password = SMTP_PASSWORD_MAILGUN;            // SMTP password
				$mail->SMTPSecure = SMTP_SECURE_MAILGUN;            // Enable 'tls' encryption, `ssl` also accepted
				$mail->Port = SMTP_PORT_MAILGUN;                    // TCP port to connect to
			}
			
			if ( $pFrom !== "" ) {
				$mail->setFrom( $pFrom );
			}
			if ( $pTo !== "" ) {
				$mail->addAddress( $pTo );
			}
			if ( $pSubject !== "" ) {
				$mail->Subject = $pSubject;
			}
			if ( $pBodyHTML !== "" ) {
				$mail->isHTML( true );
				$mail->Body = nl2br( $pBodyHTML );
				$mail->AltBody = $pBodyText;
			}
			if ( $pBodyHTML === "" && $pBodyText !== "" ) {
				$mail->isHTML( false );
				$mail->Body = $pBodyText;
			}
			if ( $pAttachPath !== "" ) {
				if ( file_exists( $pAttachPath ) ) {
					$mail->addAttachment( $pAttachPath, pathinfo( $pAttachPath, PATHINFO_FILENAME ) );
				}
			}
			
			if ( $pAutoSend ) {
				$mail->send();
			}
			
			$this->resultEmail = $mail->ErrorInfo;
		} catch ( \PHPMailer\PHPMailer\Exception $e ) {
			$errorInfo = print_r( $e, true );
			\xan\logEventToFile( "Catch", "xanPHPMailer: " . $mail->ErrorInfo, $errorInfo, paramEncode( $_SERVER[ "PHP_SELF" ] ), $_SESSION[ SESS_USER ][ 'EmailAddress' ] ?? "No", $_SESSION[ SESS_USER ][ UUIDUSERS ] ?? "No" );
			$this->resultEmail = "Error: " . $errorInfo;
		}
	}
	
	
}

// Debugging
function sendEmailDebug( $subject, $message ) {
	$sender = new \xan\sender();
	$sender->sendEmail( true, APP_EMAIL_FROM, APP_EMAIL_TO_DEBUG, $subject, '', $message );
}

?>