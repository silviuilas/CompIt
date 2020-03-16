<?php
require_once ('../configure/config.php');
$_SESSION['header']->show_file_modified()?>
    <div class="main">
        <div class="search_container">
            <div id="search_name">
                {NUMAR_PRODUSE} de rezultate pentru "{SEARCH}"
            </div>
            <div class="space"></div>
            <div id="search_box">
            </div>
        </div>
    </div>
    <script defer src="{URL}/JS/search.js"></script>
<?php $_SESSION['footer']->show_file_modified() ?>