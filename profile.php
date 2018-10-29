<!DOCTYPE html>
<?php
  session_start();
 ?>
<html>
   <body>
      <?php
         $name = $_SESSION["name"];
         $username = $_SESSION["usernameToLoad"];
         $password = $_SESSION["passwordToLoad"];
         $teamName = $_SESSION["teamName"];

         $config = parse_ini_file("db.ini");
         $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
         $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

         $dbh->beginTransaction();
         foreach($dbh->query("SELECT * FROM Team WHERE user = '$username' AND name = '$teamName'") as $row) {
           $player1 = $row[2];
           $player2 = $row[3];
           $player3 = $row[4];
           $player4 = $row[5];
           $player5 = $row[6];
           $goalie  = $row[7];
           $wins    = $row[8];
           $losses  = $row[9];
           $ties    = $row[10];
         }
         $dbh->commit();
      ?>

      <h1 align="center"><?php echo $teamName?></h3>

      <font size="5"><u>Team Owner:</u> <?php echo $name?></font></br></br>

      <font size="5"><u>Current Record:</u></font></br>
        <font size="5">&nbsp;&nbsp;&nbsp;<?php echo $wins?> wins</font></br>
        <font size="5">&nbsp;&nbsp;&nbsp;<?php echo $losses?> losses</font></br>
        <font size="5">&nbsp;&nbsp;&nbsp;<?php echo $ties?> ties</font></br></br>

      <font size="5"><u>Current Roster:</u></font></br>
        <?php
          $dbh->beginTransaction();
          foreach($dbh->query("SELECT * FROM draftedPlayer where name = '$player1' or name = '$player2' or name = '$player3' or name = '$player4' or name = '$player5'") as $row) {
            echo "Player: $row[0]<br>";
          }

          foreach($dbh->query("SELECT * FROM draftedGoalie where name = '$goalie'") as $row) {
            echo "Goalie: $row[0]<br>";
          }
         ?>

   </body>

   <style>
    h1 {
      font-size: 4em;
    }
   </style>
</html>
