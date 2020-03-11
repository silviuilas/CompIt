<?php
require_once('../configure/config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //TO DO MAKE IT SECURE FOR HTML INJECTIONS

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
        if ($row[1] == $_POST['usrname'])
            if ($row[2] == $_POST['paswd']) {
                $_SESSION['header']->update_array(array('NAME'=>$_POST['usrname']));
                header('Location: '._SITE_URL);
                die();
            }
    }
}
?>


<?php $_SESSION['header']->show_file_modified()?>
	<div class="main">
        <form method="post">
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

<?php $_SESSION['footer']->show_file_modified() ?>