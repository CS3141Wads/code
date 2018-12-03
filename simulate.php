<?php

    // Connect to the database
    $config = parse_ini_file("db.ini");
    $dbh = new PDO($config['dsn'], $config['username'], $config['password']);
    $dbh->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

    // Call the procedure
    $stmt = $dbh->prepare("CALL simGame()");
    $stmt->execute();

    $stmt2 = $dbh->prepare("CALL matchMaker()");
    $stmt2->execute();

    $stmt3 = $dbh->prepare("CALL update_team_stats()");
    $stmt3->execute();
?>
