<!DOCTYPE html>
<html lang="en">
<?php
  session_start();
  if( !isset($_SESSION["name"]) && !isset($_SESSION["usernameToLoad"]) && !isset($_SESSION["passwordToLoad"]) ){
                         header("Location: index.html");
  }
 ?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A layout example that shows off a responsive product landing page.">
	<style>
	
    /* Style the tab */
    .tab {
     overflow: hidden;
     border: 1px solid #ccc;
     background-color: #f1f1f1;
    }

    .row {
      display: flex;
    }

    .columnLeft {
      height: 100%;
      float: left;
      width: 35%;
    }

    .columnRight {
      height: 100%;
      float: left;
      width: 65%;
    }

    /* Style the buttons that are used to open the tab content */
    .tab button {
     background-color: inherit;
     float: left;
     border: none;
     outline: none;
     cursor: pointer;
     padding: 14px 16px;
     transition: 0.3s;
	 color: #2D3E50;
	 font-weight: bold;
    }

    /* Create an active/current tablink class */
    .tab button.active {
     background-color: #ccc;
    }

    /* Style the tab content */
    .tabcontent {
     display: none;
     padding: 6px 12px;
     border: 1px solid #ccc;
     border-top: none;
     height: 100vh;
     overflow-y: scroll;
    }

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
	</style>
    <title>Draft</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>

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
<?php
		$config = parse_ini_file("db.ini");
        $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
		
?>

<div class="header">
    <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">
        <a class="pure-menu-heading" href="profile.php">Fantasy Broomball</a>

        <ul class="pure-menu-list">
			<li class="pure-menu-item"><a name="profileB" href="profile.php" class="pure-menu-link">Profile</a></li>
			<li class="pure-menu-item"><a name="draftB" href="draft.php" class="pure-menu-link">Draft</a></li>
			<li class="pure-menu-item"><a name="gameB" href="game.php" class="pure-menu-link">Gameplay</a></li>
			<li class="pure-menu-item"><a name="logoutB" href="logout.php" class="pure-menu-link">Logout</a></li>
        </ul>
    </div>
</div>

<h1>Draft Page</h1>

