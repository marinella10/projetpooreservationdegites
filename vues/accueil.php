<?php
//Appel du fichier de la classe Gites.php
require_once "backend/Gites.php";

//Instance de la classe Gites = copie de la classe stockée dans une variable
$gitesClasse = new Gites();
//On stock dans une seconde variable l'appel a la methode getGiteDisponible() = le resultat de la requète SQL
//cette methode affiche les gites dont la date de depart < a la date du jour
$gites = $gitesClasse->getGiteDisponible();
//On stock dans une seconde variable l'appel a la methode getGiteDisponible() = le resultat de la requète SQL
//cette methode affiche les gites dont la date de depart > a la date du jour
$gitesIndisponible = $gitesClasse->getGiteIndisponible()
//Debug
//var_dump($gites);

?>
<div class="text-center pt-5">
    <h3 data-heading="Slide" class="text-danger">Liste de nos gites</h3>
</div>


<div class="row">
    <?php
    //On parcours les resultats à l'aide d'une boucle foreach et un alias pour les gites disponible
    foreach ($gites as $row) {
        ?>


        <div class="mt-3 p-3 col-md-4 col-sm-12">
            <img src="<?= $row['image_gite'] ?>" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
                <h5 class="card-title text-info"><?= $row['nom_gite'] ?></h5>
                <h6 class="text-success">Regions : <?= $row['nom_region'] ?></h6>
                <div class="card">Nombre de chambre : <?= $row['nbr_chambre'] ?>
                    <div class=" container text-center m-2">
                        <a href="gites_detail?id_gite=<?= $row['id_gite'] ?>" class="btn btn-primary">Détails</a>
                    </div>

                </div>
            </div>
        </div>

        <?php

    }
    ?>
</div>
<?php
//On parcours les resultats à l'aide d'une boucle foreach et un alias pour les gites indisponible
foreach ($gitesIndisponible as $row) {
    //Pour les gites insponible on ajoute un fond rouge + titre + la date de depart bien visible
    ?>
    <div class="mt-3 p-3 col-md-3 col-sm-12 bg-danger">
        <div class="card">
            <div class="text-center p-3">
                <h4 class="text-warning">INDISPONIBLE</h4>
            </div>

            <img src="<?= $row['image_gite'] ?>" class="card-img-top img-fluid" alt="...">
            <div class="card-body">
                <h5 class="card-title text-info"><?= $row['nom_gite'] ?></h5>
                <h6 class="text-success">Regions : <?= $row['nom_region'] ?></h6>
                <p class="text-info">Nombre de chambre : <?= $row['nbr_chambre'] ?>
                    <?php

                    $date_d = new DateTime($row['date_depart']);
                    ?>
                </p>
                <h5 class="text-danger">Ce gite sera disponible à partir du : </h5>
                <h4 class="alert-info p-2 text-center text-white font-weight-bold"> <?= $date_d->format('d-m-Y') ?></h4>
                <div class="text-center">
                    <a href="gites_detail?id_gite=<?= $row['id_gite'] ?>" class="btn btn-danger">Plus d'infos</a>


                </div>

            </div>
        </div>
    </div>
    <?php
}
?>




