<?php
//----------------------------------------------------Headers----------------------------------------------------------------
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//----------------------------------------------------Headers----------------------------------------------------------------


 if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include_once '../configs/Database.php';
    include_once '../modeles/Produits.php';

    $database = new Database(); 
    $db = $database->getConnection();

   
    $produit = new Produits($db);

     $donnees = json_decode(file_get_contents("php://input"));
    
    if(!empty($donnees->nom) && !empty($donnees->description) && !empty($donnees->prix) && !empty($donnees->categories_id)
     && !empty($donnees->date_creation)){
   

        $produit->nom = $donnees->nom;
        $produit->description = $donnees->description;
        $produit->prix = $donnees->prix;
        $produit->categories_id = $donnees->categories_id;
        $produit->date_creation = $donnees->date_creation;
         

        if($produit->creer()){
           
            http_response_code(201);
            echo json_encode(["message" => "L'ajout a été effectué"]);
        }else{
             
            http_response_code(503);
            echo json_encode(["message" => "L'ajout n'a pas été effectué"]);         
        }
    }
}else{
   
    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}