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
VALUES (6, 'Gestionnaire1', 'Gestionnaire1', 'ABC Company', '0695847128', 'gestionnaire@example.com', '2022-01-01', '2023-12-31');


INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin)
VALUES (7, 'Gestionnaire2', 'Gestionnaire2', 'ZZZ Company', '0695847128', 'gestionnaire@example.com', '2022-01-01', '2023-12-31');

-- ---------------ABLE ADMINISTRATEUR ----------------------------------------------

INSERT INTO Administrateur (idLogin, nom, prenom, telephone, mail)
VALUES (3, 'Admin1', 'Admin1', '0626594871', 'admin@example.com');

-- --------------- TABLE DATA DEFI ----------------------------------------------

INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFIN)
VALUES (6, 'Battle', 2, 3, 'Octogone 2pac vs Eminem', '2022-05-01', '2022-06-30');

INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFIN)
VALUES (7, 'Battle', 3, 2, 'Octogone Omar vs Julien', '2022-07-01', '2022-08-30');


-- --------------- TABLE QUESTIONNAIRE ----------------------------------------------

-- INSERT INTO Questionnaire (nom, descriptionQ, idDataDefi)
-- VALUES ('Questionnaire1', 'pas d idee', 1);

-- INSERT INTO Questionnaire (nom, descriptionQ, idDataDefi)
-- VALUES ('Questionnaire2', 'Questionnaire pour un champion', 1);

-- INSERT INTO Questionnaire (nom, descriptionQ, idDataDefi)
-- VALUES ('Questionnaire3', 'QCM inédit', 1);

-- --------------- TABLE GROUPE ----------------------------------------------

INSERT INTO Groupe (idCapitaine, idDataChallenge, idEtudiant1, idEtudiant2, idEtudiant3, nom)
VALUES (1, 1, 1, 2, 3, 'Groupe A');

-- -- --------------- TABLE PROJET DATA ----------------------------------------------

-- INSERT INTO ProjetData (idDataChallenge, idGroupe, descriptionP, imageP)
-- VALUES (1, 1, 'le bard sort victorieux', 'images/image.png');

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
    (6, 'Gagnon', 'Marie', 'L3', '0612358749', 'marie.gagnon@Supprimer.com', 'University5'),
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


INSERT INTO DataDefi (idGestionnaire,typeD,nombreSujet,nombreQuestionnaire,nom,dateDebut,dateFIN,descriptionD) VALUES
    (6, 'Battle', 10, 10, 'Défi1', '2022-01-01', '2023-12-31', 'Description du défi1'),
    (6, 'Challenge', 20, 20, 'Défi2', '2022-01-01', '2023-12-31', 'Description du défi2'),
    (6, 'Battle', 30, 30, 'Défi3', '2022-01-01', '2022-12-31', 'Description du défi3'),
    (7, 'Challenge', 40, 40, 'Défi4', '2022-01-01', '2022-12-31', 'Description du défi4'),
    (7, 'Battle', 50, 50, 'Défi5', '2022-01-01', '2022-12-31', 'Description du défi5'),
    (7, 'Challenge', 60, 60, 'Défi6', '2022-01-01', '2022-12-31', 'Description du défi6'),
    (7, 'Battle', 70, 70, 'Défi7', '2022-01-01', '2022-12-31', 'Description du défi7'),
    (8, 'Challenge', 80, 80, 'Défi8', '2022-01-01', '2022-12-31', 'Description du défi8'),
    (9, 'Battle', 90, 90, 'Défi9', '2022-01-01', '2022-12-31', 'Description du défi9'),
    (10, 'Challenge', 100, 100, 'Défi10', '2022-01-01', '2022-12-31', 'Description du défi10'),
    (11, 'Battle', 110, 110, 'Défi11', '2022-01-01', '2022-12-31', 'Description du défi11'),
    (12, 'Challenge', 120, 120, 'Défi12', '2022-01-01', '2022-12-31', 'Description du défi12'),
    (13, 'Battle', 130, 130, 'Défi13', '2022-01-01', '2022-12-31', 'Description du défi13'),
    (14, 'Challenge', 140, 140, 'Défi14', '2022-01-01', '2022-12-31', 'Description du défi14'),
    (15, 'Battle', 150, 150, 'Défi15', '2022-01-01', '2022-12-31', 'Description du défi15'),
    (16, 'Challenge', 160, 160, 'Défi16', '2022-01-01', '2022-12-31', 'Description du défi16'),
    (17, 'Battle', 170, 170, 'Défi17', '2022-01-01', '2022-12-31', 'Description du défi17'),
    (18, 'CHallenge', 180, 180, 'Défi18', '2022-01-01', '2022-12-31', 'Description du défi18'),
    (19, 'Battle', 190, 190, 'Défi19', '2022-01-01', '2022-12-31', 'Description du défi19'),
    (20, 'Challenge', 200, 200, 'Défi20', '2022-01-01', '2022-12-31', 'Description du défi20');

    INSERT INTO ProjetData (nom,descriptionS,idDataDefi,image,ressources) VALUES
    ('Sujet1', 'Description du sujet1', 1, 'image1', 'ressources1'),
    ('Sujet2', 'Description du sujet2', 2, 'image2', 'ressources2'),
    ('Sujet3', 'Description du sujet3', 3, 'image3', 'ressources3'),
    ('Sujet4', 'Description du sujet4', 4, 'image4', 'ressources4'),
    ('Sujet5', 'Description du sujet5', 5, 'image5', 'ressources5'),
    ('Sujet6', 'Description du sujet6', 6, 'image6', 'ressources6'),
    ('Sujet7', 'Description du sujet7', 7, 'image7', 'ressources7'),
    ('Sujet8', 'Description du sujet8', 8, 'image8', 'ressources8'),
    ('Sujet9', 'Description du sujet9', 9, 'image9', 'ressources9'),
    ('Sujet10', 'Description du sujet10', 10, 'image10', 'ressources10'),
    ('Sujet11', 'Description du sujet11', 11, 'image11', 'ressources11'),
    ('Sujet12', 'Description du sujet12', 12, 'image12', 'ressources12'),
    ('Sujet13', 'Description du sujet13', 13, 'image13', 'ressources13'),
    ('Sujet14', 'Description du sujet14', 14, 'image14', 'ressources14'),
    ('Sujet15', 'Description du sujet15', 15, 'image15', 'ressources15'),
    ('Sujet16', 'Description du sujet16', 16, 'image16', 'ressources16'),
    ('Sujet17', 'Description du sujet17', 17, 'image17', 'ressources17'),
    ('Sujet18', 'Description du sujet18', 18, 'image18', 'ressources18'),
    ('Sujet19', 'Description du sujet19', 19, 'image19', 'ressources19'),
    ('Sujet20', 'Description du sujet20', 20, 'image20', 'ressources20');


