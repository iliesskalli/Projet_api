<?php
class Utilisateurs{
    private $connexion;
    private $table = "utilisateurs";

    public $mail;
    public $mdp;
    public $nom; 
    public $prenom;
    public $token;
   
    
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

        $sql = "SELECT mail,nom,prenom, token FROM " . $this->table . " ";
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
        SET mail=:mail, 
        mdp=:mdp, 
        nom=:nom, 
        prenom=:prenom,
        token=:token";

        $query = $this->connexion->prepare($sql);


//Secure Inject

        $this->mail=htmlspecialchars(strip_tags($this->mail));
        $this->mdp=htmlspecialchars(strip_tags($this->mdp));
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->token=htmlspecialchars(strip_tags($this->token));
 
     
        $query->bindParam(":mail", $this->mail);
        $query->bindParam(":mdp", $this->mdp);
        $query->bindParam(":nom", $this->nom);
        $query->bindParam(":prenom", $this->prenom);
        $query->bindParam(":token", $this->token);

       
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

        $sql = "DELETE FROM " . $this->table . " WHERE mail = ?";
        $query = $this->connexion->prepare( $sql );
        $this->mail=htmlspecialchars(strip_tags($this->mail));
        $query->bindParam(1, $this->mail);

       
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
         mail = :mail,
         mdp = :mdp,
         nom = :nom,
         prenom = :prenom,
         token = :token
         WHERE mail = :mail";
        
        $query = $this->connexion->prepare($sql);
        
       
        $this->mail=htmlspecialchars(strip_tags($this->mail));
        $this->mdp=htmlspecialchars(strip_tags($this->mdp));
        $this->nom=htmlspecialchars(strip_tags($this->nom));
        $this->prenom=htmlspecialchars(strip_tags($this->prenom));
        $this->token=htmlspecialchars(strip_tags($this->token));


        $query->bindParam(':mail', $this->mail);
        $query->bindParam(':mdp', $this->mdp);
        $query->bindParam(':nom', $this->nom);
        $query->bindParam(':prenom', $this->prenom);
        $query->bindParam(':token', $this->token);

         
       
        if($query->execute()){ 
            return true;
        }
        
        return false;
    }

}

//**************************** **************************** **************************** **************************** 
