<?php
class Categories{

    private $connexion;
    private $table = "categories";
    public $id;
    public $nom;
    public $description;
    public $date_creation;   

    /**
     * @param $db
     */


    public function __construct($db){ 
        $this->connexion = $db;
    }

    /**
     * @return void
     */

//**************************** **************************** **************************** **************************** 


    public function lire(){
     
        $sql = "SELECT * from categories";
        $query = $this->connexion->prepare($sql);
        $query->execute();
        return $query;
    }

    /**
     * @return void
     */

//**************************** **************************** **************************** **************************** 


    public function creer(){

        $sql = "INSERT INTO " . $this->table . " 
        SET nom=:nom, 
        description=:description,
        date_creation=:date_creation";


        $query = $this->connexion->prepare($sql);

        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->date_creation=htmlspecialchars(strip_tags($this->date_creation));

        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":description", $this->description);
        $query->bindParam(":date_creation", $this->date_creation);

        
        if($query->execute()){
        return true;
        }
        return false;
    }



//**************************** **************************** **************************** **************************** 
 
    /**
     * @return void
     */
    public function supprimer(){
         
        $sql = "DELETE FROM " . $this->table . " WHERE id = ?";
        $query = $this->connexion->prepare( $sql );
        $this->id=htmlspecialchars(strip_tags($this->id));
        $query->bindParam(1, $this->id);

       
        if($query->execute()){
        return true;
        }
        
        return false;
    }

    /**
     * @return void
     */
    public function modifier(){

//**************************** **************************** **************************** **************************** 

$sql = "UPDATE " . $this->table . " SET nom = :nom, description = :description WHERE id = :id";
        
        $query = $this->connexion->prepare($sql);
        
 
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->description=htmlspecialchars(strip_tags($this->description));
        $this->id=htmlspecialchars(strip_tags($this->id));
        
      
        $query->bindParam(':nom', $this->nom);
        $query->bindParam(':description', $this->description);
        $query->bindParam(':id', $this->id);
        

        if($query->execute()){
            return true; 
        }
        
        return false;
    }

}

//**************************** **************************** **************************** **************************** 
