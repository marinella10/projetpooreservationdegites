<?php
require_once "modeles/Database.php";


//pour afficher les regions
class Regions extends Database
{
    public function getRegions(){
        //la connexion
        $db = $this->getPDO();
        $sql = "SELECT * FROM regions";
        $regions = $db->query($sql);
        return $regions;
    }

}
