<?php
session_start();
/*
 * ob_start() démarre la temporisation de sortie.
 *  Tant qu'elle est enclenchée, aucune donnée, hormis les en-têtes, n'est envoyée au navigateur, mais temporairement mise en tampon.
 */
ob_start();
//Les options passées dans URL
////Si dans url, un paramètre $_GET['url'] existe
/// Soit index.php?url="quelquechose"
if(isset($_GET['url'])){
    $url = $_GET['url'];
}else{
    $url = "accueil";
}
//Si $url retourne une chaine de caractères vide
if($url === ""){
    //On redirige vers la page d'accueil
    $url = "accueil";
}


//Liste des routes:
//accueil = vues/accueil.php


//Si la route $url : index.php?url=accueil
if($url === "accueil"){
    $title  = "Location de gîtes -ACCUEIL-";
    //On appel le fichier accueil.php
    require_once "vues/accueil.php";

}
//Si la route $url : index.php?url=connexion
elseif ($url === "connexion"){
    $title = "Location de gîtes-Connexion-";
    require_once "vues/connexion.php";
    //ici on check que la session de connexion existe et retoune true
}
//Si la route $url : index.php?url=deconnexion
elseif ($url === "deconnexion"){
    //On appel le fichier deconnexion.php
    require_once "vues/deconnexion.php";
}
////Si la route $url : index.php?url=administration et on est connecter en tant qu'admin
elseif($url === "administration" && isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
    $title = "Location de gîtes-Adminsitration-";
    require_once "vues/gestion_administrateurs/administration.php";
}

elseif ($url ==="inscription"){
    $title="location de gites-inscription";
    require_once "vues/inscription.php";


//Dans la page administration.php <a href="details_gite?id_gite=<?= $gite['id_gite'] ? >" class="btn btn-info">Details du gite</a>
}
elseif($url === "gites_detail" && isset($_GET['id_gite']) && $_GET['id_gite'] > 0){
    $title = "Mic location -gestion_locations_gites-";
    require_once "vues/gestion_locations_gites/gites_detail.php";

}elseif($url === "gites_ajouter" && isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
    $title = "Mic location -gestion_locations_gites";
    require_once "vues/gestion_locations_gites/gites_ajouter.php";


//IDEM pour la page de confirmation d'ajout
}
elseif ($url === "confirmer-ajout-gite" && isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
$title = "Mic location -Confirmer Ajouter un Gite-";
require_once "vues/gestion_locations_gites/confirmer-ajout-gite.php";


//IDEM pour la page de confirmation de supression
}
elseif($url === "supprimer-gite" && isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
$title = "Mic location -Supprimer Ajouter un Gite-";
require_once "vues/gestion_locations_gites/supprimer_gite.php";
}elseif($url === "confirmer-maj-gite" && isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
$title = "Mic location -Mise a jour d' un Gite-";
require_once "vues/gestion_locations_gites/confirmer-maj-gite.php";


}elseif ($url === "reservation" && isset($_GET['id_gite']) && $_GET['id_gite'] > 0 ){
    require_once "vues/reservation/reservation.php";
}
//Si la route $url n'est pas formée de [#: A-Z a-z O-9] soit index.php?url=NON VALIDE
//On effectue une redirection

elseif($url !=  '#:[\w]+)#'){
    //On redirige vers la page d'accueil
    header("Location: accueil");
}

/*
 * ob_get_clean — Lit le contenu courant du tampon (du cache)de sortie puis l'efface
 */
//ici $content se situe dans le dossier template.php
$content = ob_get_clean();
require_once "template.php";