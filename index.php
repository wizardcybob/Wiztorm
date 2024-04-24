<?php

include('include/connexion.php');

include('include/twig.php');
$twig = init_twig();



///////////////////////////////////////////////////////////////
include('include/Article.php');
include('include/Lieu.php');

// récupération de la variable page sur l'URL
if (isset($_GET['page'])) $page = $_GET['page']; else $page = '';
 
// récupération de la variable action sur l'URL
if (isset($_GET['action'])) $action = $_GET['action']; else $action = 'read';
 
// récupération de l'id s'il existe (par convention la clé 0 correspond à un id inexistant)
if (isset($_GET['id'])) $id = intval($_GET['id']); else $id = 0;
if (isset($_GET['id_autre'])) $id_autre = intval($_GET['id_autre']); else $id_autre = 0;
 

// test des différents choix
switch ($page) {
    case 'article' :
        switch ($action) {
            case 'read' :
                if ($id > 0) {
                $modele = 'ft_article.twig';
                $data = ['un_article' => Article::readOne_Article($id), 'plusieurs_article' => Article::readAll_Article()]; //readAll pour l'aside
                }
                else {
                $modele = 'articles.twig';
                $data = ['plusieurs_article' => Article::readAll_Article()];
                }
            break;
            case 'delete' :
                $data = ['qqc' => Article::delete($id)];
                header('Location: index.php?page=article&action=read');
                break;
                default :
                echo 'Action non reconnue';
            break;
            case 'create' :
                if (isset($_POST["new_article"])) { //new_article fait référence au submit du formulaire
                    $creation_new_article = new Article();
                    $creation_new_article->chargePOST();
                    $creation_new_article->create();
                    $creation_new_article->associer_cat();
                    $creation_new_article->associer_lieu();
                }
                header('Location: index.php?page=article&action=read&id='.$creation_new_article->id_article);
            break;
			case 'edit' : //va permettre de récupérer l'id pour l'update
				$modele = 'modif.twig';
				$data = ['un_article' => Article::readOne_Article($id)];
				break;
            case 'update' :
                $update_article = new Article(); //$up.. est un objet
                $update_article->chargePOST();
                $update_article->update();
                header('Location: index.php?page=article&action=read&id='.$update_article->id_article);
            break;
            case 'associer_cat' :
                Article::modif_associer_cat($id, $id_autre);
                header('Location: index.php?page=article&action=edit&id='.$id);
            break;
            case 'delete_associer_cat' :
                Article::modif_delete_associer_cat($id, $id_autre);
                header('Location: index.php?page=article&action=edit&id='.$id);
            break;
            case 'associer_lieu' :
                Article::modif_associer_lieu($id, $id_autre);
                header('Location: index.php?page=article&action=edit&id='.$id);
            break;
            case 'delete_associer_lieu' :
                Article::modif_delete_associer_lieu($id, $id_autre);
                header('Location: index.php?page=article&action=edit&id='.$id);
            break;
        }
        break;
    //version multicontrolleur
    case 'categorie' :
        $result = Categorie::controleur($action, $id);
        $data = $result['data'];        
        $modele = $result['modele'];
        break; //si pas break l'affichage du reste se met à la suite
    case 'lieu' :
        $result = Lieu::controleur($action, $id);
        $data = $result['data'];        
        $modele = $result['modele'];
        break;
    //special formulaire
    case 'formulaire' :
        switch ($action) {
            case 'read' :
                $modele = 'formulaire.twig';
                $data = ['plusieurs_cat' => Categorie::readAll_Categorie(), 'plusieurs_lieu' => Lieu::readAll_Lieu()];
            break;
        }
    break;
    
    default :
    $modele = 'articles.twig';
    $data = ['plusieurs_article' => Article::readAll_Article()];
}
 
// Affichage du modèle choisi avec les données récupérées
echo $twig->render($modele, $data);