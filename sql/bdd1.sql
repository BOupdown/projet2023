DROP DATABASE IF EXISTS projetIng;
CREATE DATABASE IF NOT EXISTS projetIng;
USE projetIng;


CREATE TABLE Login(
    idLogin INTEGER PRIMARY KEY AUTO_INCREMENT,
    nomUtilisateur VARCHAR(50),
    mdp TEXT,
    type VARCHAR(20)
);

CREATE TABLE Etudiant(
    idLogin INTEGER PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    niveauEtude VARCHAR(10),
    telephone VARCHAR(10),
    mail VARCHAR(255),
    FOREIGN KEY (idLogin) REFERENCES Login (idLogin)
);

CREATE TABLE Gestionnaire(
    idLogin INTEGER PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    entreprise VARCHAR(10),
    telephone VARCHAR(10),
    mail VARCHAR(255),
    dateDebut DATE DEFAULT (CURRENT_DATE),
    dateFin DATE,
    FOREIGN KEY (idLogin) REFERENCES Login (idLogin)
);

CREATE TABLE Administrateur(
    idLogin INTEGER PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    telephone VARCHAR(10),
    mail VARCHAR(255),
    FOREIGN KEY (idLogin) REFERENCES Login (idLogin)
);

CREATE TABLE DataChallenge(
    idDataChallenge INTEGER PRIMARY KEY AUTO_INCREMENT,
    idGestionnaire INTEGER,
    descriptionD TEXT,
    nom TEXT,
    dateDebut DATE DEFAULT (CURRENT_DATE),
    dateFin DATE,
    FOREIGN KEY (idGestionnaire) REFERENCES Gestionnaire (idLogin)
);

CREATE TABLE Groupe(
    idGroupe INTEGER PRIMARY KEY AUTO_INCREMENT,
    idCapitaine INTEGER,
    idDataChallenge INTEGER,
    idEtudiant1 INTEGER,
    idEtudiant2 INTEGER,
    idEtudiant3 INTEGER,
    idEtudiant4 INTEGER,
    idEtudiant5 INTEGER,
    idEtudiant6 INTEGER,
    idEtudiant7 INTEGER,
    idEtudiant8 INTEGER,
    nom VARCHAR(100),
    FOREIGN KEY (idCapitaine) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idDataChallenge) REFERENCES DataChallenge (idDataChallenge),
    FOREIGN KEY (idEtudiant1) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant2) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant3) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant4) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant5) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant6) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant7) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant8) REFERENCES Etudiant (idLogin)
);


CREATE TABLE ProjetData(
    idProjetData INTEGER PRIMARY KEY AUTO_INCREMENT,
    idDataChallenge INTEGER,
    idGroupe INTEGER,
    descriptionP TEXT,
    imageP TEXT,
    FOREIGN KEY (idDataChallenge) REFERENCES DataChallenge (idDataChallenge),
    FOREIGN KEY (idGroupe) REFERENCES Groupe (idGroupe)
);

CREATE TABLE DataBattle(
    idDataBattle INTEGER PRIMARY KEY AUTO_INCREMENT,
    idGestionnaire INTEGER,
    nom VARCHAR(50),
    descriptionP TEXT,
    dateDebut DATE,
    dateFIN DATE,
    FOREIGN KEY (idGestionnaire) REFERENCES Gestionnaire (idLogin)
);


CREATE TABLE Podium(
    idDataBattle INTEGER PRIMARY KEY,
    idEtudiant1 INTEGER,
    idEtudiant2 INTEGER,
    idEtudiant3 INTEGER,
    FOREIGN KEY (idEtudiant1) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant2) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idEtudiant3) REFERENCES Etudiant (idLogin),
    FOREIGN KEY (idDataBattle) REFERENCES DataBattle (idDataBattle)
);


CREATE TABLE Message(
    idMessage INTEGER PRIMARY KEY AUTO_INCREMENT,
    idExpediteur INTEGER,
    idDestinataire INTEGER,
    dateHeure DATE DEFAULT (CURRENT_DATE),
    lu BOOLEAN,
    FOREIGN KEY (idExpediteur) REFERENCES Login (idLogin),
    FOREIGN KEY (idDestinataire) REFERENCES Login (idLogin)
);

