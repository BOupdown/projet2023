USE projetIng;


-- ----------- LOGIN ETUDIANT ------------------------------------------------------

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Omar', '86f7e437faa5a7fce15d1ddcb9eaeaea377667b8', 'Etudiant');
-- mdp = a

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Rémi', 'e9d71f5ee7c92d6dc9e92ffdad17b8bd49418f98', 'Etudiant');
-- mdp = b

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Patrick', '84a516841ba77a5b4648de2cd0dfcb30ea46dbb4', 'Etudiant');
-- mdp = c

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Julien', '3c363836cf4e16666669a25da280a1865c2d2874', 'Etudiant');
-- mdp = d

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Nezar', '58e6b3a414a1e090dfc6029add0f3555ccba127f', 'Etudiant');
-- mdp = e

-- --------------- LOGIN GESTIONNAIRE ----------------------------------------------

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Gestionnaire1', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Gestionnaire');
-- mdp = password123

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Gestionnaire2', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Gestionnaire');
-- mdp = password123

-- --------------- LOGIN ADMINISTRATEUR ----------------------------------------------

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Admin1', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Administrateur');
-- mdp = password123

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


INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin)
VALUES (7, 'Gestionnaire2', 'Gestionnaire2', 'ZZZ Company', '0695847128', 'gestionnaire@example.com', '2022-01-01', '2022-12-31');

-- ---------------ABLE ADMINISTRATEUR ----------------------------------------------

INSERT INTO Administrateur (idLogin, nom, prenom, telephone, mail)
VALUES (3, 'Admin1', 'Admin1', '0626594871', 'admin@example.com');

-- --------------- TABLE DATA DEFI ----------------------------------------------

INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFIN)
VALUES (6, 'DataBattle', 2, 3, 'Octogone 2pac vs Eminem', '2022-05-01', '2022-06-30');

INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFIN)
VALUES (7, 'DataBattle', 3, 2, 'Octogone Omar vs Julien', '2022-07-01', '2022-08-30');

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

INSERT INTO Podium (idDataBattle, idEtudiant1, idEtudiant2, idEtudiant3)
VALUES (2, 5, 3, 4);

-- --------------- TABLE MESSAGE ----------------------------------------------

INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu)
VALUES (6, 2, 'vrai objet', 'bonjour bonjour bonjour b!!!!! jour');

INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu)
VALUES (6, 2, 'objet kreklzrnf', 'bonjour bonjour bonjour b!!!!! jour');

INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu)
VALUES (7, 1, 'OBJETTT', 'salutt salut :) b!!!!! jour');

INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu)
VALUES (6, 3, 'objet de oui', 'oui c pour ca que je parle avec user3');

INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu)
VALUES (3, 1, 'objet de ok', 'ok merci user1');

INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu)
VALUES (6, 4, 'sssss', 'sssssssssssssssssssssss');

INSERT INTO Message (idExpediteur, idDestinataire, objet, contenu)
VALUES (7, 2, 'Bjr', 'Bonjour, chacal!');

INSERT INTO MessageGroupe (idMessage, idDestinataire)
VALUES (7, 1);
-- 

-- --------------- TABLE REPONSE ----------------------------------------------

