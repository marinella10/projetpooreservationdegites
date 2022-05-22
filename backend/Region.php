<?php
require_once "backend/Database.php";


//pour afficher les regions (table)
class Region extends Database
{

    //Creation d'une fonction pour lire la table des regions
    public function getRegions(){
        //la connexion
        $db = $this->getPDO();


        //Afficher la table region
        $sql = "SELECT * FROM regions";
        $regions = $db->query($sql);
        return $regions;
    }

}
