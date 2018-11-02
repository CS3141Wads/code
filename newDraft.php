<!DOCTYPE html>
<?php
  session_start();

  $config = parse_ini_file("db.ini");
  $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
  $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
 ?>
<html>
  <head>

  </head>

  <body>
    <!-- Tab links -->
    <div class="tab">
      <button class="tablinks" onclick="openTab(event, 'Players')" id="defaultOpen">Players</button>
      <button class="tablinks" onclick="openTab(event, 'Goalies')">Goalies</button>
    </div>

    <!-- Tab content -->
    <div id="Players" class="tabcontent">
      <div style="text-align: center;">
        <h1>Order players by:</h1>
        <button class="button" id="wins" onClick="sortEntries(this.id)">Wins</button>
        <button class="button" id="looses" onClick="sortEntries(this.id)">Losses</button>
        <button class="button" id="ties" onClick="sortEntries(this.id)">Ties</button>
        <button class="button" id="goals" onClick="sortEntries(this.id)">Goals</button>
        <button class="button" id="assists" onClick="sortEntries(this.id)">Assists</button>
        <button class="button" id="points" onClick="sortEntries(this.id)">Points</button>
        <button class="button" id="penaltyMinutes" onClick="sortEntries(this.id)">Penalty Minutes</button>
        </br>
        </br>
        </br>
      </div>


      <?php
      	if(isset($_POST["nameP"])){
      		echo $_POST["nameP"];
      	}

        if(isset($_SESSION["entryFilter"])) {

        } else {
          $_SESSION["entryFilter"] = "goals ASC";
        }

        $sortByThis = $_SESSION["entryFilter"];

      	echo "<table style='width:45% border='1' align='center'>";
      	echo "<TR>";
      	echo "<TH> <u>Player Name</u> </TH> ";
      	echo "<TH> <u>Team Name</u> </TH>";
      	echo "<TH> <u>Wins</u>  </TH>";
      	echo "<TH> <u>Losses</u>  </TH>";
      	echo "<TH> <u>Ties</u>  </TH>";
      	echo "<TH> <u>Goals</u>  </TH>";
      	echo "<TH> <u>Assists</u>  </TH>";
      	echo "<TH> <u>Points</u>  </TH>";
      	echo "<TH> <u>Penlty Minutes</u>  </TH>";
      	echo "<TH> </TH>";
      	echo "</TR>";

      	foreach( $dbh->query("SELECT * FROM playerLifetime ORDER BY $sortByThis") as $rows){
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

    <div id="Goalies" class="tabcontent">
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
  </body>

  <style>
    /* Style the tab */
    .tab {
     overflow: hidden;
     border: 1px solid #ccc;
     background-color: #f1f1f1;
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
    }

    /* Change background color of buttons on hover */
    .tab button:hover {
     background-color: #ddd;
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
    }
  </style>

  <script>
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
</html>
