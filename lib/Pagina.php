<?php

class Pagina {

    private $titelPagina;

    public function __construct($titel) {
        $this->titelPagina = $titel;
    }

    public function paginaMenu($item) {
        echo "<div id=menu> <ul>";
        if ($item == 1) echo "<li><a id=select href=\"index.php\">Home</a></li>";
        else echo "<li><a href=\"index.php\">Home</a></li>";
        if ($item == 2) echo "<li><a id=select href=\"strip_zoeken.php\">Strips</a></li>";
        else echo "<li><a href=\"strip_zoeken.php\">Strips</a></li>";
        if ($item == 3) echo "<li><a id=select href=\"gebruiker_zoeken.php?\">Gebruiker</a></li>";
        else echo "<li><a href=\"gebruiker_zoeken.php?\">Gebruiker</a></li>";
        if ($item == 4) echo "<li><a id=select href=\"tekenaar_zoeken.php\">Tekenaar</a></li>";
        else echo "<li><a href=\"tekenaar_zoeken.php\">Tekenaar</a></li>";
        if ($item == 4) echo "<li><a id=select href=\"uitgever_change.php\">Uitgeverij</a></li>";
        else echo "<li><a href=\"uitgever_change.php\">Uitgeverij</a></li>";
        echo "<li><a href=\"#\" style='color: #ffffff;'><div style='display: inline; border: solid 1px green;'>&nbsp;&nbsp;&nbsp;&nbsp;</div></a></li><li><a href=\"logout.php\">Logout</a></li>";
        echo "</ul> </div>";
    }

    public function footer() {
        echo "<div id=footer>I am footer</div>";
    }

    /**
     * @return string
     */
    public function getTitelPagina()
    {
        return $this->titelPagina;
    }


}