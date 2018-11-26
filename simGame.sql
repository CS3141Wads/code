CREATE DEFINER=`wccollic`@`%` PROCEDURE `simGame`()
BEGIN

	-- Assign goals to players and update their lifetime stats --
	UPDATE draftedPlayer dp JOIN playerLifetime pl ON dp.name = pl.name
    SET dp.goals = 
		CASE 
			WHEN (pl.goals >= 0  and pl.goals <= 4)  THEN FLOOR(RAND()*(2-0+1)) 
            WHEN (pl.goals >= 5  and pl.goals <= 9)  THEN FLOOR(RAND()*(3-0+1)) 
            WHEN (pl.goals >= 10 and pl.goals <= 14) THEN FLOOR(RAND()*(4-0+1)) 
            WHEN (pl.goals >= 15 and pl.goals <= 19) THEN FLOOR(RAND()*(5-0+1)) 
            WHEN (pl.goals >= 20)                    THEN FLOOR(RAND()*(6-0+1))
		END; 
        
	UPDATE draftedPlayer dp JOIN playerLifetime pl ON dp.name = pl.name
    SET pl.goals = pl.goals + dp.goals;
    
    -- Assign assists to players and update their lifetime stats --
	UPDATE draftedPlayer dp JOIN playerLifetime pl ON dp.name = pl.name
    SET dp.assists = 
		CASE 
			WHEN (pl.assists >= 0  and pl.assists <= 4)  THEN FLOOR(RAND()*(1-0+1)) 
            WHEN (pl.assists >= 5  and pl.assists <= 9)  THEN FLOOR(RAND()*(2-0+1)) 
            WHEN (pl.assists >= 10 and pl.assists <= 14) THEN FLOOR(RAND()*(3-0+1)) 
            WHEN (pl.assists >= 15 and pl.assists <= 19) THEN FLOOR(RAND()*(4-0+1)) 
            WHEN (pl.assists >= 20)                      THEN FLOOR(RAND()*(5-0+1))
		END;
        
	UPDATE draftedPlayer dp JOIN playerLifetime pl ON dp.name = pl.name
    SET pl.assists = pl.assists + dp.assists;
     
    -- Assign penalty minutes to players and update their lifetime stats --
	UPDATE draftedPlayer dp JOIN playerLifetime pl ON dp.name = pl.name
    SET dp.penaltyMinutes = 
		CASE 
			WHEN (pl.penaltyMinutes >= 0  and pl.penaltyMinutes <= 2)  THEN FLOOR(RAND()*(2-0+1)) 
            WHEN (pl.penaltyMinutes >= 3  and pl.penaltyMinutes <= 5)  THEN FLOOR(RAND()*(3-0+1)) 
            WHEN (pl.penaltyMinutes >= 6)                              THEN FLOOR(RAND()*(4-0+1)) 
		END;
        
    UPDATE draftedPlayer dp JOIN playerLifetime pl ON dp.name = pl.name
    SET pl.penaltyMinutes = pl.penaltyMinutes + dp.penaltyMinutes;
    
    -- Assign penalty minutes to goalies and update their lifetime stats --
	UPDATE draftedGoalie dg JOIN goalieLifetime gl ON dg.name = gl.name
    SET dg.penaltyMinutes = 
		CASE
			WHEN (gl.penaltyMinutes >= 0  and gl.penaltyMinutes <= 2)  THEN FLOOR(RAND()*(2-0+1)) 
            WHEN (gl.penaltyMinutes >= 3  and gl.penaltyMinutes <= 5)  THEN FLOOR(RAND()*(3-0+1)) 
            WHEN (gl.penaltyMinutes >= 6)                              THEN FLOOR(RAND()*(4-0+1)) 
		END;
        
    UPDATE draftedGoalie dg JOIN goalieLifetime gl ON dg.name = gl.name
    SET gl.penaltyMinutes = gl.penaltyMinutes + dg.penaltyMinutes;
    
    -- Increment each active goalie's minutes played by 30 in both their drafted and lifetime entry --
	UPDATE draftedGoalie set goalieMinutes = goalieMinutes + 30;
    UPDATE goalieLifetime set goalieMinutes = goalieMinutes + 30 WHERE drafted = 1;
    
    -- Assign goals against to goalies and update their lifetime stats
    UPDATE draftedGoalie dg JOIN goalieLifetime gl ON dg.name = gl.name
    SET dg.goalsAgainst = 
		CASE
			WHEN (gl.goalsAgainst >= 0  and gl.goalsAgainst <= 4)  THEN FLOOR(RAND()*(2-0+1)) 
            WHEN (gl.goalsAgainst >= 5  and gl.goalsAgainst <= 9)  THEN FLOOR(RAND()*(3-0+1)) 
            WHEN (gl.goalsAgainst >= 10 and gl.goalsAgainst <= 14) THEN FLOOR(RAND()*(4-0+1)) 
            WHEN (gl.goalsAgainst >= 15 and gl.goalsAgainst <= 19) THEN FLOOR(RAND()*(5-0+1)) 
            WHEN (gl.goalsAgainst >= 20)                           THEN FLOOR(RAND()*(6-0+1))
		END;
        
    UPDATE draftedGoalie dg JOIN goalieLifetime gl ON dg.name = gl.name
    SET gl.goalsAgainst = gl.goalsAgainst + dg.goalsAgainst;
    
    -- Assign saves to goalies and update their lifetime stats
	UPDATE draftedGoalie dg JOIN goalieLifetime gl ON dg.name = gl.name
    SET dg.saves = 
		CASE
			WHEN (gl.saves >= 0   and gl.saves <= 39)  THEN FLOOR(RAND()*(9-5+1)+5)
            WHEN (gl.saves >= 40  and gl.saves <= 79)  THEN FLOOR(RAND()*(14-10+1)+10)
            WHEN (gl.saves >= 80  and gl.saves <= 119) THEN FLOOR(RAND()*(19-15+1)+15)
            WHEN (gl.saves >= 120 and gl.saves <= 159) THEN FLOOR(RAND()*(24-20+1)+20)
            WHEN (gl.saves >= 160 and gl.saves <= 199) THEN FLOOR(RAND()*(29-25+1)+25)
            WHEN (gl.saves >= 200)                     THEN FLOOR(RAND()*(34-30+1)+30)
		END;
        
	UPDATE draftedGoalie dg JOIN goalieLifetime gl ON dg.name = gl.name
    SET gl.saves = gl.saves + dg.saves;
    
END