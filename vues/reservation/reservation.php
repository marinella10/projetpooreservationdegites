<?php

// appelle du fichier reserver
require_once "backend/Reservation.php";

//Instance = copie de la classe stockee dans une variable
$reservationClasse = new Reservation();


?>
    <div class="container">
        <form method="post" id="reservation-form">
            <div class="mb-3">
                <label for="email_user">Votre email :</label>
                <input name="email_user" type="email" class="form-control" value="<?= $_SESSION['email_utilisateur'] ?>" required />
            </div>

            <div class="mb-3">
                <label for="date_arrivee">Votre date d'arrivée :</label>
                <input name="date_arrivee" type="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="mb-3">
                <label for="date_depart">Votre date de départ</label>
                <input name="date_depart" type="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="mb-3">
                <button type="submit" class="btn btn-success" name="validerReservation">Valider la reservation</button>
            </div>

        </form>
    </div>

<?php
// si le bouton existe
if(isset($_POST['validerReservation'])){
    //var_dump("test click");
    //echo "test clic";
    $reservationClasse->reserverGite();
}