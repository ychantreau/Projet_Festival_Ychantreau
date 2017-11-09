CREATE TABLE Representation  (
    date CHAR(11) NOT NULL,
    id_lieu int NOT NULL,
    id_groupe CHAR(4) NOT NULL,
    heureDebut VARCHAR(5),
    heureFin VARCHAR(5),
    PRIMARY KEY (date,id_lieu,id_groupe),
    CONSTRAINT FK_Lieu FOREIGN KEY (id_lieu)
    REFERENCES Lieu(id),
    CONSTRAINT FK_Groupe FOREIGN KEY (id_groupe)
    REFERENCES Groupe(id)
);