<?php

echo "<div id=menu> <ul>";

if (str_replace ( "/strips/oo/", "", $_SERVER['PHP_SELF'] )=="index.php") echo "<li><a id=select href=\"index.php\">Home</a></li>";
else echo "<li><a href=\"index.php\">Home</a></li>";
if (str_replace ( "/strips/oo/", "", $_SERVER['PHP_SELF'] ) == "strip_zoeken.php") echo "<li><a id=select href=\"strip_zoeken.php\">Strips</a></li>";
else echo "<li><a href=\"strip_zoeken.php\">Strips</a></li>";
echo "<li><a href=\"gebruiker_zoeken.php?\">Gebruiker</a></li><li><a href=\"tekenaar_zoeken.php\">Tekenaar</a></li><li><a href=\"uitgever_change.php\">Uitgeverij</a></li><li><a href=\"#\" style='color: #ffffff;'><div style='display: inline;width: 100px;'>&nbsp;</div></a></li><li><a href=\"logout.php\">Logout</a></li>";

echo "</ul> </div>";

//echo str_replace ( "/strips/oo/", "", $_SERVER['PHP_SELF'] );

