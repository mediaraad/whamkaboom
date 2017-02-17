<?php
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
