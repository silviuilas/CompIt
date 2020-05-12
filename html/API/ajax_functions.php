<?php
header("Content-Type:application/json");
require_once ('../configure/config.php');

$aResult = array();
$function = $_POST['fct_name'];

switch ($function) {
    case "rate_system":
        if (!isset($_POST['product_name'])) {
            $aResult['error'] = 'No product name!';
            break;
        }
        if (!isset($_POST['rating'])) {
            $aResult['error'] = 'No rating!';
            break;
        }
        $aResult['result'] = "Success";
        break;
    case "favorite_system":
        if (!isset($_POST['product_name'])) {
            $aResult['error'] = 'No product name!';
            break;
        }
        if (!isset($_POST['set'])) {
            $aResult['error'] = 'I am confused!';
            break;
        }
        $name=$_POST['product_name'];
        $db = Database::getDatabaseObj();
        $db->connect();
        $query = $db->query("Select * from items where name ='".$name."'");
        $row=mysqli_fetch_row($query);
        $row[6]=0;
        if(!isset($_SESSION['fav']))
            $_SESSION['fav']=[];
        array_push($_SESSION['fav'],$row);
        //TODO check if working
        $_SESSION['fav']=array_reverse(array_unique(array_reverse($_SESSION['fav']),SORT_REGULAR));
        if(count($_SESSION['fav'])>=30)
            unset($_SESSION['fav'][0]);
        if($_POST['set']==0)
            array_pop($_SESSION['fav']);
        $aResult['result']=count($_SESSION['fav']);
        break;
}
echo json_encode($aResult);