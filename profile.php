<!DOCTYPE html>
<html>
   <body>
     <p align="center">Welcome to your profile page, <?php echo $_SESSION["name"]?>!</p>
      <?php
         $name = $_SESSION["name"];
         $username = $_SESSION["usernameToLoad"];
         $password = $_SESSION["passwordToLoad"];
         $teamName = $_SESSION["teamName"];

         $config = parse_ini_file("db.ini");
         $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
         $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

         
      ?>


   </body>
</html>
