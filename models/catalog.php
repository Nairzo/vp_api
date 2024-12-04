<?php 

require_once "connection.php";

Class Catalog{

    static public function index(){
        return "Estas en la vista catalog";
    }
    
    static public function allCatalog($nombre){
        $stmt = Connection::connect()->prepare("SELECT C.id, C.nombre, C.titulo, C.contenido, C.empleo, G.nombre as categoria, C.precio_em, C.precio_pu, C.imagen, C.ingredientes 
        FROM catalogo_app C 
        INNER JOIN cat_catalogo_app G ON G.id = C.id_categoria
        WHERE (C.nombre LIKE CONCAT('%', :nombre, '%') OR :nombre = '');");

        $stmt->bindParam(':nombre', $nombre);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt=null;
        return $data;
    }
}

?>