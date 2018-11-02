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
			<li class="pure-menu-item"><a href="profile.php" class="pure-menu-link">Profile</a></li>
			<li class="pure-menu-item"><a href="draft.php" class="pure-menu-link">Draft</a></li>
			<li class="pure-menu-item"><a href="logout.php" class="pure-menu-link">Logout</a></li>
        </ul>
    </div>
</div>

<h1>Draft Page</h1>

<div style="clear: both">
<h2 style="float: left"><u> Team Roster </u></h2>
<h2 style="float: right"><u> TODO who is up </u></h2>
</div>

<?php
	$config = parse_ini_file("db.ini");
   	$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
  	$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	$name = $_SESSION["name"];
    $username = $_SESSION["usernameToLoad"];
    $teamName = $_SESSION["teamName"];
		


	if(isset($_POST["nameP"])){
	$player = $_POST["nameP"];
		foreach( $dbh->query("select * from Team where user = '".$username."'") as $rows){
			if($rows[2]==NULL){
				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["points"].",".$_POST["penalty"].",0) ");
				$dbh->query("update Team set player1 = '".$player."' where user = '".$username."' ");
			} else if($rows[3]==NULL){
				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["points"].",".$_POST["penalty"].",0) ");
				$dbh->query("update Team set player2 = '".$player."' where user = '".$username."' ");
			} else if($rows[4]==NULL){
				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["points"].",".$_POST["penalty"].",0) ");
				$dbh->query("update Team set player3 = '".$player."' where user = '".$username."' ");
			} else if($rows[5]==NULL){
				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["points"].",".$_POST["penalty"].",0) ");
				$dbh->query("update Team set player4 = '".$player."' where user = '".$username."' ");
			} else if($rows[6]==NULL){
				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["points"].",".$_POST["penalty"].",0) ");
				$dbh->query("update Team set player5 = '".$player."' where user = '".$username."' ");
			}
		}
	}
	
	if(isset($_POST["rm1"])){
		$player = $_POST["rm1"];
		$dbh->query("update Team set player1 = NULL where user = '".$username."' ");
		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
	}
	
	if(isset($_POST["rm2"])){
		$player = $_POST["rm2"];
		$dbh->query("update Team set player2 = NULL where user = '".$username."' ");
		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
	}
	
	if(isset($_POST["rm3"])){
		$player = $_POST["rm3"];
		$dbh->query("update Team set player3 = NULL where user = '".$username."' ");
		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
	}
	
	if(isset($_POST["rm4"])){
		$player = $_POST["rm4"];
		$dbh->query("update Team set player4 = NULL where user = '".$username."' ");
		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
	}
	
	if(isset($_POST["rm5"])){
		$player = $_POST["rm5"];
		$dbh->query("update Team set player5 = NULL where user = '".$username."' ");
		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
	}

	echo "<table style='width:45% border='1' align='center'>";
	foreach( $dbh->query("select * from Team where user = '".$username."'") as $rows){
		if($rows[2] != NULL){
			echo "<TR>";
			echo "<TH>" .$rows[2]."</TH> ";
			echo '<form action="draft.php" method="post">';
			echo '<input type="hidden" name="rm1" value="'.$rows[2].'">';
			echo '<TD> <input type="submit" name="select2" value="Remove"> </TD>';
			echo '</form>';
			echo "</TR>";
		}
		if($rows[3] != NULL){
			echo "<TR>";
			echo "<TH>" .$rows[3]."</TH> ";
			echo '<form action="draft.php" method="post">';
			echo '<input type="hidden" name="rm2" value="'.$rows[3].'">';
			echo '<TD> <input type="submit" name="select2" value="Remove"> </TD>';
			echo '</form>';
			echo "</TR>";
		}
		if($rows[4] != NULL){
			echo "<TR>";
			echo "<TH>" .$rows[4]."</TH> ";
			echo '<form action="draft.php" method="post">';
			echo '<input type="hidden" name="rm3" value="'.$rows[4].'">';
			echo '<TD> <input type="submit" name="select2" value="Remove"> </TD>';
			echo '</form>';
			echo "</TR>";
		}
		if($rows[5] != NULL){
			echo "<TR>";
			echo "<TH>" .$rows[5]."</TH> ";
			echo '<form action="draft.php" method="post">';
			echo '<input type="hidden" name="rm4" value="'.$rows[5].'">';
			echo '<TD> <input type="submit" name="select2" value="Remove"> </TD>';
			echo '</form>';
			echo "</TR>";
		}
		if($rows[6] != NULL){
			echo "<TR>";
			echo "<TH>" .$rows[6]."</TH> ";
			echo '<form action="draft.php" method="post">';
			echo '<input type="hidden" name="rm5" value="'.$rows[6].'">';
			echo '<TD> <input type="submit" name="select2" value="Remove"> </TD>';
			echo '</form>';
			echo "</TR>";
		}
		echo "<TR>";
		echo "<TH>" .$rows[7]."</TH> ";
		echo "</TR>";
		echo "<TR>";
		echo '</form>';
		echo "</TR>"; 
	}
	echo "</table>";
	
?>

<button class="collapsible">Players</button>
<div class="content">
<?php
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
	echo "<TH> Penalty Minutes  </TH>";
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
			echo '<input type="hidden" name="nameT" value="'.$rows[1].'">';
			echo '<input type="hidden" name="wins" value="'.$rows[2].'">';
			echo '<input type="hidden" name="losses" value="'.$rows[3].'">';
			echo '<input type="hidden" name="goals" value="'.$rows[5].'">';
			echo '<input type="hidden" name="assists" value="'.$rows[6].'">';
			echo '<input type="hidden" name="points" value="'.$rows[7].'">';
			echo '<input type="hidden" name="penalty" value="'.$rows[8].'">';
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
	echo "<TH> Penalty Minutes </TH>";
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
