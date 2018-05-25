
-- lors de la création de la base festival, il faut le jeu de caractères
-- UTF-8 et l'interclassement associé utf8_general_ci (ce sont les valeurs 
-- par défaut si vous utilisez le package EasyPHP du CERTA)
CREATE USER IF NOT EXISTS 'ychantreau_util'@'%' IDENTIFIED BY 'secret';
GRANT ALL ON ychantreau_festival . * TO 'ychantreau_util'@'%' IDENTIFIED BY 'secret';

CREATE DATABASE IF NOT EXISTS `ychantreau_festival` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `ychantreau_festival`;

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

CREATE TABLE Lieu (
    id INTEGER PRIMARY KEY, 
    nom VARCHAR(30), 
    adr VARCHAR(50), 
    capacite INTEGER 
);

CREATE TABLE Representation (
    id int NOT NULL AUTO_INCREMENT, 
    date_rep DATE NOT NULL,
    id_lieu int NOT NULL,
    id_groupe CHAR(4) NOT NULL,
    heureDebut TIME,
    heureFin TIME,
    PRIMARY KEY (id),
    CONSTRAINT FK_Lieu FOREIGN KEY (id_lieu)
    REFERENCES Lieu(id),
    CONSTRAINT FK_Groupe FOREIGN KEY (id_groupe)
    REFERENCES Groupe(id)
);


-- les dirigeants du collège de Moka et de l'Institution St-Malo Providence sont fictifs
-- idem pour le prénom de Mme Lefort
insert into Etablissement values ('0350785N', 'Collège de Moka', '2 avenue Aristide Briand BP 6', '35401', 'Saint-Malo', '0299206990', null,1,'Monsieur','Dupont','Alain');
insert into Etablissement values ('0350773A', 'Collège Ste Jeanne d''Arc-Choisy', '3, avenue de la Borderie BP 32', '35404', 'Paramé', '0299560159', null, 1,'Madame','Lefort','Anne');  
insert into Etablissement values ('0352072M', 'Institution Saint-Malo Providence', '2 rue du collège BP 31863', '35418', 'Saint-Malo', '0299407474', null, 1,'Monsieur','Durand','Pierre');   
insert into Etablissement values ('111111111', 'Centre de rencontres internationales', '37 avenue du R.P. Umbricht BP 108', '35407', 'Saint-Malo', '0299000000', null, 0, 'Monsieur','Guenroc','Guy');

insert into TypeChambre values ('C1', '1 lit');
insert into TypeChambre values ('C2', '2 à 3 lits');
insert into TypeChambre values ('C3', '4 à 5 lits');
insert into TypeChambre values ('C4', '6 à 8 lits');
insert into TypeChambre values ('C5', '8 à 12 lits');
 
-- certains groupes sont incomplètement renseignés
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g001','Groupe folklorique du Bachkortostan',40,'Bachkirie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g002','Marina Prudencio Chavez',25,'Bolivie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g003','Nangola Bahia de Salvador',34,'Brésil','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g004','Bizone de Kawarma',38,'Bulgarie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g005','Groupe folklorique camerounais',22,'Cameroun','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g006','Syoung Yaru Mask Dance Group',29,'Corée du Sud','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g007','Pipe Band',19,'Ecosse','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g008','Aira da Pedra',5,'Espagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g009','The Jersey Caledonian Pipe Band',21,'Jersey','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g010','Groupe folklorique des Émirats',30,'Emirats arabes unis','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g011','Groupe folklorique mexicain',38,'Mexique','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g012','Groupe folklorique de Panama',22,'Panama','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g013','Groupe folklorique papou',13,'Papouasie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g014','Paraguay Ete',26,'Paraguay','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g015','La Tuque Bleue',8,'Québec','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g016','Ensemble Leissen de Oufa',40,'République de Bachkirie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g017','Groupe folklorique turc',40,'Turquie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g018','Groupe folklorique russe',43,'Russie','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g019','Ruhunu Ballet du village de Kosgoda',27,'Sri Lanka','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g020','L''Alen',34,'France - Provence','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g021','L''escolo Di Tourre',40,'France - Provence','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g022','Deloubes Kévin',1,'France - Bretagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g023','Daonie See',5,'France - Bretagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g024','Boxty',5,'France - Bretagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g025','Soeurs Chauvel',2,'France - Bretagne','O');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g026','Cercle Gwik Alet',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g027','Bagad Quic En Groigne',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g028','Penn Treuz',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g029','Savidan Launay',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g030','Cercle Boked Er Lann',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g031','Bagad Montfortais',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g032','Vent de Noroise',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g033','Cercle Strollad',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g034','Bagad An Hanternoz',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g035','Cercle Ar Vro Melenig',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g036','Cercle An Abadenn Nevez',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g037','Kerc''h Keltiek Roazhon',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g038','Bagad Plougastel',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g039','Bagad Nozeganed Bro Porh-Loeiz',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g040','Bagad Nozeganed Bro Porh-Loeiz',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g041','Jackie Molard Quartet',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g042','Deomp',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g043','Cercle Olivier de Clisson',0,'France - Bretagne','N');
insert into Groupe (id, nom, nombrepersonnes, nompays, hebergement) values ('g044','Kan Tri',0,'France - Bretagne','N');

