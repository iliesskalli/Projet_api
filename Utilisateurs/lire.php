<?php
//**************************** **************************** **************************** **************************** 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//**************************** **************************** **************************** **************************** 


//Si on est en GET
if($_SERVER['REQUEST_METHOD'] == 'GET'){

    include_once '../configs/Database.php';
    include_once '../modeles/Utilisateurs.php';

    $database = new Database(); 
    $db = $database->getConnection();

    $utilisateurs = new Utilisateurs($db);

    $DON = $utilisateurs->lire();


     if($DON->rowCount() > 0){

//Tableau
        $tableauUtilisateurs = [];
        $tableauUtilisateurs['utilisateurs'] = [];

// On parcourt les utilisateurs

        while($row = $DON->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $montab = [
                "mail" => $mail,
                "nom" => $nom,
                "prenom" => $prenom,
                "token" => $token
            ];

            $tableauUtilisateurs['utilisateurs'][] = $montab;
        }

        //200 donc OK
        http_response_code(200);
        echo json_encode($tableauUtilisateurs);
    }

}else{

    http_response_code(405);
    echo json_encode(["message" => "Methode non autorisee"]);
}
