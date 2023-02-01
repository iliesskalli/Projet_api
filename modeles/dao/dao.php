<?php
require_once 'configs/param.php';


class DBConnex extends PDO{

    private static $instance;

    public static function getInstance(){
        if ( !self::$instance ){
            self::$instance = new DBConnex();
        }
        return self::$instance;
    }

    function __construct(){
        try {
            parent::__construct(Param::$dsn ,Param::$user, Param::$pass);
        } catch (Exception $e) {
            echo $e->getMessage();
            die("Impossible de se connecter." );
        }
    }

    public function __destruct(){
        if(!is_null(self::$instance)){
            self::$instance = null;
        }
    }


    public function queryFetchAll($sql){
        $sth  =$this->query($sql);

        if ( $sth ){
            return $sth -> fetchAll(PDO::FETCH_ASSOC);
        }

        return false;
    }


    public function queryFetchFirstRow($sql){
        $sth    = $this->query($sql);
        $result    = array();

        if ( $sth ){
            $result  = $sth -> fetch();
        }

        return $result;
    }


    public function insert($sql){
        if ( $this -> exec($sql) > 0 ){
            return 1;
            //$this->lastInsertId();
        }
        return false;
    }

    public function update($sql){
        return $this->exec($sql) ;
    }

    public function delete($sql){
        return $this->exec($sql) ;
    }
}


  
Class AbonneDAO{

//*********** vérifie si l'abonne qui tente de se connecter a un Mail et Mdp existant dans la bdd***********
    public static function verification(abonne $abonne){
        $sql = "select Mail from utilisateurs where Mail = '" . $abonne->getMail() . "' 
        and  Mdp =  '" . $_POST['mdp'] ."'
        and  Token =  '" . $_POST['token'] ."'";
        $login = DBConnex::getInstance()->queryFetchFirstRow($sql);
        if(empty($login)){
            return null;
        } 
        return $login[0];
    }
}



