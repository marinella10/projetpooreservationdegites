<?php

// Appel du fichier Gites classe
require_once "backend/Gites.php";
require_once "backend/Categorie.php";
require_once "backend/Region.php";
require_once "backend/Commentaires.php";


//Instance = copie de la classe stockee dans une variable
$giteClasse = new Gites();
$categorieClasse = new Categorie();
$regionClasse = new Region();
$commentaireClasse = new Commentaires();


//Appel de la methode getGiteById() pour appeler un gite
$details = $giteClasse->getGiteById();

//Stock et recup toutes les catégories dans une variables
$categories = $categorieClasse->getCategories();
$regions = $regionClasse->getRegions();
$commentaires = $commentaireClasse->getComments();

var_dump($_FILES);
var_dump($_POST);
?>


<div class="container-fluid bg-warning mt-3 rounded p-3">

    <h1 class="text-center text-danger"><b>DÉTAILS DU GITE</b></h1>
    <div id="gite-by-id">

        <?php
        echo $details['nom_gite'];
        echo $details['description_gite'];
        echo $details['image_gite'];
        ?>
    </div>
</div>

<!--On check la session si session connecter en tant qu'administrateur = retourne la page d'accueil-->
<?php
if (isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true) {
?>
<div class="text-center">
    <a href="administration" class="btn btn-danger mt-3">RETOUR</a>
    <form method="post" class="mt-3">
        <button name="bnt-delete-gite" class="btn btn-success">Supprimer le gite</button>
    </form>
</div>


<?php
if (isset($_POST['bnt-delete-gite'])) {
    var_dump("test de clic");
    $giteClasse->deleteGite();
}

} else {
    ?>
    <div class="text-center">
        <a href="accueil" class="btn btn-danger mt-2">RETOUR</a>
    </div>
    <?php

}

//Si on est connecté en tant qu'utilisateur = on affiche les boutons ajouter commentaire + reserver
if (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true) {
    ?>
    <a href="ajouter_commentaire?id=<?= $details['id_gite'] ?>" class="btn btn-outline-danger mt-2">Ajouter
        un commentaire</a>
    <a href="reservation?id_gite=<?= $details['id_gite'] ?>"
       class="btn btn-outline-info mt-2">RESERVER</a>
    <?php
} else {
    ?>
    <p></p>
    <?php
}
?>

<div class="col-6">
    <div class="text-center">
        <p class="card-text"><b>Description : </b></p>
        <p><?= $details['description_gite'] ?></p>
        <p><b>Nombre de chambre : </b><b class="text-danger"><?= $details['nbr_chambre'] ?></b></p>
        <p><b>Nombre de salle de bains : </b><b class="text-danger"><?= $details['nbr_sdb'] ?></b></p>
        <p><b>nom_region : </b><b class="text-info"><?= $details['nom_region'] ?></b></p>
        <p><b>Prix à la semaine : </b><b class="text-success"><?= $details['prix_gite'] ?> €</b></p>
    </div>

    <?php
    $dispo = $details['disponible'];
    if ($dispo == false) {
        echo $dispo = "NON";
    } else {
       // echo $dispo = "OUI";
    }
    ?>


    <p><b>Disponible : </b><b class="text-warning"><?= $dispo ?></b></p>
    <?php
    $date_a = new DateTime($details['date_arrivee']);
    $date_d = new DateTime($details['date_depart']);
    ?>
    <p><b>Date debut de la dernière location : </b></p>
    <p class="alert-success p-2"><?= $date_a->format('d-m-Y') ?></p>

    <p><b>Date du dernier depart : </b></p>
    <p class="alert-info p-2"> <?= $date_d->format('d-m-Y') ?></p>
</div>


<div class="container">
    <?php

    if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
        ?>
        <!--La methode post recup les trriburs name de chaque elements du formulaire a l'aide de la super globale $_POST['name=nom_gite']-->
    <form method="post" enctype="multipart/form-data">
        <div class="mt-3">
            <label for="nom_gite">Nom du gite</label>
            <input type="text" id="nom_gite" name="nom_gite" class="form-control"
                   placeholder="<?= $details['nom_gite'] ?>" value="<?= $details['nom_gite'] ?>" required>
        </div>

        <div class="mt-3">
            <label for="description_gite">Description du gite</label>
            <textarea type="text" id="description_gite" name="description_gite" class="form-control"
                      value="<?= $details['description_gite'] ?>">
                    <?= $details['description_gite'] ?>
            </textarea>
        </div>

        <div class="form-group">
            <label for="img_gite">Image du gite : </label>
            <br/>
            <input class="btn btn-outline-success" type="file" id="image_gite" name="image_gite"
                   accept="image/png, image/jpeg, image/webp image/bmp, image/svg">
        </div>

        <div class="mt-3">
            <label for="nbr_chambre">Choix du nombre de chambre
                <select name="nbr_chambre" class="form-control">
                    <option selected>Nombre de chambre</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                </select>
            </label>
        </div>

        <div class="mt-3">
            <label for="nbr_sdb">Choix du nombre de salle de bains
                <select name="nbr_sdb" class="form-control">
                    <option selected>Nombre de salle de bains</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </label>
        </div>

        <div class="mt-3">
            <label for="regions">Choix de la region
                <select name="nom_region" class="form-control">
                    <?php
                    foreach ($regions as $region) {
                        ?>
                        <option value="<?= $region['id_region'] ?>"><?= $region['nom_region'] ?></option>
                        <?php
                    }
                    ?>
                </select>
            </label>
        </div>

        <div class="mt-3">
            <label for="categories">Choix de la catégorie
                <select name="type_gite" class="form-control">
                    <?php
                    foreach ($categories as $category) {
                        ?>
                        <option value="<?= $category['id_categorie'] ?>">
                            <?= $category['type_categorie'] ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </label>
        </div>

        <div class="form-group">
            <label for="prix">Prix / semaine : </label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix_gite"
                   placeholder="<?= $details['prix_gite'] ?>" value="<?= $details['prix_gite'] ?>">
        </div>

        <div class="mt-3">
            <label for="disponible">Est disponible
                <select name="disponible" class="form-control">
                    <option value="0">NON</option>
                    <option value="1">OUI</option>
                </select>
            </label>
        </div>

        <div class="form-group">
            <label for="date_arrivee">Date de depot de l'offre : </label>
            <input type="date" id="date_arrivee" name="date_arrivee" placeholder="<?= $details['date_arrivee'] ?>"
                   value="<?= $details['date_arrivee'] ?>" class="form-control">
        </div>

        <div class="form-group">
            <label for="date_depart">Date de depart</label>
            <input type="date" class="form-control" name="date_depart" id="date_depart"
                   placeholder="<?= $details['date_depart'] ?>" value="<?= $details['date_depart'] ?>" required>
        </div>
        <!--Ce champs est caché Admin na pas renseigner de commentaire ou le mettre a jour sur le gite sa valeur par defaut est 1-->
        <input type="hidden" name="commentaires" value="1">

        <button type="submit" name="btn-ajouter-gite" class="btn btn-outline-success">Mettre le gite</button>
    </form>
    </form>
    <?php
    }
    ?>


    <?php
    if (isset($_POST['btn-ajouter-gite'])) {
        //Appel de la methode updateGite de la classe Gites.php
        $giteClasse->updateGite();
    }
    ?>

    <?php
    foreach ($commentaires as $comment) {
        ?>
        <p class="text-danger">Auteur : <?= $comment ["auteur_commentaire"];?></p>
        <p class="text-success"><?= $comment ["contenus_commentaire"];?></p>

    <?php
    }
    ?>

</div>

