<?php
require __DIR__ . '/bootstrap.php';
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">

    <style type="text/css">
        #presentatie {
            width: 600px;
            text-align: left;
            margin-top: 50px;
            margin: 0 auto;
        }

        /* body {display:none;} */
    </style>
    <title>Uitgevers uit database</title>
    <link rel='stylesheet' href='style.css'>
    <link rel="stylesheet" type="text/css" href="css/jquery_ui/jquery-ui-1.10.3.custom.css"/>
    <!-- <link rel="stylesheet" type="text/css" href="js3/DataTables-1.10.13/media/css/dataTables.jqueryui.css" /> -->
    <link rel="stylesheet" type="text/css" href="css/datatables_table_jui.css"/>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery-ui-min.js"></script>
    <script type="text/javascript" src="js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            //$('#menu_item4').addClass("ui-tabs-active ui-state-active ui-tabs-loading");
            //$(":button").button();

            var oTable = $('#overzicht').dataTable({
                "oLanguage": {
                    "sProcessing": "Bezig met verwerken...",
                    "sLengthMenu": "Toon _MENU_ rijen",
                    "sZeroRecords": "Geen resultaten gevonden",
                    "sInfo": "_START_ tot _END_ van _TOTAL_ rijen",
                    "sInfoEmpty": "Er zijn geen items om te tonen",
                    "sInfoFiltered": "(gefilterd uit _MAX_ rijen)",
                    "sInfoPostFix": "",
                    "sSearch": "Zoek ",
                    "sUrl": "",
                    /*

                     "bProcessing": true,
                     "bServerSide": true,
                     "sAjaxSource": "ajax.php",
                     "sPaginationType": "full_numbers",
                     "sServerMethod": "POST",
                     */

                    "oPaginate": {
                        "sFirst": "Eerste",
                        "sPrevious": "Vorige",
                        "sNext": "Volgende",
                        "sLast": "Laatste"
                    }
                },
                "iDisplayLength": 25,
                "bJQueryUI": true,
                "sPaginationType": "full_numbers",
                "aoColumnDefs": [
                    {"bSortable": false, "aTargets": [0,4]},
                    {"bVisible": false, "aTargets": []}
                ],
                "aaSorting": [[1, "asc"]]
            });

        });

        function confirmDelete(entry) {
            return confirm("Weet u zeker dat u * " + entry + " * wilt verwijderen?");
        }
    </script>

</head>
<body>


<?php
include "menu.php";
$container = new Container($configuration);
$uitgeverLader = $container->getUitgeverLader();
/*
echo '<pre>';
print_r($uitgeverLader);
echo '</pre>';
*/
$uitgevers = $uitgeverLader->getUitgever("%");

// var_dump($uitgevers);


//$Query = "SELECT * from tekenaar_tbl where tek_naam like '$letter%' and ($act) order by tek_naam";
//$Result = mysqli_query ($mylink, $Query );
//echo $Query;
echo("<div style=\"width:1000px; margin:0 auto;\"><p><table id='overzicht' width='100%'><thead>\n");
echo("<tr valign=top>\n");
echo("<td valign=top>id</td>\n");
echo("<td valign=top>Naam</td>\n");
echo("<td valign=top>Adres</td>\n");
echo("<td valign=top>Opmerking</td>\n");
echo("<td valign=top>Bewerk</td>\n");
echo("</tr></thead>\n");


echo "<tbody>";

foreach ($uitgevers as $uitgever) {
    echo "<tr>";
    echo "<td>{$uitgever->getId()}</td>";
    echo "<td>{$uitgever->getNaam()}";
    echo "<td>{$uitgever->getAdres()}</td>";

    if ($uitgever->getOpmerking() != "") echo "<td>Er is een opmerking</td>";
    else echo "<td></td>";

    echo("<td VALIGN=TOP><a href=\"uitgever_bewerk.php?ID={$uitgever->getId()}\">bewerk</a>/<a onClick=\"return confirmDelete('{$uitgever->getNaam()}');\" href=\"uitgever_verwijder.php?id={$uitgever->getId()}\">verwijder</a></td>\n");


    echo "</tr>";
}
echo("'</tbody></table></div>\n");

?>
<p>
    <script type="text/javascript">
        $(function () {
            $('body').show();
        }); // end ready
    </script>
</body>
</html>