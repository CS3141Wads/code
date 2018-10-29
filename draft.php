<!DOCTYPE html>
<html>
<body>
<h1>Draft Page</h1>

<?php
	$config = parse_ini_file("db.ini");
    $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
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
	echo "</TR>";
	
	foreach( $dbh->query("select * from playerLifetime") as $rows){
		echo "<TR>";
		echo "<TH>" .$rows[0]"</TH> ";
		echo "<TH>" .$rows[1]"</TH> ";
		echo "<TH>" .$rows[2]"</TH> ";
		echo "<TH>" .$rows[3]"</TH> ";
		echo "<TH>" .$rows[4]"</TH> ";
		echo "<TH>" .$rows[5]"</TH> ";
		echo "<TH>" .$rows[6]"</TH> ";
		echo "<TH>" .$rows[7]"</TH> ";
		echo "<TH>" .$rows[8]"</TH> ";
		echo "</TR>"; 
	}
	

	
	
	
?>

</body>
</html>
