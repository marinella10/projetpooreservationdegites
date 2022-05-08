<?php
require_once "backend/Gites.php";


//créer la nouvelle class Gite, stocker dans une variable
$nouvelGite = new Gites();

$gites = $nouvelGite->getGites();
//afficher avec un var_dump
//var_dump($gites);


?>
<!--faire la partie html pour afficher mes gites-->
<div class="container">

    <h2 class=" text-center text-info m-5 ">Les imbattables du moment</h2>

    <div class="row">


        <?php
        //faire le foreach pour affincher ma table
        foreach ($gites as $alias) {
            ?>

            <div class="col-md-4 col-sm-12 mt-5">

                <div class="card">

                    <div class="p-3 border bg-light">

                        <h5 class=" text-center m-3 text-info"><?= $alias['nom_gite'] ?></h5>
                        <img src="<?= $alias['image_gite'] ?>" class="card-img-top img-fluid" alt="<?= $alias['nom_gite'] ?>" title="<?= $alias['nom_gite'] ?>">

                    </div>
                    <div class="card-body m-2">
                      <!--<p class="card-text"><?= $alias['description_gite'] ?></p>-->
                        <p class="card-text text-info fw-bold">PRIX : <?= $alias['prix_gite'] ?> €/ par pers</p>
                        <p class="card-text text-warning">Disponibilité :

                            <?php
                            //si le Gite existe
                            if($alias['disponible'] == true){
                                echo "L'hébergement est disponible";

                            }else{
                                echo "L 'hébergement n'est pas disponible";
                            }
                            ?>
                        </p>

                        <div class="container  text-center  m-2">
                            <a  href="detailGite.php?iGite=<?= $alias['id_gite'] ?>" class="btn btn-info  ">Plus d'info</a>

                        </div>

                    </div>


                </div>

            </div>
            <?php
        }
        ?>
    </div>
</div>

