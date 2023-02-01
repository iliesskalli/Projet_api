<?php
//**************************** **************************** **************************** **************************** 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//**************************** **************************** **************************** **************************** 

//Si on est en PUT 
if($_SERVER['REQUEST_METHOD'] == 'PUT'){


    include_once '../configs/Database.php';
    include_once '../modeles/Categories.php';



    $database = new Database();
    $db = $database->getConnection();
 
    
    $categorie = new Categories($db);
    $donnees = json_decode(file_get_contents("php://input"));
    
    if(!empty($donnees->id) && !empty($donnees->nom) 
                            && !empty($donnees->description)
                            && !empty($donnees->date_creation)){
      

        $categorie->id = $donnees->id;
        $categorie->nom = $donnees->nom;
        $categorie->description = $donnees->description;
        $categorie->date_creation = $donnees->date_creation;
      

        if($categorie->modifier()){
          
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