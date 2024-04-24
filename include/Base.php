<?php

//mettre $this qnd il y a un objet
//mettre static si on utilise pas $this
//ATTENTION : pas le droit de faire un bindvalue d'un nom de table pcq considéré comme string


class Base {

    static function readAll($table_bdd, $tri_par, $nom_class) {
        // connexion
        $pdo = connexion();

        // définition de la requête SQL
        $sql = "SELECT * from $table_bdd ORDER BY $tri_par";

        // préparation de la requête
        $query = $pdo->prepare($sql);

        // exécution de la requête
        $query->execute();

        // récupération de toutes les lignes sous forme d'objets
        $tab = $query->fetchAll(PDO::FETCH_CLASS, $nom_class); //$nom_class = le nom de la class
        // retourne le tableau d'objets
        return $tab;
    
    }

    static function readOne($table_bdd ,$id_table, $nom_class, $id) {
        $sql= "SELECT * from $table_bdd WHERE $id_table = :valeur";

        $pdo = connexion();

        $query = $pdo->prepare($sql);

        $query->bindValue(':valeur', $id, PDO::PARAM_INT);

        $query->execute();

        $objet = $query->fetchObject($nom_class);

        return $objet;
    }
}