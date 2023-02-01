<?php
require_once 'fonctions/menu.php';
require_once 'fonctions/formulaire.php';
require_once 'fonctions/dispatcher.php';
require_once 'modeles/dto/Abonne.php';
require_once 'modeles/dao/dao.php';
require_once 'fonctions/fonctions.php';
 

//**************************** **************************** **************************** **************************** 

//Verifie si il y a deja un menu principal et lui affecte la valeur selectionné

if (isset($_GET['siteweb'])){
    $_SESSION['siteweb']= $_GET['siteweb'];
}
else{
    if(!isset($_SESSION['siteweb'])){
        $_SESSION['siteweb']="accueil";
    }
}


$messageErreurConnexion= '';
if (isset($_POST['login'],$_POST['mdp'])){
   
   
    $unAbonne =new Abonne($_POST['login']);
    $_SESSION['identification']=abonneDAO::verification($unAbonne);
    $_SESSION['abonne'] = $unAbonne;

    if($_SESSION['identification']){
        $_SESSION['siteweb']='accueil';
    }
}

//**************************** **************************** **************************** **************************** 



//************Crée un nouveau menu principal***********
$siteweb = new Menu("menuPrincipal");

if (isset($_SESSION['identification'])){
 
    $siteweb->ajouterComposant($siteweb->creerItemLien("deconnexion", "Se deconnecter"));
}

else {
  $siteweb->ajouterComposant($siteweb->creerItemLien("connexion", "Se connecter"));
}



//***********Crée le menu principal***********

$menuPrincipal = $siteweb->creerMenu($_SESSION['siteweb'],'siteweb');
include_once dispatcher::dispatch($_SESSION['siteweb']);

//**************************** **************************** **************************** **************************** 

?>

