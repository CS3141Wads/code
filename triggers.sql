delimiter //
create trigger update_team_stats after insert on game
for each row
begin
	declare win varchar(25); 
    declare dat date; 
    declare t1 varchar(25);
    declare t2 varchar(25);
    select winner into win from game order by data desc limit 1; 
    select data into dat from game order by data desc limit 1; 
    select team1 into t1 from game where data=dat and team1 != win;
    select team2 into t2 from game where data=dat and team2 != win; 
    update Team set wins = wins + 1 where name = win; 
	update Team set losses = losses + 1 where name = ifnull ( t1, t2 ); 
end // 

CREATE TRIGGER update_team_score AFTER UPDATE ON draftedPlayer
FOR EACH ROW
BEGIN 
UPDATE Team SET currentScore = 0;
UPDATE Team INNER JOIN draftedPlayer ON Team.player1 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player2 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player3 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player4 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedPlayer ON Team.player5 = draftedPlayer.name SET Team.currentScore = Team.currentScore + draftedPlayer.currentScore;
UPDATE Team INNER JOIN draftedGoalie ON Team.goalie = draftedGoalie.name SET Team.currentScore = Team.currentScore + draftedGoalie.currentScore;
END;//
delimiter ;



