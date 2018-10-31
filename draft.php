<!DOCTYPE html>
<html>
<body>
<h1>Draft Page</h1>

<?php
	$config = parse_ini_file("db.ini");
    $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	if(isset($_POST["nameP"])){
		echo $_POST["nameP];
	}
	
	echo "<h1>Player</h1>";
	echo "<table style='width:45%; float:left' border='1'>";
	echo "<TR>";
	echo "<TH> Player Name </TH> ";
	echo "<TH> Team Name </TH>";
	echo "<TH> Wins </TH>";
	echo "<TH> Losses </TH>";
	echo "<TH> Ties </TH>";
	echo "<TH> Goals </TH>";
	echo "<TH> Assists </TH>";
	echo "<TH> Points </TH>";
	echo "<TH> Penlty Minutes </TH>";
	echo "<TH> </TH>";
	echo "</TR>";
	
	foreach( $dbh->query("select * from playerLifetime") as $rows){
		if(!$row[9]){
			echo "<TR>";
			echo "<TH>" .$rows[0]."</TH> ";
			echo "<TH>" .$rows[1]."</TH> ";
			echo "<TH>" .$rows[2]."</TH> ";
			echo "<TH>" .$rows[3]."</TH> ";
			echo "<TH>" .$rows[4]."</TH> ";
			echo "<TH>" .$rows[5]."</TH> ";
			echo "<TH>" .$rows[6]."</TH> ";
			echo "<TH>" .$rows[7]."</TH> ";
			echo "<TH>" .$rows[8]."</TH> ";
			echo '<form action="draft.php" method="post">';
			echo '<input type="hidden" name="nameP" value="'.$row[0].'">';
			echo '<TD> <input type="submit" name="select2" value="Pick"> </TD>';
			echo '</form>';
			echo "</TR>"; 
		}
	}
	echo "</table>";

	echo "<h1>Goalie</h1>";
	echo "<table style='width:45%; float:right' border='1'>";
	echo "<TR>";
	echo "<TH> Player Name </TH> ";
	echo "<TH> Team Name </TH>";
	echo "<TH> Wins </TH>";
	echo "<TH> Losses </TH>";
	echo "<TH> Ties </TH>";
	echo "<TH> Saves </TH>";
	echo "<TH> Minutes in Goal </TH>";
	echo "<TH> Goals Against </TH>";
	echo "<TH> Penlty Minutes </TH>";
	echo "</TR>";
	
	foreach( $dbh->query("select * from playerGoalie") as $rows){
		if(!$row[9]){
			echo "<TR>";
			echo "<TH>" .$rows[0]."</TH> ";
			echo "<TH>" .$rows[1]."</TH> ";
			echo "<TH>" .$rows[2]."</TH> ";
			echo "<TH>" .$rows[3]."</TH> ";
			echo "<TH>" .$rows[4]."</TH> ";
			echo "<TH>" .$rows[8]."</TH> ";
			echo "<TH>" .$rows[6]."</TH> ";
			echo "<TH>" .$rows[7]."</TH> ";
			echo "<TH>" .$rows[5]."</TH> ";
			echo '<form action="draft.php" method="post">';
			echo '<input type="hidden" name="nameG" value="'.$row[0].'">';
			echo '<TD> <input type="submit" name="select2" value="Pick"> </TD>';
			echo '</form>';
			echo "</TR>";
		}			
	}
	echo "</table>";
	
	
?>

</body>
</html>
