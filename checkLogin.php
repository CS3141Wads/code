<!DOCTYPE html>
<?php 
  session_start();
 ?>
<html>
    <body>
        <?php
			
			// Record the username and password, and also encrypt them
            $username1 = mysql_escape_string($_POST["username"]);
			$encrypt = md5($_POST["password"]);
            $password1 = mysql_escape_string($encrypt);

			// Connect to the database
            $config = parse_ini_file("db.ini");
            $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
            $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

			// If the Admin is logging in, go to the admin page
            $dbh->beginTransaction();
            if(isset($_POST["username"]) && isset($_POST["password"])) {
				if( $username1 == "admin@admin.com" && $password1 == md5("admin") ) {
					header("Location: admin.php" ); 
					$_SESSION["name"] = "admin";
					$_SESSION["usernameToLoad"] = $username1; 
					$_SESSION["passwordToLoad"] = $_password1; 
				}
				else {

				  // Else, query the database. If there is a result, we know that user already has an account, so load their profile page
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
            }
        ?>
    </body>
</html>

