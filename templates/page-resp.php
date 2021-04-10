<?php
ob_start();
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
		<?php
		if ( $resp->headLogoutAuto and intval( LOGOUT_AUTO_SECONDS ) > 0 ) {
			echo "\r";
			echo "\t\t" . '<!-- Session Updated:' . \xan\dateTimeFromString( $_SESSION[ SES_CHANGE ], DATETIME_FORMAT_DISPLAY_TIMESTAMP ) . '; Expires: ' . \xan\dateTimeFromString( $_SESSION[ SES_EXPIRES ], DATETIME_FORMAT_DISPLAY_TIMESTAMP ) . '; -->' . "\r";
			echo "\t\t" . '<meta http-equiv="refresh" content="' . LOGOUT_AUTO_SECONDS . ';url=' . $mmUsersLogout->URLRelative . '">' . "\r\r";
		}
		?>
        <!-- Init Messages -->
        <script>
            var xanConsoleMsgs = [];
        </script>
	
		<!-- XSS Protection with Self and Stripe -->
		<?php
		$aloe_response->header_set( 'Content-Security-Policy', "default-src 'none';  script-src 'self' 'unsafe-eval' 'unsafe-inline' https://js.stripe.com;  style-src 'self' 'unsafe-inline';  img-src 'self';  connect-src 'self';  font-src 'self';  object-src 'self';  media-src 'self';  frame-src 'self' https://js.stripe.com;  child-src 'self';  form-action 'self';  frame-ancestors 'none';  " );
        ?>
        <meta name="Referrer-Policy" content="no-referrer, strict-origin-when-cross-origin">
        <meta name="referrer" content="strict-origin-when-cross-origin">
        <meta name="Referer" content="no-referrer, strict-origin-when-cross-origin">
        <meta name="Strict-Transport-Security" content="max-age=63072000">
        <meta name="X-Content-Type-Options" content="nosniff">
        <meta name="X-Frame-Options" content="deny">
        <meta name="X-XSS-Protection" content="1; mode=block">

        <!-- Title and Icons -->
        <title><?= $resp->headTitle ?></title>
        <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon"/>
        <link rel="apple-touch-icon" href="/images/apple-touch-icon.png"/>
        <link rel="apple-touch-icon" sizes="57x57" href="/images/apple-touch-icon-57x57.png"/>
        <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-touch-icon-72x72.png"/>
        <link rel="apple-touch-icon" sizes="76x76" href="/images/apple-touch-icon-76x76.png"/>
        <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-touch-icon-114x114.png"/>
        <link rel="apple-touch-icon" sizes="120x120" href="/images/apple-touch-icon-120x120.png"/>
        <link rel="apple-touch-icon" sizes="144x144" href="/images/apple-touch-icon-144x144.png"/>
        <link rel="apple-touch-icon" sizes="152x152" href="/images/apple-touch-icon-152x152.png"/>
        <link rel="apple-touch-icon" sizes="180x180" href="/images/apple-touch-icon-180x180.png"/>

        <!-- Moment  https://momentjs.com     Production: https://momentjs.com/downloads/moment.min.js  -->
        <script src="/include/moment/2.24.0/moment.min.js"></script>

        <!-- jQuery -->
        <script src="/include/jquery/3.3.1/jquery.min.js"></script>

        <!-- jQuery Press and Hold https://github.com/santhony7/pressAndHold     https://plugins.jquery.com/pressAndHold/  -->
        <script src="/include/jquery-press-and-hold/1.0.0-2013-12-05/jquery.pressAndHold.js"></script>

        <!-- Bootstrap JavaScript and CSS -->
        <script src="/include/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
        <link href="/include/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
        <link href="/include/bootstrap/theme/darkly/bootstrap.min.css" rel="stylesheet" media="(prefers-color-scheme: dark)">

        <!-- AutoComplete https://github.com/Pixabay/JavaScript-autoComplete -->
        <script src="/include/autocomplete/2020-11-20/auto-complete.min.js"></script>
        <link href="/include/autocomplete/2020-11-20/auto-complete.css" rel="stylesheet">

        <!-- Flatpickr  https://chmln.github.io/flatpickr/     http://www.wou.edu/~smadani14/CWF15/flatpickr-gh-pages/    DOWNLOAD: https://www.jsdelivr.com/package/npm/flatpickr -->
        <script src="/include/flatpickr/4.6.9/flatpickr.min.js"></script>
        <link href="/include/flatpickr/4.6.9/flatpickr.min.css" rel="stylesheet"/>
        <link href="/include/flatpickr/lightXan.css" rel="stylesheet">
        <link href="/include/flatpickr/darkXan.css" rel="stylesheet" media="(prefers-color-scheme: dark)">

        <!-- QueryBuilder  https://querybuilder.js.org     https://github.com/mistic100/jQuery-QueryBuilder  -->
        <link href="/include/querybuilder/2.5.2/css/query-builder.default.min.css" rel="stylesheet"/>
        <link href="/include/querybuilder/2.5.2/css/query-builder.dark.min.css" rel="stylesheet" media="screen and (prefers-color-scheme: dark)"/>
        <script src="/include/querybuilder/2.5.2/js/query-builder.standalone.min.js"></script>
        <script src="/include/querybuilder/2.5.2/i18n/query-builder.en.js"></script>

        <!-- SQL-Parser for QueryBuilder     https://github.com/mistic100/sql-parser  -->
        <script src="/include/sql-parser/1.3.0/sql-parser.min.js"></script>

        <!-- StackTable     https://johnpolacek.github.io/stacktable.js/     https://github.com/johnpolacek/stacktable.js/ -->
        <!-- StackTable css is in <head><style> -->
        <script src="/include/stacktable/2017-08-14/stacktable.js"></script>

        <!-- LazyLoad     https://www.andreaverlicchi.eu/lazyload/ -->
        <script src="/include/lazyload/14.0.0/lazyload.min.js"></script>

        <!-- Stripe.com     https://github.com/stripe/stripe-php -->
        <script src="https://js.stripe.com/v3/"></script>

        <!-- Xanadu Javascript -->
        <script src="/xan/xan.js"></script>

        <!-- FontAwesome     https://fontawesome.com/icons -->
        <link href="/include/fontawesome/5.15.2_pro/css/all.min.css" rel="stylesheet" type="text/css">

        <!-- Fonts and Styles -->
        <!-- <link href="https://fonts.googleapis.com/css?family=IBM+Plex+Sans&display=swap" rel="stylesheet"> -->
        <!-- family=IBM+Plex+Sans|IBM+Plex+Sans+Condensed|IBM+Plex+Serif|IBM+Plex+Mono&display=swap -->

        <style>
            /* Common Vars */
            :root {
                --xan-border-radius: 4px;
                --xan-nav-item-link-font-size: 1.3rem;
                --xan-nav-item-link-padding-top-bottom: 0.2rem;
                --xan-nav-item-link-padding-left-right: 0.5rem;
                --xan-hover-brightness: 0.85;
            }
            /* Light Mode Vars */
            :root {
                /* Light Mode Bootstrap */
                --xan-bs-text-body: #212529;
                --xan-bs-text-light: #f8f9fa;
                --xan-bs-bg-light: #f8f9fa;
                --xan-bs-border-secondary: #6c757d;
                /* Light Mode Vars */
                --xan-font-weight: 500;
                --xan-image-grayscale: 0;
                --xan-image-opacity: 100%;
                --xan-text-color: var(--xan-bs-text-body);
                --xan-bg-color: var(--xan-bs-bg-light);
                --xan-border-color: var(--xan-bs-border-secondary);
                --xan-text-color-active: var(--xan-bs-text-light);
                --xan-text-color-button: var(--xan-bs-text-light);
                --xan-bg-color-active: teal;
                --xan-bg-color-hover: var(--xan-bs-bg-light);
            }
            /* Dark Mode Vars */
            @media screen and (prefers-color-scheme: dark) {
                :root {
                    /* Dark Mode Bootstrap */
                    --xan-bs-text-body: #fff;
                    --xan-bs-bg-secondary: #444;
                    --xan-bs-border-light: #adb5bd;
                    /* Dark Mode Vars */
                    --xan-font-weight: 400;
                    --xan-image-grayscale: 50%;
                    --xan-image-opacity: 60%;
                    --xan-text-color: var(--xan-bs-text-body);
                    --xan-bg-color: var(--xan-bs-bg-secondary);
                    --xan-border-color: var(--xan-bs-border-light);
                    --xan-text-color-active: var(--xan-bs-text-body);
                    --xan-text-color-button: var(--xan-bs-text-body);
                    --xan-bg-color-active: teal;
                    --xan-bg-color-hover: var(--xan-bs-bg-secondary);
                }
            }
            /* Styles */
            body {
                font-family: 'Arial', sans-serif;
                font-size: medium;
                font-weight: var(--xan-font-weight);
                position: relative;
            }
            /*
            font-family: 'IBM Plex Sans', 'Arial', sans-serif;
            font-family: 'IBM Plex Sans', sans-serif;
            font-family: 'IBM Plex Sans Condensed', sans-serif;
            font-family: 'IBM Plex Serif', serif;
            font-family: 'IBM Plex Mono', monospace;
            */
            .noscript {
                width: 100%;
                height: 100%; /* will cover the text displayed when javascript is enabled*/
                z-index: 100000; /* higher than other z-index */
                position: absolute;
            }
            .noscript #noscriptdiv {
                display: block;
                height: 100%;
                color: white;
                background-color: red;
                font-size: 2rem;
                padding: 70px 0;
                text-align: center;
            }
            .noscript #noscriptdiv a:link, .noscript #noscriptdiv a:visited, .noscript #noscriptdiv a:active {
                color: white;
                text-decoration: underline;
            }
            .noscript #noscriptdiv a:hover {
                color: gray;
                text-decoration: underline;
            }
            .form-file-area {
                text-align: center;
                overflow: hidden;
                border-radius: var(--xan-border-radius);
                position: relative;
            }
            .form-file-area:hover,
            .form-file-area.dragging {
                filter: brightness(var(--xan-hover-brightness));
            }
            .form-file-input {
                position: absolute;
                z-index: 2;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                cursor: pointer;
                color: transparent;
                opacity: 0;
            }
            .form-file-icon {
                position: absolute;
                z-index: 1;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                padding-top: 3px;
                color: var(--xan-text-color-button);
            }
            .xanControl, .xanControl:focus, .btn-secondary, .navbar, .dropdown-menu {
                background-color: var(--xan-bg-color) !important;
                border-color: var(--xan-border-color);
                color: var(--xan-text-color);
            }
            .img-thumbnail {
                padding: 0.3rem;
                background-color: var(--xan-bg-color) !important;
                border-color: var(--xan-border-color);
            }
            .nav-hamburger, .nav-item-link {
                color: var(--xan-text-color);
                font-size: var(--xan-nav-item-link-font-size);
                padding-top: var(--xan-nav-item-link-padding-top-bottom);
                padding-bottom: var(--xan-nav-item-link-padding-top-bottom);
                padding-left: var(--xan-nav-item-link-padding-left-right);
                padding-right: var(--xan-nav-item-link-padding-left-right);
            }
            .nav-item-link:hover {
                filter: brightness(var(--xan-hover-brightness));
                color: var(--xan-text-color);
                background-color: var(--xan-bg-color-hover);
                border-radius: var(--xan-border-radius);
                font-size: var(--xan-nav-item-link-font-size);
                padding-top: var(--xan-nav-item-link-padding-top-bottom);
                padding-bottom: var(--xan-nav-item-link-padding-top-bottom);
                padding-left: var(--xan-nav-item-link-padding-left-right);
                padding-right: var(--xan-nav-item-link-padding-left-right);
            }
            .nav-item-link.active {
                color: var(--xan-text-color-active);
                background-color: var(--xan-bg-color-active);
                border-radius: var(--xan-border-radius);
            }
            .btn-secondary:hover {
                filter: brightness(var(--xan-hover-brightness));
                color: var(--xan-text-color);
                border-color: var(--xan-border-color);
            }
            .dropdown-item:hover:hover {
                filter: brightness(var(--xan-hover-brightness));
                color: var(--xan-text-color);
                background-color: var(--xan-bg-color-hover);
                border-radius: var(--xan-border-radius);
            }
            .list-group-item-text.active {
                color: var(--xan-text-color-active);
            }
            .list-group-item.active {
                background-color: var(--xan-bg-color-active);
                border-radius: var(--xan-border-radius);
            }
            select {
                -moz-appearance: none;
                -webkit-appearance: none;
                appearance: none;
            }
            .modal-content, .dropdown {
                border-color: var(--xan-border-color);
            }
            img, video {
                /* filter: drop-shadow(4px 4px 5px gray); grayscale(var(--xan-image-grayscale)) opacity(var(--xan-image-opacity)) */
            }
            /* StackTable */
            .stacktable {
                width: <?= STACKTABLE_WIDTH ?>;
            }
            .stacktable.large-only {
                display: table;
            }
            .stacktable.small-only {
                display: none;
            }
            @media (max-width: <?= STACKTABLE_TRIGGER ?>) {
                .stacktable.large-only {
                    display: none;
                }
                .stacktable.small-only {
                    display: table;
                }
            }
            .st-head-row {
                padding-top: 1em;
            }
            .st-head-row.st-head-row-main {
                font-size: 1.5em;
                padding-top: 0;
            }
            .st-key {
                width: 29%;
                text-align: right;
                padding-right: 1%;
            }
            .st-val {
                width: 69%;
                padding-left: 1%;
            }
        </style>

        <!-- Head Extra Begin -->
		<?= \xan\respAToString( $resp->headExtraA ) ?>
        <!-- Head Extra End -->

    </head>
    <body>
    <noscript class="noscript">
        <div id="noscriptdiv"><?= APP_NAME ?> cannot load without JavaScript. <br/>Here's how to enable JavaScript: <br/><a href="https://www.google.com/search?client=safari&rls=en&q=how+to+enable+javascript&ie=UTF-8&oe=UTF-8/" target="_blank">Google Search</a> <br/>or <br/><a href="https://www.enable-javascript.com/" target="_blank">https://www.enable-javascript.com</a></div>
    </noscript>

    <!-- Wrapper Begin -->
    <div class="d-flex" id="wrapper">

        <!-- Page Begin -->
        <div id="page-content-wrapper">

            <!-- Nav Begin -->
            <nav class="navbar navbar-expand-sm text-body bg-light border-secondary border-bottom fixed-top w-100 pt-2 pb-2" style="z-index: <?= ZINDEX_NAVBAR ?>;">
				
				<?php if ( $resp->navInclude ) : ?>

                    <!-- Menu Hamburger -->
                    <button class="navbar-toggler nav-hamburger" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><?= FA_MENU . STR_NBSP ?>Menu</button>

                    <!-- Menu Expanded -->
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav mt-2 mt-sm-0">

                            <!-- ------ -->
							<?= \xan\navItemButtonModule( $mmHome, $resp->moduleName ) ?>
                            <!-- ------ -->
							<?= \xan\navItemButtonModule( $mmContactsT, $resp->moduleName ) ?>
                            <!-- ------ -->
                            <li class="nav-item dropdown">
                                <a class="nav-item-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?= $mmUsersT->FontAwesome ?></i></a>
                                <div class="dropdown-menu text" aria-labelledby="navbarDropdown">
									<?php
									if ( $_SESSION[ SESS_USER ][ 'PrivAdmin' ] === 'Yes' ) {
										echo \xan\navItemDropdownModule( $mmServerStats );
										echo \xan\navDivider();
										echo \xan\navItemDropdownModule( $mmSettingsT );
										echo \xan\navItemDropdownModule( $mmUsersT );
										echo \xan\navDivider();
									}
									if ( \xan\isNotEmpty( $_SESSION[ SESS_USER ][ UUIDUSERS ] ) ) {
										echo \xan\navItemDropdownCustom( FA_PASSWORD . STR_NBSP . 'Change My Password', /** @lang JavaScript */ "$('#UsersPasswordChange_Modal').modal('show');" );
										echo \xan\navDivider();
										require_once( PATH_ROOT_APP . 'settings-users/contentModal-users-passwordChange.php' );
									}
									?>
									<?= \xan\navItemDropdownModule( $mmUsersLogout ) ?>
									<?= \xan\navDivider() ?>
                                    <span class="dropdown-item disabled">Session Info</span>
                                    <span class="dropdown-item disabled">Email: <?= $_SESSION[ SESS_USER ][ 'EmailAddress' ] ?></span>
                                    <span class="dropdown-item disabled">Tenant: <?= $_SESSION[ SESS_USER ][ UUIDTENANTS ] ?></span>
                                    <span class="dropdown-item disabled">User: <?= $_SESSION[ SESS_USER ][ UUIDUSERS ] ?></span>
                                    <span class="dropdown-item disabled">Active: <?= $_SESSION[ SESS_USER ][ 'Active' ] ?></span>
                                    <span class="dropdown-item disabled">Admin: <?= $_SESSION[ SESS_USER ][ 'PrivAdmin' ] ?></span>
                                </div>
                            </li>
                            <!-- ------ -->
                        </ul>
                    </div>

                    <!-- xanMessage -->
                    <table class="small" style="padding: 0; margin: 0; line-height: 1.1;">
                        <tr id="xanMessage"></tr>
                    </table>
				
				<?php endif ?>

                <!-- Brand -->
                <a class="nav-item-link" href="<?= APP_ICON_URL_LINK ?>" target="_blank"><img src="<?= APP_ICON_URL_50 ?>" alt="Logo" width="30" height="30"/> <?= APP_NAME ?></a>

            </nav>
            <!-- Nav End -->

            <!-- Content Begin -->
            <div id="pageContent" class="container-fluid" style="margin-top: 63px;">

                <!-- Header -->
                <h3 id="pageContentHeader" class="mt-2" style="width: 98vw;"><?= $resp->contentHeader ?></h3>

                <!-- Stages Begin -->
                <div id="pageContentBody" class="d-flex flex-wrap ml-n3" style="width: 99vw;">
					<?= \xan\respAToString( $resp->contentAreaA ) ?>
                </div>
                <!-- Stages End -->

            </div>
            <!-- Content End -->
        </div>
        <!-- Page End -->

    </div>
    <!-- Wrapper End -->

    <!-- Content End -->
	<?= \xan\respAToString( $resp->contentEndA ) ?>

    <script>
        function xanDo( params ) {
            let iconID = Math.floor( ( Math.random() * 999999999 ) + 1 );
            xanMessageDisplay( "#xanMessage", "<?= FA_PSOS_CLOUD ?>", iconID, '', false, false );
            // alert( "xanDo params = " + JSON.stringify( params ) );
            let timeBegin = new Date();
            // Window in Current or New Window
            let theWindow = window;
            if ( params[ "NewWindow" ] === 1 ) {
                theWindow = window.open( "/loading.php?label=Loading%20" + params[ "Msg" ] + "...", "_blank" );
                theWindow.focus();
            }
            $.ajax( {
                type: "POST",
                url: params[ "URL" ],
                dataType: "text",
                data: "params=" + encodeURIComponent( JSON.stringify( params ) ),
                success: function ( successResult, status, xhr ) {
                    // JSON Get
                    // alert( "xanDo Success: " + successResult );
                    if ( successResult === "" ) {
                        alert( "Error: xanDo Result is Blank; Params: " + JSON.stringify( params ) );
                        return;
                    }
                    let xanDoJS;
                    try {
                        xanDoJS = JSON.parse( successResult );
                    } catch ( e ) {
                        alert( "Error: xanDo Result Cannot Parse: " + e + "; Result: " + successResult );
                        return;
                    }

                    // Do Selectors
                    if ( xanDoJS !== undefined ) {
                        let i;
                        for ( i = 0; i < xanDoJS.length; i++ ) {

                            switch ( xanDoJS[ i ][ "xanDo_Action" ] ) {

                                case "setPageTitle":
                                    document.title = xanDoJS[ i ][ "xanDo_Value" ];
                                    break;

                                case "setPageURL":
                                    theWindow.location.href = xanDoJS[ i ][ "xanDo_Value" ]
                                    break;

                                case "hideOrShow":
                                    if ( xanDoJS[ i ][ "xanDo_Value" ] === "hide" ) {
                                        $( xanDoJS[ i ][ "xanDo_Selector" ] ).hide();
                                    } else {
                                        $( xanDoJS[ i ][ "xanDo_Selector" ] ).show();
                                    }
                                    break;

                                case "hideOrShowModal":
                                    if ( xanDoJS[ i ][ "xanDo_Value" ] === "hide" ) {
                                        $( xanDoJS[ i ][ "xanDo_Selector" ] ).modal( "hide" );
                                    } else {
                                        $( xanDoJS[ i ][ "xanDo_Selector" ] ).modal( "show" );
                                    }
                                    break;


                                case "setHTML":
                                    $( xanDoJS[ i ][ "xanDo_Selector" ] ).html( xanDoJS[ i ][ "xanDo_Value" ] );
                                    break;

                                case "setVal":
                                    $( xanDoJS[ i ][ "xanDo_Selector" ] ).val( xanDoJS[ i ][ "xanDo_Value" ] );
                                    break;

                                case "setHTMLProperty":
                                    $( xanDoJS[ i ][ "xanDo_Selector" ] ).prop( xanDoJS[ i ][ "xanDo_Property" ], xanDoJS[ i ][ "xanDo_Value" ] );
                                    break;

                                case "runInit":
                                    xanDoInit();
                                    break;

                                case "setFocus":
                                    $( xanDoJS[ i ][ "xanDo_Selector" ] ).focus().select();
                                    break;

                            }

                        }
                    }

                    // Focus from Session
					<?php
					if ( $_SESSION[ SESS_FOCUS_SELECTOR ] !== '' ) {
						echo '$( "' . $_SESSION[ SESS_FOCUS_SELECTOR ] . '" ).focus().select();' . STR_CRLF_ASCII;
						$_SESSION[ SESS_FOCUS_SELECTOR ] = '';
					}
					?>

                    // Notify
                    let timeEnd = new Date();
                    let timeSecs = ( timeEnd.getMilliseconds() - timeBegin.getMilliseconds() ) / 1000;
                    let messageID = Math.floor( ( Math.random() * 999999999 ) + 1 );
                    xanMessageDisplay( "#xanMessage", "<span class='text-success'>" + params[ "Msg" ] + "<br />" + Math.abs( timeSecs ) + "s</span>", messageID, iconID, true, true );
                },
                error: function ( xhr, status, error ) {
                    xanMessageDisplay( "#xanMessage", "<?= FA_PSOS_ERROR ?>", '', '', false, false );
                    xanMessageDisplay( "#xanMessage", "<span class='text-danger'>" + params[ "Msg" ] + " Error:" + error + "</span>", '', '', false, true );
                }
            } );
        }

        function xanDoInit() {
            // Flatpickr Init
            flatpickr( '.flatpickr_date', { altInputClass: 'flatpickr_date-generated', dateFormat: 'Y-m-d', altInput: true, altFormat: 'n/j/Y', noCalendar: false, shorthandCurrentMonth: true, weekNumbers: false, allowInput: false } );
            flatpickr( '.flatpickr_datetime', { altInputClass: 'flatpickr_datetime-generated', dateFormat: 'Y-m-d H:i:S', altInput: true, altFormat: 'n/j/Y h:i K', noCalendar: false, shorthandCurrentMonth: true, weekNumbers: false, allowInput: false, enableTime: true, time_24hr: false, defaultHour: 9, defaultMinute: 0 } );
            flatpickr( '.flatpickr_time', { altInputClass: 'flatpickr_time-generated', dateFormat: 'H:i:S', altInput: true, altFormat: 'h:i K', noCalendar: true, enableTime: true, time_24hr: false, defaultHour: 9, defaultMinute: 0, weekNumbers: false, allowInput: false } );

            // Menu Toggle Init
            $( "#menu-toggle" ).click( function ( e ) {
                e.preventDefault();
                $( "#wrapper" ).toggleClass( "toggled" );
            } );

            // LazyLoad Init
            var lazyLoadInstance = new LazyLoad( { elements_selector: ".lazy" } );

            // StackTable Init
            $( '.xanStackTable' ).cardtable( { myClass: 'stacktable small-only' } );

            // Save on Change Init
            $( '.xanDoSave' ).off( 'change', xanDoSave ).on( 'change', xanDoSave );

            // Scripts DoInit
			<?= \xan\respAToString( $resp->scriptsDoInitA ) ?>

            // Console Display
            xanConsoleDisplay();
        }

        function xanDoSave( event ) {
            let iconID = Math.floor( ( Math.random() * 999999999 ) + 1 );
            xanMessageDisplay( "#xanMessage", "<?= FA_PSOS_SAVE ?>", iconID, '', false, false );
            thisInput = $( this );
            let thisInputID = $( thisInput ).attr( "id" );
            let thisInputName = $( thisInput ).attr( "name" );
            let thisInputValue = $( thisInput ).val();
            let thisNameVP = thisInputName + "=" + thisInputValue;
            let thisActionVP = "ajaxAction=ajaxSave";
            let thisLabelVP = "ajaxLabel=" + $( thisInput ).attr( "data-label" );
            let thisFormName = thisInputID.split( "_", 2 ).join( "_" );
            let thisFormMetaVP = "ajaxMeta=" + $( "#" + thisFormName + "_<?= FORM_PREFIX . FORM_META ?>" ).val();

            let thisData = "";
            if ( typeof thisInputName !== "undefined" ) {
                thisData = thisNameVP + "&" + thisActionVP + "&" + thisLabelVP + "&" + thisFormMetaVP;
                $.ajax( {
                    type: "POST",
                    url: "/xanDoSave",
                    dataType: "text",
                    data: thisData,
                    success: function ( successResult, status, xhr ) {
                        // alert( "Success: " + result );
                        // Get the JSON
                        let result;
                        try {
                            result = JSON.parse( successResult );
                        } catch ( e ) {
                            alert( "xanDo JSON Parse Error: " + e + "; Result: " + successResult );
                            return;
                        }
                        // For each Record
                        for ( let theIndex in result ) {
                            //alert( theRecordIndex + " = " + jsonObj[theRecordIndex] );
                            // For each ColumnName
                            for ( let theColName in result[ theIndex ] ) {
                                // Get the Column Selector with its ID
                                let theSelector = $( "#" + thisFormName + "_" + theColName );
                                let theSelectorName = $( theSelector ).attr( "name" );
                                let theSelectorInputValue = theSelector.val();
                                let theSelectorRecordValue = result[ theIndex ][ theColName ];
                                // If Selector Exists
                                if ( typeof theSelectorName !== "undefined" ) {
                                    // If Input Value = Record Value
                                    if ( theSelectorInputValue != theSelectorRecordValue ) {
                                        // alert( theSelectorName + ' = ' + theSelectorRecordValue + ' > ' + theSelectorInputValue );
                                        theSelector.val( theSelectorRecordValue );
                                    }
                                }
                            }
                        }
                        let messageID = Math.floor( ( Math.random() * 999999999 ) + 1 );
                        xanMessageDisplay( "#xanMessage", "<span class='text-success'>Saved " + result[ 0 ][ 'AjaxColumnLabel' ] + "<br />" + result[ 0 ][ "AjaxLoadTime" ] + "</span>", messageID, iconID, true, true );
                    },
                    error: function ( xhr, status, error ) {
                        //alert( "Error: " + status + " / " + error );
                        xanMessageDisplay( "#xanMessage", "<?= FA_PSOS_ERROR ?>", '', '', false, false );
                        xanMessageDisplay( "#xanMessage", "<span class='text-danger'>Saving Error: " + error + "</span>", '', '', false, true );
                    }
                } );
            }
        }

        // Scripts Extra
		<?= \xan\respAToString( $resp->scriptsExtraA ) ?>

        // On Load
        $( function () {

            // Disable Right Click
            $( document ).bind( "contextmenu", xanEventReturnFalse );
            // $( document ).unbind( "contextmenu", xanEventReturnFalse );

            // Disable Drag to the Window with Exceptions
            window.addEventListener( "dragover", function ( e ) {
                if ( !e.target.classList.contains( 'form-file-input' ) ) {
                    e = e || event;
                    e.preventDefault();
                }
            }, false );
            window.addEventListener( "drop", function ( e ) {
                if ( !e.target.classList.contains( 'form-file-input' ) ) {
                    e = e || event;
                    e.preventDefault();
                }
            }, false );

            // Message Display
            let iconID = Math.floor( ( Math.random() * 999999999 ) + 1 );
            xanMessageDisplay( "#xanMessage", "<?= FA_PSOS_STOPWATCH ?>", iconID, '', true, false );
            let messageID = Math.floor( ( Math.random() * 999999999 ) + 1 );
            xanMessageDisplay( "#xanMessage", "<span class='text-success'>Load Page<br /><?= \xan\microsecsDiff( $pageload_begin ) ?></span>", messageID, iconID, true, true );

            // Scripts Onload
			<?= \xan\respAToString( $resp->scriptsOnLoadA ) ?>

        } );
    </script>
    </body>
    </html>
<?php
return ob_get_clean();
?>