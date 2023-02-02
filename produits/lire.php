<?php
//-----------------------------------------------------Headers------------------------------------------------------------------------

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//-----------------------------------------------------Headers------------------------------------------- -----------------------------
 

//Si on est en GET
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    include_once '../configs/Database.php';
    include_once '../modeles/Produits.php';

    $database = new Database();
    $db = $database->getConnection();

    $produit = new Produits($db);

    

    $DON = $produit->lire();


     if($DON->rowCount() > 0){

//Tableau
        $tableauProduits = [];
        $tableauProduits['produits'] = [];

// On parcourt les produits

        while($row = $DON->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $montab = [
                "id" => $id,
                "nom" => $nom,
                "description" => $description,
                "prix" => $prix,
                "categories_id" => $categories_id,
      
            ];

            $tableauProduits['produits'][] = $montab;
        }

        //200 donc OK
        http_response_code(200);
        echo json_encode($tableauProduits);
    }

}else{

    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee"]);
}
