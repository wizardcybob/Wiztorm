<?php

include('include/Categorie.php');

//mettre $this qnd il y a un objet
//mettre static si on utilise pas $this

class Article extends Base {
    // liste des attributs
    public $id_article; //faut que ça ait le même nom que PhpMyAdmin pour que ce soit remplacer dans le tableau
    public $titre_article;
    public $texte_article;
    public $image_article;
    public $dateevenement_article;
    public $type_pheno_article;
    public $liste_categories; //voir ~ligne 53
    public $liste_lieux;
    public $id_categorie;
    public $id_lieu;
    public $pas_liste_categories;
    public $pas_liste_lieux;
    public $image2_article;
    public $image3_article;
    public $image4_article;
    public $special;


    static function readAll_Article() {
        return Base::readAll('Articles', 'titre_article', 'Article');
    }
    
    static function readOne_Article($id) { //on rajoute des paramètre dédié à article à la fonction de base
        $objet = Base::readOne('Articles','id_article','Article', $id);
        $objet->liste_categories = $objet->select_categorie(); //correspond à la function qu'on a créé
        $objet->pas_liste_categories = $objet->pas_select_categorie();
        $objet->liste_lieux = $objet->select_lieu(); 
        $objet->pas_liste_lieux = $objet->pas_select_lieu();
        return $objet;
    }

    // static function readOne($id) {
    //     $sql= 'SELECT * FROM Articles WHERE id_article = :valeur';
    //     $pdo = connexion();    
    //     $query = $pdo->prepare($sql);  
    //     $query->bindValue(':valeur', $id, PDO::PARAM_INT); 
    //     $query->execute();
    //     $objet = $query->fetchObject('Article'); //ici Article = nom de la class
    //     $objet->liste_categories = $objet->select_categorie(); //correspond à la function qu'on a créé
    //     $objet->pas_liste_categories = $objet->pas_select_categorie();
    //     $objet->liste_lieux = $objet->select_lieu(); 
    //     return $objet;
    // }

    static function delete($id) {
        // construction de la requête :nom, :prenom sont les valeurs à insérées
        $sql = 'DELETE FROM Articles WHERE id_article = :id';
     
        // connexion à la base de données
        $pdo = connexion();
     
        // préparation de la requête
        $query = $pdo->prepare($sql);
     
        // on lie le paramètre :id à la variable $id reçue
        $query->bindValue(':id', $id, PDO::PARAM_INT);
     
        // exécution de la requête
        $query->execute();
    }

    function chargePOST() { //pour réceptionner les données du formulaire
        // ID
        if (isset($_POST['id'])) {
        $this->id_article = $_POST['id'];
        }
        // TITRE
        if (isset($_POST['titre'])) {
        $this->titre_article = $_POST['titre']; //rentre dans le nouvel objet le titre de l'article qu'on a envoyé par le formulaire(pas encore dans PMA)
        } 
        else {
        $this->titre_article = 'aucun titre identifié'; //si pas de nom donné "sans nom" s'affiche but on a mit des required
        }
        // TEXTE
        if (isset($_POST['texte'])) {
        $this->texte_article = $_POST['texte'];
        }
        else {
        $this->texte_article = 'aucun texte identifié';
        }
        // PHOTO
        if (isset($_FILES['photo']['name'])) {
        $this->image_article = 'images/'.$_FILES['photo']['name'];
        }
        move_uploaded_file($_FILES['photo']['tmp_name'], 'images/'.$_FILES['photo']['name']);    
        // DATE
        if (isset($_POST['date']) && !empty($_POST['date'])) {
        $this->dateevenement_article = $_POST['date'];
        }
        // CATEGORIE
        if (isset($_POST['categorie'])) {
        $this->id_categorie = $_POST['categorie'];
        }
        // LIEU
        if (isset($_POST['lieu'])) {
        $this->id_lieu = $_POST['lieu'];
        }
    }
    
