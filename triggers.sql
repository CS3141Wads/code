delimiter //
create trigger update_team_stats after insert on game
for each row begin
	declare win varchar(25); 
    declare dat date; 
    declare t1 varchar(25);
    declare t2 varchar(25);
    select winner into win from game order by data desc limit 1; 
    select data into dat from game order by data desc limit 1; 
    select team1 into t1 from game where data=dat and team1 != win;
    select team2 into t2 from game where data=dat and team2 != win; 
    if ( win like 'tie' ) then 
		update Team set ties = ties + 1 where name = t1;
        update Team set ties = ties + 1 where name = t2; 
    else 
		update Team set wins = wins + 1 where name = win; 
		update Team set losses = losses + 1 where name = ifnull ( t1, t2 ); 
	end if; 
end // 

create trigger update_lifetime_stats after update on Team
for each row begin 
    if ( NEW.ties = OLD.ties + 1 ) then 
		update playerLifetime set ties = ties + 1 where name = NEW.player1;
        update playerLifetime set ties = ties + 1 where name = NEW.player2; 
        update playerLifetime set ties = ties + 1 where name = NEW.player3;
        update playerLifetime set ties = ties + 1 where name = NEW.player4; 
        update playerLifetime set ties = ties + 1 where name = NEW.player5; 
        update goalieLifetime set ties = ties + 1 where name = NEW.goalie;
	end if; 
end //

CREATE TRIGGER update_team_score AFTER UPDATE ON draftedPlayer
FOR EACH ROW BEGIN 
UPDATE Team SET currentScore = 0;
UPDATE Team INNER JOIN draftedPlayer ON Team.player1 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player2 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player3 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player4 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player5 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedGoalie ON Team.goalie = draftedGoalie.name SET Team.currentScore = Team.currentScore + draftedGoalie.currentScore;
END;//
delimiter ;



