///////////////////////////////////////////////////////////
// Utility
function xanEventReturnFalse( e ) {
    return false;
}

///////////////////////////////////////////////////////////
// Messages

function xanMessageDisplay( selector, html, id, doFadeOutID, doFadeOut, doConsoleLog ) {
    if ( document.getElementById( "xanMessage" ) ) {
        let cell = document.getElementById( "xanMessage" ).insertCell( -1 );
        cell.innerHTML = "<span id='" + id + "'>" + html + "</span>";
        if ( doFadeOutID !== '' ) {
            $( "#" + doFadeOutID ).delay( 3000 ).fadeOut( 'slow' );
        }
        if ( doFadeOut === true ) {
            $( "#" + id ).delay( 3000 ).fadeOut( 'slow' );
        }
    }
    if ( doConsoleLog === true ) {
        console.log( xanConsoleCleanHTML( html ) );
    }
}

function xanConsoleDisplay() {
    for ( i = 0; i < xanConsoleMsgs.length; i++ ) {
        console.log( xanConsoleCleanHTML( xanConsoleMsgs[ i ] ) );
    }
    xanConsoleMsgs = [];
}

function xanConsoleCleanHTML( html ) {
    html = html.replaceAll( "<br />", " " );
    html = strip_tags( html );
    html = addslashes( html );
    html = html.replaceAll( "&nbsp;", " " );
    html = html.replace( /\s+/g, " " );
    html = html.trim();
    return html;
}

///////////////////////////////////////////////////////////
// PHP Equivalents

