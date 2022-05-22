<?php

//Appel du fichier model
require_once "backend/Gites.php";
//Instance de la classe gite
$gites = new Gites();

?>
<h1 class="alert-success p-5 text-center text-dark mt-3">Votre réservation est validée !</h1>
<h2 class="text-center text-danger"><b>Récapitulatif de votre réservation :</b></h2>
<form method="post">
    <div class="text-center">
        <a href="accueil" class="btn btn-info">ACCUEIL</a>
    </div>
</form>

<?php
$id_gite = $_GET['id'];
$gites->getGiteById($id_gite);

?>