INSERT INTO Groupe (idCapitaine,idDataChallenge,idEtudiant1,idEtudiant2,idEtudiant3,idEtudiant4,idEtudiant5,idEtudiant6,idEtudiant7,idEtudiant8,nom) VALUES
    (1, 1, 1, 2, 3, 4, 5, 6, 7, 8, 'Groupe1'),
    (2, 2, 2, 3, 4, 5, 6, 7, 8, 1, 'Groupe2'),
    (3, 3, 3, 4, 5, 6, 7, 8, 1, 2, 'Groupe3'),
    (4, 4, 4, 5, 6, 7, 8, 1, 2, 3, 'Groupe4'),
    (5, 5, 5, 6, 7, 8, 1, 2, 3, 4, 'Groupe5'),
    (6, 6, 6, 7, 8, 1, 2, 3, 4, 5, 'Groupe6'),
    (7, 7, 7, 8, 1, 2, 3, 4, 5, 6, 'Groupe7'),
    (8, 8, 8, 1, 2, 3, 4, 5, 6, 7, 'Groupe8'),
    (9, 9, 1, 2, 3, 4, 5, 6, 7, 8, 'Groupe9'),
    (10, 10, 2, 3, 4, 5, 6, 7, 8, 1, 'Groupe10'),
    (11, 11, 3, 4, 5, 6, 7, 8, 1, 2, 'Groupe11'),
    (12, 12, 4, 5, 6, 7, 8, 1, 2, 3, 'Groupe12'),
    (13, 13, 5, 6, 7, 8, 1, 2, 3, 4, 'Groupe13'),
    (14, 14, 6, 7, 8, 1, 2, 3, 4, 5, 'Groupe14'),
    (15, 15, 7, 8, 1, 2, 3, 4, 5, 6, 'Groupe15'),
    (16, 16, 8, 1, 2, 3, 4, 5, 6, 7, 'Groupe16'),
    (17, 17, 1, 2, 3, 4, 5, 6, 7, 8, 'Groupe17'),
    (18, 18, 2, 3, 4, 5, 6, 7, 8, 1, 'Groupe18'),
    (19, 19, 3, 4, 5, 6, 7, 8, 1, 2, 'Groupe19'),
    (20, 20, 4, 5, 6, 7, 8, 1, 2, 3, 'Groupe20');  
