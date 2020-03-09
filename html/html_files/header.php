<!DOCTYPE html>


<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{URL}/CSS/search.css">
    <link rel="stylesheet" href="{URL}/CSS/custom.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/money-and-finance/512/find-512.png">
    <script src="{URL}/JS/customJS.js"></script>
    <title>COMP IT</title>
</head>
<nav class="navbar" >
    <a href="{URL}/">CompIT</a>
    <input type="text" placeholder="Search...">
    <a href="#">Favorite</a>
    <div class="dropdown">
        <a href="javascript:void(0);" class="icon" onclick="dropDownHamburger()">
            <i class="fa fa-bars"></i>
        </a>
        <div class="dropcontent">
            <a href="#">Categorii</a>
            <a href="{URL}/html_files/login.php">Login</a>
            <a href="{URL}/html_files/register.php">Sign Up</a>
            <a href="#">Your Opinion</a>
        </div>
    </div>
    <a href="{URL}/html_files/login.php">
    <?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    if(isset($_SESSION['username'])) {
        echo "Buna ";
        echo $_SESSION['username'];
    }
    else
    {
        echo "Login";
    }
    ?>
    </a>
</nav>