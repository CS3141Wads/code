<!DOCTYPE html>
<?php

	$config = parse_ini_file("db.ini");
    $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$dbh->query("delete from turn");
	foreach( $dbh->query("select name from Team") as $rows){
		$dbh->query("update Team set player1 = null where name = '".$rows[0]."'");
		$dbh->query("update Team set player2 = null where name = '".$rows[0]."'");
		$dbh->query("update Team set player3 = null where name = '".$rows[0]."'");
		$dbh->query("update Team set player4 = null where name = '".$rows[0]."'");
		$dbh->query("update Team set player5 = null where name = '".$rows[0]."'");
		$dbh->query("update Team set goalie = null where name = '".$rows[0]."'");
		$dbh->query("update Team set wins = 0 where name = '".$rows[0]."'");
		$dbh->query("update Team set losses = 0 where name = '".$rows[0]."'");
		$dbh->query("update Team set ties = 0 where name = '".$rows[0]."'");
		$dbh->query("update Team set currentScore = 0 where name = '".$rows[0]."'");
	}
	$dbh->query("delete from draftedPlayer");
	$dbh->query("delete from draftedGoalie");
	foreach( $dbh->query("select name from playerLifetime") as $rows){
		$dbh->query("update playerLifetime set drafted = 0 where name = '".$rows[0]."'");
	}
	foreach( $dbh->query("select name from goalieLifetime") as $rows){
		$dbh->query("update goalieLifetime set drafted = 0 where name = '".$rows[0]."'");
	}
	
	$id = 1;
	
	date_default_timezone_set("America/New_York");
	$date = date('Y-m-d H:i:s');
	
	for($i = 1; $i < 7; $i++){
		if($i%2 == 0){
			foreach( $dbh->query("select name from Team order by name") as $rows){
				//$date = date('Y-m-d H:i:s', strtotime('+'.$id*2 . ' minute'));
				$date = date('Y-m-d H:i:s', strtotime('+'.$id*10 . ' second'));
				$dbh->query("insert into turn(ID, team, num, time) values( ".$id.", '".$rows[0]."', ".$i.", '".$date."' )");
				$id++;
			}
		} else {
			foreach( $dbh->query("select name from Team order by name desc") as $rows){
			//	$date = date('Y-m-d H:i:s', strtotime('+'.$id*2 . ' minute'));
			$date = date('Y-m-d H:i:s', strtotime('+'.$id*10 . ' second'));
				$dbh->query("insert into turn(ID, team, num, time) values( ".$id.",'".$rows[0]."', ".$i.", '".$date."' )");
				$id++;
			}
		}	
	}
	
	//date_default_timezone_set("America/New_York");
	// TODO change time acordingly
	//$date = date('Y-m-d H:i:s', strtotime('+2 minute'));
	
	
	//$dbh->query(" update turn set time = '".$date."' where ID = 1");
	
	echo "done";
?>