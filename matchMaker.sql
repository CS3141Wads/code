CREATE DEFINER=`wccollic`@`%` PROCEDURE `matchMaker`()
BEGIN
	DECLARE theWinner VARCHAR(25);
	DECLARE team1Name VARCHAR(25);
    DECLARE team2Name VARCHAR(25);
    DECLARE team1Score INTEGER(11);
    DECLARE team2Score INTEGER(11);
    
	-- Reset all teams to have not played yet
	UPDATE Team SET played = 0;

	WHILE(SELECT COUNT(*) FROM Team WHERE played = 0) >= 2
    DO
		-- Select 2 random teams and mark them as having each played a game
        SET team1Name = (SELECT name FROM Team WHERE played = 0 ORDER BY RAND() LIMIT 1);
        UPDATE Team SET played = 1 WHERE name = team1Name;
        
        SET team2Name = (SELECT name FROM Team WHERE played = 0 ORDER BY RAND() LIMIT 1);
        UPDATE Team SET played = 1 WHERE name = team2Name;
        
        -- Get the scores for each team
        SET team1Score = (SELECT currentScore FROM Team WHERE name = team1Name);
        SET team2Score = (SELECT currentScore FROM Team WHERE name = team2Name);
        
        -- Call the determineWinner function to decide who won the game (or if it's a tie)
        SET theWinner = determineWinner(team1Score, team2Score, team1Name, team2Name);
        
		-- Insert data into game table
		INSERT INTO game2 VALUES(team1Name, team2Name, CURRENT_DATE(), theWinner, team1Score, team2Score);
   END WHILE;  
END