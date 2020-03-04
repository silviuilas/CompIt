<?php
require_once('../configure/config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //TO DO MAKE IT SECURE FOR HTML INJECTIONS
    require_once('../PHP/Database.php');
    if (isset($_POST["usrname"])==NULL or isset($_POST["paswd"])==NULL)
    {
        echo "Username sau password bug";
        die();
    }
    $db = new Database();
    $db->connect();
    $name=trim($_POST["usrname"]);
    $pass=trim($_POST["paswd"]);
    if(isset($_POST["email"]))
        $email=trim($_POST["email"]);
    else
        $email=NULL;
    $result = $db->query("Select * from users_info where username='$name'");
    if(($row = mysqli_fetch_row($result))!=NULL) {
        if ($row[1] == $_POST['usrname']) {
            //To do throw exeption
            die();
        }
    }
    $db->query("INSERT INTO users_info (username,password,email) VALUES ('$name','$pass','$email')");
}


?>


<?php $_SESSION['header']->show_file_modified() ?>
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
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
    </body>
<?php $_SESSION['footer']->show_file_modified() ?>