INSERT INTO DataFichier (idDataFichier, idGroupe, idProjetData, nomFichier, nbLignes,nbFonctions,tailleMinFonction,tailleMaxFonction,tailleMoyenneFonction) VALUES
    (1, 1, 1, 'code.py', 100, 7, 2, 20, 3),
    (2, 2, 2, 'code.py', 200, 20, 20, 200, 100),
    (3, 3, 3, 'code.py', 300, 30, 30, 300, 150),
    (4, 4, 4, 'code.py', 400, 40, 40, 400, 200),
    (5, 5, 5, 'code.py', 500, 50, 50, 500, 250),
    (6, 6, 6, 'code.py', 600, 60, 60, 600, 300),
    (7, 7, 7, 'code.py', 700, 70, 70, 700, 350),
    (8, 8, 8, 'code.py', 800, 80, 80, 800, 400),
    (9, 9, 9, 'code.py', 900, 90, 90, 900, 450),
    (10, 10, 10, 'code.py', 1000, 100, 100, 1000, 500),
    (11, 11, 11, 'code.py', 1100, 110, 110, 1100, 550),
    (12, 12, 12, 'code.py', 1200, 120, 120, 1200, 600),
    (13, 13, 13, 'code.py', 1300, 130, 130, 1300, 650),
    (14, 14, 14, 'code.py', 1400, 140, 140, 1400, 700),
    (15, 15, 15, 'code.py', 1500, 150, 150, 1500, 750),
    (16, 16, 16, 'code.py', 1600, 160, 160, 1600, 800),
    (17, 17, 17, 'code.py', 1700, 170, 170, 1700, 850),
    (18, 18, 18, 'code.py', 1800, 180, 180, 1800, 900),
    (19, 19, 19, 'code.py', 1900, 190, 190, 1900, 950),
    (20, 20, 20, 'code.py', 2000, 200, 200, 2000, 1000);




INSERT INTO Podium (idDataBattle,idEtudiant1,idEtudiant2,idEtudiant3) VALUES
    (3, 3, 4, 5),
    (4, 4, 5, 6),
    (5, 5, 6, 7),
    (6, 6, 7, 8),
    (7, 7, 8, 1),
    (8, 8, 1, 2),
    (9, 1, 2, 3),
    (10, 2, 3, 4),
    (11, 3, 4, 5),
    (12, 4, 5, 6),
    (13, 5, 6, 7),
    (14, 6, 7, 8),
    (15, 7, 8, 1),
    (16, 8, 1, 2),
    (17, 1, 2, 3),
    (18, 2, 3, 4),
    (19, 3, 4, 5),
    (20, 4, 5, 6);


INSERT INTO Questionnaire (numero, idSujet, nom, descriptionQ) VALUES
    (1, 1, 'Questionnaire1', 'Description du questionnaire1'),
    (2, 2, 'Questionnaire2', 'Description du questionnaire2'),
    (3, 3, 'Questionnaire3', 'Description du questionnaire3'),
    (4, 4, 'Questionnaire4', 'Description du questionnaire4'),
    (5, 5, 'Questionnaire5', 'Description du questionnaire5'),
    (6, 6, 'Questionnaire6', 'Description du questionnaire6'),
    (7, 7, 'Questionnaire7', 'Description du questionnaire7'),
    (8, 8, 'Questionnaire8', 'Description du questionnaire8'),
    (9, 9, 'Questionnaire9', 'Description du questionnaire9'),
    (10, 10, 'Questionnaire10', 'Description du questionnaire10'),
    (11, 11, 'Questionnaire11', 'Description du questionnaire11'),
    (12, 12, 'Questionnaire12', 'Description du questionnaire12'),
    (13, 13, 'Questionnaire13', 'Description du questionnaire13'),
    (14, 14, 'Questionnaire14', 'Description du questionnaire14'),
    (15, 15, 'Questionnaire15', 'Description du questionnaire15'),
    (16, 16, 'Questionnaire16', 'Description du questionnaire16'),
    (17, 17, 'Questionnaire17', 'Description du questionnaire17'),
    (18, 18, 'Questionnaire18', 'Description du questionnaire18'),
    (19, 19, 'Questionnaire19', 'Description du questionnaire19'),
    (20, 20, 'Questionnaire20', 'Description du questionnaire20');

