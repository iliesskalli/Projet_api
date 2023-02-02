<?php
//**************************** **************************** **************************** **************************** 

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET"); 
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

//**************************** **************************** **************************** **************************** 


// On vérifie que la méthode utilisée est correcte
if($_SERVER['REQUEST_METHOD'] == 'GET'){
 
    

    include_once '../configs/Database.php';
    include_once '../modeles/Categories.php';

    $database = new Database(); 
    $db = $database->getConnection();

    $categorie = new Categories($db);

//Lecture
    $donnees = $categorie->lire();

//Si au moins un produit
    if($donnees->rowCount() > 0){

//Creation du tableau
        $tableauCategories = [];
        $tableauCategories['categories'] = [];

//Parcourir les données
        while($row = $donnees->fetch(PDO::FETCH_ASSOC)){
            extract($row);

            $tab = [
                "id" => $id,
                "nom" => $nom, 
                "description" => $description
                
            ];

            $tableauCategories['categories'][] = $tab;
        } 

        //200 = OK
        http_response_code(200);

//Encodage Json
        echo json_encode($tableauCategories);
    }

}else{ 

    http_response_code(405);
    echo json_encode(["message" => "La méthode n'est pas autorisée"]);
}
