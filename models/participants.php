<?php 

require_once "connection.php";

Class Participants{

    static public function index(){
        return "Estas en la vista participants";
    }
    
    static public function participantsByProm($idPromotion){
        $stmt = Connection::connect()->prepare("SELECT REPLACE(FORMAT(SUM(CANTSOLICITADA * P.puntos),2), ',', '') as puntos, E.NOMBRE, E.PATERNO, E.MATERNO, E.ID_EIA, E.ID_NOMBRAMIENTO, E.SEXO 
        FROM detalleventas D 
        INNER JOIN productos P ON D.ID_PRODUCTO = P.ID_PRODUCTO 
        INNER JOIN ventas V ON D.ID_VENTA = V.ID_VENTA 
        INNER JOIN promocion_vp M ON V.FECHA_VENTA >= M.fecha_inicio AND V.FECHA_VENTA <= M.fecha_fin 
        INNER JOIN eia E ON V.ID_EIA = E.ID_EIA
        WHERE P.CLAVE LIKE 'VP%' AND M.id_promocion = :idpromotion AND E.ESTATUS = 'A' 
        GROUP BY E.NOMBRE, E.PATERNO, E.MATERNO, E.ID_EIA, E.ID_NOMBRAMIENTO, E.SEXO 
        HAVING puntos > 0") ;

        $stmt->bindParam(':idpromotion', $idPromotion);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt=null;
        return $data;
    }

    static public function participantsByPromAndName($idPromotion, $nombre){
        $stmt = Connection::connect()->prepare("SELECT REPLACE(FORMAT(SUM(CANTSOLICITADA * P.puntos), 2), ',', '') as puntos, 
        E.NOMBRE, E.PATERNO, E.MATERNO, E.ID_EIA, E.ID_NOMBRAMIENTO, E.SEXO
        FROM detalleventas D
        INNER JOIN productos P ON D.ID_PRODUCTO = P.ID_PRODUCTO
        INNER JOIN ventas V ON D.ID_VENTA = V.ID_VENTA
        INNER JOIN promocion_vp M ON V.FECHA_VENTA >= M.fecha_inicio AND V.FECHA_VENTA <= M.fecha_fin
        INNER JOIN eia E ON V.ID_EIA = E.ID_EIA
        WHERE P.CLAVE LIKE 'VP%' 
        AND M.id_promocion = :idpromotion 
        AND E.ESTATUS = 'A'
        AND (E.NOMBRE LIKE CONCAT('%', :nombre, '%') OR :nombre = '')
        GROUP BY E.NOMBRE, E.PATERNO, E.MATERNO, E.ID_EIA, E.ID_NOMBRAMIENTO, E.SEXO
        HAVING puntos > 0;");

        $stmt->bindParam(':idpromotion', $idPromotion);
        $stmt->bindParam(':nombre', $nombre);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt=null;
        return $data;
    }

    static public function pvpByMonth($id, $startDate, $endDate){

        $stmt = Connection::connect()->prepare("SELECT COALESCE(REPLACE(FORMAT(SUM(D.CANTSOLICITADA * P.puntos),2), ',', ''), 0) as puntos 
        FROM detalleventas D 
        INNER JOIN productos P ON D.ID_PRODUCTO = P.ID_PRODUCTO 
        INNER JOIN ventas V ON D.ID_VENTA = V.ID_VENTA 
        WHERE V.ID_EIA = :id AND V.FECHA_VENTA BETWEEN :startDate AND :endDate AND P.CLAVE LIKE 'VP%'");

        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':startDate', $startDate, PDO::PARAM_STR);
        $stmt->bindParam(':endDate', $endDate, PDO::PARAM_STR);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt=null;
        return $data;
    }

}

?>