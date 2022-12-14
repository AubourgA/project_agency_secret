-- creation de la bdd
DROP SCHEMA IF EXISTS MONAGENCE;
CREATE SCHEMA MONAGENCE; 

-- creation de la table ADMIN
CREATE TABLE ADMIN
 (
	Id int not null primary key auto_increment,
	name varchar(50) not null,
	firstname varchar(50) not null,
	email varchar(255) not null,
	password varchar(255) not null,
	createdAt DATETIME
)
ENGINE=InnoDB
;


-- creation de la table AGENT
CREATE TABLE AGENTS (
    Id int NOT NULL AUTO_INCREMENT,
    Specialite VARCHAR(50) NOT NULL,
    Name varchar(50) NOT NULL,
    Prenom varchar(50) NOT NULL,
    Date_naissance DATETIME NOT NULL,
    Type_mission varchar(100),
    Code int(11) NOT NULL,
    Nationality varchar(50) NOT NULL,
    PRIMARY KEY (Id)  
)
ENGINE=INNODB;

-- creation de la table CIBLE
CREATE TABLE CIBLE (
    Id int NOT NULL AUTO_INCREMENT,
    Name varchar(50) NOT NULL,
    Prenom varchar(50) NOT NULL,
    Date_naissance DATETIME NOT NULL,
    Code int(11) NOT NULL,
    Nationality varchar(50) NOT NULL,
    PRIMARY KEY (Id)
)
ENGINE=INNODB;


-- creation de la table CONTACT
CREATE TABLE CONTACT (
    Id int NOT NULL AUTO_INCREMENT,
    Name varchar(50) NOT NULL,
    Prenom varchar(50) NOT NULL,
    Date_naissance DATETIME NOT NULL,
    Code int(11) NOT NULL,
    Nationality varchar(50) NOT NULL,
    PRIMARY KEY (Id) 
)
ENGINE=INNODB;


-- creation de la table PLANQUE
CREATE TABLE Planque (
    Id int NOT NULL AUTO_INCREMENT,
    Adress varchar(255) NOT NULL,
    Country varchar(100) NOT NULL,
    Code int(11) NOT NULL,
    Type varchar(100) NOT NULL,
    PRIMARY KEY (Id) 
)
ENGINE=INNODB;


-- creation de la table MISSION
CREATE TABLE MISSIONS (
    Id int NOT NULL AUTO_INCREMENT,
    Title VARCHAR(50) NOT NULL,
    Description longtext NOT NULL,
    Status varchar(50) NOT NULL,
    Date_debut DATETIME NOT NULL,
    Date_fin DATETIME NOT NULL,
    Type_mission varchar(100),
    Code_name VARCHAR(50) NOT NULL,
    Agent_Id int NOT NULL,
    Cible_Id int NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (Agent_Id) REFERENCES AGENTS(Id),
    FOREIGN KEY (Cible_Id) REFERENCES CIBLE(Id)
)
ENGINE=INNODB;

-- creation de la table MIXED
CREATE TABLE contact_mission (
    Id int NOT NULL AUTO_INCREMENT,
    Mission_Id int NOT NULL,
    Contact_Id int NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (Mission_Id) REFERENCES MISSIONS(Id),
    FOREIGN KEY (Contact_Id) REFERENCES CONTACT(Id)
)
ENGINE=INNODB;

-- creation de la table MIXED
CREATE TABLE planque_mission (
    Id int NOT NULL AUTO_INCREMENT,
    Mission_Id int NOT NULL,
    Planque_Id int NOT NULL,
    PRIMARY KEY (Id),
    FOREIGN KEY (Mission_Id) REFERENCES MISSIONS(Id),
    FOREIGN KEY (Planque_Id) REFERENCES PLANQUE(Id)
)
ENGINE=INNODB;