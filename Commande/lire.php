<?php
//**************************** **************************** **************************** **************************** 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET"); 
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//**************************** **************************** **************************** **************************** 


// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    include_once '../configs/Database.php';
    include_once '../modeles/Commandes.php';

    $database = new Database(); 
    $db = $database->getConnection();

    $commande = new Commandes($db);

//Lecture
    $donnees = $commande->lire();

//Si au moins un produit
    if($donnees->rowCount() > 0){

//Creation du tableau
        $tableauCommandes = [];
        $tableauCommandes['commande'] = [];

//Parcourir les données
        while($row = $donnees->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $tab = [
                "id" => $id,
                "Mail_Utilisateur" => $Mail_Utilisateur, 
                "id_produit" => $id_produit,
                "prix_produit" => $prix_produit
                
            ];

            $tableauCommandes['commandes'][] = $tab;
        } 

        //200 = OK
        http_response_code(200);

//Encodage Json
        echo json_encode($tableauCommandes);
    }

}else{ 

    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
