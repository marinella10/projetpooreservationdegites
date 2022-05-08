<?php
require_once "backend/Categorie.php";
require_once "backend/Region.php";

$categorieClasse = new Categories();
$regionsClasse = new Regions();

$categories = $categorieClasse->getCategories();
$regions = $regionsClasse->getRegions();

?>
<div class="container">
    <!--La methode post recup les trriburs name de chaque elements du formulaire a l'aide de la super globale $_POST['name=nom_gite']-->
    <form method="post" enctype="multipart/form-data">
        <div class="mt-3">
            <label for="nom_gite">Nom du gite</label>
            <input type="text" id="nom_gite" name="nom_gite" class="form-control" placeholder="Gite du Lac" required>
        </div>

        <div class="mt-3">
            <label for="description_gite">Description du gite</label>
            <textarea type="text" id="description_gite" name="description_gite" class="form-control" placeholder="Gite au bord du lac etc..." required>

            </textarea>
        </div>

        <div class="form-group">
            <label for="image_gite">Image du gite : </label>
            <br />
            <input class="btn btn-outline-success" type="file" id="image_gite" name="image_gite" accept="image/png, image/jpeg, image/webp image/bmp, image/svg">
        </div>

        <div class="mt-3">
            <label for="nbr_chambre">Choix de la  catégorie
                <select name="nbr_chambre" class="form-control">
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
            <label for="nbr_sdb">Choix de la  catégorie
                <select name="nbr_sdb" class="form-control">
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </label>
        </div>

        <div class="mt-3">
            <label for="regions">Choix de la  catégorie
                <select name="zone_geo" class="form-control">
                    <?php
                    //for each(table) as (alias)
                    foreach ($categories
                             as $category){
                        ?>
                        <option value="<?= $category['id_categorie'] ?>">
                            <?= $category['type_gite'] ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </label>
        </div>

        <div class="mt-3">
            <label for="categories">Choix de la  catégorie
                <select name="categories" class="form-control">
                    <?php
                    foreach ($regions  as $region){
                        ?>
                        <option value="<?= $region['id_region'] ?>">
                            <?= $region['nom_region'] ?>
                        </option>
                        <?php
                    }
                    ?>
                </select>
            </label>
        </div>

        <div class="form-group">
            <label for="prix">Prix / semaine : </label>
            <input type="number" step="0.01" class="form-control" id="prix" name="prix_gite" placeholder="250.50">
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
            <input type="date" id="date_arrivee" name="date_arrivee" placeholder="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" class="form-control">
        </div>

        <div class="form-group">
            <label for="date_depart">Date de depart</label>
            <input type="date" class="form-control" name="date_depart" id="date_depart" placeholder="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d') ?>" required>
        </div>

        <input type="hidden" name="commentaires" value="0">

        <button type="submit" name="btn-ajouter-gite" class="btn btn-outline-success">Ajouter le gite</button>
    </form>

    <?php
    if(isset($_POST['btn-ajouter-gite'])){
        echo "ca marche";
    }
    ?>



</div>