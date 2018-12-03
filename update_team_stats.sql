CREATE DEFINER=`aeciesla`@`%.mtu.edu` PROCEDURE `update_team_stats`()
BEGIN
	-- declares a done variable for when the loop ends --
	declare done int default 0;  
    -- declares variables to hold the team names and winners - 
	declare t1 varchar(25); 
    declare t2 varchar(25); 
    declare win varchar(25); 
    -- declares a cursor to loop through the entries in the game table -- 
    declare cur cursor for select team1, team2, winner from game; 
    declare continue handler for not found set done = 1; 
    
    -- opens the cursor -- 
    open cur; 
    
    -- loops through each entry in the game table -- 
    for_loop: loop
		fetch cur into t1, t2, win;
        if done then
			leave for_loop;
		end if; 
        -- checks if there was a tie and updates the tie count of the two teams -- 
        if win like 'tie' then
			update Team set ties = ties + 1 where name = t1;
            update Team set ties = ties + 1 where name = t2;
		-- checks if the first team is the winner -- 
		elseif win like t1 then
			update Team set wins = wins + 1 where name = t1;
            update Team set losses = losses + 1 where name = t2;
		-- checks if the second team is the winner -- 
		else
			update Team set wins = wins + 1 where name = t2;
            update Team set losses = losses + 1 where name = t1;
		end if;
	end loop;
    
    -- closes the cursor -- 
    close cur; 
END