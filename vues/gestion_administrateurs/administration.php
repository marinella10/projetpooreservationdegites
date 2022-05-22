<?php
require_once "backend/Gites.php";

$giteClasse = new Gites();
$gites = $giteClasse->getGites();
?>

<div class="container-fluid mt-3 rounded p-3">
    <div class="text-center">
        <h2 class="text-info p-3">ESPACE ADMINISTRATION : Liste de nos gites</h2>
        <div class="text-center">
            <a href="gites_ajouter" class="btn btn-danger">AJOUTER UN GITE</a>
        </div>

<div class="row">
    <?php
    foreach ($gites as $gite){
        ?>
        <div class="col-md-3 col-sm-12">
            <h5 class="class="card-title text-infos"><?= $gite['nom_gite'] ?></h5>
            <p> <?=$gite['description_gite'] ?></p>
            <img src=<?= $gite['image_gite'] ?>>
            <p><?= $gite['prix_gite'] ?></p>
            <p><?= $gite['nbr_chambre'] ?></p>
            <p><?= $gite['nbr_sdb'] ?></p>
            <p><?= $gite['disponible'] ?></p>
            <p><?= $gite['date_arrivee'] ?></p>
            <p><?= $gite['date_depart'] ?></p>
            <?php
            $dispo = $gite['disponible'];
            if($dispo == false) {
                $dispo = "NON";
            }else{
                $dispo = "OUI";
            }
            ?>
            <p><b>Disponible</b><b class="text-warning"><?= $dispo ?></b></p>

            <?php
            $date_d = new DateTime($gite['date_depart']);
            ?>

            <p><b>Date du dernier depart : </b></p>
            <p class="alert-info p-2 text-center text-white font-weight-bold"> <?= $date_d->format('d-m-y')?></p>
            <a href="gites_detail?id_gite=<?= $gite['id_gite'] ?>" class="btn btn-outline-info">Plus d'infos</a>
            <a href="supprimer-gite?id_gite=<?= $gite['id_gite'] ?>" class="btn btn-outline-danger">Supprimer</a>

        </div>



       <?php

    }
    ?>

</div>





