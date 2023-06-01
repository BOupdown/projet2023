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

INSERT INTO Login (nomUtilisateur, mdp, type) VALUES
    ('user6','password8','Etudiant'),
    ('user7','password9','Etudiant'),
    ('user8','password10','Etudiant'),
    ('user9','password11','Etudiant'),
    ('user10','password12','Etudiant'),
    ('user11','password13','Etudiant'),
    ('user12','password14','Etudiant'),
    ('user13','password15','Etudiant'),
    ('user14','password16','Etudiant'),
    ('user15','password17','Etudiant'),
    ('user16','password18','Etudiant'),
    ('user17','password19','Etudiant'),
    ('user28','password20','Etudiant'),
    ('user19','password21','Etudiant'),
    ('user20','password22','Etudiant'),
    ('user21','password23','Etudiant'),
    ('user22','password24','Etudiant'),
    ('user23','password25','Etudiant'),
    ('user24','password26','Etudiant'),
    ('user25','password27','Etudiant'),
    ('user26','password28','Etudiant'),
    ('user27','password29','Etudiant'),
    ('user28','password30','Etudiant'),
    ('user29','password31','Etudiant'),
    ('user30','password32','Etudiant'),
    ('user31','password33','Etudiant'),
    ('user32','password34','Etudiant'),
    ('user33','password35','Etudiant'),
    ('user34','password36','Etudiant'),
    ('user35','password37','Etudiant'),
    ('user36','password38','Etudiant'),
    ('user37','password39','Etudiant'),
    ('user38','password40','Etudiant');

-- --------------- LOGIN GESTIONNAIRE ----------------------------------------------

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Gestionnaire1', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Gestionnaire');
-- mdp = password123

INSERT INTO Login (nomUtilisateur, mdp, type)
VALUES ('Gestionnaire2', 'cbfdac6008f9cab4083784cbd1874f76618d2a97', 'Gestionnaire');
-- mdp = password123

INSERT INTO Login (nomUtilisateur, mdp, type) VALUES
    ('user41', 'password41', 'Gestionnaire'),
    ('user42', 'password42', 'Gestionnaire'),
    ('user43','password43','Gestionnaire'),
    ('user44','password44','Gestionnaire'),
    ('user45','password45','Gestionnaire'),
    ('user46','password46','Gestionnaire'),
    ('user47','password47','Gestionnaire'),
    ('user49','password48','Gestionnaire'),
    ('user50','password49','Gestionnaire'),
    ('user51','password50','Gestionnaire');

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

INSERT INTO Etudiant (idLogin, nom, prenom, niveauEtude, telephone, mail, ecole) VALUES
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
    (38, 'Gauthier', 'Emma', 'L3', '0658741245', 'emma.gauthier@example.com', 'University37');

-- --------------- TABLE GESTIONNAIRE ----------------------------------------------

INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin)
VALUES (39, 'Gestionnaire1', 'Gestionnaire1', 'ABC Company', '0695847128', 'gestionnaire@example.com', '2022-01-01', '2022-12-31');


INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin)
VALUES (40, 'Gestionnaire2', 'Gestionnaire2', 'ZZZ Company', '0695847128', 'gestionnaire@example.com', '2022-01-01', '2022-12-31');

INSERT INTO Gestionnaire (idLogin, nom, prenom, entreprise, telephone, mail, dateDebut, dateFin) VALUES
    (41, 'Gestionnaire8', 'Gestionnaire8', 'Acme Corporation', '0622315987', 'gestionnaire8@example.com', '2022-01-01', '2022-12-31'),
    (42, 'Gestionnaire9', 'Gestionnaire9', 'ABC Company', '0612358745', 'gestionnaire9@example.com', '2022-01-01', '2022-12-31'),
    (43, 'Gestionnaire10', 'Gestionnaire10', 'XYZ Corp', '0695847129', 'gestionnaire10@example.com', '2022-01-01', '2022-12-31'),
    (44, 'Gestionnaire11', 'Gestionnaire11', '123 Industries', '0687451240', 'gestionnaire11@example.com', '2022-01-01', '2022-12-31'),
    (45, 'Gestionnaire12', 'Gestionnaire12', 'Acme Corporation', '0674895214', 'gestionnaire12@example.com', '2022-01-01', '2022-12-31'),
    (46, 'Gestionnaire13', 'Gestionnaire13', 'ABC Company', '0662358742', 'gestionnaire13@example.com', '2022-01-01', '2022-12-31'),
    (47, 'Gestionnaire14', 'Gestionnaire14', 'XYZ Corp', '0658741235', 'gestionnaire14@example.com', '2022-01-01', '2022-12-31'),
    (48, 'Gestionnaire15', 'Gestionnaire15', '123 Industries', '0645987624', 'gestionnaire15@example.com', '2022-01-01', '2022-12-31'),
    (49, 'Gestionnaire16', 'Gestionnaire16', 'Acme Corporation', '0635874127', 'gestionnaire16@example.com', '2022-01-01', '2022-12-31'),
    (50, 'Gestionnaire17', 'Gestionnaire17', 'ABC Company', '0622315988', 'gestionnaire17@example.com', '2022-01-01', '2022-12-31'),
    (51, 'Gestionnaire18', 'Gestionnaire18', 'XYZ Corp', '0612358746', 'gestionnaire18@example.com', '2022-01-01', '2022-12-31');