<div class="pure-g">
  <div class="pure-u-1-6" style="margin-left: 1em;">
	<?php
		include 'draftturn.php';
		$rcount = 0;
		$rosterCount=0;
		$team = "12d3";
		$number = 6;

		foreach($dbh->query("select team, num, time from turn") as $row){
			$team = $row[0];
			$number = $row[1];
			$time = $row[2];
			break;
		}
		
		$q = $dbh->query("select player1, player2, player3, player4, player5 from Team where name='".$team."'");
		$rows = $q->fetch();
		if($rows[0] != NULL){
			$rosterCount++;
		}
		if($rows[1] != NULL){
			$rosterCount++;
		}
		if($rows[2] != NULL){
			$rosterCount++;
		}
		if($rows[3] != NULL){
			$rosterCount++;
		}
		if($rows[4] != NULL){
			$rosterCount++;
		}
		foreach( $dbh->query("select goalie from Team where name='".$team."'") as $rows){
				if($rows[0] != NULL){
					$rosterCount++;
				}
		}
		
		if(isset($_SESSION['rcount'])){
			$rcount = $_SESSION['rcount'];
		} else {
			$_SESSION['rcount'] = 0;
		}
		
		if($rcount == $number){
			checkTurn(1);
		} else {
			checkTurn(0);
		}
		
		define("count", 0);
		
		foreach($dbh->query("select count(*) from turn") as $row){
				$count = $row[0];
			break;
		}
		
		 $teamName = $_SESSION["teamName"];
		
		if($team != "12d3"){
			echo "<br>";
			echo "<br>";
			echo "<br>";
			echo "<h1>".$team."'s Turn</h1>";
		} 
		echo "<h1> <p id='demo'></p></h1>";
		
	?>

	<h2>Team Roster</h2>
		<?php

		$name = $_SESSION["name"];
        $username = $_SESSION["usernameToLoad"];
		
		

		echo "<table class='pure-table pure-table-horizontal'>";
			echo "<thead>";
			echo "<tr>";
				echo "<th>Players</th><th></th>";
			echo "</tr>";
			echo "</thead>";
		echo "<tbody>";
		
		$q = $dbh->query("select player1, player2, player3, player4, player5 from Team where user='$username'");
		$rows = $q->fetch();
		if($rows[0] != NULL){
			echo "<tr>";
			echo "<td name='rm1'>".$rows[0]."</td> ";
			if($team == "12d3" || $team == $teamName ){
				echo '<form action="pick.php" method="post">';
				 echo '<input type="hidden" name="user" value="'.$_SESSION["name"].'">';
                  echo '<input type="hidden" name="username" value="'.$_SESSION["usernameToLoad"].'">';
				echo '<input type="hidden" name="rm1" value="'.$rows[0].'">';
				echo '<td> <input type="submit" name="rem1" value="Remove"> </td>';
				echo '</form>';
			}
			echo "</tr>";
		}
		if($rows[1] != NULL){
			echo "<tr>";
			echo "<td name='rm2'>".$rows[1]."</td> ";
			if($team == "12d3" || $team == $teamName ){
				echo '<form action="pick.php" method="post">';
				 echo '<input type="hidden" name="user" value="'.$_SESSION["name"].'">';
                  echo '<input type="hidden" name="username" value="'.$_SESSION["usernameToLoad"].'">';
				echo '<input type="hidden" name="rm2" value="'.$rows[1].'">';
				echo '<td> <input type="submit" name="rem2" value="Remove"> </td>';
				echo '</form>';
			}
			echo "</tr>";
		}
		if($rows[2] != NULL){
			echo "<tr>";
			echo "<td name='rm3'>".$rows[2]."</td> ";
			if($team == "12d3" || $team == $teamName ){
				echo '<form action="pick.php" method="post">';
				 echo '<input type="hidden" name="user" value="'.$_SESSION["name"].'">';
                  echo '<input type="hidden" name="username" value="'.$_SESSION["usernameToLoad"].'">';
				echo '<input type="hidden" name="rm3" value="'.$rows[2].'">';
				echo '<td> <input type="submit" name="rem3" value="Remove"> </td>';
				echo '</form>';
			}
			echo "</tr>";
		}
		if($rows[3] != NULL){
			echo "<tr>";
			echo "<td name='rm4'>".$rows[3]."</td> ";
			if($team == "12d3" || $team == $teamName ){
				echo '<form action="pick.php" method="post">';
				 echo '<input type="hidden" name="user" value="'.$_SESSION["name"].'">';
                  echo '<input type="hidden" name="username" value="'.$_SESSION["usernameToLoad"].'">';
				echo '<input type="hidden" name="rm4" value="'.$rows[3].'">';
				echo '<td> <input type="submit" name="rem4" value="Remove"> </td>';
				echo '</form>';
			}
			echo "</tr>";
		}
		if($rows[4] != NULL){
			echo "<tr>";
			echo "<td name='rm5'>".$rows[4]."</td> ";
			if($team == "12d3" || $team == $teamName ){
				echo '<form action="pick.php" method="post">';
				 echo '<input type="hidden" name="user" value="'.$_SESSION["name"].'">';
                  echo '<input type="hidden" name="username" value="'.$_SESSION["usernameToLoad"].'">';
				echo '<input type="hidden" name="rm5" value="'.$rows[4].'">';
				echo '<td> <input type="submit" name="rem5" value="Remove"> </td>';
				echo '</form>';
			}
			echo "</tr>";
		}
		echo "</tbody>";
		echo "<thead>";
			echo "<tr>";
				echo "<th>Goalie</th><th></th>";
			echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
			foreach( $dbh->query("select goalie from Team where user = '".$username."'") as $rows){
				if($rows[0] != NULL){
					echo "<tr>";
					echo "<td name='rm6'>".$rows[0]."</td>";
					if($team == "12d3" || $team == $teamName ){
						echo '<form action="pick.php" method="post">';
						 echo '<input type="hidden" name="user" value="'.$_SESSION["name"].'">';
                  echo '<input type="hidden" name="username" value="'.$_SESSION["usernameToLoad"].'">';
						echo '<input type="hidden" name="rm6" value="'.$rows[0].'">';
						echo '<td> <input type="submit" name="rem6" value="Remove"> </td>';
						echo '</form>';
					}
					echo "</tr>";
				}
			}
		echo "</tbody>";
		echo "</table>";
		
		$_SESSION['rcount'] = $rosterCount;
		
		?>
  </div>

