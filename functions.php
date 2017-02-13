<?php
include "namen.php";

function user_valid_login ( $login, $password ) {
    global $error;
    global $Namen;
    $aantal=count($Namen);
    $ret = false;
    $login_error = "";
//sql statement mogelijk

    if ($login=='' or $password=='') {
        $ret=false;
        $error = "Toegang geweigerd: Geen gebruikersnaam en toegangscode";
    }

    else {
        for ($i=0;$i<=$aantal;$i=$i+2) {
            if (isset($Namen[$i]) && $login==$Namen[$i]) {
                if ($password==$Namen[$i+1]) {
                    $ret=true;
                    $error = "OK";
                }
                else {
                    $ret=false;
                    $error = "Toegang geweigerd: Toegangscode verkeerd";
                }
            }
        }
    }
// sql afhandeling
    return $ret;
}


function user_valid_crypt ( $login, $crypt_password ) { //nodig bij index.php
    global $error;
    global $Namen;
    $aantal=count($Namen);
    $ret = false;
    $login_error = "";
    $salt = substr($crypt_password, 0, 2);
//sql statement mogelijk
    $res=false;
    for ($i=0;$i<=$aantal;$i=$i+2) {
        if (isset($Namen[$i]) && $login==$Namen[$i]) {
            $j=$i+1;
            $password=$Namen[$j];
            $res=true;
            //echo "gevonden ID/PW: $login $password<br>";
        }
        //echo "$Namen[$i] - $Namen[$j]<br>";
    }
    if ( $res ) {
        //echo "RES routine<br>";
        if ( crypt($password, $salt) == $crypt_password ) {
            $ret = true; // found login/password
//		echo "Goed";
        }
// sql afhandeling
        else $error= "Geen toegang";
    }
    else {
        $error = "Geen toegang";
    }
    return $ret;
}


// send a redirect to the specified page
// MS IIS/PWS has a bug in which it does not allow us to send a cookie
// and a redirect in the same HTTP header.
// See the following for more info on the IIS bug:
//   http://www.faqts.com/knowledge_base/view.phtml/aid/9316/fid/4
function do_redirect ( $url ) {
    if ( substr ( $SERVER_SOFTWARE, 0, 5 ) == "Micro" ) {
        echo "<HTML><HEAD><TITLE>Redirect</TITLE>" .
            "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"0; URL=$url\"></HEAD><BODY>" .
            "Redirecting to ... <A HREF=\"" . $url . "\">here</A>.</BODY></HTML>.\n";
    } else {
        Header ( "Location: $url" );
        echo "<HTML><HEAD><TITLE>Redirect</TITLE></HEAD><BODY>" .
            "Redirecting to ... <A HREF=\"" . $url . "\">here</A>.</BODY></HTML>.\n";
    }
    exit;
}


// send an HTTP login request
function send_http_login () {
    global $application_name;
    Header ( "WWW-Authenticate: Basic realm=\"Atlanta\"");
    Header ( "HTTP/1.0 401 Unauthorized" );
    echo "<HTML><HEAD><TITLE>Unauthorized</TITLE></HEAD><BODY>\n" .
        "<H2>Atlanta</H2>" .
        "You are not authorized" .
        "\n</BODY></HTML>\n";
    exit;
}


// Send header stuff that tells the browser not to cache this page.
function send_no_cache_header () {
    header ( "Expires: Mon, 26 Jul 1997 05:00:00 GMT" );
    header ( "Last-Modified: " . gmdate ( "D, d M Y H:i:s" ) . " GMT" );
    header ( "Cache-Control: no-store, no-cache, must-revalidate" );
    header ( "Cache-Control: post-check=0, pre-check=0", false );
    header ( "Pragma: no-cache" );
}


// Define an array to use to jumble up the key
$offsets = array ( 31, 41, 59, 26, 54 );

function hextoint ( $val ) {
    if ( empty ( $val ) )
        return 0;
    switch ( strtoupper ( $val ) ) {
        case "0": return 0;
        case "1": return 1;
        case "2": return 2;
        case "3": return 3;
        case "4": return 4;
        case "5": return 5;
        case "6": return 6;
        case "7": return 7;
        case "8": return 8;
        case "9": return 9;
        case "A": return 10;
        case "B": return 11;
        case "C": return 12;
        case "D": return 13;
        case "E": return 14;
        case "F": return 15;
    }
    return 0;
}

// Extract a user's name from a session id
// This is a lame attempt at security.  Otherwise, users would be
// able to edit their cookies.txt file and set the username in plain
// text.
// $instr is a hex-encoded string. "Hello" would be "678ea786a5".
function decode_string ( $instr ) {
    global $offsets;
    //echo "<P>DECODE <BR>";
    $orig = "";
    for ( $i = 0; $i < strlen ( $instr ); $i += 2 ) {
        //echo "<P>";
        $ch1 = substr ( $instr, $i, 1 );
        $ch2 = substr ( $instr, $i + 1, 1 );
        $val = hextoint ( $ch1 ) * 16 + hextoint ( $ch2 );
        //echo "decoding \"" . $ch1 . $ch2 . "\" = $val <br>\n";
        $j = ( $i / 2 ) % count ( $offsets );
        //echo "Using offsets $j = " . $offsets[$j] . "<br>";
        $newval = $val - $offsets[$j] + 256;
        $newval %= 256;
        //echo " neval \"$newval\" <br>\n";
        $dec_ch = chr ( $newval );
        //echo " which is \"$dec_ch\" <br>\n";
        $orig .= $dec_ch;
    }
    return $orig;
}

// Take an input string and encoded it into a slightly encoded hexval
// that we can use as a session cookie.
function encode_string ( $instr ) {
    global $offsets;
    //echo "<P>ENCODE<BR>";
    $ret = "";
    for ( $i = 0; $i < strlen ( $instr ); $i++ ) {
        //echo "<P>";
        $ch1 = substr ( $instr, $i, 1 );
        $val = ord ( $ch1 );
        //echo "val = $val for \"$ch1\" <br>\n";
        $j = $i % count ( $offsets );
        //echo "Using offsets $j = $offsets[$j]<br>";
        $newval = $val + $offsets[$j];
        $newval %= 256;
        //echo "newval = $newval for \"$ch1\" <br>\n";
        $ret .= bin2hex ( chr ( $newval ) );
    }
    return $ret;
}

?>
