<!DOCTYPE html>
<?php
	
	function checkTurn($x){
		
		$config = parse_ini_file("db.ini");
		$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	//	define("ch", 0);
	
	$time = 0;
	$name = "421.3";
	
	
		date_default_timezone_set("America/New_York");
		foreach( $dbh->query("select team, time, ID from turn") as $rows){
				$name = $rows[0];
				$time = $rows[1];
				$id = $rows[2];
	//			$ch = 1;
			break;
		}
		
		if(time() >= strtotime($time) && $x == 0){
			foreach( $dbh->query("select * from playerLifetime") as $rows){
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
			foreach( $dbh->query("select * from goalieLifetime") as $rows){
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
    		foreach( $dbh->query("select * from Team where name = '".$name."'") as $rows){
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
			//$date = date('Y-m-d H:i:s', strtotime('+2 minute'));
	
			//$id = $id + 1;
			//$dbh->query(" update turn set time = '".$date."' where ID = ".$id."");
			
    		} 
			if($name != "421.3"){
				$dbh->query("delete from turn where ID = ".$id."");
			}
				$dbh->commit();
		} else if (time() >= strtotime($time) && $x == 1 && $name != "421.3"){
			$dbh->query("delete from turn where ID = ".$id."");
		}
		return 0;
	}
	
	

?>