function addslashes( str ) {
    str = str.replace( /\\/g, '\\\\' );
    str = str.replace( /\'/g, '\\\'' );
    str = str.replace( /\"/g, '\\"' );
    str = str.replace( /\0/g, '\\0' );
    return str;
}

function stripslashes( str ) {
    str = str.replace( /\\'/g, '\'' );
    str = str.replace( /\\"/g, '"' );
    str = str.replace( /\\0/g, '\0' );
    str = str.replace( /\\\\/g, '\\' );
    return str;
}

function strip_tags( str ) {
    if ( ( str === null ) || ( str === '' ) )
        return false;
    else
        str = str.toString();
    return str.replace( /(<([^>]+)>)/ig, '' );
}

///////////////////////////////////////////////////////////
// Elements

function xanEleSelectOnChange( pIDSelect, pValue ) {
    hiddenSelector = $( "#" + pIDSelect );
    selectSelector = $( "#" + pIDSelect + "_Select" );
    modalSelector = $( "#" + pIDSelect + "_Modal" );
    switch ( pValue ) {
        case 'Other':
            selectSelector.val( selectSelector.data( 'prev' ) );
            modalSelector.modal( "show" );
            break;
        case 'Clear':
            selectSelector.val( "" );
            hiddenSelector.val( "" ).trigger( "change" );
            break;
        default:
            hiddenSelector.val( selectSelector.val() ).trigger( "change" );
    }
}

function xanEleSelectOtherAction( pIDSelect ) {
    hiddenSelector = $( "#" + pIDSelect );
    selectSelector = $( "#" + pIDSelect + "_Select" );
    modalInputSelector = $( "#" + pIDSelect + "_Modal_Input" );
    let theValue = modalInputSelector.val();
    let theSelect = document.getElementById( pIDSelect + "_Select" );
    let theOpt = document.createElement( "option" );
    theOpt.value = theValue;
    theOpt.innerHTML = theValue;
    theSelect.add( theOpt, theSelect[ 0 ] );
    selectSelector.val( theValue );
    hiddenSelector.val( theValue ).trigger( "change" );
}

function xanEleFlatpickrSet( pIDSelect, pIDFlatpickr, pTypeFlatpickr, pValue ) {
    // Select Reset
    document.querySelector( pIDSelect ).value = "";
    document.querySelector( pIDSelect ).blur();

    // Return if Empty
    if ( pValue === "" ) return;

    // Get Formats
    let formatMoment = "";
    let formatFlatpickr = "";
    switch ( pTypeFlatpickr ) {
        case "date":
            formatMoment = 'YYYY-MM-DD';
            formatFlatpickr = 'Y-m-d';
            break;
        case "datetime":
            formatMoment = 'YYYY-MM-DD HH:mm:ss';
            formatFlatpickr = 'Y-m-d H:i:S';
            break;
        case "time":
            formatMoment = 'HH:mm:ss';
            formatFlatpickr = 'H:i:S';
            break;
    }

    // Get Moment
    let eleMoment = '';
    switch ( pValue ) {
        case "Today":
            eleMoment = moment().format( formatMoment );
            break;
        case "Yesterday":
            eleMoment = moment().subtract( 1, "days" ).format( formatMoment );
            break;
        case "Tomorrow":
            eleMoment = moment().add( 1, "days" ).format( formatMoment );
            break;

        case "Year Begin":
            eleMoment = moment().startOf( 'year' ).format( formatMoment );
            break;
        case "Year End":
            eleMoment = moment().endOf( 'year' ).format( formatMoment );
            break;

        case "Q1 Begin":
            eleMoment = moment().quarter( 1 ).startOf( 'quarter' ).format( formatMoment );
            break;
        case "Q1 End":
            eleMoment = moment().quarter( 1 ).endOf( 'quarter' ).format( formatMoment );
            break;
        case "Q2 Begin":
            eleMoment = moment().quarter( 2 ).startOf( 'quarter' ).format( formatMoment );
            break;
        case "Q2 End":
            eleMoment = moment().quarter( 2 ).endOf( 'quarter' ).format( formatMoment );
            break;
        case "Q3 Begin":
            eleMoment = moment().quarter( 3 ).startOf( 'quarter' ).format( formatMoment );
            break;
        case "Q3 End":
            eleMoment = moment().quarter( 3 ).endOf( 'quarter' ).format( formatMoment );
            break;
        case "Q4 Begin":
            eleMoment = moment().quarter( 4 ).startOf( 'quarter' ).format( formatMoment );
            break;
        case "Q4 End":
            eleMoment = moment().quarter( 4 ).endOf( 'quarter' ).format( formatMoment );
            break;

        case "Month Begin":
            eleMoment = moment().startOf( 'month' ).format( formatMoment );
            break;
        case "Month End":
            eleMoment = moment().endOf( 'month' ).format( formatMoment );
            break;
        case "Last Month Begin":
            eleMoment = moment().subtract( 1, 'month' ).startOf( 'month' ).format( formatMoment );
            break;
        case "Last Month End":
            eleMoment = moment().subtract( 1, 'month' ).endOf( 'month' ).format( formatMoment );
            break;
        case "Next Month Begin":
            eleMoment = moment().add( 1, 'month' ).startOf( 'month' ).format( formatMoment );
            break;
        case "Next Month End":
            eleMoment = moment().add( 1, 'month' ).endOf( 'month' ).format( formatMoment );
            break;

        case "Week Begin":
            eleMoment = moment().startOf( 'week' ).format( formatMoment );
            break;
        case "Week End":
            eleMoment = moment().endOf( 'week' ).format( formatMoment );
            break;
        case "Last Week Begin":
            eleMoment = moment().subtract( 1, 'week' ).startOf( 'week' ).format( formatMoment );
            break;
        case "Last Week End":
            eleMoment = moment().subtract( 1, 'week' ).endOf( 'week' ).format( formatMoment );
            break;
        case "Next Week Begin":
            eleMoment = moment().add( 1, 'week' ).startOf( 'week' ).format( formatMoment );
            break;
        case "Next Week End":
            eleMoment = moment().add( 1, 'week' ).endOf( 'week' ).format( formatMoment );
            break;

        case "Now":
            eleMoment = moment().format( formatMoment );
            break;

        case "7am":
            eleMoment = moment( '07:00', 'hh:mm' ).format( formatMoment );
            break;
        case "8am":
            eleMoment = moment( '08:00', 'hh:mm' ).format( formatMoment );
            break;
        case "9am":
            eleMoment = moment( '09:00', 'hh:mm' ).format( formatMoment );
            break;
        case "10am":
            eleMoment = moment( '10:00', 'hh:mm' ).format( formatMoment );
            break;
        case "11am":
            eleMoment = moment( '11:00', 'hh:mm' ).format( formatMoment );
            break;
        case "12pm":
            eleMoment = moment( '12:00', 'hh:mm' ).format( formatMoment );
            break;

        case "1pm":
            eleMoment = moment( '13:00', 'hh:mm' ).format( formatMoment );
            break;
        case "2pm":
            eleMoment = moment( '14:00', 'hh:mm' ).format( formatMoment );
            break;
        case "3pm":
            eleMoment = moment( '15:00', 'hh:mm' ).format( formatMoment );
            break;
        case "4pm":
            eleMoment = moment( '16:00', 'hh:mm' ).format( formatMoment );
            break;
        case "5pm":
            eleMoment = moment( '17:00', 'hh:mm' ).format( formatMoment );
            break;
        case "6pm":
            eleMoment = moment( '18:00', 'hh:mm' ).format( formatMoment );
            break;
        case "7pm":
            eleMoment = moment( '19:00', 'hh:mm' ).format( formatMoment );
            break;

        case "8pm":
            eleMoment = moment( '20:00', 'hh:mm' ).format( formatMoment );
            break;
        case "9pm":
            eleMoment = moment( '21:00', 'hh:mm' ).format( formatMoment );
            break;
        case "10pm":
            eleMoment = moment( '22:00', 'hh:mm' ).format( formatMoment );
            break;
        case "11pm":
            eleMoment = moment( '23:00', 'hh:mm' ).format( formatMoment );
            break;
        case "12am":
            eleMoment = moment( '00:00', 'hh:mm' ).format( formatMoment );
            break;

        case "1am":
            eleMoment = moment( '01:00', 'hh:mm' ).format( formatMoment );
            break;
        case "2am":
            eleMoment = moment( '02:00', 'hh:mm' ).format( formatMoment );
            break;
        case "3am":
            eleMoment = moment( '03:00', 'hh:mm' ).format( formatMoment );
            break;
        case "4am":
            eleMoment = moment( '04:00', 'hh:mm' ).format( formatMoment );
            break;
        case "5am":
            eleMoment = moment( '05:00', 'hh:mm' ).format( formatMoment );
            break;
        case "6am":
            eleMoment = moment( '06:00', 'hh:mm' ).format( formatMoment );
            break;

    }

    // Set Flatpickr
    switch ( pValue ) {
        case "Clear":
            document.querySelector( pIDFlatpickr )._flatpickr.clear( true );
            break;
        default:
            document.querySelector( pIDFlatpickr )._flatpickr.setDate( eleMoment, true, formatFlatpickr );
    }
}

function xanFileUploadToBucket( formSelector, postURL, callbackSuccess, callbackProblem ) {
    // Submit Directly
    // $( formSelector ).submit();
    // return;
    // Submit Directly
    let thisData = new FormData( $( formSelector )[ 0 ] );
    // alert( JSON.stringify( thisData ) );
    $.ajax( {
        type: "POST",
        url: postURL,
        data: thisData,
        cache: false,
        contentType: false,
        processData: false,
        success: function ( result, status, xhr ) {
            // alert( result.toString() );
            let jsonObj = JSON.parse( result );
            if ( jsonObj[ "IsOK" ] === 1 ) {
                let theURL = jsonObj[ "FilePathBase" ] + jsonObj[ "FileKey" ] + "/" + jsonObj[ "FileName" ];
                callbackSuccess( theURL );
            } else {
                callbackProblem( jsonObj[ "Message" ] );
            }
        },
        error: function ( xhr, status, error ) {
            // alert( error );
            callbackProblem( error );
        }
    } );
}

///////////////////////////////////////////////////////////
// Geolocation

function xanLocationGet( pCallbackFunction ) {
    // Calling Example
    // locationGet( function ( coords ) { alert( coords['ErrorCode'] + '|' + coords['Latitude'] ); } );
    if ( navigator.geolocation ) {
        navigator.geolocation.getCurrentPosition(
            function ( position ) {
                let result = {};
                result[ 'ErrorCode' ] = "0";
                result[ 'ErrorDesc' ] = "OK";
                result[ 'Latitude' ] = position.coords.latitude;
                result[ 'Longitude' ] = position.coords.longitude;
                result[ 'Altitude' ] = position.coords.altitude;
                result[ 'Heading' ] = position.coords.heading;
                result[ 'Speed' ] = position.coords.speed;
                result[ 'Accuracy' ] = position.coords.accuracy;
                result[ 'AccuracyAltitude' ] = position.coords.altitudeAccuracy;
                pCallbackFunction( result );
            },
            function ( err ) {
                let result = {};
                result[ 'ErrorCode' ] = err.code;
                result[ 'ErrorDesc' ] += ''; // err.message;
                result[ 'ErrorDesc' ] += ( err.code === 1 ) ? "The acquisition of the geolocation information failed because the page didn't have the permission to do it." : "";
                result[ 'ErrorDesc' ] += ( err.code === 2 ) ? "The acquisition of the geolocation failed. Using Safari on Mac OS? Enable System Preferences > Security and Privacy > Privacy > Location Services > Safari." : "";
                result[ 'ErrorDesc' ] += ( err.code === 3 ) ? "The time allowed to acquire the geolocation, was reached before the information was obtained." : "";
                pCallbackFunction( result );
            },
            {
                enableHighAccuracy: true,
                timeout: 15000,
                maximumAge: 0
            }
        )
    } else {
        let result = {};
        result[ 'ErrorCode' ] = -1;
        result[ 'ErrorDesc' ] = "Browser does not support Geolocation";
        callbackFunction( result );
    }
}

///////////////////////////////////////////////////////////
// Stripe

function xanStripeButtonInit( pStripeKeyPublic, pSessionID, pButtonID ) {
    let stripe = Stripe( pStripeKeyPublic );
    let stripeButton = document.getElementById( pButtonID );
    stripeButton.addEventListener( "click", function () {
        stripe.redirectToCheckout( {
            sessionId: pSessionID
        } ).then( function ( result ) {
            alert( "Error: " + result.error.message );
        } );
    } );
}