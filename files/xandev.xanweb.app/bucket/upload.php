<?php
// Init
require_once( "../../../init.php" );

// Prep
$ds = DIRECTORY_SEPARATOR;
$filesArrayName = 'file'; // $_FILES array name
$uploadOk = 1;

// Result Init
$resultArray[ 'Message' ] = '';
$resultArray[ 'Log' ] = '';
$resultArray[ 'Log' ] .= 'disk_free_space = ' . \xan\numBytesToString( disk_free_space( "/" ) ) . ' ';
$resultArray[ 'Log' ] .= 'upload_max_filesize = ' . ini_get( 'upload_max_filesize' ) . ' ';
$resultArray[ 'Log' ] .= 'post_max_size = ' . ini_get( 'post_max_size' ) . ' ';
$resultArray[ 'Log' ] .= 'file_uploads = ' . ini_get( 'file_uploads' ) . ' ';

///////////////////////////////////////////////////////////
// Params Get
$pKey = \xan\paramEncode( $_POST[ 'fileKey' ] ); // Like 'Contacts/123/PhotoFN'
$pFileTypes = \xan\paramEncode( $_POST[ 'fileTypes' ] );

// Validate Params
$resultArray[ 'Log' ] .= '$pKey = ' . $pKey . ' ';
if ( \xan\isEmpty( $pKey ) ) {
	$resultArray[ 'Message' ] .= 'The fileKey is empty. ';
	$uploadOk = 0;
}
$resultArray[ 'Log' ] .= '$pFileTypes = ' . $pFileTypes . ' ';
if ( \xan\isEmpty( $pFileTypes ) ) {
	$resultArray[ 'Message' ] .= 'The fileTypes is empty. ';
	$uploadOk = 0;
}

// Get File Info
$resultArray[ 'FilePathBase' ] = URL_BUCKET;
$resultArray[ 'FileKey' ] = $pKey;
$resultArray[ 'FileName' ] = $_FILES[ $filesArrayName ][ "name" ];
$resultArray[ 'FileNameBase' ] = basename( $_FILES[ $filesArrayName ][ "name" ] );
$resultArray[ 'FileType' ] = $_FILES[ $filesArrayName ][ "type" ];
$resultArray[ 'FileError' ] = $_FILES[ $filesArrayName ][ "error" ];
$resultArray[ 'SizeBytes' ] = $_FILES[ $filesArrayName ][ "size" ];
$resultArray[ 'FileNameTemp' ] = $_FILES[ $filesArrayName ][ "tmp_name" ];

// Get target dir
$target_dir = dirname( __FILE__ ) . $ds . $pKey;
$resultArray[ 'Log' ] .= '$target_dir = ' . $target_dir . ' ';

// Append Path
if ( !is_dir( $target_dir . $ds ) ) {
	$mkdirResult = mkdir( $target_dir . $ds, 0755, true );
	$resultArray[ 'Log' ] .= 'Dir Created = ' . $mkdirResult . ' ';
} else {
	$resultArray[ 'Log' ] .= 'Dir Exists ; ';
	$chmodResult = chmod( $target_dir . $ds, 0755 );
	if ( $chmodResult = true ) {
		$resultArray[ 'Log' ] .= 'Chmod ok ; ';
	} else {
		$resultArray[ 'Log' ] .= 'Chmod fail ; ';
	}
}

// Get target file
$target_file = $target_dir . $ds . basename( $_FILES[ $filesArrayName ][ "name" ] );
$resultArray[ 'Log' ] .= '$target_file = ' . $target_file . ' ';

// Check if file already exists
if ( file_exists( $target_file ) ) {
	$resultArray[ 'Message' ] .= 'File already exists. ';
	//    $uploadOk = 0;
}

// Check file extension
$fileExtension = strtolower( pathinfo( $target_file, PATHINFO_EXTENSION ) );
// Get valid extensions
$validExtensions = array();
if ( $pFileTypes === FILE_TYPES_IMAGES ) {
	$validExtensions = FILE_TYPES_IMAGES_EXTENSIONS;
}
if ( !in_array( $fileExtension, $validExtensions ) ) {
	$resultArray[ 'Message' ] .= '"' . $fileExtension . '" files are not accepted. Try: ' . join( ", ", $validExtensions ) . '. ';
	$uploadOk = 0;
}

// Check if image file is a actual image or fake image
if ( isset( $_POST[ "submit" ] ) ) {
	$imageMetaArray = getimagesize( $_FILES[ $filesArrayName ][ "tmp_name" ] );
	if ( $imageMetaArray !== false ) {
		$resultArray[ 'Log' ] .= 'File is Mime = ' . $imageMetaArray[ "mime" ] . ' ';
	} else {
		$resultArray[ 'Message' ] .= 'File is not an image. ';
		$uploadOk = 0;
	}
}

// Check file size
$sizeMaxBytes = ( 1024 * 1024 ) * 10; // MB
if ( $_FILES[ $filesArrayName ][ "size" ] > $sizeMaxBytes ) {
	$resultArray[ 'Message' ] .= 'File is too large. Must be less than ' . \xan\numBytesToString( $sizeMaxBytes ) . ' but is ' . \xan\numBytesToString( $_FILES[ $filesArrayName ][ "size" ] ) . '. ';
	$uploadOk = 0;
}

///////////////////////////////////////////////////////////
// Check if $uploadOk is set to 0 by an error
if ( $uploadOk == 0 ) {
	$resultArray[ 'Log' ] .= 'File not uploaded. ';
	$resultArray[ 'Message' ] .= 'File not uploaded. ';
	
	// if everything is ok, try to upload file
} else {
	xan\filesDeleteFromDir( $target_dir );
	if ( move_uploaded_file( $_FILES[ $filesArrayName ][ "tmp_name" ], $target_file ) ) {
		$resultArray[ 'Log' ] .= 'File was uploaded. ';
		$uploadOk = 1;
	} else {
		$resultArray[ 'Message' ] .= 'Upload Error when moving uploaded file. ';
		$uploadOk = 0;
	}
}

///////////////////////////////////////////////////////////
// Return json
//$resultArray[ 'Log' ] = ''; // Don't send the log.
$resultArray[ 'IsOK' ] = $uploadOk;

$resultJSON = json_encode( $resultArray );
echo $resultJSON;
?>