delimiter //
-- updates the wins, losses, and ties of a team based on their most recent game -- 
create trigger update_team_stats after insert on game
for each row begin
	declare win varchar(25); 
    declare dat date; 
    declare t1 varchar(25);
    declare t2 varchar(25);
    -- selects the winner from the most recent game -- 
    select winner into win from game order by data desc limit 1; 
    -- selects the date from the most recent game -- 
    select data into dat from game order by data desc limit 1; 
    -- grabs both team names, where the lossing team name will be null -- 
    select team1 into t1 from game where data=dat and team1 != win;
    select team2 into t2 from game where data=dat and team2 != win; 
    -- increases the tie count for both teams if they tie  -- 
    if ( win like 'tie' ) then 
		update Team set ties = ties + 1 where name = t1;
        update Team set ties = ties + 1 where name = t2; 
	-- increases the win count and losses count for the winning and lossing team respectively -- 
    else 
		update Team set wins = wins + 1 where name = win; 
		update Team set losses = losses + 1 where name = ifnull ( t1, t2 ); 
	end if; 
end // 

-- updates the player's lifetime stats when they play in a game that ties -- 
delimiter // 
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
delimiter ;



