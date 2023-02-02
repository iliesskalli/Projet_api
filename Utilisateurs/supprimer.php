<?php
//**************************** **************************** **************************** **************************** 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Methods: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


//**************************** **************************** **************************** **************************** 
 

//Si on est en delete
if($_SERVER['REQUEST_METHOD'] == 'DELETE'){


    include_once '../configs/Database.php';
    include_once '../modeles/Utilisateurs.php';

    $database = new Database();
    $db = $database->getConnection();


    $utilisateurs = new Utilisateurs($db);
    $donnees = json_decode(file_get_contents("php://input"));

    if(!empty($donnees->mail)){
        $utilisateurs->mail = $donnees->mail;

        if($utilisateurs->supprimer()){
             
            //OK CD 200
            http_response_code(200);
            echo json_encode(["message" => "Suppression effectuee ! "]);

        }else{
            
            http_response_code(503);
            echo json_encode(["message" => "Suppression non effectuee ! "]);         
        }
    }
}else{

    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee ! "]);
}