<div class="pure-u-3-4" style="margin-left: 3em;">
    <div class="tab">
          <button class="tablinks" onclick="openTab(event, 'Players')" id="defaultOpen">Players</button>
          <button name='goal' class="tablinks" onclick="openTab(event, 'Goalies')">Goalies</button>
    </div>

    <div id="Players" class="tabcontent">
    <?php
      echo '<table id="table_id" class="display">';
        echo '<thead>';
          echo '<tr>';
            echo "<th>Player</th> ";
            echo "<th>Team</th>";
            echo "<th>Wins</th>";
            echo "<th>Losses</th>";
            echo "<th>Ties</th>";
            echo "<th>Goals</th>";
            echo "<th>Assists</th>";
            echo "<th>Points</th>";
            echo "<th>Penalty Min</th>";
            echo "<th> </th>";
          echo '</tr>';
        echo '</thead>';

        echo '<tbody>';

            foreach( $dbh->query("select * from playerLifetime") as $rows){
              //echo '<tr>';
              if($rows[9] == 0){
                //echo "<td>";
                echo "<tr>";
                echo "<td>".$rows[0]."</td> ";
                echo "<td>".$rows[1]."</td> ";
                echo "<td>".$rows[2]."</td> ";
                echo "<td>".$rows[3]."</td> ";
                echo "<td>".$rows[4]."</td> ";
                echo "<td>".$rows[5]."</td> ";
                echo "<td>".$rows[6]."</td> ";
                echo "<td>".$rows[7]."</td> ";
                echo "<td>".$rows[8]."</td> ";
				if(($team == "12d3" || $team == $teamName) && $rosterCount < $number){
                echo '<form action="pick.php" method="post">';
					 echo '<input type="hidden" name="user" value="'.$_SESSION["name"].'">';
                  echo '<input type="hidden" name="username" value="'.$_SESSION["usernameToLoad"].'">';
                  echo '<input type="hidden" name="nameP" value="'.$rows[0].'">';
                  echo '<input type="hidden" name="nameT" value="'.$rows[1].'">';
                  echo '<input type="hidden" name="goals" value="'.$rows[5].'">';
                  echo '<input type="hidden" name="assists" value="'.$rows[6].'">';
                  echo '<input type="hidden" name="points" value="'.$rows[7].'">';
                  echo '<input type="hidden" name="penalty" value="'.$rows[8].'">';
                echo '<td> <input type="submit" name="select2" value="Pick"> </td>';
                echo '</form>';
				}
              echo "</tr>";
              }
            }
        echo '</tbody>';
      echo '</table>';
      ?>
    </div>

    <div id="Goalies" class="tabcontent">
	 <!--<button class="collapsible">Open Goalies</button>
    <div class="content">-->
    <?php
    	echo '<table id="table_id2" class="display">';
			echo'<thead>';
				echo '<tr>';
					echo "<th>Goalie</th>";
					echo "<th>Team</th>";
					echo "<th>Wins</th>";
					echo "<th>Losses</th>";
					echo "<th>Ties</th>";
					echo "<th>Saves</th>";
					echo "<th>Min in Goal</th>";
					echo "<th>Goals Against</th>";
					echo "<th>Penalty Min</th>";
					echo "<th> </th>";
				echo '</tr>';
			echo '</thead>';

      echo '<tbody>';

    	foreach( $dbh->query("select * from goalieLifetime") as $rows){
    		if($rows[9] == 0){
    			echo "<tr>";
    			echo "<td>".$rows[0]."</td> ";
    			echo "<td>".$rows[1]."</td> ";
    			echo "<td>".$rows[2]."</td> ";
    			echo "<td>".$rows[3]."</td> ";
    			echo "<td>".$rows[4]."</td> ";
    			echo "<td>".$rows[8]."</td> ";
    			echo "<td>".$rows[6]."</td> ";
    			echo "<td>".$rows[7]."</td> ";
    			echo "<td>".$rows[5]."</td> ";
				if(($team == "12d3" || $team == $teamName) && $rosterCount < $number){
    			echo '<form action="pick.php" method="post">';
				 echo '<input type="hidden" name="user" value="'.$_SESSION["name"].'">';
                  echo '<input type="hidden" name="username" value="'.$_SESSION["usernameToLoad"].'">';
      			echo '<input type="hidden" name="nameG" value="'.$rows[0].'">';
  				  echo '<input type="hidden" name="nameT" value="'.$rows[1].'">';
  				  echo '<input type="hidden" name="saves" value="'.$rows[8].'">';
  				  echo '<input type="hidden" name="minutes" value="'.$rows[6].'">';
  				  echo '<input type="hidden" name="goals" value="'.$rows[7].'">';
  				  echo '<input type="hidden" name="penalty" value="'.$rows[5].'">';
    			echo '<td> <input type="submit" name="select2" value="Pick"> </td>';
    			echo '</form>';
				}
    			echo "</tr>";
    		}
    	}
    	echo '</tbody>';
    echo '</table>';
    ?>
  </div>
