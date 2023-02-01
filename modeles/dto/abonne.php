<?php
class Abonne{
    private $mail;
    private $nom;
    private $prenom;

    /**
     * abonne constructor.
     * @param $codeAcces
     */

    public function __construct($mail)
    {
        $this->mail = $mail;
  
    }

    public function hydrate(array $donnees)
    {
        foreach ($donnees as $key => $value)
        {
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method))
            {
                $this->$method($value);
            }
        }
    }

     
    public function getmail()
    {
        return $this->mail;
    }

    /**
     * @param mixed $mail
     */
    public function setmail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return mixed
     */
    public function getnom()
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setnom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getprenom()
    {
        return $this->prenom;
    }

    /**
     * @param mixed $prenom
     */
    public function setPRENOM($prenom)
    {
        $this->prenom = $prenom;
    }

    }


 