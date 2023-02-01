<?php
//**************************** **************************** **************************** **************************** 
 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//**************************** **************************** **************************** **************************** 
//Si on est en POST

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    include_once '../configs/Database.php';
    include_once '../modeles/Categories.php';


    $database = new Database();
    $db = $database->getConnection();
    $categorie = new Categories($db);

 
    $donnees = json_decode(file_get_contents("php://input"));
    
    if(!empty($donnees->nom) && !empty($donnees->description) && !empty($donnees->date_creation)){
        
        $categorie->nom = $donnees->nom;
        $categorie->description = $donnees->description;
        $categorie->date_creation = $donnees->date_creation;
         

        if($categorie->creer()){
            
//Passe
            http_response_code(201);
            echo json_encode(["message" => "Ajout effectue ! "]);
        }else{

//Ne passe pas 
           
            http_response_code(503);
            echo json_encode(["message" => "Ajout non effectue ! "]);         
        }
    }
}else{
    
    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee ! "]);
}