INSERT INTO Question (idQuestionnaire, question) VALUES
    (1, 'Question1'),
    (1, 'Question2'),
    (1, 'Question3'),
    (1, 'Question4'),
    (1, 'Question5'),
    (1, 'Question6'),
    (1, 'Question7'),
    (1, 'Question8'),
    (1, 'Question9'),
    (1, 'Question10'),
    (1, 'Question11'),
    (1, 'Question12'),
    (1, 'Question13'),
    (1, 'Question14'),
    (1, 'Question15'),
    (1, 'Question16'),
    (1, 'Question17'),
    (1, 'Question18'),
    (1, 'Question19'),
    (1, 'Question20'),
    (2, 'Question1'),
    (2, 'Question2'),
    (2, 'Question3'),
    (2, 'Question4'),
    (2, 'Question5'),
    (2, 'Question6'),
    (2, 'Question7'),
    (2, 'Question8'),
    (2, 'Question9'),
    (2, 'Question10'),
    (2, 'Question11'),
    (2, 'Question12'),
    (2, 'Question13'),
    (2, 'Question14'),
    (2, 'Question15'),
    (2, 'Question16'),
    (2, 'Question17'),
    (2, 'Question18'),
    (2, 'Question19'),
    (2, 'Question20'),
    (3, 'Question1'),
    (3, 'Question2'),
    (3, 'Question3'),
    (3, 'Question4'),
    (3, 'Question5'),
    (3, 'Question6'),
    (3, 'Question7'),
    (3, 'Question8'),
    (3, 'Question9'),
    (3, 'Question10'),
    (3, 'Question11'),
    (3, 'Question12'),
    (3, 'Question13'),
    (3, 'Question14'),
    (3, 'Question15'),
    (3, 'Question16'),
    (3, 'Question17'),
    (3, 'Question18'),
    (3, 'Question19'),
    (3, 'Question20'),
    (4, 'Question1');



INSERT INTO Reponses(idGroupe,idQuestion,reponse) VALUES 
    (1, 1, 'Reponse1'),
    (1, 2, 'Reponse2'),
    (1, 3, 'Reponse3'),
    (1, 4, 'Reponse4'),
    (1, 5, 'Reponse5'),
    (1, 6, 'Reponse6'),
    (1, 7, 'Reponse7'),
    (1, 8, 'Reponse8'),
    (1, 9, 'Reponse9'),
    (1, 10, 'Reponse10'),
    (1, 11, 'Reponse11'),
    (1, 12, 'Reponse12'),
    (1, 13, 'Reponse13'),
    (1, 14, 'Reponse14'),
    (1, 15, 'Reponse15'),
    (1, 16, 'Reponse16'),
    (1, 17, 'Reponse17'),
    (1, 18, 'Reponse18'),
    (1, 19, 'Reponse19'),
    (1, 20, 'Reponse20'),
    (2, 1, 'Reponse1'),
    (2, 2, 'Reponse2'),
    (2, 3, 'Reponse3'),
    (2, 4, 'Reponse4'),
    (2, 5, 'Reponse5'),
    (2, 6, 'Reponse6'),
    (2, 7, 'Reponse7'),
    (2, 8, 'Reponse8'),
    (2, 9, 'Reponse9'),
    (2, 10, 'Reponse10'),
    (2, 11, 'Reponse11'),
    (2, 12, 'Reponse12'),
    (2, 13, 'Reponse13'),
    (2, 14, 'Reponse14'),
    (2, 15, 'Reponse15'),
    (2, 16, 'Reponse16'),
    (2, 17, 'Reponse17'),
    (2, 18, 'Reponse18'),
    (2, 19, 'Reponse19'),
    (2, 20, 'Reponse20'),
    (3, 1, 'Reponse1'),
    (3, 2,'az'),
    (3, 3,'az'),
    (3, 4,'az'),
    (3, 5,'az'),
    (3, 6,'az'),
    (3, 7,'az'),
    (3, 8,'az'),
    (3, 9,'az'),
    (3, 10,'az'),
    (3, 11,'az'),
    (3, 12,'az'),
    (3, 13,'az'),
    (3, 14,'az'),
    (3, 15,'az'),
    (3, 16,'az'),
    (3, 17,'az'),
    (3, 18,'az'),
    (3, 19,'az'),
    (3, 20,'az'),
    (4, 1, 'Reponse1'),
    (4, 2, 'Reponse2'),
    (4, 3, 'Reponse3'),
    (4, 4, 'Reponse4'),
    (4, 5, 'Reponse5'),
    (4, 6, 'Reponse6'),
    (4, 7, 'Reponse7'),
    (4, 8, 'Reponse8'),
    (4, 9, 'Reponse9'),
    (4, 10, 'Reponse10'),
    (4, 11, 'Reponse11'),
    (4, 12, 'Reponse12'),
    (4, 13, 'Reponse13'),
    (4, 14, 'Reponse14'),
    (4, 15, 'Reponse15'),
    (4, 16, 'Reponse16'),
    (4, 17, 'Reponse17'),
    (4, 18, 'Reponse18'),
    (4, 19, 'Reponse19'),
    (4, 20, 'Reponse20');