    function create() {
        $pdo = connexion();

        $sql = "INSERT INTO Articles(titre_article, texte_article, image_article, dateevenement_article) VALUES (:titre_article, :texte_article, :image_article, :dateevenement_article)";

        $query = $pdo->prepare($sql);

        $query->bindValue(':titre_article', $this->titre_article, PDO::PARAM_STR);
        $query->bindValue(':texte_article', $this->texte_article, PDO::PARAM_STR);
        $query->bindValue(':image_article', $this->image_article, PDO::PARAM_STR);
        $query->bindValue(':dateevenement_article', $this->dateevenement_article, PDO::PARAM_STR);
        
        $query->execute();
        $this->id_article = $pdo->lastInsertId();
    }

    function update() {
        $sql = 'UPDATE Articles SET titre_article = :titre_article, texte_article = :texte_article, image_article = :image_article, dateevenement_article = :dateevenement_article WHERE id_article = :id';
    
        // connexion à la base de données
        $pdo = connexion();
    
        // préparation de la requête
        $query = $pdo->prepare($sql);

        // on donne une valeur aux paramètres à partir des attributs de l'objet courant
        $query->bindValue(':id', $this->id_article, PDO::PARAM_STR);
        $query->bindValue(':titre_article', $this->titre_article, PDO::PARAM_STR);
        $query->bindValue(':texte_article', $this->texte_article, PDO::PARAM_STR);
        $query->bindValue(':image_article', $this->image_article, PDO::PARAM_STR);
        $query->bindValue(':dateevenement_article', $this->dateevenement_article, PDO::PARAM_STR);
    
        // exécution de la requête
        $query->execute();
    }

    function associer_cat() { //dans le formulaire
        $pdo = connexion();

        $sql = "INSERT INTO Appartenir(id_article, id_categorie) VALUES (:id_art, :id_cat)";

        $query = $pdo->prepare($sql);

        $query->bindValue(':id_art', $this->id_article, PDO::PARAM_INT);
        $query->bindValue(':id_cat', $this->id_categorie, PDO::PARAM_INT);
        
        $query->execute();
    }

    function associer_lieu() { //dans le formulaire
        $pdo = connexion();

        $sql = "INSERT INTO Situer(id_article, id_lieu) VALUES (:id_art, :id_lieu)";

        $query = $pdo->prepare($sql);

        $query->bindValue(':id_art', $this->id_article, PDO::PARAM_INT);
        $query->bindValue(':id_lieu', $this->id_lieu, PDO::PARAM_INT);
        
        $query->execute();
    }

    function select_categorie() { //afficher les catégories associé à l'article
        // définition de la requête SQL avec un paramètre :valeur
        $sql= 'SELECT DISTINCT Categories.* FROM Appartenir INNER JOIN Categories ON Appartenir.id_categorie=Categories.id_categorie WHERE id_article = :valeur';
       
        // connexion à la base de données
        $pdo = connexion();
     
        // préparation de la requête
        $query = $pdo->prepare($sql);
     
        // on lie le paramètre :valeur à la variable $id reçue
        $query->bindValue(':valeur', $this->id_article, PDO::PARAM_INT);
     
        // exécution de la requête
        $query->execute();
     
        // récupération de l'unique ligne
        $objet = $query->fetchAll(PDO::FETCH_CLASS, 'Categorie'); //ici Categorie = nom de la class Categorie qu'on a créé
     
        // retourne l'objet contenant résultat
        return $objet;
    }

    function pas_select_categorie() { //afficher les catégorie pas associé à l'article
        // définition de la requête SQL avec un paramètre :valeur
        $sql= 'SELECT Categories.id_categorie, Categories.nom_categorie FROM Categories LEFT JOIN (SELECT * FROM Appartenir WHERE id_article = :valeur) as une_table on une_table.id_categorie=Categories.id_categorie where id_article is null';
       
        // connexion à la base de données
        $pdo = connexion();
     
        // préparation de la requête
        $query = $pdo->prepare($sql);
     
        // on lie le paramètre :valeur à la variable $id reçue
        $query->bindValue(':valeur', $this->id_article, PDO::PARAM_INT);
     
        // exécution de la requête
        $query->execute();
     
        // récupération de l'unique ligne
        $objet = $query->fetchAll(PDO::FETCH_CLASS, 'Categorie'); //ici Categorie = nom de la class Categorie qu'on a créé
     
        // retourne l'objet contenant résultat
        return $objet;
    }

