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
    if(isset($_POST["email"]))
        $email=$_POST["email"];
    else
        $email=NULL;
    $result = $db->query("Select * from users_info where username='$name'");
    if(($row = mysqli_fetch_row($result))!=NULL) {
        if ($row[1] == $_POST['usrname']) {
            //To do throw exeption
            die();
        }
    }
    //$db->query("INSERT INTO users_info (username,password) VALUES ('silviuilas1111','qazqazqaz12')");
    $db->query("INSERT INTO users_info (username,password,email) VALUES ('$name','$pass','$email')");
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
                <label for="email">Email</label>
                <input type="email" id="email" name="email">
            </div>
            <div>
                <input type="submit" value="Submit">
            </div>
        </form>
    </div>
    </body>
    </html>
<?php include('footer.php'); ?>