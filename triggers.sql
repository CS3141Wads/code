delimiter //
-- updates the player's lifetime stats when they play in a game that ties -- 
create trigger update_lifetime_stats after update on Team
for each row begin 
	-- checks if the most recent game resulted in a win and updates the win count of each player -- 
	if ( NEW.wins = OLD.wins + 1 ) then 
		update playerLifetime set wins = wins + 1 where name = NEW.player1;
        update playerLifetime set wins = wins + 1 where name = NEW.player2; 
        update playerLifetime set wins = wins + 1 where name = NEW.player3;
        update playerLifetime set wins = wins + 1 where name = NEW.player4; 
        update playerLifetime set wins = wins + 1 where name = NEW.player5; 
        update goalieLifetime set wins = wins + 1 where name = NEW.goalie;
	-- checks if the most recent game resulted in a loss and updates the loss count of each player -- 
	elseif ( NEW.losses = OLD.losses + 1 ) then
		update playerLifetime set losses = losses + 1 where name = NEW.player1;
        update playerLifetime set losses = losses + 1 where name = NEW.player2; 
        update playerLifetime set losses = losses + 1 where name = NEW.player3;
        update playerLifetime set losses = losses + 1 where name = NEW.player4; 
        update playerLifetime set losses = losses + 1 where name = NEW.player5; 
        update goalieLifetime set losses = losses + 1 where name = NEW.goalie;
	-- checks if the most recent game resulted in a tie and updates the tie count of each player -- 
    elseif ( NEW.ties = OLD.ties + 1 ) then 
		update playerLifetime set ties = ties + 1 where name = NEW.player1;
        update playerLifetime set ties = ties + 1 where name = NEW.player2; 
        update playerLifetime set ties = ties + 1 where name = NEW.player3;
        update playerLifetime set ties = ties + 1 where name = NEW.player4; 
        update playerLifetime set ties = ties + 1 where name = NEW.player5; 
        update goalieLifetime set ties = ties + 1 where name = NEW.goalie;
	end if; 
end //

-- updates each team's total score any time a player's personal score is updated
CREATE TRIGGER update_team_score AFTER UPDATE ON draftedPlayer
FOR EACH ROW BEGIN 
-- resets team score to zero, individual player scores are then added to the total one at a time
UPDATE Team SET currentScore = 0;
UPDATE Team INNER JOIN draftedPlayer ON Team.player1 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player2 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player3 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player4 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player5 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedGoalie ON Team.goalie = draftedGoalie.name SET Team.currentScore = Team.currentScore + draftedGoalie.currentScore;
END;//

-- updates each team's total score any time a goalie's personal score is updated 
CREATE TRIGGER update_team_score_2 AFTER UPDATE ON draftedGoalie
FOR EACH ROW
BEGIN 
-- resets team score to zero, individual player score are then added to the total one at a time 
UPDATE Team SET currentScore = 0;
UPDATE Team INNER JOIN draftedPlayer ON Team.player1 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player2 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player3 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player4 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player5 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedGoalie ON Team.goalie = draftedGoalie.name SET Team.currentScore = Team.currentScore + draftedGoalie.currentScore;
END;//


delimiter ;



