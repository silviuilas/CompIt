<?php
require_once ('../configure/config.php');
$_SESSION['header']->show_file_modified()?>
    <!DOCTYPE html>
    <body class="container" onload="search_items()";>
    <div class="main">
        <div class="search_container">
            <div id="search_name">
                {NUMAR_PRODUSE} de rezultate pentru "{SEARCH}"
            </div>
            <div id="search_box">
            </div>
        </div>
    </div>
    </body>
<?php $_SESSION['footer']->show_file_modified() ?>