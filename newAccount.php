<!DOCTYPE html>
<?php
  session_start();
 ?>
<html>
  <body>
    <?php
      $newName = $_POST["name"];
      $newUsername = $_POST["username"];
      $newPassword = $_POST["password"];
      $teamName = $_POST["teamName"];

      $config = parse_ini_file("db.ini");
      $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
      $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

      $dbh->beginTransaction();
      $dbh->query("INSERT INTO User VALUES('$newName', '$newUsername', '$newPassword', '$teamName')");
      $dbh->query("INSERT INTO Team VALUES('$newUsername', '$teamName', null, null, null, null, null, null, 0, 0, 0, 0)");

      $_SESSION["name"] = $newName;
      $_SESSION["usernameToLoad"] = $newUsername;
      $_SESSION["passwordToLoad"] = $newPassword;
      $_SESSION["teamName"] = $teamName;
      $dbh->commit();

      header("Location: profile.php");

    ?>

  </body>
</html>
