<!DOCTYPE html>


<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{URL}/CSS/search.css">
    <link rel="stylesheet" href="{URL}/CSS/custom.css">
    <link rel="stylesheet" href="{URL}/CSS/search_page.css">
    <link rel="icon" href="https://cdn4.iconfinder.com/data/icons/money-and-finance/512/find-512.png">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <title>COMP IT</title>
</head>

<body class="container">
    <nav class="navbar" >
        <div class="nav_wrapper">
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
            <div class="logo_wrap">
                <a href="{URL}/" id="logo">CompIT</a>
            </div>
            <form class="search_bar_box hidden_s" action="{URL}/PHP/search.php" method="get">
                <input type="text" name="search" placeholder="Search...">
            </form>
            <div class="fav_warp">
                <a href="#" id="fav">Favorite</a>
            </div>
            <div class="name_wrap hidden_m hidden_s">
                <a href="{URL}/html_files/login.php" id="name">
                    Buna, {NAME}
                </a>
            </div>
        </div>
        <form class="mobile_search_bar_box hidden_m hidden_l" action="{URL}/PHP/search.php" method="get">
            <input type="text" name="search" placeholder="Search...">
        </form>
    </nav>