-- les offres sont fictives
insert into Offre values ('0350785N', 'C1', 5);
insert into Offre values ('0350785N', 'C2', 10);
insert into Offre values ('0350785N', 'C3', 5);

insert into Offre values ('0350773A', 'C2', 15);
insert into Offre values ('0350773A', 'C3', 1);

insert into Offre values ('0352072M', 'C1', 5);
insert into Offre values ('0352072M', 'C2', 10);
insert into Offre values ('0352072M', 'C3', 3);

-- les attributions sont fictives
insert into Attribution values ('0350785N', 'C1', 'g001', 1);
insert into Attribution values ('0350785N', 'C1', 'g002', 2);
insert into Attribution values ('0350785N', 'C1', 'g003', 2);
insert into Attribution values ('0350785N', 'C2', 'g001', 2);
insert into Attribution values ('0350785N', 'C2', 'g002', 1);
insert into Attribution values ('0350785N', 'C3', 'g001', 2);
insert into Attribution values ('0350785N', 'C3', 'g002', 1);

insert into Attribution values ('0350773A', 'C2', 'g004', 2);
insert into Attribution values ('0350773A', 'C3', 'g005', 1);

insert into Attribution values ('0352072M', 'C1', 'g006', 1);
insert into Attribution values ('0352072M', 'C2', 'g007', 3);
insert into Attribution values ('0352072M', 'C3', 'g006', 3);

INSERT INTO Lieu VALUES (1,'SALLE DU PANIER FLEURI','Rue de Boneville',450);
INSERT INTO Lieu VALUES (2,'LE CABARET','MAIRIE ANNEXE DE PARAME Place Georges COUDRAY',250);
INSERT INTO Lieu VALUES (3,'LE PARC DES CHENES','14 rue des chênes',2000);
INSERT INTO Lieu VALUES (4,'LE VILLAGE','Ecole LEGATELOIS, 25 rue Général de Catselnau',500);

INSERT INTO Representation VALUES (null,'2017-07-11',2,'g024','19:00:00','20:00:00');
INSERT INTO Representation VALUES (null,'2017-07-11',3,'g031','11:00:00','12:00:00');
INSERT INTO Representation VALUES (null,'2017-07-11',3,'g035','12:00:00','13:00:00');

INSERT INTO Representation VALUES (null,'2017-07-12',1,'g008','20:30:00','22:00:00');
INSERT INTO Representation VALUES (null,'2017-07-12',1,'g009','22:15:00','23:30:00');

INSERT INTO Representation VALUES (null,'2017-07-13',2,'g041','20:30:00','22:00:00');

INSERT INTO Representation VALUES (null,'2017-07-14',1,'g020','19:30:00','21:00:00');
INSERT INTO Representation VALUES (null,'2017-07-14',1,'g022','21:15:00','23:00:00');
INSERT INTO Representation VALUES (null,'2017-07-14',3,'g010','14:00:00','14:30:00');
INSERT INTO Representation VALUES (null,'2017-07-14',3,'g011','14:30:00','15:00:00');
INSERT INTO Representation VALUES (null,'2017-07-14',3,'g012','15:00:00','15:30:00');
INSERT INTO Representation VALUES (null,'2017-07-14',3,'g013','15:30:00','16:00:00');
INSERT INTO Representation VALUES (null,'2017-07-14',3,'g017','16:00:00','16:30:00');
INSERT INTO Representation VALUES (null,'2017-07-14',3,'g018','16:30:00','17:00:00');
INSERT INTO Representation VALUES (null,'2017-07-14',4,'g032','11:00:00','12:00:00');
INSERT INTO Representation VALUES (null,'2017-07-14',4,'g044','15:00:00','17:00:00');
INSERT INTO Representation VALUES (null,'2017-07-14',4,'g042','17:30:00','19:30:00');

INSERT INTO Representation VALUES (null,'2017-07-15',4,'g037','11:00:00','12:30:00');
INSERT INTO Representation VALUES (null,'2017-07-15',4,'g025','15:00:00','16:00:00');
INSERT INTO Representation VALUES (null,'2017-07-15',4,'g029','16:30:00','19:00:00');

