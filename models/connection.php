<?php

Class Connection{

    static public function connect(){
        try{
            $link = new PDO("mysql:host=201.120.42.39;dbname=alfa_newlife","root","Conque2");
            $link->exec("set names utf8");
            $link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $link;
        }catch (PDOException $e){
            echo "Conexión fallida: ".$e->getMessage();
        }
    }
}

?>