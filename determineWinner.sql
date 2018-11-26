CREATE DEFINER=`wccollic`@`%` FUNCTION `determineWinner`(team1Score int(11), team2Score int(11), team1Name VARCHAR(25), team2Name VARCHAR(25)) RETURNS varchar(25) CHARSET latin1
BEGIN
	DECLARE winner VARCHAR(25);

	IF team1Score > team2Score THEN SET winner = team1Name;
	ELSE 
		IF team2Score > team1Score THEN SET winner = team2Name;
		ELSE SET winner = 'tie';
        END IF;
	END IF;
    
    RETURN winner;
END