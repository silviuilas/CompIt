<?php
require_once ('../configure/config.php');
$_SESSION['header']->show_file_modified()?>
<div class="main">
    <div class="information_container">
        <div class="img_item_container">
            <img id="img_style" src={imglink}>
        </div>
        <div>
            <h2 id="item_name">{name}</h2>
            <div id="favButton" class="favButton fa {heart}" onclick="fav_ajax();"></div>
            <h3>{categori}</h3>
            <h3 id="minprice">De la {minprice} RON</h3>
            <div id="stars"></div>
        </div>
    </div>
   <div id="prices_list">
   </div>
</div>

<script src="{URL}/JS/item_page.js"></script>

<?php $_SESSION['footer']->show_file_modified() ?>