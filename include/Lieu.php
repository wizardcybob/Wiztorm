<?php 

class Lieu extends Base {
    // liste des attributs
    public $id_lieu;
    public $nom_lieu;
    public $continent_lieu;
    public $capitale_lieu;
    public $superficie_lieu;
    public $population_lieu;
    public $liste_articles_for_lieu;
    public $photo_lieu;


    static function controleur($action, $id) {
        switch ($action) {
            case 'read' :
                if ($id > 0) {
                $modele = 'ft_lieu.twig';
                $data = ['un_lieu' => Lieu::readOne_Lieu($id), 'plusieurs_lieu' => Lieu::readAll_Lieu()];
                }
                else {
                $modele = 'lieux.twig';
                $data = ['plusieurs_lieu' => Lieu::readAll_Lieu()];
                }
            break;
        }
        return ['modele' => $modele, 'data' => $data];
    }

    static function readAll_Lieu() {
        return parent::readAll('Lieux', 'nom_lieu', 'Lieu'); //au lieu de mettre Base on peut mettre "parent" qui appelle la fonction parent
    }
    
    static function readOne_Lieu($id) {
        $objet = parent::readOne('Lieux','id_lieu','Lieu', $id);
        $objet->liste_articles_for_lieu = $objet->select_article_for_lieu();
        return $objet;
    }

    // static function readOne($id) {
    //     // définition de la requête SQL avec un paramètre :valeur
    //     $sql= 'SELECT * FROM Lieux WHERE id_lieu = :valeur';
     
    //     // connexion à la base de données
    //     $pdo = connexion();
     
    //     // préparation de la requête
    //     $query = $pdo->prepare($sql);
     
    //     // on lie le paramètre :valeur à la variable $id reçue
    //     $query->bindValue(':valeur', $id, PDO::PARAM_INT);
     
    //     // exécution de la requête
    //     $query->execute();
     
    //     // récupération de l'unique ligne
    //     $objet = $query->fetchObject('Lieu');
    //     $objet->liste_articles_for_lieu = $objet->select_article_for_lieu();
     
    //     // retourne l'objet contenant résultat
    //     return $objet;
    // }

    function select_article_for_lieu() {
        // définition de la requête SQL avec un paramètre :valeur
        $sql= 'SELECT Articles.* FROM Situer INNER JOIN Articles ON Situer.id_article=Articles.id_article WHERE Situer.id_lieu = :valeur';
        
        // connexion à la base de données
        $pdo = connexion();
     
        // préparation de la requête
        $query = $pdo->prepare($sql);
     
        // on lie le paramètre :valeur à la variable $id reçue
        $query->bindValue(':valeur', $this->id_lieu, PDO::PARAM_INT);
     
        // exécution de la requête
        $query->execute();
     
        // récupération de l'unique ligne
        $objet = $query->fetchAll(PDO::FETCH_CLASS, 'Article'); //ici Article = nom de la class Article qu'on a créé
     
        // retourne l'objet contenant résultat
        return $objet;
    }
}