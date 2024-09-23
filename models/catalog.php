<?php 

require_once "connection.php";

Class Catalog{

    static public function index(){
        return "Estas en la vista catalog";
    }
    
    static public function allCatalog(){
        $stmt = Connection::connect()->prepare("SELECT * FROM catalogo_app");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt=null;
        return $data;
    }
}

?>