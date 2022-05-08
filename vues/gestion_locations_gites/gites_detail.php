<?php
require_once  "backend/Gites.php";

$giteClasse = new Gites();

$details = $giteClasse->getGiteById();

echo $details['nom_gite'];