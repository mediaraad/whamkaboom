<?php

$url = "https://www.google.nl/search?q=asterix+de+gallier&biw=1149&bih=937&source=lnms&tbm=isch&sa=X&sqi=2&ved=0ahUKEwi-mNarpJfSAhXMAMAKHZWfAl4Q_AUIBigB#q=asterix+de+gallier&tbm=isch&tbas=0&imgrc=_";

// $url = "https://www.google.nl/imgres?imgurl=http%3A%2F%2Fwww.asterix.com%2Fbd%2Falbs%2F01dex.jpg&imgrefurl=http%3A%2F%2Fwww.asterix.com%2Fde-collectie%2Fde-albums%2Fasterix-de-gallier.html&docid=fz-HKDuagMdCSM&tbnid=QagqUsfnJ-aK-M%3A&vet=1&w=435&h=580&bih=937&biw=1595&q=asterix%20de%20gallier&ved=0ahUKEwjTiPPXpJfSAhVCuBQKHTuhDscQMwgaKAAwAA&iact=mrc&uact=8";


// $client->setHeader('User-Agent', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_2) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.111 Safari/537.36');


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




$html = curl($url);
echo '<pre>';
echo ($html);
echo '</pre>';

?>
</body>
</html>
