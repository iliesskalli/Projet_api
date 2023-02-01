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
    include_once '../modeles/Utilisateurs.php';

    $database = new Database();
    $db = $database->getConnection();

    $utilisateurs = new Utilisateurs($db);

    $donnees = json_decode(file_get_contents("php://input"));
    
    if(!empty($donnees->mail) && !empty($donnees->mdp) && !empty($donnees->nom) && !empty($donnees->prenom) && !empty($donnees->token)){
     

        $utilisateurs->mail = $donnees->mail;
        $utilisateurs->mdp = $donnees->mdp;
        $utilisateurs->nom = $donnees->nom;
        $utilisateurs->prenom = $donnees->prenom;
        $utilisateurs->token = $donnees->token;
 
         

        if($utilisateurs->creer()){
           

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