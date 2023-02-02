<?php
//-----------------------------------------------------Headers------------------------------------------------------------------------
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


//-----------------------------------------------------Headers------------------------------------------------------------------------


//Si on est en delete
if($_SERVER['REQUEST_METHOD'] == 'GET'){


    include_once '../configs/Database.php';
    include_once '../modeles/Produits.php';

    $database = new Database();
    $db = $database->getConnection();


    $produit = new Produits($db);
    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->id)){
        $produit->id = $donnees->id;

        if($produit->lireun()){
            
            
            //OK CD 200
            http_response_code(200);
            echo json_encode(["message" => "Produit existe ! "]);

        }else{
            
            http_response_code(503);
            echo json_encode(["message" => "Produit n'existe pas ! "]);         
        }
    }
}else{

    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee ! "]);
}