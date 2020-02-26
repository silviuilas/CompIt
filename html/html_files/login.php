<?php
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //TO DO MAKE IT SECURE TO SQL INJECTIONS
    require_once('../PHP/Database.php');
    if (isset($_POST["usrname"])==NULL or isset($_POST["paswd"])==NULL)
    {
        echo "Username sau password bug";
        die();
    }
    $db = new Database();
    $db->connect();
    $name=$_POST["usrname"];
    $pass=$_POST["paswd"];
    $result = $db->query("Select * from users_info where username='$name'");
    if(($row = mysqli_fetch_row($result))!=NULL) {
        echo implode(" ",$row);
        if ($row[1] == $_POST['usrname'])
            if ($row[2] == $_POST['paswd']) {
                header('Location: http://compit.dev');
                die();
            }
    }
    }
?>


<?php include('header.php'); ?>
<!DOCTYPE html>
<body>
	<div class="main">
        <form action="" method="post">
                <br>
                <div>
                <label for="usrname">Nume</label>
                    <input type="text" id="usrname" name="usrname" required>
                </div>
                <div>
                <label for="paswd">Password</label>
                    <input type="password" id="paswd" name="paswd" pattern="(?=.*\d)(?=.*[a-z]).{8,}" title="Trebuie sa contina cel putin un numar si sa aiba cel putin 8 cifre" required>
                </div>
                <div>
                    <input type="submit" value="Submit">
                </div>
        </form>
	</div>
</body>
</html>
<?php include('footer.php'); ?>