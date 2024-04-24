<?php

include('include/Base.php');

//class Categorie {
class Categorie extends Base {
    // liste des attributs
    public $id_categorie;
    public $nom_categorie;
    public $description_categorie;
    public $photo_categorie;
    public $liste_articles_for_cat;


    static function controleur($action, $id) {
        switch ($action) {
            case 'read' :
                if ($id > 0) {
                $modele = 'ft_categorie.twig';
                $data = ['un_cat' => Categorie::readOne_Categorie($id), 'plusieurs_cat' => Categorie::readAll_Categorie()];
                }
                else {
                $modele = 'categories.twig';
                $data = ['plusieurs_cat' => Categorie::readAll_Categorie()]; // va réussir à trouver par rapport à la bdd pcq transforme la variable en texte 
            }
            break;
        }
        return ['modele' => $modele, 'data' => $data];
    }

    static function readAll_Categorie() {
        return Base::readAll('Categories', 'nom_categorie', 'Categorie');
    }
    
    static function readOne_Categorie($id) {
        $objet = Base::readOne('Categories','id_categorie','Categorie', $id);
        $objet->liste_articles_for_cat = $objet->select_articles_for_cat();
        return $objet;
    }

    function select_articles_for_cat() {
        // définition de la requête SQL avec un paramètre :valeur
        $sql= 'SELECT Articles.* FROM Appartenir INNER JOIN Articles ON Appartenir.id_article=Articles.id_article WHERE Appartenir.id_categorie = :valeur';
        
        // connexion à la base de données
        $pdo = connexion();
     
        // préparation de la requête
        $query = $pdo->prepare($sql);
     
        // on lie le paramètre :valeur à la variable $id reçue
        $query->bindValue(':valeur', $this->id_categorie, PDO::PARAM_INT);
     
        // exécution de la requête
        $query->execute();
     
        // récupération de l'unique ligne
        $objet = $query->fetchAll(PDO::FETCH_CLASS, 'Article'); //ici Article = nom de la class Article qu'on a créé
     
        // retourne l'objet contenant résultat
        return $objet;
    }
}