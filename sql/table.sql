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
    ecole VARCHAR(50),
    FOREIGN KEY (idLogin) REFERENCES Login (idLogin) ON DELETE CASCADE
);

CREATE TABLE Gestionnaire(
    idLogin INTEGER PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    entreprise VARCHAR(255),
    telephone VARCHAR(10),
    mail VARCHAR(255),
    dateDebut DATE DEFAULT (CURRENT_DATE),
    dateFin DATE,
    FOREIGN KEY (idLogin) REFERENCES Login (idLogin) ON DELETE CASCADE
);

CREATE TABLE Administrateur(
    idLogin INTEGER PRIMARY KEY,
    nom VARCHAR(50),
    prenom VARCHAR(50),
    telephone VARCHAR(10),
    mail VARCHAR(255),
    FOREIGN KEY (idLogin) REFERENCES Login (idLogin) ON DELETE CASCADE
);


CREATE TABLE DataDefi(
    idDataDefi INTEGER PRIMARY KEY AUTO_INCREMENT,
    idGestionnaire INTEGER,
    typeD VARCHAR(50),
    nombreSujet INTEGER,
    nombreQuestionnaire INTEGER,
    nom TEXT,
    dateDebut DATE DEFAULT (CURRENT_DATE),
    dateFIN DATE,
    descriptionD TEXT,
    
    FOREIGN KEY (idGestionnaire) REFERENCES Gestionnaire (idLogin) ON DELETE SET NULL
);

CREATE TABLE ProjetData(
    idSujet INTEGER PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(50),
    descriptionS TEXT,
    idDataDefi INTEGER,
    image TEXT,
    ressources TEXT,
    FOREIGN KEY (idDataDefi) REFERENCES DataDefi (idDataDefi) ON DELETE CASCADE
);


CREATE TABLE Questionnaire(
    idQuestionnaire INTEGER PRIMARY KEY AUTO_INCREMENT,
    numero INTEGER,
    idSujet INTEGER,
    nom VARCHAR(50),
    descriptionQ TEXT,
    FOREIGN KEY (idSujet) REFERENCES ProjetData (idSujet) ON DELETE CASCADE
);

CREATE TABLE Question(
  idQuestion INTEGER PRIMARY KEY AUTO_INCREMENT,
  idQuestionnaire INTEGER,
  question TEXT,
  FOREIGN KEY (idQuestionnaire) REFERENCES Questionnaire (idQuestionnaire) ON DELETE CASCADE
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
    rendu BOOLEAN DEFAULT 0,
    FOREIGN KEY (idCapitaine) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idDataChallenge) REFERENCES DataDefi (idDataDefi) ON DELETE CASCADE,
    FOREIGN KEY (idEtudiant1) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant2) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant3) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant4) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant5) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant6) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant7) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant8) REFERENCES Etudiant (idLogin) ON DELETE SET NULL
);

CREATE TABLE Reponses(
    idReponse INTEGER PRIMARY KEY AUTO_INCREMENT,
    idGroupe INTEGER,
    idQuestion INTEGER,
    reponse TEXT,
    FOREIGN KEY (idQuestion) REFERENCES Question (idQuestion) ON DELETE CASCADE,
    FOREIGN KEY (idGroupe) REFERENCES Groupe (idGroupe) ON DELETE CASCADE
);  


CREATE TABLE Podium(
    idDataBattle INTEGER PRIMARY KEY,
    idEtudiant1 INTEGER,
    idEtudiant2 INTEGER,
    idEtudiant3 INTEGER,
    FOREIGN KEY (idEtudiant1) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant2) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idEtudiant3) REFERENCES Etudiant (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idDataBattle) REFERENCES DataDefi (idDataDefi) ON DELETE CASCADE
);


CREATE TABLE Message(
    idMessage INTEGER PRIMARY KEY AUTO_INCREMENT,
    idExpediteur INTEGER ,
    idDestinataire INTEGER,
    dateHeure DATETIME DEFAULT NOW(),
    objet VARCHAR(128),
    contenu TEXT,
    lu BOOLEAN DEFAULT 0,
    FOREIGN KEY (idExpediteur) REFERENCES Login (idLogin) ON DELETE SET NULL,
    FOREIGN KEY (idDestinataire) REFERENCES Login (idLogin) ON DELETE SET NULL
);


CREATE TABLE MessageGroupe(
    idMessage INTEGER PRIMARY KEY,
    idDestinataire INTEGER,
    FOREIGN KEY (idMessage) REFERENCES Message (idMessage) ON DELETE CASCADE,
    FOREIGN KEY (idDestinataire) REFERENCES Groupe (idGroupe) ON DELETE SET NULL
);

CREATE TABLE DataFichier(
    idDataFichier INTEGER PRIMARY KEY AUTO_INCREMENT,
    idProjetData INTEGER,
    nbLignes INTEGER,
    nbFonctions INTEGER,
    tailleMinFonction INTEGER,
    tailleMaxFonction INTEGER,
    tailleMoyenneFonction INTEGER,
    FOREIGN KEY (idProjetData) REFERENCES ProjetData (idSujet) ON DELETE CASCADE
);

CREATE TABLE Rendu(
    idGroupe INTEGER,
    idProjetData INTEGER,
    code TEXT,
    PRIMARY KEY (idGroupe, idProjetData),
    FOREIGN KEY (idGroupe) REFERENCES Groupe (idGroupe) ON DELETE CASCADE,
    FOREIGN KEY (idProjetData) REFERENCES ProjetData (idSujet) ON DELETE CASCADE
);