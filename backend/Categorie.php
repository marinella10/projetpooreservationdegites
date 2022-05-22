<?php
require_once "backend/Database.php";

//pour afficher les regions (table)
class Categorie extends Database
{
//Creation d'une fonction pour lire la table des catégories
    public function getCategories(){
        $db = $this->getPDO();

        //Afficher la table categorie
        $sql = "SELECT * FROM categorie";

        $categories = $db->query($sql);
        return $categories;
    }

}