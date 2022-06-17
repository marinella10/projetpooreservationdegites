-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 17 juin 2022 à 12:51
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `reservationgite`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateurs_loc`
--

DROP TABLE IF EXISTS `administrateurs_loc`;
CREATE TABLE IF NOT EXISTS `administrateurs_loc` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email_admin` varchar(255) NOT NULL,
  `password_admin_vachar` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `administrateurs_loc`
--

INSERT INTO `administrateurs_loc` (`id_admin`, `email_admin`, `password_admin_vachar`) VALUES
(1, 'marine.calandri1@gmail.com', 'clb'),
(2, 'florentcalandri@gmail.com', 'clb');

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `type_categorie` varchar(255) NOT NULL,
  PRIMARY KEY (`id_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `type_categorie`) VALUES
(1, 'studio'),
(2, 'gites'),
(3, 'yourt'),
(4, 'maison'),
(5, 'mas');

-- --------------------------------------------------------

--
-- Structure de la table `commentaires`
--

DROP TABLE IF EXISTS `commentaires`;
CREATE TABLE IF NOT EXISTS `commentaires` (
  `id_commentaire` int(11) NOT NULL AUTO_INCREMENT,
  `auteur_commentaire` varchar(255) NOT NULL,
  `contenus_commentaire` text NOT NULL,
  `gite_id` int(11) NOT NULL,
  PRIMARY KEY (`id_commentaire`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `commentaires`
--

INSERT INTO `commentaires` (`id_commentaire`, `auteur_commentaire`, `contenus_commentaire`, `gite_id`) VALUES
(1, 'marine', 'logement en bon etat, situe ds elle belle endroit, correspond au photo.', 2),
(2, 'justyna', 'logement bien situe mais sale', 2),
(3, 'karim', 'proprete ok\r\nlogement ok\r\nsituation ok', 3);

-- --------------------------------------------------------

--
-- Structure de la table `location_gite`
--

DROP TABLE IF EXISTS `location_gite`;
CREATE TABLE IF NOT EXISTS `location_gite` (
  `id_gite` int(11) NOT NULL AUTO_INCREMENT,
  `nom_gite` varchar(250) NOT NULL,
  `description_gite` text NOT NULL,
  `image_gite` varchar(250) NOT NULL,
  `prix_gite` float NOT NULL,
  `nbr_chambre` int(11) NOT NULL,
  `nbr_sdb` int(11) NOT NULL,
  `disponible` tinyint(1) NOT NULL,
  `date_arrivee` datetime DEFAULT NULL,
  `date_depart` datetime DEFAULT NULL,
  `categorie_id` int(11) NOT NULL,
  `commentaire_id` int(11) NOT NULL,
  `region_id` int(11) NOT NULL,
  PRIMARY KEY (`id_gite`),
  KEY `region_id` (`region_id`),
  KEY `categorie_id` (`categorie_id`),
  KEY `commentaire_id` (`commentaire_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `location_gite`
--

INSERT INTO `location_gite` (`id_gite`, `nom_gite`, `description_gite`, `image_gite`, `prix_gite`, `nbr_chambre`, `nbr_sdb`, `disponible`, `date_arrivee`, `date_depart`, `categorie_id`, `commentaire_id`, `region_id`) VALUES
(2, 'Gîte Villa Les Ocres, Côté rivière', 'Bienvenue à l\'Isle sur la Sorgue dans ce beau gîte, idéalement situé pour découvrir la Provence. C\'est une grande maison indépendante, à la décoration soignée, au milieu d\'un magnifique jardin de 1500 m2 (palmiers, arbres fruitiers, massifs à fleurs …).\r\n\r\nA l\'extérieur, vous profitez d\'une belle terrasse couverte, orientée au sud, très agréable pour se reposer. La piscine (11 m x 5.5 m) est ouverte du 1er mai au 30 septembre. Elle est partagée avec 3 autres gîtes et les propriétaires.\r\nEn suivant le chemin longeant la rivière, aux eaux limpides et aux berges paisibles, vous atteignez le centre-ville en 10 minutes à pied.\r\n Sa situation au cœur de L\'Isle sur la Sorgue en fait un lieu idéal pour profiter de toutes les richesses de la ville et rayonner sur la Provence !\r\n\r\n', 'image/2\'.png', 565, 6, 2, 0, '2022-04-20 09:44:53', '2022-04-20 09:44:53', 2, 1, 2),
(3, 'Gîte Cabanon du Mourre de Cabus', 'Joli mazet indépendant aménagé avec goût par Marylène. Situé au coeur d\'une oliveraie, vous êtes seulement à 3 minutes en voiture du centre de Carpentras.\r\n\r\nVous trouverez une grande pièce à vivre climatisée de 45 m² lumineuse avec de grandes baies vitrées (TV, lecteur DVD). Cuisine (micro-ondes, lave-vaisselle). 1 chambre (1 lit en 140x190, lit bébé). Salle d\'eau (lave-linge). Wc indépendant. Vous disposerez aussi d\'une véranda de 18 m², lieu agréable à la mi-saison. Salon de jardin, plancha.\r\n\r\nEnfin, Marylène et Michel sauront vous donner les bons conseils pour trouver des restaurants typiques aux saveurs provençales', 'image/cabanondumourreext1\'\'.png', 343, 1, 1, 0, '2022-04-20 09:49:00', '2022-04-20 09:49:00', 3, 1, 1),
(4, 'Chambre d\'hotes Les luttins des montagnes', 'Marc est heureux de vous accueillir dans un cadre magnifique aux portes du parc national des écrins, sur les hauteurs de Chorges, dans son chalet typique qui vous invitera au calme avec sa terrasse, son jardin où la cascade et le bassin vous rafraichiront les jours d\'été. Le chalet \"les lutins des montagnes\" est situé à 10 minutes du lac de Serre Ponçon et à 15 minutes de la ville d\'Embrun, cité épiscopale avec sa cathédrale et de nombreux monuments. Pour les amoureux de la montagne et du sport, vous pourrez pratiquer des activités nautiques tel que la voile, le paddle, et des activités liées aux sports de montagne tel que l\'escalade, l\'alpinisme, le ski. La chambre a son entrée indépendante par la terrasse.\r\n', 'image/chambredeslutinsext1\'\'.png', 70, 1, 1, 1, '2022-04-20 12:00:36', '2022-04-20 12:00:36', 5, 2, 1),
(5, 'chambre d\'hotes Domaine des Eucalyptus', 'Le Domaine des Eucalyptus est un majestueux mas construit en pierre de Beaulieu en 2015, devant son nom aux 200 eucalyptus présents sur la propriété de 6 Ha.\r\nChantal vous régalera avec ses petits-déjeuners composés de jus de fruits locaux, miel d\'eucalyptus, viennoiseries, confitures, charcuteries, œufs de ses poules, beurre et lait de la ferme proche, légumes du potager, différentes variétés de pain...\r\n\r\nSituée à seulement 5km d\'Eygalières et 7km de St Rémy de Provence, cette maison d\'hôtes de grand standing vous permettra de vous ressourcer tout en découvrant les principaux trésors des Alpilles alentours, ou encore Avignon et son Palais des Papes non loin.\r\n\r\n2 nuits min en été.', 'image/domaineeucalyptuseext1.png', 225, 1, 1, 1, '2022-04-20 12:00:36', '2022-04-20 12:00:36', 1, 2, 2),
(6, 'les yourts de Paraloup', 'Sur les hauteurs de la vallée de l\'Avance, à la ferme, 2 spacieux chalets en bois façon yourtes pour un séjour atypique alliant confort et originalité, avec une vue dégagée sur tous les massifs du Gapençais. Les 2 chalets en bois façon yourtes , face à face, donnent sur une grande terrasse en bois aménagée avec mobilier de jardin . A proximité, nombreuses activités de pleine nature : ski, randonnées, Serre-Ponçon et ses activités nautiques, découverte de Gap et surtout du sanctuaire de Notre-Dame du Laus accessible à pied. Espace extérieur aménagé. Piscine hors sol.', 'image/yourtext1.png', 430, 3, 1, 0, '2022-04-20 12:11:58', '2022-04-20 12:11:58', 4, 1, 1),
(7, 'gites les lauriers roses', '\r\n\r\nA seulement 500m des plages,et a 20 de la route des plages, avec vue imprenable sur la Méditerranée et les Iles d\'Or à l\'horizon, maison individuelle avec terrasse couverte, salon de jardin et chaises longues. Sur la même propriété, non mitoyen, trois autres gîtes (G701, G702, G995). Navette pour les plages (Gigaro) et le village à 200m (du 15 juin au 15 septembre). Accès wifi. Parking dans la propriété (partiellement clos). Idéalement situé pour visiter les villages du golfe de Saint Tropez (Gassin, le Lavandou, Ramatuelle...) et pour découvrir le sentier du littoral à partir de la plage de Gigaro : le Cap Lardier, le Cap Taillat...', 'image/giteslesloriersroseext1\'.png', 490, 2, 1, 1, '2022-04-20 12:11:58', '2022-04-20 12:11:58', 2, 3, 1),
(8, 'sutidio Antinea', '\r\nUn sympathique pied à terre au cœur de La Ciotat : le matin vous pourrez descendre sur le port acheter votre poisson frais, partir à pied dans la Calanque du Mugel ou de Figuerolles ou prendre une navette pour aller passer la journée sur l\'Ile Verte, aller sur l\'une des plages de sable tout au long de la route, prendre votre café à une terrasse au pied du clocher de la ville ou tout simplement vous promener dans les rues piétonnes adjacentes. Parking public à 150 m avec des forfaits hebdomadaires (25€ - tarifs 2020).', 'image/studioantineavue3\'.png', 400, 1, 1, 1, '2022-04-20 12:42:39', '2022-04-20 12:42:39', 1, 2, 1),
(9, 'maison adelaide', 'Située en plein centre de La Ciotat, Osez Adélaïde est une superbe maison Luxury proposant des installations high tech et haut de gamme.\r\n\r\nLa maison, organisée sur 4 niveaux, comprend 7 chambres dont un studio indépendant avec facilité d\'accès pour les PMR (largeur de porte adaptée, rampes, douche à l\'italienne grande dimension).\r\n\r\nAu sous-sol : très grande pièce avec billard US, jukebox, baby-foot, vélo d\'appartement, nombreux jeux dont jeux enfants, sauna/hammam avec infrarouges ou poële et petite salle de cinéma 7 places..\r\n- Piscine intérieure 3x10m, profondeur 1,5m, magnifiquement aménagée, avec fontaine lumineuse. Rétroprojecteur et écran de projection permettant de visionner un film directement dans l\'eau. Douche et WC.\r\n\r\n\r\n \r\n\r\n\r\n', 'image/maisonadelaidepiscineinterieur1.png', 6060, 6, 7, 0, '2022-04-20 12:42:39', '2022-04-20 12:42:39', 1, 2, 3),
(10, 'Appartement fernandel', 'Située dans le 4ème arrondissement, proche de la Friche de la Belle de Mai (espace culturel très animé de Marseille), à 350m de la station de métro des Chartreux (Conseil Départemental), la Casa Ammirati propose 4 appartements pour 2 personnes, deux d\'entre eux ouvrant sur une cour arborée et fleurie, où chacun dispose d\'un salon de jardin et de l\'accès à la piscine des propriétaires (hors sol - chauffée - 5x3 m - accessible du 01/04 au 15/10 de 9h à 23h).\r\n\r\nL\'appartement Fernandel est situé au 1er étage côté jardin. Il dispose d\'une pièce de jour avec coin cuisine (2 plaques vitrocéramique, frigo, four micro ondes, petit électroménager) et coin salon (canapé pour 2 personnes), espace repas.\r\nChambre avec lit 2 personnes (140x190), petit coin dressing.\r\nSalle d\'eau/wc.\r\n\r\nWi-fi, télévision écran plat, buanderie commune avec lave linge et sèche linge.\r\n\r\nToutes charges comprises : chauffage électrique, draps et linge, ménage de fin de séjour. Ventilateur, double vitrage, lit et chaise bébé sur demande. Place dans parking souterrain mise gracieusement à disposition.\r\n\r\nLa tranquilité d\'un quartier à quelques minutes en métro du centre ville et ses animations !', 'image/appartementfernendelext.png', 525, 1, 1, 1, '2022-04-20 12:59:29', '2022-04-20 12:59:29', 1, 2, 1),
(11, 'le petit Malosque', 'Les pieds dans l\'eau, découvrez un vrai cabanon marseillais dans l\'anse de Malmousque : en bas de la Corniche, vue plongeante sur la mer, les îles du Frioul, le Château d\'If et la Côte Bleue, les ferries et les paquebots de croisière qui passent au loin... Sur une corniche commune aux autres cabanons en front de mer, plusieurs logements mitoyens, petit espace extérieur commun avec table pliante (petits déjeuners de rêve face à la Méditerranée).\r\n\r\nSitué dans le plus joli quartier de Marseille, ce cabanon de pêcheur a été entièrement rénové et meublé. Il vous offre tout le confort nécessaire pour des vacances inoubliables ! Ce gîte peut accueillir 2 personnes dans 25m². Il possède une grande pièce à vivre qui réunit le salon avec un canapé convertible en 140x190cm, TV écran plat, espace repas face à la mer, cuisine équipée avec plaque 4 feux vitrocéramique, petit réfrigérateur et micro-ondes. Sa salle d\'eau dispose d\'une douche et WC.\r\n\r\nPour nos invités venant en voiture, le stationnement dans le quartier de Malmousque est gratuit. Le centre-ville et le vieux port sont eux à 1.5 kilomètres.\r\n', 'image/lepetitmanosqueext\'\'.png', 475, 1, 1, 0, '2022-04-20 12:59:29', '2022-04-20 12:59:29', 1, 3, 2),
(12, 'gite terrasse du Garlaban', 'Situé dans le village de Marcel Pagnol, au cœur de la Treille, le gîte Pagnol a été aménagé dans une ancienne fermette du XIXème siècle et est mitoyen au gîte Marcel. Il possède une grande terrasse privative en bois de 100 m² avec salon de jardin et barbecue, piscine privative de 30 m² (profondeur de 1,2m à 1,5m) accessible du 15/05 au 19/09 et jardin privatif de 100 m².\r\n\r\nLe gîte est composé au rez-de-chaussée de :\r\n- Cuisine avec plaque 4 feux vitrocéramique, hotte aspirante, combiné four micro-ondes, four électrique, réfrigérateur/congélateur et lave-linge. Espace repas pour 4 personnes devant la cheminée (bois fourni).\r\n- Salon avec canapé convertible 140x190cm, TV écran plat 125cm avec Netflix et rangements.\r\n- Bureau.\r\n\r\nVous bénéficierez dans cet hébergement d\'une localisation idéale pour découvrir Marseille et ses plages (à 10km), tout en étant dans un environnement verdoyant privilégié. Cure thermale à 1,5km, restaurant Le Cigalon à proximité immédiate avec superbe point de vue sur la vallée ainsi que l\'Eglise Saint-Dominique. Nombreux chemins de randonnée au départ immédiat du gîte. La tombe de Marcel Pagnol se situe à 200m.\r\n\r\n', 'image/garlaban\'.png', 1, 1, 1, 1, '2022-04-20 13:52:53', '2022-04-20 13:52:53', 1, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `regions`
--

DROP TABLE IF EXISTS `regions`;
CREATE TABLE IF NOT EXISTS `regions` (
  `id_region` int(11) NOT NULL AUTO_INCREMENT,
  `nom_region` varchar(255) NOT NULL,
  PRIMARY KEY (`id_region`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `regions`
--

INSERT INTO `regions` (`id_region`, `nom_region`) VALUES
(1, 'provence'),
(2, 'cote d\'azur'),
(3, 'hautes alpes');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur_location`
--

DROP TABLE IF EXISTS `utilisateur_location`;
CREATE TABLE IF NOT EXISTS `utilisateur_location` (
  `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  PRIMARY KEY (`id_utilisateur`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur_location`
--

INSERT INTO `utilisateur_location` (`id_utilisateur`, `email`, `password`) VALUES
(1, 'audrey.dizet@gmail.com', 'online'),
(2, 'justyna@hotmail.com', ''),
(3, 'ludo@gmail.com', 'saida@gmail.com'),
(4, 'bob@furfrf.fr', '$2y$10$wrxeb08pGi87VkdWL5VObO0jQF39EBJ5FeAnwxMlLw/CssbBwCjti'),
(5, 'test@test.fr', '$2y$10$r7oZosUmyTAx0zx0ODcJBOGSPf5qX95hvnhLhhlhxVNnbKWYvC7vu'),
(6, 'marine.calandri1@gmail.com', '$2y$10$Cgb5rWcXnAI1iJRHcXyw4epFxqtyTd1ReA10rXCiP4455WMs.ylG2'),
(7, 'marine.calandri1@gmail.com', '$2y$10$hL0i1mizpyw4l/9QaBCaqu0k9T6mS5I4SarKjaHpczTYvNTYzvAtm');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `location_gite`
--
ALTER TABLE `location_gite`
  ADD CONSTRAINT `location_gite_ibfk_1` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`),
  ADD CONSTRAINT `location_gite_ibfk_2` FOREIGN KEY (`commentaire_id`) REFERENCES `commentaires` (`id_commentaire`),
  ADD CONSTRAINT `location_gite_ibfk_3` FOREIGN KEY (`region_id`) REFERENCES `regions` (`id_region`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
