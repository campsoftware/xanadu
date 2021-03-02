<?php 

	// Cryptographic functions using OpenSSL and AES256-GCM.
	
	namespace aloe;	

	/*

	Example of encryption and decryption usage...
	
    $key = 'H8xa966GP364WAL5D5ZWqjKufuTj9mGYCkUG49gqa6MTxcHNNDJjD2XmTWCfVx6h';
    echo '<p>Key: ' . $key . '</p>';
   
	$plaintext = "This is another test!";
	echo '<p>Plaintext: '. $plaintext . '</p>';
	
	$encrypted = \aloe\encrypt( $plaintext, $key );
	echo '<p>Encrypted: '. $encrypted['ciphertext'] . '</p>';

	$decrypted = \aloe\decrypt( $encrypted['ciphertext'], $key, $encrypted['iv'], $encrypted['tag'] );
	echo '<p>Decrypted: '. $decrypted . '</p>';	
	
	die;
	
	*/
	
	function encrypt( $plaintext, $key ) {
			
		// Specify the encryption settings.
		$cipher = 'aes-256-gcm';
		$options = 0;
		$ivlen = openssl_cipher_iv_length( $cipher );
		$iv = openssl_random_pseudo_bytes( $ivlen );
		
		// Encrypt the plaintext value.
		$ciphertext = openssl_encrypt( $plaintext, $cipher, $key, $options, $iv, $tag );
				
		// Create an array based on the encryption.
		$encrypted = [
			'ciphertext' => base64_encode( $ciphertext ),
			'iv' => base64_encode( $iv ),
			'tag' => base64_encode( $tag )		
		];
		
		// Confirm that the values being returned can be used decode the cipher.
		$decrypted = \aloe\decrypt( $encrypted['ciphertext'], $key, $encrypted['iv'], $encrypted['tag'] );
		
		// If the decryption failed...
		if ( $decrypted != $plaintext ) {
			return null;
		}		
		
		return $encrypted;
	
	}
	
	function decrypt( $ciphertext, $key, $iv, $tag ) {
	
		$cipher = 'aes-256-gcm';
		$options = 0;
		
		$ciphertext = base64_decode( $ciphertext );
		$iv = base64_decode( $iv );
		$tag = base64_decode( $tag );
		$decrypted = openssl_decrypt( $ciphertext, $cipher, $key, $options, $iv, $tag );
		
		return $decrypted;
	
	}	
	
	
	/*

	Example of hash usage...	
	
	$test = 'hello world!';
	$hashed = \aloe\hash( $test );
	
	This results in an array such as this:
	
	array(2) { 	
		["hashed"]=> string(128) "00540d7cd0f25dbc25f9b945fcb1e8753bc8d19890dba82559309251a39c8d0cfdaf84be1cc880143657570e78555281908fb3447421ad45fc165d2fe1091317" 
		["salt"]=> string(46) "5bcb68009063c6.583379865bcb6800906421.98637625" 
	}		
	
	*/
	
	function hash( $value, $salt = '' ) {
	
		if ( $salt == '' ) {
			$salt = uniqid( '', true ) . uniqid( '', true );
		}
		
		// Note the use of the default namespace to resolve duplicate
		// function name. Without this, the call to "hash" would
		// resolve to the "aloe" namespace and cause recursion.
		$hashed = \hash( 'sha512', $value . $salt, false );	
		
		$hashed = [
			'hashed' => $hashed,
			'salt' => $salt			
		];		
		
		return $hashed;
		
	}


?>