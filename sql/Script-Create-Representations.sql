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
