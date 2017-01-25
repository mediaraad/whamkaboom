<?php
require __DIR__ . '/bootstrap.php';

?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <style type="text/css">
        #presentatie {width:600px; text-align:left; margin-top:50px; margin:0 auto;}
        body {display:none;}
    </style>
    <title>Tekenaars uit database</title>
    <link rel='stylesheet' href='style.css'>
    <link rel="stylesheet" type="text/css" href="css/jquery_ui/jquery-ui-1.10.3.custom.css"/>
    <link rel="stylesheet" type="text/css" href="css/datatables_table_jui.css" />
    <link rel="stylesheet" type="text/css" href="css/datatables_page.css" />

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            //$('#menu_item4').addClass("ui-tabs-active ui-state-active ui-tabs-loading");
            //$(":button").button();

            var oTable = $('#overzicht').dataTable({
                "oLanguage": {
                    "sProcessing":   "Bezig met verwerken...",
                    "sLengthMenu":   "Toon _MENU_ rijen",
                    "sZeroRecords":  "Geen resultaten gevonden",
                    "sInfo":         "_START_ tot _END_ van _TOTAL_ rijen",
                    "sInfoEmpty":    "Er zijn geen items om te tonen",
                    "sInfoFiltered": "(gefilterd uit _MAX_ rijen)",
                    "sInfoPostFix":  "",
                    "sSearch":       "Zoek:",
                    "sUrl":          "",
                    "oPaginate": {
                        "sFirst":    "Eerste",
                        "sPrevious": "Vorige",
                        "sNext":     "Volgende",
                        "sLast":     "Laatste"}
                },
                "iDisplayLength": 40,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0,3,4,5,7,8,9]},
                    {"bVisible": false, "aTargets": []}
                ],
                "aaSorting" : [[1,"asc"]]
            });

        });

    </script>
</head>
<body>
<?php
include "menu.php";
$container = new Container($configuration);
$tekenaarLader = $container->getTekenaarLader();
$tekenaars = $tekenaarLader->getTekenaars("%");
//$Query = "SELECT * from tekenaar_tbl where tek_naam like '$letter%' and ($act) order by tek_naam";
//$Result = mysqli_query ($mylink, $Query );
//echo $Query;
echo ("<div style=\"width:1000px; margin:0 auto;\"><p><table id=\"overzicht\" width='100%'><thead>\n");
echo ("<tr valign=top>\n");
echo ("<td valign=top>id</td>\n");
echo ("<td valign=top>Naam</td>\n");
echo ("<td valign=top>Voornaam</td>\n");
echo ("<td valign=top>Alias</td>\n");
echo ("<td valign=top>Geboorte datum</td>\n");
echo ("<td valign=top>Geboorte land</td>\n");
echo ("<td valign=top>Act.</td>\n");
echo ("<td valign=top>Image</td>\n");
echo ("<td valign=top>Opmerking</td>\n");
echo ("<td valign=top>Bewerk</td>\n");
echo ("</tr></thead>\n");


echo "<tbody>";

foreach ($tekenaars as $teken) {
    echo "<tr>";
    echo "<td>{$teken->getId()}</td>";
    echo "<td>{$teken->getAchterNaam()}";
    if (stristr($teken->getOpmerking(),"overleden")) echo "<span style=\"color:blue\">&dagger;</span>";
    echo "</td>";
    echo "<td>{$teken->getVoorNaam()}</td>";
    echo "<td>{$teken->getAlias()}</td>";
    echo "<td>{$teken->getGeboorteDatum()}</td>";
    echo "<td>{$teken->getGeboorteLand()}</td>";
    echo "<td>{$teken->getRol()}</td>";
    echo "<td>{$teken->getImage()}</td>";
    if ($teken->getOpmerking()!="") echo "<td>Er is een opmerking</td>";
    else echo "<td></td>";

    echo ("<td VALIGN=TOP><a href=\"tekenaar_bewerk.php?ID={$teken->getId()}\">bewerk</a>/<a href=\"tekenaar_delete.php?ID=\">verwijder</a></td>\n");


    echo "</tr>";
}
echo ("'</tbody></table></div>\n");

?>
<p>
<script type="text/javascript">
    $(function () {
        $('body').show();
    }); // end ready
</script>
</body>
</html>