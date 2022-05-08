<?php
require_once "backend/Gites.php";

$giteClasse = new Gites();
$gites = $giteClasse->getGites();
?>
<div class="row">
    <?php
    foreach ($gites as $gite){
        ?>
        <div class="col-md-3 col-sm-12">
            <p><?= $gite['nom_gite'] ?></p>
            <p><?= $gite['description_gite'] ?></p>
            <p><?= $gite['image_gite'] ?></p>
            <p><?= $gite['prix_gite'] ?></p>
            <p><?= $gite['nbr_chambre'] ?></p>
            <p><?= $gite['nbr_sdb'] ?></p>
            <p><?= $gite['disponible'] ?></p>
            <p><?= $gite['date_arrivee'] ?></p>
            <p><?= $gite['date_depart'] ?></p>
            <?php
            $dispo = $gite['disponible'];
            if($dispo == false) {
                $dispo = "NOM";
            }else{
                $dispo = "OUI";
            }
            ?>
            <p><b>Disponible</b><b class="text-warning"><?= $dispo ?></b></p>

            <?php
            $date_d = new DateTime($gite['date_depart']);
            ?>

            <p><b>Date du dernier depart : </b></p>
            <p class="alet-info p-2 text-center text-white font-weight-bold"> <?= $date_d->format('d-m-y')?></p>
            <a href="gites_detail?id_gite=<?= $gite['id_gite'] ?>" class="btn btn-outline-info">Plus d'infos</a>
        </div>



       <?php

    }
    ?>

</div>





