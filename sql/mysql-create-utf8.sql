
-- lors de la création de la base festival, il faut le jeu de caractères
-- UTF-8 et l'interclassement associé utf8_general_ci (ce sont les valeurs 
-- par défaut si vous utilisez le package EasyPHP du CERTA)

GRANT ALL ON ychantreau_festival . * TO 'ychantreau_util'@'localhost' IDENTIFIED BY 'secret';

DROP TABLE IF EXISTS `Attribution`;
DROP TABLE IF EXISTS `Offre`;
DROP TABLE IF EXISTS `TypeChambre`;
DROP TABLE IF EXISTS `Groupe`;
DROP TABLE IF EXISTS `Etablissement`;

create table Etablissement 
(id char(8) not null, 
nom varchar(45) not null,
adresseRue varchar(45) not null, 
codePostal char(5) not null, 
ville varchar(35) not null,
tel varchar(13) not null,
adresseElectronique varchar(70),
type tinyint not null,
civiliteResponsable varchar(12) not null,
nomResponsable varchar(25) not null,
prenomResponsable varchar(25),
constraint pk_Etablissement primary key(id))
ENGINE=INNODB;

create table TypeChambre
(id char(2) not null, 
libelle varchar(15) not null, 
constraint pk_TypeChambre primary key(id))
ENGINE=INNODB;

create table Offre
(idEtab char(8) not null, 
idTypeChambre char(2) not null, 
nombreChambres integer not null, 
constraint pk_Offre primary key(idEtab, idTypeChambre), 
INDEX(idTypeChambre),
constraint fk1_Offre foreign key(idEtab) references Etablissement(id) 
ON DELETE CASCADE ON UPDATE CASCADE, 
constraint fk2_Offre foreign key(idTypeChambre) references TypeChambre(id)
ON DELETE CASCADE ON UPDATE CASCADE)
ENGINE=INNODB;

create table Groupe
(id char(4) not null, 
nom varchar(40) not null, 
identiteResponsable varchar(40) default null,
adressePostale varchar(120) default null,
nombrePersonnes integer not null, 
nomPays varchar(40) not null, 
hebergement char(1) not null,
constraint pk_Groupe primary key(id))
ENGINE=INNODB;

create table Attribution
(idEtab char(8) not null, 
idTypeChambre char(2) not null, 
idGroupe char(4) not null, 
nombreChambres integer not null,
INDEX(idTypeChambre),
INDEX(idGroupe),
constraint pk_Attribution primary key(idEtab, idTypeChambre, idGroupe), 
constraint fk1_Attribution foreign key(idGroupe) references Groupe(id), 
constraint fk2_Attribution foreign key(idEtab, idTypeChambre) references Offre(idEtab, idTypeChambre) )
ENGINE=INNODB;
