<?php
class Param {
  public static $user = 'root';
  public static $pass = '';
  public static $dsn = 'mysql:host=localhost;dbname=api;charset=utf8';
 
//**************************** **************************** **************************** **************************** 

    public function getConnection(){

        $this->connexion = null;

        try{
            $this->connexion = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->connexion->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Erreur de connexion : " . $exception->getMessage();
        }

        return $this->connexion;
    }   
}
