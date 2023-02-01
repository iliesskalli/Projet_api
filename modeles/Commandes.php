<?php
class Commandes{
    private $connexion;
    private $table = "commandes";

    public $id;
    public $Mail_Utilisateur;
    public $id_produit;
    public $prix_produit;
 
 
    /**
     * @param $db
     */ 
    public function __construct($db){ 
        $this->connexion = $db;
    }


//**************************** **************************** **************************** **************************** 

    /**
     * @return void
     */
    public function lire(){

        $sql = "SELECT * FROM commandes";

        $query = $this->connexion->prepare($sql);
        $query->execute();

    
        return $query;
    }

    /**
     * @return void
     */

    public function creer(){

        $sql = "INSERT INTO commandes 
        SET Mail_Utilisateur=:Mail_Utilisateur, 
        id_produit=:id_produit, 
        prix_produit=:prix_produit";

        $query = $this->connexion->prepare($sql);


//**************************** **************************** **************************** **************************** 

//Secure Inject

        $this->Mail_Utilisateur=htmlspecialchars(strip_tags($this->Mail_Utilisateur));
        $this->id_produit=htmlspecialchars(strip_tags($this->id_produit));
        $this->prix_produit=htmlspecialchars(strip_tags($this->prix_produit));
      
    
        $query->bindParam(":Mail_Utilisateur", $this->Mail_Utilisateur);
        $query->bindParam(":id_produit", $this->id_produit);
        $query->bindParam(":prix_produit", $this->prix_produit);
          
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


//**************************** **************************** **************************** **************************** 

    /**
     * @return void
     */


    public function modifier(){
          
        $sql = "UPDATE " . $this->table . " SET 
        Mail_Utilisateur=:Mail_Utilisateur,
        id_produit=:id_produit,
        prix_produit=:prix_produit WHERE Mail_Utilisateur = :Mail_Utilisateur";
        
        $query = $this->connexion->prepare($sql);
        
       
        $this->Mail_Utilisateur=htmlspecialchars(strip_tags($this->Mail_Utilisateur));
        $this->id_produit=htmlspecialchars(strip_tags($this->id_produit));
        $this->prix_produit=htmlspecialchars(strip_tags($this->prix_produit));
        
      
        $query->bindParam(':Mail_Utilisateur', $this->Mail_Utilisateur);
        $query->bindParam(':id_produit', $this->id_produit);
        $query->bindParam(':prix_produit', $this->prix_produit);
    
       
        if($query->execute()){
            return true;
        }
        
        return false;
    }

}

//**************************** **************************** **************************** **************************** 
