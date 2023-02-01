<?php
//**************************** **************************** **************************** **************************** 

  $formulaireConnexion = new Formulaire('post', 'index.php', 'fConnexion', 'connexion');
  $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabelFor('identifiant', 'Identifiant :'));
  $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputTexte('login', 'login', '', 1, '', 0));
  $formulaireConnexion->ajouterComposantTab();

//**************************** **************************** **************************** **************************** 

  $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabelFor('mdp', 'Mot de passe :'));
  $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputMdp('mdp', 'mdp', '', '', 0));
  $formulaireConnexion->ajouterComposantTab();

//**************************** **************************** **************************** **************************** 


  $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabelFor('token', 'Token :'));
  $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputMdp('token', 'token', '', '', 0));
  $formulaireConnexion->ajouterComposantTab();

//**************************** **************************** **************************** **************************** 


  $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerInputSubmit('submitConnex', 'submitConnex', 'Valider'));
  $formulaireConnexion->ajouterComposantTab();
  $formulaireConnexion->ajouterComposantLigne($formulaireConnexion->creerLabel($messageErreurConnexion));
  $formulaireConnexion->ajouterComposantTab();
  $formulaireConnexion->ajouterComposantTab();
  $formulaireConnexion->creerFormulaire();

//**************************** **************************** **************************** **************************** 

  
include_once 'vues/squeletteConnexion.php';
?>