INSERT INTO Login (nomUtilisateur, mdp, type) VALUES
    -- 40 enregistrements avec "Etudiant" en tant que type et 20 Gestionnaire
    ('user8','password8','Etudiant'),
    ('user9','password9','Etudiant'),
    ('user10','password10','Etudiant'),
    ('user11','password11','Etudiant'),
    ('user12','password12','Etudiant'),
    ('user13','password13','Etudiant'),
    ('user14','password14','Etudiant'),
    ('user15','password15','Etudiant'),
    ('user16','password16','Etudiant'),
    ('user17','password17','Etudiant'),
    ('user18','password18','Etudiant'),
    ('user19','password19','Etudiant'),
    ('user20','password20','Etudiant'),
    ('user21','password21','Etudiant'),
    ('user22','password22','Etudiant'),
    ('user23','password23','Etudiant'),
    ('user24','password24','Etudiant'),
    ('user25','password25','Etudiant'),
    ('user26','password26','Etudiant'),
    ('user27','password27','Etudiant'),
    ('user28','password28','Etudiant'),
    ('user29','password29','Etudiant'),
    ('user30','password30','Etudiant'),
    ('user31','password31','Etudiant'),
    ('user32','password32','Etudiant'),
    ('user33','password33','Etudiant'),
    ('user34','password34','Etudiant'),
    ('user35','password35','Etudiant'),
    ('user36','password36','Etudiant'),
    ('user37','password37','Etudiant'),
    ('user38','password38','Etudiant'),
    ('user39','password39','Etudiant'),
    ('user40','password40','Etudiant'),
    -- 40 enregistrements avec "Gestionnaire" en tant que type
    ('user41', 'password41', 'Gestionnaire'),
    ('user42', 'password42', 'Gestionnaire'),
    ('user43','password43','Gestionnaire'),
    ('user44','password44','Gestionnaire'),
    ('user45','password45','Gestionnaire'),
    ('user46','password46','Gestionnaire'),
    ('user47','password47','Gestionnaire'),
    ('user48','password48','Gestionnaire'),
    ('user49','password49','Gestionnaire'),
    ('user50','password50','Gestionnaire'),
    ('user51','password51','Gestionnaire'),
    ('user52','password52','Gestionnaire'),
    ('user53','password53','Gestionnaire'),
    ('user54','password54','Gestionnaire'),
    ('user55','password55','Gestionnaire'),
    ('user56','password56','Gestionnaire'),
    ('user57','password57','Gestionnaire'),
    ('user58','password58','Gestionnaire'),
    ('user59','password59','Gestionnaire'),
    ('user60','password60','Gestionnaire');


INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail, ecole) VALUES
    (1, 'Benzeroual', 'Omar', 'L3', '0662315984', 'benzeroual@cy-tech.fr', 'CY-Tech'),
    (2, 'Dubois', 'Emma', 'L3', '0658741237', 'emma.dubois@example.com', 'University1'),
    (3, 'Lefebvre', 'Thomas', 'L3', '0645987622', 'thomas.lefebvre@example.com', 'University2'),
    (4, 'Martin', 'Julie', 'L3', '0612358748', 'julie.martin@example.com', 'University3'),
    (5, 'Tremblay', 'Alexandre', 'L3', '0662315981', 'alexandre.tremblay@example.com', 'University4'),
    (6, 'Gagnon', 'Marie', 'L3', '0612358749', 'marie.gagnon@example.com', 'University5'),
    (7, 'Roy', 'Charlotte', 'L3', '0645874123', 'charlotte.roy@example.com', 'University6'),
    (8, 'Lavoie', 'William', 'L3', '0662315982', 'william.lavoie@example.com', 'University7'),
    (9, 'Morin', 'Léa', 'L3', '0612358747', 'lea.morin@example.com', 'University8'),
    (10, 'Gauthier', 'Thomas', 'L3', '0658741238', 'thomas.gauthier@example.com', 'University9'),
    (11, 'Bouchard', 'Clara', 'L3', '0645987621', 'clara.bouchard@example.com', 'University10'),
    (12, 'Pelletier', 'Édouard', 'L3', '0662315983', 'edouard.pelletier@example.com', 'University11'),
    (13, 'Lévesque', 'Léa', 'L3', '0612358746', 'lea.levesque@example.com', 'University12'),
    (14, 'Bergeron', 'Louis', 'L3', '0658741239', 'louis.bergeron@example.com', 'University13'),
    (15, 'Gagné', 'Sophie', 'L3', '0645987620', 'sophie.gagne@example.com', 'University14'),
    (16, 'Caron', 'Gabriel', 'L3', '0662315980', 'gabriel.caron@example.com', 'University15'),
    (17, 'Lefebvre', 'Mia', 'L3', '0612358745', 'mia.lefebvre@example.com', 'University16'),
    (18, 'Girard', 'Liam', 'L3', '0658741240', 'liam.girard@example.com', 'University17'),
    (19, 'Simard', 'Léa', 'L3', '0645987619', 'lea.simard@example.com', 'University18'),
    (20, 'Gagnon', 'Noah', 'L3', '0662315979', 'noah.gagnon@example.com', 'University19'),
    (21, 'Côté', 'Mia', 'L3', '0612358744', 'mia.cote@example.com', 'University20'),
    (22, 'Roy', 'Liam', 'L3', '0658741241', 'liam.roy@example.com', 'University21'),
    (23, 'Bélanger', 'Léa', 'L3', '0645987618', 'lea.belanger@example.com', 'University22'),
    (24, 'Ouellet', 'Thomas', 'L3', '0662315978', 'thomas.ouellet@example.com', 'University23'),
    (25, 'Rousseau', 'Olivia', 'L3', '0612358743', 'olivia.rousseau@example.com', 'University24'),
    (26, 'Pelletier', 'Jacob', 'L3', '0658741242', 'jacob.pelletier@example.com', 'University25'),
    (27, 'Morin', 'Léa', 'L3', '0645987617', 'lea.morin@example.com', 'University26'),
    (28, 'Lavoie', 'Liam', 'L3', '0662315977', 'liam.lavoie@example.com', 'University27'),
    (29, 'Gagnon', 'Léa', 'L3', '0612358742', 'lea.gagnon@example.com', 'University28'),
    (30, 'Beaudoin', 'William', 'L3', '0658741243', 'william.beaudoin@example.com', 'University29'),
    (31, 'Deschênes', 'Léa', 'L3', '0645987616', 'lea.deschenes@example.com', 'University30'),
    (32, 'Dumas', 'Liam', 'L3', '0662315976', 'liam.dumas@example.com', 'University31'),
    (33, 'Martel', 'Emma', 'L3', '0612358741', 'emma.martel@example.com', 'University32'),
    (34, 'Fournier', 'Thomas', 'L3', '0658741244', 'thomas.fournier@example.com', 'University33'),
    (35, 'Bélanger', 'Léa', 'L3', '0645987615', 'lea.belanger@example.com', 'University34'),
    (36, 'Gagnon', 'Liam', 'L3', '0662315975', 'liam.gagnon@example.com', 'University35'),
    (37, 'Fortin', 'Léa', 'L3', '0612358740', 'lea.fortin@example.com', 'University36'),
    (38, 'Gauthier', 'Emma', 'L3', '0658741245', 'emma.gauthier@example.com', 'University37'),
    (39, 'Bergeron', 'Thomas', 'L3', '0645987614', 'thomas.bergeron@example.com', 'University38'),
    (40, 'Rousseau', 'Sophie', 'L3', '0635874123', 'sophie.rousseau@example.com', 'University39');


    
INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin) VALUES
    (1, 'Gestionnaire1', 'Gestionnaire1', 'ABC Company', '0695847128', 'gestionnaire1@example.com', '2022-01-01', '2022-12-31'),
    (2, 'Gestionnaire2', 'Gestionnaire2', 'XYZ Corp', '0687451239', 'gestionnaire2@example.com', '2022-01-01', '2022-12-31'),
    (3, 'Gestionnaire3', 'Gestionnaire3', '123 Industries', '0674895213', 'gestionnaire3@example.com', '2022-01-01', '2022-12-31'),
    (4, 'Gestionnaire4', 'Gestionnaire4', 'Acme Corporation', '0662358741', 'gestionnaire4@example.com', '2022-01-01', '2022-12-31'),
    (5, 'Gestionnaire5', 'Gestionnaire5', 'ABC Company', '0658741234', 'gestionnaire5@example.com', '2022-01-01', '2022-12-31'),
    (6, 'Gestionnaire6', 'Gestionnaire6', 'XYZ Corp', '0645987623', 'gestionnaire6@example.com', '2022-01-01', '2022-12-31'),
    (7, 'Gestionnaire7', 'Gestionnaire7', '123 Industries', '0635874126', 'gestionnaire7@example.com', '2022-01-01', '2022-12-31'),
    (8, 'Gestionnaire8', 'Gestionnaire8', 'Acme Corporation', '0622315987', 'gestionnaire8@example.com', '2022-01-01', '2022-12-31'),
    (9, 'Gestionnaire9', 'Gestionnaire9', 'ABC Company', '0612358745', 'gestionnaire9@example.com', '2022-01-01', '2022-12-31'),
    (10, 'Gestionnaire10', 'Gestionnaire10', 'XYZ Corp', '0695847129', 'gestionnaire10@example.com', '2022-01-01', '2022-12-31'),
    (11, 'Gestionnaire11', 'Gestionnaire11', '123 Industries', '0687451240', 'gestionnaire11@example.com', '2022-01-01', '2022-12-31'),
    (12, 'Gestionnaire12', 'Gestionnaire12', 'Acme Corporation', '0674895214', 'gestionnaire12@example.com', '2022-01-01', '2022-12-31'),
    (13, 'Gestionnaire13', 'Gestionnaire13', 'ABC Company', '0662358742', 'gestionnaire13@example.com', '2022-01-01', '2022-12-31'),
    (14, 'Gestionnaire14', 'Gestionnaire14', 'XYZ Corp', '0658741235', 'gestionnaire14@example.com', '2022-01-01', '2022-12-31'),
    (15, 'Gestionnaire15', 'Gestionnaire15', '123 Industries', '0645987624', 'gestionnaire15@example.com', '2022-01-01', '2022-12-31'),
    (16, 'Gestionnaire16', 'Gestionnaire16', 'Acme Corporation', '0635874127', 'gestionnaire16@example.com', '2022-01-01', '2022-12-31'),
    (17, 'Gestionnaire17', 'Gestionnaire17', 'ABC Company', '0622315988', 'gestionnaire17@example.com', '2022-01-01', '2022-12-31'),
    (18, 'Gestionnaire18', 'Gestionnaire18', 'XYZ Corp', '0612358746', 'gestionnaire18@example.com', '2022-01-01', '2022-12-31'),
    (19, 'Gestionnaire19', 'Gestionnaire19', '123 Industries', '0695847130', 'gestionnaire19@example.com', '2022-01-01', '2022-12-31'),
    (20, 'Gestionnaire20', 'Gestionnaire20', 'Acme Corporation', '0687451241', 'gestionnaire20@example.com', '2022-01-01', '2022-12-31');



INSERT TO DataFichier (idDataFichier,idProjetData,nbLignes,nbFonctions,tailleMinFonction,tailleMaxFonction,tailleMoyenneFonction) VALUES
    (1,1,100,10,10,20,15),
    (1,2,200,20,10,20,15),
    (1,3,300,30,10,20,15),
    (1,4,400,40,10,20,15),
    (1,5,500,50,10,20,15),
    (1,6,600,60,10,20,15),
    (1,7,700,70,10,20,15),
    (1,8,800,80,10,20,15),
    (1,9,900,90,10,20,15),
    (1,10,1000,100,10,20,15),
    (1,11,1100,110,10,20,15),
    (1,12,1200,120,10,20,15),
    (1,13,1300,130,10,20,15),
    (1,14,1400,140,10,20,15),
    (1,15,1500,150,10,20,15),
    (1,16,1600,160,10,20,15),
    (1,17,1700,170,10,20,15),
    (1,18,1800,180,10,20,15),
    (1,19,1900,190,10,20,15),
    (1,20,2000,200,10,20,15);




