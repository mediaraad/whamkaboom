<?php
require __DIR__ . '/bootstrap.php';
include "validate.php";
$pagina=new Pagina("Stripboek zoeken");
?>
<!DOCTYPE html>
<html>

<head>
    <title><?php echo $pagina->getTitelPagina(); ?></title>
    <meta charset=utf-8>
    <link rel=stylesheet href=style.css type=text/css>
    <link rel=stylesheet type=text/css href=js3/jquery-ui-1.12.1/jquery-ui.css>
    <script type=text/javascript src=js3/jquery-3.1.1.min.js></script>
    <script type=text/javascript src=js3/jquery-ui-1.12.1/jquery-ui.min.js></script>
    <script type=text/javascript>
        $(function () {
            $("#stripheld").autocomplete({
                source: "ajax_autocomplete_stripheld.php",
                minLength: 3
            });
        });
    </script>


</head>

<body>
<div id="container">
    <?php
    $pagina->paginaMenu(2);
    $pagina->movingDiv();
    ?>

    <h3>Stripboek zoeken</h3>

    <form action="strip_view.php" method="post"> Zoek een held
        <input name="held" id=stripheld> <input class=home type="submit" value="ok" name=put  >
    </form>
</div>

<p>&nbsp;<br>
<?php
$pagina->footer();
?>
</body>
</html>