USE projetIng;


-- ----------- LOGIN ETUDIANT ------------------------------------------------------

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Omar', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Etudiant');
-- mdp = a

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Rémi', 'e9d71f5ee7c92d6dc9e92ffdad17b8bd49418f98', 'Etudiant');

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Patrick', '84a516841ba77a5b4648de2cd0dfcb30ea46dbb4', 'Etudiant');

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Julien', '3c363836cf4e16666669a25da280a1865c2d2874', 'Etudiant');

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Nezar', '58e6b3a414a1e090dfc6029add0f3555ccba127f', 'Etudiant');

-- --------------- LOGIN GESTIONNAIRE ----------------------------------------------

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Gestionnaire1', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Gestionnaire');

-- --------------- LOGIN ADMINISTRATEUR ----------------------------------------------

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Admin1', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Administrateur');

-- --------------- TABLE ETUDIANT ----------------------------------------------

INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail, ecole)
VALUES (1, 'Benzeroual', 'Omar', 'L3', '0662315984', 'benzeroual@cy-tech.fr', 'CY-Tech');

INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail, ecole)
VALUES (2, 'Couzi', 'Rémi', 'L3', '0785941652', 'couziremi@cy-tech.fr', 'CY-Tech');

INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail, ecole)
VALUES (3, 'Theuret', 'Patrick', 'L3', '0695821649', 'theuretpat@cy-tech.fr', 'CY-Tech');

INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail, ecole)
VALUES (4, 'Papini', 'Julien', 'L3', '0785269548', 'papinijuli@cy-tech.fr', 'CY-Tech');

INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail, ecole)
VALUES (5, 'El Medkour', 'Nezar', 'L3', '0715849526', 'elmedkourn@cy-tech.fr', 'CY-Tech');

-- --------------- TABLE GESTIONNAIRE ----------------------------------------------

INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin)
VALUES (6, 'Gestionnaire1', 'Gestionnaire1', 'ABC Company', '0695847128', 'gestionnaire@example.com', '2022-01-01', '2022-12-31');

-- --------------- TABLE ADMINISTRATEUR ----------------------------------------------

INSERT INTO Administrateur (idLogin, nom, prenom, telephone, mail)
VALUES (3, 'Admin1', 'Admin1', '0626594871', 'admin@example.com');

-- --------------- TABLE DATA DEFI ----------------------------------------------

INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFIN)
VALUES (6, 'DataBattle', 2, 3, 'Octogone 2pac vs Eminem', '2022-05-01', '2022-06-30');

-- --------------- TABLE SUJET ----------------------------------------------

INSERT INTO Sujet (nom, descriptionS, idDataDefi)
VALUES ('Sujet1', 'Si 2pac était un bard', 1);

INSERT INTO Sujet (nom, descriptionS, idDataDefi)
VALUES ('Sujet2', 'Si Eminem était boucher', 1);

-- --------------- TABLE QUESTIONNAIRE ----------------------------------------------

INSERT INTO Questionnaire (nom, descriptionQ, idDataDefi)
VALUES ('Questionnaire1', 'pas d idee', 1);

INSERT INTO Questionnaire (nom, descriptionQ, idDataDefi)
VALUES ('Questionnaire2', 'Questionnaire pour un champion', 1);

INSERT INTO Questionnaire (nom, descriptionQ, idDataDefi)
VALUES ('Questionnaire3', 'QCM inédit', 1);

-- --------------- TABLE GROUPE ----------------------------------------------

INSERT INTO Groupe (idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, nom)
VALUES (1, 1, 1, 2, 3, 'Groupe A');

-- --------------- TABLE PROJET DATA ----------------------------------------------

INSERT INTO ProjetData (idDataChallenge, idGroupe, descriptionP, imageP)
VALUES (1, 1, 'le bard sort victorieux', 'images/image.png');

-- --------------- TABLE PODIUM ----------------------------------------------

INSERT INTO Podium (idDataBattle, idEtudiant1, idEtudiant2, idEtudiant3)
VALUES (1, 3, 4, 5);

-- --------------- TABLE MESSAGE ----------------------------------------------

INSERT INTO Message (idExpediteur, idDestinataire, dateHeure, contenu)
VALUES (1, 2, '2023-05-17 8:05:20', 'bonjour bonjour bonjour b!!!!! jour');

INSERT INTO Message (idExpediteur, idDestinataire, dateHeure, contenu)
VALUES (2, 1, '2023-05-17 10:54:32', 'salutt salut :) b!!!!! jour');

INSERT INTO Message (idExpediteur, idDestinataire, dateHeure, contenu)
VALUES (1, 3, '2023-05-18 17:04:11', 'oui c pour ca que je parle avec user3');

INSERT INTO Message (idExpediteur, idDestinataire, dateHeure, contenu)
VALUES (3, 1, '2023-05-18 19:04:11', 'ok merci user1');

INSERT INTO Message (idExpediteur, idDestinataire, dateHeure, contenu)
VALUES (1, 4, '2023-05-19 15:47:21', 'sssssssssssssssssssssss');

INSERT INTO Message (idExpediteur, idDestinataire, dateHeure, contenu)
VALUES (1, 2, '2023-05-23 14:08:08', 'Bonjour, chacal!');

-- 