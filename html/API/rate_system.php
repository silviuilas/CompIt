<?php
header("Content-Type:application/json");
$aResult = array();

if( !isset($_POST['product_name']) ) { $aResult['error'] = 'No product name!'; }

if( !isset($_POST['rating']) ) { $aResult['error'] = 'No rating!'; }

$aResult['result']="Success";

echo json_encode($aResult);