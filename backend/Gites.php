<?php

//appelle le fichier database
require_once "backend/Database.php";

//créer la class gites qui est une méthode
// class gites qui hérites du  la class  database
class Gites extends Database
{

    //Afficher les gites
    //faire les propriétés qui son des Variables
    //mettre les variable en public pour pouvoir acceder de l'intérieur et de l'extérieur

    private $nom_gite;
    private $description_gite;
    private $image_gite;
    private $prix_gite;
    private $nbr_chambre;
    private $nbr_sdb;
    private $disponible;
    private $date_arrivee;
    private $date_depart;
    private $nom_region;
    private $type_gite;
    private $id_commentaire;

    public function getGites()
    {
        //recupérer getPDO de la class Databases
        $baseGites = $this->getPDO();

        //faire ma requete sql
        $sql = "SELECT * FROM location_gite";


        //On stock le resultats dans une variables $gites
        $gites = $baseGites->query($sql);

        //faire le return
        return $gites;
    }

    //Cette methode est destinée a recupérer tous les gites de la table phpMyADmin et a etre afficher sur le tableau de bord Administrateur
    public function getLocation_gite()
    {
        //Appel de la methode getPDO de la classe MERE Database.php
        //La connexion a PDO est stocké dans une variable
        $db = $this->getPDO();
        //la requètes SQL
        $sql = "SELECT * FROM `location_gite` 
                INNER JOIN categorie ON location_gite.gite_categorie = categories.id_categorie 
                INNER JOIN regions ON location_gite.nom_region = regions.id_region ORDER BY id_gite DESC";
        //On stock le resultats dans une variables $gites
        $gites = $db->query($sql);
        //la fonction getGites() retourne un tableau associatif contenant toutes les données de la table gites phpMyAdmin
        //Ici $gites sera utilisé dans la vue accueil.php
        return $gites;

    }

    //Cette methode est destinée a recupérer un gite de la table phpMyADmin a l'aide de son ID
    public function getGiteById()
    {
        //Appel de la methode getPDO de la classe MERE Database.php
        //La connexion a PDO est stocké dans une variable
        $db = $this->getPDO();
        //Requète SQL filtrer par id_gite
        $sql = "SELECT * FROM location_gite
                                    INNER JOIN categorie ON location_gite.categorie_id= categorie.id_categorie
                                    INNER JOIN  regions ON location_gite.region_id = regions.id_region          
                                    INNER JOIN commentaires ON location_gite.commentaire_id = commentaires.id_commentaire
                                    WHERE location_gite.id_gite = ?";
        //Requète preparée lutte contre les injections SQL methode prepare de la classe PDO + (requète SQL en paramètre)
        $request = $db->prepare($sql);
        //Recup de l'id du gite passée dans l'url de la page administration via <a href="<?= details_gite&id=<?= $row['id_gite']" ? > ></a>
        //A l'aide de la variable super globale $_GET['']
        $id = $_GET['id_gite'];
        //On lie ID recuperer a la  requète SQL
        $request->bindParam(1, $id);
        //On execute la requète
        $request->execute();
        //fetch =  Récupère la ligne suivante d'un jeu de résultats PDO execute() et on stock dans une variable
        $details = $request->fetch();
        //La fonction retourne un resultat (un gite) par id
        return $details;
    }

