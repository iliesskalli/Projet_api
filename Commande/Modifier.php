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
    include_once '../modeles/Commandes.php';



    $database = new Database();
    $db = $database->getConnection();
 
    
    $commande = new Commandes($db);  
    $donnees = json_decode(file_get_contents("php://input"));
    
    if (!empty($donnees->id) &&!empty($donnees->Mail_Utilisateur) 
                            && !empty($donnees->id_produit)
                            && !empty($donnees->prix_produit)){
      

        $commande->id = $donnees->id;
        $commande->Mail_Utilisateur = $donnees->Mail_Utilisateur;
        $commande->id_produit = $donnees->id_produit;
        $commande->prix_produit = $donnees->prix_produit;
      

        if($commande->modifier()){
          
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