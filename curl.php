<?php



// Script to test if the CURL extension is installed on this server

// Define function to test

/*function _is_curl_installed() {
    if  (in_array  ('curl', get_loaded_extensions())) {
        return true;
    }
    else {
        return false;
    }
}

// Ouput text to user based on test
if (_is_curl_installed()) {
    echo "cURL is <span style=\"color:blue\">installed</span> on this server";
} else {
    echo "cURL is NOT <span style=\"color:red\">installed</span> on this server";
}*/


$url = "https://www.google.nl/search?q=asterix+de+gallier";
   function curl($url) {
        $ch = curl_init();  // Initialising cURL
        curl_setopt($ch, CURLOPT_URL, $url);    // Setting cURL's URL option with the $url variable passed into the function
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); // Setting cURL's option to return the webpage data
        $data = curl_exec($ch); // Executing the cURL request and assigning the returned data to the $data variable
        curl_close($ch);    // Closing cURL
        return $data;   // Returning the data from the function
    }

?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">

    <title>Strip collectie</title>

    <link rel='stylesheet' href='style.css' type="text/css">
</head>
<body>

<?php

echo curl($url);
?>
</body>
</html>
