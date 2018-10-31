<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
    <title>Profile</title>
    
    <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/pure-min.css" integrity="sha384-" crossorigin="anonymous">
    
    <!--[if lte IE 8]>
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-old-ie-min.css">
    <![endif]-->
    <!--[if gt IE 8]><!-->
        <link rel="stylesheet" href="https://unpkg.com/purecss@1.0.0/build/grids-responsive-min.css">
    <!--<![endif]-->
    
    <link rel="stylesheet" href="https://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css">
    
        <!--[if lte IE 8]>
            <link rel="stylesheet" href="css/layouts/marketing-old-ie.css">
        <![endif]-->
        <!--[if gt IE 8]><!-->
            <link rel="stylesheet" href="marketing.css">
        <!--<![endif]-->
</head>
<body>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="">Fantasy Broomball</a>

        <ul class="pure-menu-list">
			<li class="pure-menu-item"><a href="profile.php" class="pure-menu-link">Profile</a></li>
			<li class="pure-menu-item"><a href="draft.php" class="pure-menu-link">Draft</a></li>
        </ul>
    </div>
</div>

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
		echo "<TH>" .$rows[0]."</TH> ";
		echo "<TH>" .$rows[1]."</TH> ";
		echo "<TH>" .$rows[2]."</TH> ";
		echo "<TH>" .$rows[3]."</TH> ";
		echo "<TH>" .$rows[4]."</TH> ";
		echo "<TH>" .$rows[5]."</TH> ";
		echo "<TH>" .$rows[6]."</TH> ";
		echo "<TH>" .$rows[7]."</TH> ";
		echo "<TH>" .$rows[8]."</TH> ";
		echo "</TR>"; 
	}
	echo "</table>";

	echo "<h1>Goalie</h1>";
	echo "<table style='width:45%; float:left' border='1'>";
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
	
	foreach( $dbh->query("select * from playerLifetime") as $rows){
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
		echo "</TR>"; 
	}
	echo "</table>";
	
	
?>

</body>
</html>
