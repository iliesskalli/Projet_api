<?php
//-----------------------------------------------------Headers------------------------------------------------------------------------

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//-----------------------------------------------------Headers------------------------------------------------------------------------

//Si on est en PUT 
if($_SERVER['REQUEST_METHOD'] == 'PUT'){


    include_once '../configs/Database.php';
    include_once '../modeles/Produits.php';



    $database = new Database();
    $db = $database->getConnection();

    
    $produit = new Produits($db);
    $donnees = json_decode(file_get_contents("php://input"));
    
    if(!empty($donnees->id) && !empty($donnees->nom) 
                            && !empty($donnees->description) 
                            && !empty($donnees->prix) 
                            && !empty($donnees->categories_id)){
      

        $produit->id = $donnees->id;
        $produit->nom = $donnees->nom;
        $produit->description = $donnees->description;
        $produit->prix = $donnees->prix;
        $produit->categories_id = $donnees->categories_id;

        if($produit->modifier()){
          
            http_response_code(200);
            echo json_encode(["message" => "Modification effectuee ! "]);

        }else{
            http_response_code(503);
            echo json_encode(["message" => "Modification effectuee ! "]);         
        }
    }
}else{

    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee ! "]);
}