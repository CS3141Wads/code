<!DOCTYPE html>
<?php
	
	function checkTurn(){
		
		$config = parse_ini_file("db.ini");
		$dbh = new PDO($config['dsn'], $config['username'], $config['password']);
		$dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		
		date_default_timezone_set("America/New_York");
		foreach( $dbh->query("select team, time, ID from turn") as $rows){
			$name = $rows[0];
			$time = $rows[1];
			$id = $rows[2];
			break;
		}
		if(time() >= strtotime($time) ){
			echo "out of time";
			foreach( $dbh->query("select * from playerLifetime") as $rows){
				$player = $rows[0];
                $team = $rows[1];
                $goals =$rows[5];
                $assists = $rows[6];
                $points = $rows[7];
                $penalty = $rows[8];
				break;
			}
    		foreach( $dbh->query("select * from Team where name = '".$name."'") as $rows){
    			if($rows[2]==NULL){
    				$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.") ");
    				$dbh->query("update Team set player1 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[3]==NULL){
					$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.") ");    				$dbh->query("update Team set player2 = '".$player."' where user = '".$username."' ");
					$dbh->query("update Team set player2 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[4]==NULL){
					$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.") ");    				$dbh->query("update Team set player3 = '".$player."' where user = '".$username."' ");
					$dbh->query("update Team set player3 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[5]==NULL){
					$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.") ");    				$dbh->query("update Team set player4 = '".$player."' where user = '".$username."' ");
					$dbh->query("update Team set player4 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[6]==NULL){
					$dbh->query("insert into draftedPlayer values('".$player."','".$team."','".$rows[1]."',".$goals.",".$assists.",".$penalty.") ");    				$dbh->query("update Team set player5 = '".$player."' where user = '".$username."' ");
					$dbh->query("update Team set player5 = '".$player."' where user = '".$rows[0]."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else {
					
				}
    		}
			$dbh->query("delete from turn where ID = ".$id."");
			$date = date('Y-m-d H:i:s', strtotime('+2 minute'));
	
			$id = $id + 1;
			$dbh->query(" update turn set time = '".$date."' where ID = ".$id."");
		}	
	}

?>