<!DOCTYPE html>
<?php
  session_start();
 ?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
	<style>
	.collapsible {
  	 background-color: #777; 
  	  color: white;
  	  cursor: pointer;
  	  padding: 18px;
  	  width: 100%;
  	 border: none;
  	  text-align: left;
  	  outline: none;
   	 font-size: 15px;
	}

	.active, .collapsible:hover {
 	   background-color: #555;
	}

	.content {
    	padding: 0 18px;
    	display: none;
  	overflow: hidden;
	}

	tr:nth-child(even) {
	background-color: #f2f2f2;
	}

	th, td {
   	 text-align: left;
   	 padding: 8px;
	}

	table {
  	  border-collapse: collapse;
  	  width: 100%;
	}

	table  tbody{
  	display:block;
  	height:200px;
  	overflow:auto;
	 width: 100%;
	}
	</style>
    <title>Draft</title>
    
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
			<li class="pure-menu-item"><a href="logout.php" class="pure-menu-link">Logout</a></li>
			<li class="pure-menu-item"><a href="profile.php" class="pure-menu-link">Profile</a></li>
			<li class="pure-menu-item"><a href="draft.php" class="pure-menu-link">Draft</a></li>
        </ul>
    </div>
</div>

<h1>Draft Page</h1>

<div style="clear: both">
<h2 style="float: left"><u> Team Roster </u></h2>
<h2 style="float: right"><u> TODO who is up </u></h2>
</div>

<button class="collapsible">Players</button>
<div class="content">
<?php
	$config = parse_ini_file("db.ini");
    $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	if(isset($_POST["nameP"])){
		echo $_POST["nameP"];
	}
	
	echo "<h1>Player</h1>";
	echo "<table style='width:45% border='1' align='center'>";
	echo "<TR>";
	echo "<TH> Player Name </TH> ";
	echo "<TH> Team Name </TH>";
	echo "<TH> Wins  </TH>";
	echo "<TH> Losses  </TH>";
	echo "<TH> Ties  </TH>";
	echo "<TH> Goals  </TH>";
	echo "<TH> Assists  </TH>";
	echo "<TH> Points  </TH>";
	echo "<TH> Penlty Minutes  </TH>";
	echo "<TH> </TH>";
	echo "</TR>";
	
	foreach( $dbh->query("select * from playerLifetime") as $rows){
		if($rows[9]){
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
			echo '<input type="hidden" name="nameP" value="'.$rows[0].'">';
			echo '<TD> <input type="submit" name="select2" value="Pick"> </TD>';
			echo '</form>';
			echo "</TR>"; 
		}
	}
	echo "</table>";
?>
</div>

<button class="collapsible">Open Goalies</button>
<div class="content">
<?php 
	echo "<h1>Goalie</h1>";
	echo "<table style='width:45% border='1' align='center'>";
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
	
	foreach( $dbh->query("select * from goalieLifetime") as $rows){
		if($rows[9]){
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
			echo '<input type="hidden" name="nameG" value="'.$rows[0].'">';
			echo '<TD> <input type="submit" name="select2" value="Pick"> </TD>';
			echo '</form>';
			echo "</TR>";
		}			
	}
	echo "</table>";
	
	
?>
</div>

<script>
var coll = document.getElementsByClassName("collapsible");
var i;

for (i = 0; i < coll.length; i++) {
  coll[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var content = this.nextElementSibling;
    if (content.style.display === "block") {
      content.style.display = "none";
    } else {
      content.style.display = "block";
    }
  });
}
</script>

</body>
</html>
