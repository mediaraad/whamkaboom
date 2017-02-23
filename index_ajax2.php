<!DOCTYPE html>
    <html>
<head>
<title>Ajax</title>
    <script>
        function ajax_post(){
            // Create our XMLHttpRequest object
            var hr = new XMLHttpRequest();
            // Create some variables we need to send to our PHP file
            var url = "ajax_parse.php";
            var fn = document.getElementById("voornaam").value;
            var ln = document.getElementById("achternaam").value;
            var vars = "voornaam="+fn+"&achternaam="+ln;
            hr.open("POST", url, true);
            // Set content type header information for sending url encoded variables in the request
            hr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            // Access the onreadystatechange event for the XMLHttpRequest object
            hr.onreadystatechange = function() {
                if(hr.readyState == 4 && hr.status == 200) {
                    var return_data = hr.responseText;
                    document.getElementById("status").innerHTML = return_data;
                }
            }
            // Send the data to PHP now... and wait for response to update the status div
            hr.send(vars); // Actually execute the request
            document.getElementById("status").innerHTML = "processing...";
        }
    </script>
</head>
<body>
<h2>Ajax post to php and get return data.</h2>
Voornaam <input id="voornaam" name="voornaam" type="text">
<br /><br />
Achternaam <input id="achternaam" name="achternaam" type="text">
<br /><br />
<input type="submit" name="submit" value="Submit Data" onclick="javascript:ajax_post()">

<div id="status"></div>


</body>
</html>