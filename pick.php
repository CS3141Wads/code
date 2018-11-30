<?php
		$config = parse_ini_file("db.ini");
        $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
        $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

		$name = $_POST["user"];
        $username = $_POST["username"];

    	if(isset($_POST["nameP"])){
    		$player = $_POST["nameP"];
    		foreach( $dbh->query("select * from Team where user = '".$username."'") as $rows){
    			if($rows[2]==NULL){
    				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["penalty"].",0) ");
    				$dbh->query("update Team set player1 = '".$player."' where user = '".$username."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[3]==NULL){
    				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["penalty"].",0) ");
    				$dbh->query("update Team set player2 = '".$player."' where user = '".$username."' ");
					$dbh->query("update  playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[4]==NULL){
    				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["penalty"].",0) ");
    				$dbh->query("update Team set player3 = '".$player."' where user = '".$username."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[5]==NULL){
    				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["penalty"].",0) ");
    				$dbh->query("update Team set player4 = '".$player."' where user = '".$username."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} else if($rows[6]==NULL){
    				$dbh->query("insert into draftedPlayer values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["goals"].",".$_POST["assists"].",".$_POST["penalty"].",0) ");
    				$dbh->query("update Team set player5 = '".$player."' where user = '".$username."' ");
					$dbh->query("update playerLifetime set drafted = 1 where name = '".$player."' ");
    			} 
    		}
    	}

		if(isset($_POST["nameG"])){
			$player = $_POST["nameG"];
			foreach( $dbh->query("select * from Team where user = '".$username."'") as $rows){
				if($rows[7] == NULL){
					$dbh->query("insert into draftedGoalie values('".$player."','".$_POST["nameT"]."','".$rows[1]."',".$_POST["penalty"].",".$_POST["minutes"].",".$_POST["goals"].",".$_POST["saves"].",0) ");
					$dbh->query("update Team set goalie = '".$player."' where user = '".$username."' ");
					$dbh->query("update goalieLifetime set drafted = 1 where name = '".$player."' ");
				}
			}
		}

    	if(isset($_POST["rm1"])){
    		$player = $_POST["rm1"];
    		$dbh->query("update Team set player1 = NULL where user = '".$username."' ");
    		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
			$dbh->query("update playerLifetime set drafted = 0 where name = '".$player."' ");
    	}

    	if(isset($_POST["rm2"])){
    		$player = $_POST["rm2"];
    		$dbh->query("update Team set player2 = NULL where user = '".$username."' ");
    		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
			$dbh->query("update playerLifetime set drafted = 0 where name = '".$player."' ");
    	}

    	if(isset($_POST["rm3"])){
    		$player = $_POST["rm3"];
    		$dbh->query("update Team set player3 = NULL where user = '".$username."' ");
    		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
			$dbh->query("update playerLifetime set drafted = 0 where name = '".$player."' ");
    	}

    	if(isset($_POST["rm4"])){
    		$player = $_POST["rm4"];
    		$dbh->query("update Team set player4 = NULL where user = '".$username."' ");
    		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
			$dbh->query("update playerLifetime set drafted = 0 where name = '".$player."' ");
    	}

    	if(isset($_POST["rm5"])){
    		$player = $_POST["rm5"];
    		$dbh->query("update Team set player5 = NULL where user = '".$username."' ");
    		$dbh->query("delete from draftedPlayer where name = '".$player."' ");
			$dbh->query("update playerLifetime set drafted = 0 where name = '".$player."' ");
    	}

		if(isset($_POST["rm6"])){
    		$player = $_POST["rm6"];
    		$dbh->query("update Team set goalie = NULL where user = '".$username."' ");
    		$dbh->query("delete from draftedGoalie where name = '".$player."' ");
			$dbh->query("update goalieLifetime set drafted = 0 where name = '".$player."' ");
    	}
		
		header("Location: draft.php");
		?>