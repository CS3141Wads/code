<!DOCTYPE html>
<?php 
  session_start();
 ?>
<html>
    <body>
        <?php

            $username1 = mysql_escape_string($_POST["username"]);
			$encrypt = md5($_POST["password"]);
            $password1 = mysql_escape_string($encrypt);

            $config = parse_ini_file("db.ini");
            $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $dbh->beginTransaction();
            if(isset($_POST["username"]) && isset($_POST["password"])) {

              // Query the database, is there is a result, we know that user already has an account, so load their profile page
              foreach($dbh->query("SELECT * FROM User WHERE userName = '$username1' AND password = '$password1'") as $row) {
                $_SESSION["name"] = $row[0];
                $_SESSION["usernameToLoad"] = $username1;
                $_SESSION["passwordToLoad"] = $password1;
                $_SESSION["teamName"] = $row[3];
                $dbh->commit();

                // Go to that user's profile page
                header("Location: profile.php");
                return;
              }

              // If there were no results in the table, direct the user to create an account
              header("Location: login.php");
            }
        ?>
    </body>
</html>

<!-- // $servername = "classdb.it.mtu.edu";
// $dbUsername = "wads_rw";
// $dbPassword = "wadsworth";
// $dbName = "wads";
// // Create connection
// $conn = new mysqli ($servername, $dbUsername, $dbPassword, $dbName);
//
// // Check connection
// if ($conn->connect_eror) {
//     die("Connection failed: " . $conn->connect_error);
// } else {
//     echo "Connection successful";
// } -->
