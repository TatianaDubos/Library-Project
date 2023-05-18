<!DOCTYPE html>
<html>
  <head>
    <title>Créations de nos tables</title>
  </head>
  <body>

    <h3>Préparation de la base de données...</h3>


<?php require_once "fonctions.php" ;
// Création de nos tables dans la base de donnée Bibliothèque


createTable('membres',
"id SMALLINT UNSIGNED AUTO_INCREMENT,
nom VARCHAR(50),
adresse VARCHAR(60),
telephone CHAR(14),
courriel VARCHAR(50),
mdp VARCHAR(100),
PRIMARY KEY(id),
INDEX(nom(15)),
INDEX(courriel(15))" );

createTable('documents',
"code SMALLINT UNSIGNED AUTO_INCREMENT,
titre VARCHAR(50),
auteur VARCHAR(50),
annee CHAR(4),
categorie VARCHAR(30),
type VARCHAR(20),
genre VARCHAR(30),
description TEXT,
isbn VARCHAR(20),
PRIMARY KEY(code),
FULLTEXT(description),
INDEX(titre(15)),
INDEX(auteur(15))" );

createTable('prets',
"id SMALLINT NOT NULL,
code SMALLINT NOT NULL,
datePret DATE,
dateRetourPrevu DATE" );

createTable('reservations',
"id SMALLINT NOT NULL,
code SMALLINT NOT NULL,
dateReservation DATE" );

createTable('historique',
"id SMALLINT NOT NULL,
code SMALLINT NOT NULL,
datePret DATE,
dateRetour DATE" );

createTable('equipe',
"nom VARCHAR(50),
courriel VARCHAR(50),
mdp VARCHAR(100),
role VARCHAR(20),
PRIMARY KEY(courriel)" );


// Insertions de nos documents

$query = "INSERT IGNORE INTO documents 
(code, titre, auteur, annee, categorie, type, genre, description, isbn)
VALUES
('1', 'Les énigmes de l\'aube', 'Thomas C. Durand', '2011', 'Roman', 'Jeunes', 'Fantastique', 'Anyelle a un don. Un sacré don, même ! Elle peut renforcer la magie de ceux qu\'elle touche. Mais pour maîtriser cette aptitude et apprendre, elle doit quitter la forêt qui l\'a vue naître... La voilà en route, joyeuse, insouciante et un peu maladroite pour une école prestigieuse de magie... qui n\'aime, malheureusement pour elle, ni les filles ni les pauvres...', '9782376863786'),
('2', 'Dark river', 'Jacques Goyette', '2022', 'Roman', 'Adultes', 'Policier', 'Lorsque les corps de deux jeunes femmes sont retrouvés mutilés sur la rive de la rivière du Diable, les enquêteurs sont persuadés que c\’est l\’œuvre du «Tueur de la Rivière», un tueur en série qui retire le cœur de ses victimes avant de les balancer dans l\’eau. Karine Delage, profileuse de la SQ, se voit confier le mandat de traquer et capturer ce monstre sanguinaire. Mais attraper ce démon n\’est pas la seule raison pour laquelle elle a accepté ce poste; sa sœur Mélanie a disparu sans laisser de trace. A-t-elle subi le même sort que les victimes du «Tueur de la Rivière»? C\’est ce que Karine doit découvrir. Suspense assuré !', '9782898312175'),
('3', 'Pistouvi', 'Merwan Chabane', '2016', 'Bande dessinée', 'Jeunes', 'Fantastique', 'Une petite fille, Jeanne, vit avec un jeune renard, Pistouvi, dans une charmante cabane située au sommet d\'un arbre géant. Un « homme tracteur » sillonne ces espaces infinis, fauchant sans relâche. Le vent, représenté sous les traits d\'une magnifique femme aux cheveux ondulants, s\'applique à planter graines et semences qu\'il tire de sa besace, contrecarrant ainsi les projets du défricheur.', '2205074962'),
('4', 'Persepolis', 'Marjane Satrapi', '2000', 'Bande dessinée', 'Jeunes', 'Autobiographique', 'Récit autobiographique d\'une enfance iranienne, entre guerre et révolution, à travers le regard d\'une petite fille qui, devenue adulte, s\'exile définitivement en France après avoir étudié les beaux arts dans l\'Iran islamique.', '9782844146762'),
('5', 'Un printemps à Tchernobyl', 'Emmanuel Lepage', '2012', 'Bande dessinée', 'Adultes', 'Documentaire', '22 ans après la plus grande catastrophe nucléaire du XXe siècle, Emmanuel Lepage se rend à Tchernobyl en 2008, par le biais de l\’assocation Les Dessin acteurs pour rendre compte, par le texte et le dessin, de la vie des survivants et de leurs enfants sur des terres hautement contaminées. Quand il décide de partir là-bas, Emmanuel Lepage a le sentiment de défier la mort et à l\’approche de la zone interdite, une question taraude son esprit : que suis-je venir faire ici ? Il sait qu\’il a besoin de se confronter au désastre, de voir, de comprendre. Cette expérience unique entre en résonance avec ses propres questionnements sur le dessin, sur sa capacité à dessiner et sa nécessité vitale: être au monde par le dessin.', '9782754807746'),
('6', 'Le Monde de Narnia', 'Clives Staples Lewis', '2013', 'Roman', 'Jeunes', 'Fantastique', 'Polly trouve parfois que la vie à Londres n\'est guère passionnante... jusqu\'au jour où elle rencontre son nouveau voisin, Digory. Il vit avec sa mère, gravement malade, et un vieil oncle au comportement étrange. Celui-ci force les deux enfants à essayer des bagues magiques qui les transportent dans un monde inconnu. Commence alors la plus extraordinaire des aventures...', '9782075088404'),
('7', 'Journal d\'un vampire', 'L. J. Smith', '1991', 'Roman', 'Adolescents', 'Surnaturel', 'Dès l\’arrivée de Stefan Salvatore à Fell\’s Church, Elena, la reine du lycée, se jure de le séduire. D\’abord distant, le garçon aux allures d\’ange rebelle finit par céder à sa passion dévorante… et à lui révéler son terrible secret. Quelques siècles plus tôt, la femme qu\’il aimait l\’a transformé en vampire, avant de le trahir avec son frère ennemi, Damon. Des événements tragiques se succèdent bientôt dans la région. Tout accuse Stefan mais Elena est convaincue de son innocence. Est-ce Damon, vampire cruel et assoiffé de sang, qui est derrière tout cela? L\’histoire est-elle amenée à se répéter?', '9782012017641'),
('8', 'Twilight : Fascination', 'Stephenie Meyer', '2005', 'Roman', 'Adolescents', 'Romance', 'Bella, dix-sept ans, quitte l\'Arizona ensoleillé où elle vivait avec sa mère pour s\'installer chez son père. Elle croit renoncer à tout ce qu\'elle aime, certaine qu\'elle ne s\'habituera jamais à la pluie, ni à la petite ville de Forks. La rencontre d\'Edward, un lycéen de son âge d\'une beauté inquiétante, pourrait bien la faire changer d\'avis... Quels mystères cache cet être insaisissable aux humeurs si changeantes? À la fois attirant et inatteignable, Edward Cullen n\'est pas humain. Il est au-delà de cela. Bella en est convaincue.', '9782253177159'),
('9', 'Virgin suicides', 'Jeffrey Eugenides', '2000', 'Roman', 'Adultes', 'Psychologique', 'Jeunes, belles et fragiles, les cinq filles Lisbon se suicident en l\'espace d\'une année. Difficile de comprendre ce qui se passe derrière les murs de la villa familiale : un quotidien étouffant, une mère plus sévère que les autres, une folie contagieuse... Des garçons du quartier, effrayés et fascinés, observent les filles s\'effondrer une à une. Devenus adultes, ils s\'interrogent encore.', '9782757820056'),
('10', 'Le portrait de Dorian Gray', 'Oscar Wilde', '1890', 'Roman', 'Adultes', 'Philosophique', 'Alors qu\'il rend visite à son ami peintre Basil Hallward, Lord Henry rencontre le jeune Dorian Gray. Emerveillé par sa jeune beauté et sa naïveté, il se lie rapidement d\'amitié avec lui et dit, en plaisantant, qu\'une fois le portrait terminé, seul celui-ci gardera à jamais cette beauté tandis que Dorian vieillira peu à peu. Le jeune homme déclare alors qu\'il donnerait son âme pour que ce portrait vieillisse à sa place. A ces mots, tous rirent... sur le moment.', '9782253002888'),
('11', 'Le monde de Charlie', 'Stephen Chbosky', '1999', 'Roman', 'Adolescents', 'Drame', 'Au lycée, on trouve Charlie bizarre. Trop sensible, pas «raccord». Aux yeux de son professeur de Lettres, qui lui fait découvrir les classiques américains, c\'est sans doute un prodige ; les autres le voient comme un «freak». Lui se contente de rester en marge des choses. Jusqu\'au jour où deux étudiants, Patrick et la jolie Sam, le prennent sous leur aile. La musique, les filles, la fête : c\'est tout un monde que Charlie découvre...', '9782010021787'),
('12', 'Les Misérables', 'Victor Hugo', '1862', 'Roman', 'Adultes', 'Société', 'L\'action se déroule en France au cours du premier tiers du xixe siècle, entre la bataille de Waterloo (1815) et les émeutes de juin 1832. On y suit la vie de Jean Valjean, de sa sortie du bagne jusqu\'à sa mort. Autour de lui gravitent les personnages, dont certains vont donner leur nom aux différentes parties du roman, témoins de la misère de ce siècle, misérables eux-mêmes ou proches de la misère : Fantine, Cosette, Marius, mais aussi les époux Thénardier et leurs enfants Éponine, Azelma et Gavroche, ainsi que le représentant de la loi, Javert. Outre le récit souvent dramatique des péripéties des vies de ces personnages, Victor Hugo interrompt régulièrement l\'action pour de vastes digressions (telle la longue description de la bataille de Waterloo ouvrant la deuxième partie), prétextes à exposer ses idées sur l\'Histoire, la société ou la religion.', '9782266274289'),
('13', 'Carrie', 'Stephen King', '2010', 'Roman', 'Adolescents', 'Horreur', 'Carrie White, dix-sept ans, solitaire, timide et pas vraiment jolie, vit un calvaire : elle est victime du fanatisme religieux de sa mère et des moqueries incessantes de ses camarades de classe. Sans compter ce don, cet étrange pouvoir de déplacer les objets à distance, bien qu\'elle le maîtrise encore avec difficulté... Un jour la chance paraît lui sourire. Tommy Ross, le seul garçon qui semble la comprendre et l\'aimer, l\'invite au bal de printemps de l\'école. Une marque d\'attention qu\'elle n\'aurait jamais espérée, et peut-être même le signe d\'un renouveau...', '9782253096764'),
('14', 'Fleurs Captives', 'Virginia C. Andrews', '1979', 'Roman', 'Adolescents', 'Drame', 'Quatre enfants sont séquestrés dans un immense et ténébreux grenier, avec juste de quoi subsister. Pour oublier, ils font de ce grenier le royaume de leurs jeux et de leurs rêves, le refuge secret de leur tendresse, à l\'abri du monde. Mais en grandissant, ils se découvrent des haines et des désirs d\'adultes. Leur seul rêve est maintenant de s\'évader.', '9782290211656'),
('15', 'Tintin au Tibet', 'Hergé', '1993', 'Bande dessinée', 'Jeunes', 'Policier', 'Un avion de ligne s\'est écrasé dans l\'Himalaya et Tchang, l\'ami que Tintin a connu en Chine, est au nombre des disparus. Accompagné par le capitaine Haddock, il s\'embarque aussitôt pour le Népal. Sur place, les recherches seront pimentées par la rencontre avec un célèbre autochtone, le yeti.', '9782203001190'),
('16', 'Les nombrils', 'Maryse Dubuc', '2006', 'Bande dessinée', 'Adolescents', 'Humoristique', 'Les Nombrils raconte la vie de trois adolescentes : Karine, une grande maigrichonne gentille, timide et sensible, Jenny, une rousse au corps de rêve mais qui ne réfléchit pas plus que sa brosse à cheveux, et Vicky, une belle métisse manipulatrice et prétentieuse. Les trois adolescentes forment en apparence un groupe d\'amies bien que Jenny et Vicky traitent implacablement Karine comme leur faire-valoir, tout en s\'échinant à saboter ses liaisons sentimentales.', '9782800137728'),
('17', 'Tartuffe', 'Molière', '1669', 'Roman', 'Adultes', 'Comédie', 'Issu de la haute bourgeoisie, Orgon s\'est laissé subjuguer par Tartuffe dont il admire la ferveur religieuse. Mais ce dernier n\'est qu\'un hypocrite intéressé par la fortune de son protecteur. Malgré l\'hostilité de sa propre famille, Orgon a fait de lui son directeur de conscience, son confident et son maître à penser... Les manoeuvres de l\'imposteur seront-elles déjouées à temps?', '9782081415966'),
('18', 'La cité des ténèbres', 'Cassandra Clare', '2007', 'Roman', 'Adolescents', 'Surnaturel', 'Clary n\'en croit pas ses yeux. Elle vient de voir le plus beau garçon de la soirée commettre un meurtre. Et détail terrifiant: le corps de la victime a disparu d\'un seul coup! Mais le pire reste à venir. Sa mère a été kidnappée par d\'étranges créatures et l\'appartement complètement dévasté. Sans le savoir, Clary a pénétré dans une guerre invisible entre d\'antiques forces démoniaques et la société secrète des chasseurs d\'ombres. Une guerre dans laquelle elle a un rôle fatal à jouer.', '9782266244299'),
('19', 'Coraline', 'Neil Gaiman', '2002', 'Conte', 'Jeunes', 'Fantastique', 'Coraline vient de déménager et découvre son environnement, une étrange maison qu\'elle et ses parents partagent avec des voisins peu communs: deux anciennes actrices et un vieux toqué éleveur de souris savantes. \"Je suis une exploratrice !\", clame Coraline. Gare pourtant : derrière la porte condamnée, un monde magique et effrayant l\'attend.', '9782226140197'),
('20', 'Lolita', 'Vladimir Nabokov', '2001', 'Roman', 'Adultes', 'Drame', 'Récemment arrivé en Nouvelle-Angleterre, le professeur Humbert Humbert cherche une chambre à louer. Visitant un logement, il aperçoit la jeune fille de la maison, Lolita. Cette vision l\'enflamme et il décide de s\'installer là. Il épouse bientôt madame Haze, propriétaire des lieux et mère de Lolita, pour rester auprès de la jeune fille.', '9782070412082')";

sql($query);

?>

</body>
</html>