</div>
</div>

<script>
    $(document).ready( function () {
      $('#table_id').DataTable();
      $('#table_id2').DataTable();
    } );

    document.getElementById("defaultOpen").click();

    function sortEntries(button_id) {
      var filter = button_id + " DESC";

      '<%$_SESSION["entryFilter"] = "' + filter + '"; %>';
      location.reload(true);
    }

    function openTab(evt, cityName) {
      // Declare all variables
      var i, tabcontent, tablinks;

      // Get all elements with class="tabcontent" and hide them
      tabcontent = document.getElementsByClassName("tabcontent");
      for (i = 0; i < tabcontent.length; i++) {
          tabcontent[i].style.display = "none";
      }

      // Get all elements with class="tablinks" and remove the class "active"
      tablinks = document.getElementsByClassName("tablinks");
      for (i = 0; i < tablinks.length; i++) {
          tablinks[i].className = tablinks[i].className.replace(" active", "");
      }

      // Show the current tab, and add an "active" class to the button that opened the tab
      document.getElementById(cityName).style.display = "block";
      evt.currentTarget.className += " active";
    }
  </script>
  
<script>
// Set the date we're counting down to
var countDownDate = new Date('<?php echo $time; ?>').getTime();

var count = <?php echo $count; ?>;
var now = new Date('<?php echo date('Y-m-d H:i:s')?>').getTime();

// Update the count down every 1 second
var x = setInterval(function() {

    // Get todays date and time
    now = now + 1000;
    
    // Find the distance between now and the count down date
    var distance = countDownDate - now;
    
    // Time calculations for days, hours, minutes and seconds
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
    // Output the result in an element with id="demo"
    document.getElementById("demo").innerHTML = minutes + ":" + seconds;
    
    // If the count down is over, write some text 
    if (distance < 0) {
        clearInterval(x);
		if(count > 0){
			location.reload();
		} else {
		 document.getElementById("demo").innerHTML = "End Draft";
		}
    }
}, 1000);
</script>

</body>
</html>
