<!DOCTYPE html>
<?php

	$config = parse_ini_file("db.ini");
    $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	$dbh->query("delete from turn");
	
	$id = 1;
	
	for($i = 1; $i < 7; $i++){
		if($i%2 == 0){
			foreach( $dbh->query("select name from Team order by name") as $rows){
				$dbh->query("insert into turn(ID, team, num, time) values( ".$id.", '".$rows[0]."', ".$i.", null )");
				$id++;
			}
		} else {
			foreach( $dbh->query("select name from Team order by name desc") as $rows){
				$dbh->query("insert into turn(ID, team, num, time) values( ".$id.",'".$rows[0]."', ".$i.", null )");
				$id++;
			}
		}	
	}
	
	date_default_timezone_set("America/New_York");
	// TODO change time acordingly
	$date = date('Y-m-d H:i:s', strtotime('+2 minute'));
	
	
	$dbh->query(" update turn set time = '".$date."' where ID = 1");
	
	echo "done";
?>