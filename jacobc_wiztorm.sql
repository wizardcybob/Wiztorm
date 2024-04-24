-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le : mer. 24 avr. 2024 à 13:54
-- Version du serveur : 10.3.39-MariaDB-0+deb10u2
-- Version de PHP : 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `jacobc_wiztorm`
--

-- --------------------------------------------------------

--
-- Structure de la table `Appartenir`
--

CREATE TABLE `Appartenir` (
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `id_categorie` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Appartenir`
--

INSERT INTO `Appartenir` (`id_article`, `id_categorie`) VALUES
(19, 8),
(17, 3),
(20, 2),
(18, 3),
(21, 1),
(22, 6),
(22, 5),
(13, 8),
(13, 1),
(14, 2),
(104, 2),
(104, 3);

-- --------------------------------------------------------

--
-- Structure de la table `Articles`
--

CREATE TABLE `Articles` (
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `titre_article` varchar(255) NOT NULL,
  `texte_article` text NOT NULL,
  `image_article` varchar(255) DEFAULT NULL,
  `dateevenement_article` date DEFAULT NULL COMMENT 'date qui correspond à l''évènement et non pas à la publication de l''article',
  `image2_article` varchar(255) DEFAULT NULL,
  `image3_article` varchar(255) DEFAULT NULL,
  `image4_article` varchar(255) DEFAULT NULL,
  `special` int(11) NOT NULL DEFAULT 0,
  `type_pheno_article` int(11) DEFAULT 2 COMMENT '1 : phénomène atmosphérique\r\n2 : phénomène terrestre'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Articles`
--

INSERT INTO `Articles` (`id_article`, `titre_article`, `texte_article`, `image_article`, `dateevenement_article`, `image2_article`, `image3_article`, `image4_article`, `special`, `type_pheno_article`) VALUES
(13, 'Orage volcanique', 'Les orages volcaniques, phénomènes incroyables mélangeant éclairs et éruptions, sont facilement observables au Sakurajima, un volcan japonais étant l\'un des plus actifs au monde. Cependant, il n’est pas le fruit d’un accouplement entre un orage traditionnel et d’une simple éruption. Les éclairs de cet orage volcanique se forment suite à une charge d’électricité statique qui se développe dans les nuages de cendre lorsque les particules expulsées du cratère se frottent les unes contre les autres. Ces décharges sont facilitées par la présence d\'une quantité massive de vapeur d’eau, relâchée par le volcan.\r\nDe plus, ce qui rend impressionnant ce phénomène est le fait que les éclairs, attirés par le fer qui compose la lave, frappent le sommet du volcan.\r\n', 'images/orage_volcanique.jpg', NULL, NULL, NULL, NULL, 1, 1),
(14, 'Une mousson en Amazonie', 'La mousson, au sens strict, est un terme qui s’applique qu’au climat indien. Cependant, depuis quelques années, des scientifiques se rendent compte que chaque année à la même période des nuages et de fortes pluies apparaissent au-dessus de l’Amazonie. Un phénomène semblable à celui de la mousson en Asie du Sud-Ouest.  Après de multiples recherches, les scientifiques ont pu conclure que ce phénomène de mousson en Amazonie est dû à une forte évapotranspiration des plantes !Il faut savoir que la “transpiration” des plantes s’appelle l’évapotranspiration, et que cette évapotranspiration à lieu lorsque les sols sont trop humides. A partir de là, l’eau contenu dans le sol va passer à travers les racines de la plante, dans sa sève, et va sortir sous forme de gaz par ses feuilles. C’est à travers ce fonctionnement que la plante peut avoir sa croissance.', 'images/amazonie1.jpg', NULL, NULL, NULL, NULL, 1, 1),
(17, 'La saison des tornades', 'Chaque année, à la même période, les Etats-Unis connaissent une forte apparition de tornades sur leur sol. Les états du Kansas, de l’Oklahoma, du Texas, et parfois même jusqu’à la Floride étant les plus touchés, on appelle cette zone la Tornado Alley. Par an, on compte en moyenne 1253 tornades. Le mois de mai étant la haute saison des tornades, on compte entre le 2 et le 4 mai 2021, environ 85 tornades !La formation de tornade se crée grâce à la rencontre d’un air chaud venant du sud des Etats-Unis, et d’un air froid venant du nord. Avec les courants atmosphériques (alizés, cellules de Hadley/Ferrel, courant-jet), il va y avoir un cisaillement des vents qui vont faire tourner des nuages (cumulonimbus). Par la suite, avec la force de rotation des vents, un tuba va se former, puis va toucher le sol avant de déclencher la tornade. La tornade va atteindre des vitesses entre 160 et 400 km/h.', 'images/schema_formation_tonade.jpg', NULL, 'images/carte_tornades.png', 'images/carte_nombre_tornades.png', 'images/mois_tornades.jpg', 1, 1),
(18, 'La tornade d’El Reno', 'D’une durée totale de 40 minutes, la tornade d’El Reno en Oklahoma a produit des vents allant jusqu’à 475 km/h. Connue pour être la tornade la plus large jamais enregistrée avec une largeur estimée à 4,2 km. Elle tua parmi ses victimes 3 chasseurs de tornades connus qui menaient l\'émission Storm Chasers, dont Tim Samaras étant aussi un chercheur reconnu qui étudiait ces phénomènes.', 'images/el_reno.jpg', '2013-05-31', NULL, NULL, NULL, 1, 1),
(19, 'L\'orage de Catatumbo', 'L\'orage de Catatumbo est l\'orage le plus puissant de la planète. Par an, il se produit 140 à 160 nuits pendant une dizaine d\'heures et avec une fréquence de 280 éclairs par heure. Les vents chauds et humides qui proviennent de la mer des Caraïbes s’engouffrent dans le bassin du lac de Maracaibo et rencontrent l’air froid de la Cordillères des Andes, provoquant des perturbations atmosphériques. Pendant ce temps, le méthane stocké dans le lac s’évapore et gagne en altitude. Les courants d’air ascendants des nuages répartissent alors aléatoirement le méthane qui va se concentrer à différents endroits. De là, le méthane va affaiblir les propriétés d’isolation de l’air qui servent à réduire l’activité électrique. Ceci va alors permettre à l’orage de se former et de perdurer. Mais pourquoi l’orage se déroule t-il uniquement la nuit ? A cause du rayonnement solaire. Pendant la journée, ce dernier décompose les molécules de méthane dans l’atmosphère. Lorsque le soleil se couche, les rayons ultraviolets disparaissent, le méthane joue alors son rôle et l’orage peut commencer à gronder.', 'images/catatumbo.jpg', NULL, NULL, NULL, NULL, 1, 1),
(20, 'La saison verte', 'En Thaïlande, la mousson, ou saison verte, démarre au mois de mai et se termine au mois d\'octobre. Les pluies sont alors très fréquentes mais n’ont rien à voir avec la mousson indienne. En Thaïlande, la mousson se caractérise par de gros orages imprévisibles mais également brefs. Les pluies sont cependant plus importantes dans la partie Nord du pays et s\'accompagnent de températures plus fraîches que dans le Sud. La moyenne de précipitations dans le Nord peut aller de 150 mm en début de mousson à 225 mm aux mois d\'août et septembre. Les mois les plus pluvieux sont en effet les mois de fin de mousson, quelle que soit la région.\r\nDans les régions montagnardes, à l\'Est du fleuve Chao Praya, la mousson se caractérise par une période de précipitations s\'étendant de la mi-mai à la fin du mois de novembre. La moyenne des précipitations est de 155 mm en mai et de 120 mm en octobre, avec un pic de 225 mm en août.\r\n', 'images/mousson_thai.jpg', NULL, NULL, NULL, NULL, 1, 1),
(21, 'Le mont Fuji', 'Le mont Fuji est un stratovolcan faisant partie de la ceinture de feu du Pacifique et dont les éruptions majoritairement explosives le classent comme un volcan explosif. Il est aussi considéré comme la plus haute montagne du Japon avec une  base de diamètre de 30 km et un sommet ayant un cratère de 700 m de diamètre pour une profondeur de 100 mètres. Par ses 3776 mètres d’altitude, le mont Fuji connaît différents climat le long de ses pentes. Une grande partie de la montagne se trouve au-delà de l\'étage alpin où règne un climat montagnard très froid et venteux en raison de l\'altitude, ce qui limite le maintien de la végétation qui n\'a toujours pas réussi à se régénérer complètement depuis la dernière éruption survenue il y a trois siècles. Ce climat rigoureux ne permet pas la fonte prononcée de la neige tombée au cours de l\'hiver pouvant se maintenir parfois toute l\'année. Le bas des pentes est en revanche couvert de forêts et les pieds de la montagne, jouissant d\'un climat plus tempéré. Ce sont pour ces multiples caractéristiques qu’on retrouve sur le sommet du mont Fuji un observatoire météorologique.', 'images/fuji.jpg', NULL, NULL, NULL, NULL, 1, 2),
(22, 'Le mégatsunami de la baie Lituya', 'Suite à un séisme de magnitude 8,3 dans la baie de Lituya, un glissement de terrain sur 1000m de large, souleva une vague de 60m de hauteur qui s\'abattit sur les montagnes qui bordent la baie. La végétation a été détruite jusqu’à 500m de hauteur sur les flancs des montagnes. Par ses statistiques, le “mégatsunami” de la baie de Lituya est reconnu comme le plus grand identifié.\r\n', 'images/baie_lituya.jpg', '1958-07-09', NULL, NULL, NULL, 1, 2),
(104, '.MODIFIABLE / SUPPRIMABLE', 'certains articles possèdent des conditions pour ne pas être modifiés', 'images/png-clipart-cat-bird-house-sparrow-kitten-sparrow-animals-fauna - Copie.png', NULL, NULL, NULL, NULL, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `Categories`
--

CREATE TABLE `Categories` (
  `id_categorie` bigint(20) UNSIGNED NOT NULL,
  `nom_categorie` varchar(255) NOT NULL,
  `description_categorie` text NOT NULL,
  `photo_categorie` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Categories`
--

INSERT INTO `Categories` (`id_categorie`, `nom_categorie`, `description_categorie`, `photo_categorie`) VALUES
(1, 'Volcan', 'Un volcan est une structure géologique qui résulte de la montée d\'un magma puis de l\'éruption de matériaux (gaz et lave) issus de ce magma, à la surface de la croûte terrestre ou d\'un autre astre. Il peut être aérien ou sous-marin. Les volcans sont souvent des édifices complexes qui ont été construits par une succession d\'éruptions et qui, dans la même période, ont été partiellement démolis par des phénomènes d\'explosion, d\'érosion ou d\'effondrement. \r\nIl existe des volcans effusives, avec des coulées de laves fluides, qui sont en général les moins dangereuses, et des volcans avec des éruptions explosives, plus meurtrières.', 'images/catégorie/volcan.jpg'),
(2, 'Mousson', 'La mousson est un phénomène saisonnier de régime de vent persistant qui souffle au-dessus de vastes régions intertropicales, de l\'océan vers le continent en été où il apporte des précipitations excessivement abondantes.', 'images/catégorie/mousson.jpg'),
(3, 'Tornade', 'La formation de tornade se crée grâce à la rencontre d’un air chaud et d’un air froid. Les courants atmosphériques (alizés, cellules de Hadley/Ferrel/polaire, courant-jet), vont rencontrer des vents de cisaillement qui vont faire tourner les nuages (cumulonimbus). Par la suite, avec la force de rotation des vents, un tuba va se former, puis va toucher le sol avant de déclencher une tornade. Une tornade peut atteindre des vitesses entre 160 et 400 km/h.', 'images/schema_formation_tonade.jpg'),
(5, 'Séisme', 'Un séisme ou tremblement de terre est une secousse du sol résultant de la libération brusque d\'énergie accumulée par les contraintes exercées sur les roches. Cette libération d\'énergie se fait par rupture le long d\'une faille, généralement à la limite entre les plaques tectoniques. Il se produit de très nombreux séismes tous les jours mais la plupart ne sont pas ressentis par les humains. Environ cent mille séismes sont enregistrés chaque année sur la planète.', 'images/catégorie/séisme.jpg'),
(6, 'Tsunami', 'Un tsunami est une série d\'ondes de très grande période se propageant à travers un milieu aquatique, issues du brusque mouvement d\'un grand volume d\'eau, provoqué généralement par un séisme, un glissement de terrain sous-marin ou une explosion volcanique, et pouvant se transformer, en atteignant les côtes, en vagues destructrices déferlantes de très grande hauteur. ', 'images/catégorie/tsunami.jpg'),
(8, 'Orage', 'Un orage est une perturbation atmosphérique d\'origine convective associée à un type de nuage particulier : le cumulonimbus. L\'orage engendre des pluies fortes à diluviennes, des décharges électriques de foudre accompagnées de tonnerre. Dans des cas extrêmes, il peut produire des chutes de grêle, des vents très violents et, rarement, des tornades. Les orages peuvent se produire en toute saison, tant que les conditions d\'instabilité et d\'humidité de l\'air sont présentes.', 'images/catégorie/orage.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `Lieux`
--

CREATE TABLE `Lieux` (
  `id_lieu` bigint(20) UNSIGNED NOT NULL,
  `nom_lieu` varchar(255) NOT NULL,
  `continent_lieu` varchar(255) NOT NULL,
  `capitale_lieu` varchar(255) NOT NULL,
  `superficie_lieu` varchar(255) NOT NULL,
  `population_lieu` varchar(255) NOT NULL,
  `photo_lieu` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Lieux`
--

INSERT INTO `Lieux` (`id_lieu`, `nom_lieu`, `continent_lieu`, `capitale_lieu`, `superficie_lieu`, `population_lieu`, `photo_lieu`) VALUES
(2, 'Etats-Unis', 'Amérique', 'Washington', '9,834 millions km²', '329,5 millions', 'images/lieux/usa.png'),
(3, 'Japon', 'Asie', 'Tokyo', '377 975 km²', '125,8 millions', 'images/lieux/japon.png'),
(4, 'Brésil', 'Amérique', 'Brasilia', '8,516 millions km²', '212,6 millions', 'images/lieux/bresil.png'),
(5, '.Pas de lieu précis', '/', '/', '/', '/', 'images/lieux/monde.png'),
(6, 'Thaïlande', 'Asie', 'Bangkok', '514 000 km2', '69,8 millions', 'images/lieux/thailande.png'),
(7, 'Venezuela', 'Amérique', 'Caracas', '916 445 km2', '28,44 millions', 'images/lieux/venezuela.png');

-- --------------------------------------------------------

--
-- Structure de la table `Situer`
--

CREATE TABLE `Situer` (
  `id_article` bigint(20) UNSIGNED NOT NULL,
  `id_lieu` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Déchargement des données de la table `Situer`
--

INSERT INTO `Situer` (`id_article`, `id_lieu`) VALUES
(13, 5),
(14, 4),
(17, 2),
(18, 2),
(19, 7),
(20, 6),
(21, 3),
(22, 2),
(104, 2),
(104, 4),
(104, 7);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Appartenir`
--
ALTER TABLE `Appartenir`
  ADD KEY `fk_categorie_associer` (`id_categorie`),
  ADD KEY `fk_article_associer` (`id_article`);

--
-- Index pour la table `Articles`
--
ALTER TABLE `Articles`
  ADD PRIMARY KEY (`id_article`);

--
-- Index pour la table `Categories`
--
ALTER TABLE `Categories`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `Lieux`
--
ALTER TABLE `Lieux`
  ADD PRIMARY KEY (`id_lieu`);

--
-- Index pour la table `Situer`
--
ALTER TABLE `Situer`
  ADD PRIMARY KEY (`id_article`,`id_lieu`),
  ADD KEY `fk_situer_lieu` (`id_lieu`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Articles`
--
ALTER TABLE `Articles`
  MODIFY `id_article` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT pour la table `Categories`
--
ALTER TABLE `Categories`
  MODIFY `id_categorie` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `Lieux`
--
ALTER TABLE `Lieux`
  MODIFY `id_lieu` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Appartenir`
--
ALTER TABLE `Appartenir`
  ADD CONSTRAINT `fk_article_associer` FOREIGN KEY (`id_article`) REFERENCES `Articles` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_categorie_associer` FOREIGN KEY (`id_categorie`) REFERENCES `Categories` (`id_categorie`);

--
-- Contraintes pour la table `Situer`
--
ALTER TABLE `Situer`
  ADD CONSTRAINT `fk_situer_articles` FOREIGN KEY (`id_article`) REFERENCES `Articles` (`id_article`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_situer_lieu` FOREIGN KEY (`id_lieu`) REFERENCES `Lieux` (`id_lieu`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
