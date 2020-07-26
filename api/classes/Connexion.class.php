<?php

class Connexion{

    static $cnx=null;

    private function __construct($host,$user,$pass,$bd) {
       self::$cnx=mysqli_connect($host,$user,$pass,$bd);
    }
    
    public static function SeConnecter($host="localhost",$user="root",$pass="",$bd="gestheuressupplm")
    {        
        if(self::$cnx==null)
            new Connexion ($host, $user, $pass, $bd);
        else 
            echo "Connexion deja etablie !!!!";
        return self::$cnx;
    }   

}


?>