-- ---------------TABLE ADMINISTRATEUR ----------------------------------------------

INSERT INTO Administrateur (idLogin, nom, prenom, telephone, mail)
VALUES (52, 'Admin1', 'Admin1', '0626594871', 'admin@example.com');

-- --------------- TABLE DATA DEFI ----------------------------------------------

INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFIN)
VALUES (39, 'Battle', 2, 3, 'Octogone 2pac vs Eminem', '2022-05-01', '2022-06-30');

INSERT INTO DataDefi (idGestionnaire, typeD, nombreSujet, nombreQuestionnaire, nom, dateDebut, dateFIN)
VALUES (40, 'Battle', 3, 2, 'Octogone Omar vs Julien', '2022-07-01', '2022-08-30');

INSERT INTO DataDefi (idGestionnaire,typeD,nombreSujet,nombreQuestionnaire,nom,dateDebut,dateFIN,descriptionD) VALUES
    (41, 'Battle', 10, 10, 'Défi1', '2022-01-01', '2023-12-31', 'Description du défi1'),
    (42, 'Challenge', 20, 20, 'Défi2', '2022-01-01', '2023-12-31', 'Description du défi2'),
    (43, 'Battle', 30, 30, 'Défi3', '2022-01-01', '2022-12-31', 'Description du défi3'),
    (44, 'Challenge', 40, 40, 'Défi4', '2022-01-01', '2022-12-31', 'Description du défi4'),
    (45, 'Battle', 50, 50, 'Défi5', '2022-01-01', '2022-12-31', 'Description du défi5'),
    (46, 'Challenge', 60, 60, 'Défi6', '2022-01-01', '2022-12-31', 'Description du défi6'),
    (47, 'Battle', 70, 70, 'Défi7', '2022-01-01', '2022-12-31', 'Description du défi7'),
    (48, 'Challenge', 80, 80, 'Défi8', '2022-01-01', '2022-12-31', 'Description du défi8'),
    (49, 'Battle', 90, 90, 'Défi9', '2022-01-01', '2022-12-31', 'Description du défi9'),
    (50, 'Challenge', 100, 100, 'Défi10', '2022-01-01', '2022-12-31', 'Description du défi10'),
    (51, 'Battle', 110, 110, 'Défi11', '2022-01-01', '2022-12-31', 'Description du défi11'),
    (39, 'Challenge', 120, 120, 'Défi12', '2022-01-01', '2022-12-31', 'Description du défi12'),
    (40, 'Battle', 130, 130, 'Défi13', '2022-01-01', '2022-12-31', 'Description du défi13'),
    (41, 'Challenge', 140, 140, 'Défi14', '2022-01-01', '2022-12-31', 'Description du défi14'),
    (42, 'Battle', 150, 150, 'Défi15', '2022-01-01', '2022-12-31', 'Description du défi15'),
    (43, 'Challenge', 160, 160, 'Défi16', '2022-01-01', '2022-12-31', 'Description du défi16'),
    (44, 'Battle', 170, 170, 'Défi17', '2022-01-01', '2022-12-31', 'Description du défi17'),
    (45, 'CHallenge', 180, 180, 'Défi18', '2022-01-01', '2022-12-31', 'Description du défi18'),
    (46, 'Battle', 190, 190, 'Défi19', '2022-01-01', '2022-12-31', 'Description du défi19'),
    (47, 'Challenge', 200, 200, 'Défi20', '2022-01-01', '2022-12-31', 'Description du défi20');



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

