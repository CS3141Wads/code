create table playerLifetime (
	name varchar(25) PRIMARY KEY,
    originalTeam varchar(25) NOT NULL, 
    wins int default 0, 
    losses int default 0, 
    ties int default 0, 
    goals int default 0,
    assists int default 0, 
    points int default 0, 
    penaltyMinutes double default 0 
    ); 
    
create table draftedPlayer (
	name varchar(25) PRIMARY KEY, 
    originalTeam varchar(25) NOT NULL, 
    draftedTeam varchar(25) NOT NULL, 
    goals int default 0, 
    assists int default 0, 
    points int default 0, 
    penaltyMinutes double default 0, 
    currentScore double default 0 
    );
    
create table User(
	name varchar(50) not null, 
    userName varchar(50) primary key, 
    password varchar(100) not null, 
    teamName varchar(50) not null
    );
    
create table game(
	team1 varchar(50),
	team2 varchar(50), 
	date datetime, 
	winner varchar(50), 
	team1Score int, 
	team2Score int, 
	foreign key(team1) references Team(name), 
	foreign key(team2) references Team(name), 
	foreign key(winner) references Team(name), 
	primary key(team1, team2)
);

create table Team (
	user varchar(20), 
    name varchar(25), 
    player1 varchar(25), 
    player2 varchar(25), 
    player3 varchar(25),
    player5 varchar(25), 
    goalie varchar(25), 
    wins int, 
    losses int, 
    ties int, 
    score double,
    foreign key (user) references User (name),
    foreign key (player1) references playerLifetime (name), 
    foreign key (player2) references playerLifetime (name),
    foreign key (player3) references playerLifetime (name),
    foreign key (player4) references playerLifetime (name),
    foreign key (player5) references playerLifetime (name),
    foreign key (goalie) references goalieLifetime (name),
    primary key (user, name) 
    ); 