    //Cette methode est destinée a ajouter un gites de la table phpMyADmin a l'aide d'un formulaire
    //Ici un mutateur = setters
    public function setGites()
    {
        //On verifie tous les champs du formulaires existe et ne sont pas vide
        //On assigne les $_POST[] = attribut HTML name="" au propriétés privées (variables)
        if (isset($_POST['nom_gite'])) {
            $this->nom_gite = trim(htmlspecialchars($_POST['nom_gite']));
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ nom du gite</p>";
        }

        //LA DESCRIPTION
        if (isset($_POST['description_gite'])) {
            $this->description_gite = trim(htmlspecialchars($_POST['description_gite']));
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ description du gite</p>";
        }

        //UPLOAD D' IMAGE
        if (isset($_FILES['image_gite'])) {
            $dossierDestination = "image/";
            $img_gite = $dossierDestination . basename($_FILES['image_gite']['name']);
            $_POST['image_gite'] = $img_gite;
            if (move_uploaded_file($_FILES['image_gite']['tmp_name'], $img_gite)) {
                echo '<p class="alert alert-success">Le fichier est valide et à été téléchargé avec succès !</p>';
            } else {
                echo '<p class="alert-danger">Une erreur s\'est produite, le fichier n\'est pas valide !</p>';
            }
        }

        //LE POSTE DE L'IMAGE
        if (isset($_POST['image_gite'])) {
            $this->image_gite = $_POST['image_gite'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ image du gite</p>";
        }

        //LE NOMBRE DE CHAMBRE
        if (isset($_POST['nbr_chambre'])) {
            $this->nbr_chambre = $_POST['nbr_chambre'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ nombre de chambre</p>";
        }
        //LE NOMBRE DE SALLE DE BAINS
        if (isset($_POST['nbr_sdb'])) {
            $this->nbr_sdb = $_POST['nbr_sdb'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ nombre de salle de bain</p>";
        }

        //LA REGION DE FRANCE
        if (isset($_POST['nom_region'])) {
            $this->nom_region = $_POST['nom_region'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ departement</p>";
        }
        //LE PRIX DU GITE / SEMAINE
        if (isset($_POST['prix_gite'])) {
            $this->prix_gite = $_POST['prix_gite'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ prix du gite</p>";
        }

        //LE BOOLEEN GITE DISPO OU NON
        if (isset($_POST['disponible'])) {
            $this->disponible = $_POST['disponible'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ disponible</p>";
        }

        //LA DATE DE DISPO DU GITE
        if (isset($_POST['date_arrivee'])) {
            $this->date_arrivee = $_POST['date_arrivee'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ date d'arrivée</p>";
        }
        //LA DERNIERE DATE DE FIN DE LOCATION
        if (isset($_POST['date_depart'])) {
            $this->date_depart = $_POST['date_depart'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ date de depart</p>";
        }

        //Cle etrangère gite categorie

        if (isset($_POST['type_gite'])) {
            $this->type_gite = $_POST['type_gite'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ type de gite</p>";
        }

        //LES COMMENTAIRE = champs caché avec valeurs par defaut

        if (isset($_POST['commentaire_id'])) {
            $this->commentaire_id = $_POST['commentaire_id'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ commentaire de gite</p>";
        }

        //Verifié que la date d'arrivée n'est pas supérieur à la date départ = une erreur
        if (isset($this->date_depart) > isset($this->date_arrivee)) {
            echo "<p class='alert-danger p-2'>ATTENTION : la date d'arrivée est supérieur à la date de part !</p>";
        }

        //var_dump($_POST['nom_gite']);
        //var_dump($_POST['description_gite']);
        //var_dump($_POST['image_gite']);
        //var_dump($_POST['nbr_chambre']);
        //var_dump($_POST['nbr_sdb']);
        //var_dump($_POST['nom_region']);
        //var_dump($_POST['prix']);
        //var_dump($_POST['disponible']);
        //var_dump($_POST['date_arrivee']);
        //var_dump($_POST['date_depart']);
        //var_dump($_POST['type_gite']);


        //Connexion a PDO + requète SQL + requète préparée + execution
        try {
            //Connexion de puis la methode PDO de la classe mere
            $db = $this->getPDO();
            //La requète SQL

            $sql = "INSERT INTO location_gite
            (nom_gite, description_gite, image_gite, nbr_chambre, nbr_sdb, prix_gite, disponible, date_arrivee, date_depart, categorie_id, commentaire_id, region_id) 
            VALUES (?,?,?,?,?,?,?,?,?,?,?,?) ";
            //Lutte contre les injections SQL
            $req = $db->prepare($sql);
            //Lie les 12 champs du formulaire a la requète SQL
            $req->bindParam(1, $this->nom_gite);
            $req->bindParam(2, $this->description_gite);
            $req->bindParam(3, $this->image_gite);
            $req->bindParam(4, $this->nbr_chambre);
            $req->bindParam(5, $this->nbr_sdb);
            $req->bindParam(6, $this->prix_gite);
            $req->bindParam(7, $this->disponible);
            $req->bindParam(8, $this->date_arrivee);
            $req->bindParam(9, $this->date_depart);
            $req->bindParam(10, $this->type_gite);
            $req->bindParam(11, $this->commentaire_id);
            $req->bindParam(12, $this->nom_region);
            //On execute la requète et on retourne uhn tableau associatif
            $insert = $req->execute(
                array(
                    $this->nom_gite,
                    $this->description_gite,
                    $this->image_gite,
                    $this->nbr_chambre,
                    $this->nbr_sdb,
                    $this->prix_gite,
                    $this->disponible,
                    $this->date_arrivee,
                    $this->date_depart,
                    $this->type_gite,
                    $this->commentaire_id,
                    $this->nom_region,
                ));
                var_dump($insert);
            //Si l'execution fonctionne
            //On fais une redirection sur une page de succès Sinon on affiche une erreur
            if ($insert) {
                header("Location: confirmer-ajout-gite");
            } else {
                echo "<p class='alert-danger p-3'>Une erreur est survenue durant l'ajout du gite, merci de verifié tous les champs !</p>";
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du gites ! Merci de recommencer !" . $e->getMessage();
        }

    }

    public function deleteGite()
    {
        //recup de la connexion depuis la methode getPDO de la classe mere
        $db = $this->getPDO();
        //Recup de l'id du gite depuis URL (<a href=detail_gite?id_gite=CLE PRIMAIRE></a>)
        $id = $_GET['id_gite'];
        //la requète SQL
        $sql = "DELETE FROM location_gite WHERE id_gite = ?";
        //La requète préparée pour lutter contre les injections SQL
        $req = $db->prepare($sql);
        //On lie ID de URL = CLE PRIMAIRE a la requète SQL
        $req->bindParam(1, $id);
        //On execute la requète
        $req->execute();
        //Si ca marche = redirection vers une page de succès SINON on affiche une erreur
        if ($req) {
            header("Location: supprimer-gite");
        } else {
            echo "<p class='alert-warning p-2'>Une erreur est survenue duarant la supression de cet élément.</p>";
        }
    }

    //mettre a un jour un gite
    public function updateGite()
    {
        //recup de la connexion a la base de donnée via la methode getPDO de la classe mere
        $db = $this->getPDO();
        //On verifie tous les champs du formulaires existe et ne sont pas vide
        //On assigne les $_POST[] = attribut HTML name="" au propriétés privées (variables)
        if (isset($_POST['nom_gite']) && !empty($_POST['nom_gite'])) {
            $this->nom_gite = trim(htmlspecialchars($_POST['nom_gite']));
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ nom du gite</p>";
        }

        //LA DESCRIPTION
        if (isset($_POST['description_gite']) && !empty($_POST['description_gite'])) {
            $this->description_gite = trim(htmlspecialchars($_POST['description_gite']));
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ description du gite</p>";
        }

        //UPLOAD D' IMAGE
        if (isset($_FILES['image_gite'])) {
            $dossierDestination = "image/";
            $img_gite = $dossierDestination . basename($_FILES['image_gite']['name']);
            $_POST['img_gite'] = $img_gite;
            if (move_uploaded_file($_FILES['image_gite']['tmp_name'], $img_gite)) {
                echo '<p class="alert alert-success">Le fichier est valide et à été téléchargé avec succès !</p>';
            } else {
                echo '<p class="alert-danger">Une erreur s\'est produite, le fichier n\'est pas valide !</p>';
            }
        }

        //LE POSTE DE L'IMAGE
        if (isset($_POST['image_gite'])) {
            $this->image_gite = $_POST['image_gite'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ image du gite</p>";
        }

        //LE NOMBRE DE CHAMBRE
        if (isset($_POST['nbr_chambre'])) {
            $this->nbr_chambre = $_POST['nbr_chambre'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ nombre de chambre</p>";
        }
        //LE NOMBRE DE SALLE DE BAINS
        if (isset($_POST['nbr_sdb'])) {
            $this->nbr_sdb = $_POST['nbr_sdb'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ nombre de salle de bain</p>";
        }

        //LA REGION DE FRANCE
        if (isset($_POST['nom_region'])) {
            $this->nom_region = $_POST['nom_region'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ departement</p>";
        }
        //LE PRIX DU GITE / SEMAINE
        if (isset($_POST['prix_gite'])) {
            $this->prix = $_POST['prix_gite'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ prix du gite</p>";
        }

        //LE BOOLEESN GITE DISPO OU NON
        if (isset($_POST['disponible'])) {
            $this->disponible = $_POST['disponible'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ disponible</p>";
        }

        //LA DATE DE DISPO DU GITE
        if (isset($_POST['date_arrivee'])) {
            $this->date_arrivee = $_POST['date_arrivee'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ date d'arrivée</p>";
        }
        //LA DERNIERE DATE DE FIN DE LOCATION
        if (isset($_POST['date_depart'])) {
            $this->date_depart = $_POST['date_depart'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ date de depart</p>";
        }

        //Cle etrangère gite categorie

        if (isset($_POST['type_gite'])) {
            $this->type_gite = $_POST['type_gite'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ type de gite</p>";
        }

        //LES COMMENTAIRES'' = champs caché avec valeurs par defaut

        if (isset($_POST['commentaires'])) {
            $this->id_commentaire = $_POST['commentaires'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ commentaire de gite</p>";
        }

        //Verifié que la date d'arrivée n'est pas supérieur à la date départ = une erreur
        if (isset($this->date_depart) > isset($this->date_arrivee)) {
            echo "<p class='alert-danger p-2'>ATTENTION : la date d'arrivée est supérieur à la date de part !</p>";
        }

        $sql = "UPDATE location_gite SET 
                 nom_gite = ?, 
                 description_gite = ?, 
                 image_gite = ?, 
                 prix_gite = ?,
                 nbr_chambre = ?, 
                 nbr_sdb = ?, 
                 region_id = ?, 
                 disponible = ?, 
                 date_arrivee = ?, 
                 date_depart = ?, 
                 categorie_id = ?, 
                 commentaire_id = ? 
                WHERE id_gite = ?";

        //Recup de la cle primaire dans url via la super globale =_GET['']
        //<a href="details_gite?id_gite=CLE PRIMAIRE DU GITE">Plus d'infos</a>
        $id = $_GET['id_gite'];
        $req = $db->prepare($sql);
        $req->bindParam(1, $this->nom_gite);
        $req->bindParam(2, $this->description_gite);
        $req->bindParam(3, $this->image_gite);
        $req->bindParam(4, $this->nbr_chambre);
        $req->bindParam(5, $this->nbr_sdb);
        $req->bindParam(6, $this->nom_region);
        $req->bindParam(7, $this->prix);
        $req->bindParam(8, $this->disponible);
        $req->bindParam(9, $this->date_arrivee);
        $req->bindParam(10, $this->date_depart);
        $req->bindParam(11, $this->type_gite);
        $req->bindParam(12, $this->id_commentaire);

        $updateGite = $req->execute(array(
            $this->nom_gite,
            $this->description_gite,
            $this->image_gite,
            $this->nbr_chambre,
            $this->nbr_sdb,
            $this->nom_region,
            $this->prix,
            $this->disponible,
            $this->date_arrivee,
            $this->date_depart,
            $this->type_gite,
            $this->id_commentaire,
            $id,
        ));

        if ($updateGite) {
            header("Location: confirmer-maj-gite");
        } else {
            echo "<p class='alert-danger p-2'>Erreur lors de la mise a jour : Merci de verifié et remplir tous les champs !</p>";
        }
    }


///////////////////////////////////////QUAND ON EST CONNECTER UTILISATEUR OU SIMPLE VISITEUR////////////////////////
public function getGiteDisponible(){
    //Recupere de la date du jour grace a php date()
    /*
     * Retourne une date sous forme d'une chaîne, au format donné par le paramètre format,
     * fournie par le paramètre timestamp ou la date et l'heure courantes si aucun timestamp n'est fourni.
     * En d'autres termes, le paramètre timestamp est optionnel et vaut par défaut la valeur de la fonction time().
     */
    $today = date('Y-m-d');
    //La connexion a la bdd via la classe mere Database
    $db = $this->getPDO();

    //la requète de selection + jointure + prediquat WHERE filtre de gite par date et bool disponible = true
    $sql = "SELECT * FROM location_gite 
            INNER JOIN categorie ON location_gite.categorie_id= categorie.id_categorie
            INNER JOIN  regions ON location_gite.region_id = regions.id_region 
             WHERE date_depart < '".$today."' AND disponible = 1";
    //parcours de la table gites filtrées
    $disponible = $db->query($sql);
    return $disponible;
}

public function getGiteIndisponible(){
    //Recupere de la date du jour grace a php date()
    /*
     * Retourne une date sous forme d'une chaîne, au format donné par le paramètre format,
     * fournie par le paramètre timestamp ou la date et l'heure courantes si aucun timestamp n'est fourni.
     * En d'autres termes, le paramètre timestamp est optionnel et vaut par défaut la valeur de la fonction time().
     */
    $today = date('Y-m-d');
    //La connexion via la classe mere Database
    $db = $this->getPDO();

    //la requete de selection (inverse) + jointure + date jour < date de depart
    $sql = "SELECT * FROM location_gite 
                INNER JOIN categorie ON location_gite.categorie_id= categorie.id_categorie
                INNER JOIN  regions ON location_gite.region_id = regions.id_region 
                WHERE date_depart > '".$today."' AND disponible = 1";
    //parcours de la table gites PhpMyAdmin filtrées
    $indisponible = $db->query($sql);
    return $indisponible;
}
}




