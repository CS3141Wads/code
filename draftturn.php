<!DOCTYPE html>
<?php
	
	function checkTurn($x){
		
		$config = parse_ini_file("db.ini");
		$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
	
	$time = 0; // inicalize time
	$name = "421.3"; // random variable I picked to make draft work after the time is up
	
	
		date_default_timezone_set("America/New_York");
		foreach( $dbh->query("select team, time, ID from turn") as $rows){
				$name = $rows[0]; // whoes turn is it
				$time = $rows[1]; // what time the users turn ends
				$id = $rows[2]; // currnet row id
			break;
		}
		
		if(time() >= strtotime($time) && $x == 0){ // is time past the time allowed. if so pick someone
			foreach( $dbh->query("select * from playerLifetime") as $rows){ // get the first player
				if($rows[9] == 0){
				$player = $rows[0];
                $team = $rows[1];
                $goals =$rows[5];
                $assists = $rows[6];
                $points = $rows[7];
                $penalty = $rows[8];
				break;
				}
			}
			foreach( $dbh->query("select * from goalieLifetime") as $rows){ // get the first goalie
				if($rows[9] == 0 || $rows[9] == null ){
					$goalie = $rows[0];
					$gteam = $rows[1];
					$saves =$rows[8];
					$minutes = $rows[6];
					$ggoals = $rows[7];
					$gpenalty = $rows[5];
				}
			}
			$dbh->beginTransaction();
    		foreach( $dbh->query("select * from Team where name = '".$name."'") as $rows){ // adds player to empty spot for a team and updates the drafted tables acordingly 
    			if($rows[2]==NULL){
    				$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.", 0) ");
    				$dbh->query("update Team set player1 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[3]==NULL){
					$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.",0 ) ");
					$dbh->query("update Team set player2 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[4]==NULL){
					$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.", 0) ");    				
					$dbh->query("update Team set player3 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[5]==NULL){
					$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.",0 ) ");    		
					$dbh->query("update Team set player4 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[6]==NULL){
					$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.", 0) ");    				
					$dbh->query("update Team set player5 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if ($rows[7]==NULL){
					$dbh->query("insert into draftedGoalie values('".$goalie."','".$gteam."','".$rows[1]."',".$gpenalty.",".$minutes.",".$ggoals.",".$saves.", 0) ");
					$dbh->query("update Team set goalie = '".$goalie."' where user = '".$rows[0]."' ");
					$dbh->query("update goalieLifetime set drafted = 1 where name = '".$goalie."' ");
				
				}
			
    		} 
			// deletes row from turn
			if($name != "421.3"){
				$dbh->query("delete from turn where ID = ".$id."");
			}
				$dbh->commit();
		// if user already picked someone and doesnt need an auto draft then delete the row in turn
		} else if (time() >= strtotime($time) && $x == 1 && $name != "421.3"){
			$dbh->query("delete from turn where ID = ".$id."");
		}
		return 0;
	}
	
	

?>