    function select_lieu() { //afficher les lieux associé à l'article
        // définition de la requête SQL avec un paramètre :valeur
        $sql= 'SELECT Lieux.* FROM Situer INNER JOIN Lieux ON Situer.id_lieu=Lieux.id_lieu WHERE id_article = :valeur';
       
        // connexion à la base de données
        $pdo = connexion();
     
        // préparation de la requête
        $query = $pdo->prepare($sql);
     
        // on lie le paramètre :valeur à la variable $id reçue
        $query->bindValue(':valeur', $this->id_article, PDO::PARAM_INT);
     
        // exécution de la requête
        $query->execute();
     
        // récupération de l'unique ligne
        $objet = $query->fetchAll(PDO::FETCH_CLASS, 'Lieu'); //ici Lieu = nom de la class lieu qu'on a créé
     
        // retourne l'objet contenant résultat
        return $objet;
    }

    function pas_select_lieu() { //afficher les catégorie pas associé à l'article
        // définition de la requête SQL avec un paramètre :valeur
        $sql= 'SELECT Lieux.id_lieu, Lieux.nom_lieu FROM Lieux LEFT JOIN (SELECT * FROM Situer WHERE id_article = :valeur) as une_table on une_table.id_lieu=Lieux.id_lieu where id_article is null';
       
        // connexion à la base de données
        $pdo = connexion();
     
        // préparation de la requête
        $query = $pdo->prepare($sql);
     
        // on lie le paramètre :valeur à la variable $id reçue
        $query->bindValue(':valeur', $this->id_article, PDO::PARAM_INT);
     
        // exécution de la requête
        $query->execute();
     
        // récupération de l'unique ligne
        $objet = $query->fetchAll(PDO::FETCH_CLASS, 'Lieu');
     
        // retourne l'objet contenant résultat
        return $objet;
    }

    static function modif_associer_cat($id, $id_autre) { //associer depuis modifier.twig
        $pdo = connexion();

        $sql = "INSERT INTO Appartenir(id_article, id_categorie) VALUES (:id_art, :id_cat)";

        $query = $pdo->prepare($sql);

        $query->bindValue(':id_art', $id, PDO::PARAM_INT);
        $query->bindValue(':id_cat', $id_autre, PDO::PARAM_INT);
        
        $query->execute();
    }

    static function modif_delete_associer_cat($id, $id_autre) { //delete associer depuis modifier.twig
        $pdo = connexion();

        $sql = 'DELETE FROM Appartenir WHERE id_article = :id AND id_categorie = :id_cat';

        $query = $pdo->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':id_cat', $id_autre, PDO::PARAM_INT);
        
        $query->execute();
    }

    static function modif_associer_lieu($id, $id_autre) { //associer depuis modifier.twig
        $pdo = connexion();

        $sql = "INSERT INTO Situer(id_article, id_lieu) VALUES (:id_art, :id_lieu)";

        $query = $pdo->prepare($sql);

        $query->bindValue(':id_art', $id, PDO::PARAM_INT);
        $query->bindValue(':id_lieu', $id_autre, PDO::PARAM_INT);
        
        $query->execute();
    }

    static function modif_delete_associer_lieu($id, $id_autre) { //delete associer depuis modifier.twig
        $pdo = connexion();

        $sql = 'DELETE FROM Situer WHERE id_article = :id AND id_lieu = :id_lieu';

        $query = $pdo->prepare($sql);

        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->bindValue(':id_lieu', $id_autre, PDO::PARAM_INT);
        
        $query->execute();
    }
}