-- --------------- TABLE PROJET DATA ----------------------------------------------
-- pas deux battles avec le meme idDataDefi mais avec Challenge c ok
    INSERT INTO ProjetData (nom,descriptionS,idDataDefi,image,ressources) VALUES
    ("Reconnaissance d'images", 'L exploration des méthodes d apprentissage automatique pour la reconnaissance d images.', 1, 'https://praedictia.com/wp-content/uploads/sites/107/2021/10/P3-1_intro_1456783511.jpg', 'wikipedia'),
    ("Jouer des jeux vidéos", 'L utilisation de l apprentissage par renforcement pour entraîner un agent à jouer à des jeux vidéo.', 2, 'https://www.afjv.com/2023/03/230306-cloud-gaming-jeux-video.jpg', 'youtube'),
    ("L'analyse de sentiments", 'L analyse de sentiment basée sur le traitement du langage naturel.', 3, 'https://blog.stack-labs.com/images/articles/sentiment_analysis/sentiment-analysis.jpg', 'national geographic'),
    ("La protection de la vie privée", 'L apprentissage fédéré pour la protection de la vie privée.', 4, 'https://droitdu.net/files/sites/107/2019/11/Capture-d%E2%80%99e%CC%81cran-2019-11-16-a%CC%80-21.03.26-650x411.png', 'twitch'),
    ("IA et société", 'L exploration de l IA éthique et de ses implications sociétales.', 5, 'https://aurelienbamde.com/wp-content/uploads/2016/09/illustration-41.jpg', 'github'),


INSERT INTO Groupe (idCapitaine,idDataChallenge,idEtudiant1,idEtudiant2,idEtudiant3,idEtudiant4,idEtudiant5,idEtudiant6,idEtudiant7,idEtudiant8,nom) VALUES
    (1, 1, 1, 2, 3, 4, 5, 6, 7, 8, 'Groupe1'),
    (9, 2, 9, 10, 11, 12, 13, 14, 15, 16, 'Groupe2'),
    (17, 3, 17, 18, 18, 19, 20, 21, 22, 23, 'Groupe3'),
    (24, 4, 24, 25, 26, 27, 28, 29, 30, 31, 'Groupe4'),
    (5, 5, 1, 4, 5, 11, 16, 25, 30, 18, 'Groupe5'),
    (6, 6, 6, 7, 24, 21, 20, 19, 15, 11, 'Groupe6'),
    (7, 7, 7, 8, 5, 11, 16, 20, 25, 29, 'Groupe7'),
    (8, 8, 8, 18, 19, 3, 4, 14, 16, 7, 'Groupe8'),
    (9, 9, 9, 2, 3, 4, 5, 6, 29, 30, 'Groupe9'),
    (10, 1, 10, 3, 4, 7, 11, 15, 16, 22, 'Groupe10');
    
    -- nbfonction * taillemoyennefonction < nbligne
INSERT INTO DataFichier (idDataFichier, idGroupe, idProjetData, nomFichier, nbLignes,nbFonctions,tailleMinFonction,tailleMaxFonction,tailleMoyenneFonction) VALUES
    (1, 1, 1, 'code.py', 100, 7, 2, 20, 3),
    (2, 2, 2, 'code.py', 250, 20, 20, 200, 100),
    (3, 3, 3, 'code.py', 4600, 30, 30, 300, 150),
    (4, 4, 4, 'code.py', 8100, 40, 40, 400, 200),
    (5, 5, 5, 'code.py', 13000, 50, 50, 500, 250),
    (6, 6, 6, 'code.py', 18100, 60, 60, 600, 300),
    (7, 7, 7, 'code.py', 25000, 70, 70, 700, 350),
    (8, 8, 8, 'code.py', 32500, 80, 80, 800, 400),
    (9, 9, 9, 'code.py', 41000, 90, 90, 900, 450);




-- FAIRE DES BONNES QUESTIONS
INSERT INTO Questionnaire (numero, idSujet, nom, descriptionQ) VALUES
    (1, 1, 'Questionnaire 1', 'Les robots'),
    (2, 2, 'Questionnaire 2', 'La reconnaissance faciale'),
    (3, 3, 'Questionnaire 3', 'Voiture volante'),

INSERT INTO Question (idQuestionnaire, question) VALUES
    (1, "Qui est le Business Process Owner (propriétaire du produit),
Administrateur, développeurs de processus, gardiens de robots
pour ce Robot ?"),
    (1, "A quelle division appartient-il ?"),
    (1, "Veuillez décrire le cas d'utilisation du robot"),
    (1, "Please provide network architecture and data flow
diagram for the Robot use case (can insert links to
documentation)"),
    (1, "Veuillez fournir une évaluation du seuil de confidentialité (PTA)
pour les données impliquées dans ce cas d'utilisation Robot"),
    (2, "Est-ce que la reconnaissance faciale t'es utile ?"),
    (2, "Est-elle utile à la société ?"),
    (2, "Où est-elle utilisée ?"),
    (2, "Quelle l'entreprise la plus connue dans ce domaine ?"),
    (2, "Comment coder un programme de reconnaissance faciale ?"),
    (3, "Quelles sont les conditions à respecter légalement pour concevoir une voiture volante ?"),
    (3, "Quels sont les langages les plus adaptés pour accomplir cette tâche ?"),
    (3, "Avons-nous les compétences aujourd'hui pour fabriquer ce genre de voiture ?"),
    (3, "Prouve-le.");