<?php
require_once ('../configure/config.php');
$_SESSION['header']->update_array_key('ONLOAD_JS','search_items();');
$_SESSION['header']->show_file_modified()?>
    <div class="main">
        <div class="search_container">
            <div id="search_name">
                {NUMAR_PRODUSE} de rezultate pentru "{SEARCH}"
            </div>
            <div id="search_box">
            </div>
        </div>
    </div>
<?php $_SESSION['footer']->show_file_modified() ?>