<?php 

require_once "connection.php";

Class Promotion{

    static public function index(){
        return "Estas en la vista promotion";
    }

    static public function showAllPromotions(){
        $stmt = Connection::connect()->prepare("SELECT id_promocion, nombre, fecha_inicio as inicio, fecha_fin as fin, enlace, estado 
        FROM promociones_vp 
        ORDER BY id_promocion;");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt = null;
        return $data;
    }

    static public function addPromotion($promotionData){
        $stmt = Connection::connect()->prepare("INSERT 
        INTO promociones_vp (nombre, fecha_inicio, fecha_fin, enlace, estado) 
        VALUES (:value1, :value2, :value3, :value4, :value5);");
        
        $stmt->bindParam(':value1', $promotionData['nombre']);
        $stmt->bindParam(':value2', $promotionData['fecha_inicio']);
        $stmt->bindParam(':value3', $promotionData['fecha_fin']);
        $stmt->bindParam(':value4', $promotionData['enlace']);
        $stmt->bindParam(':value5', $promotionData['estado']);
        
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);

        $stmt = null;
        return $data;
    }

    static public function showCurrentPromotion(){
        $stmt = Connection::connect()->prepare("SELECT id_promocion, nombre, fecha_inicio as inicio, fecha_fin as fin, enlace, estado 
        FROM promociones_vp
        WHERE STR_TO_DATE(fecha_inicio, '%Y-%m-%d') <= CURDATE()
        AND STR_TO_DATE(fecha_fin, '%Y-%m-%d') >= CURDATE();");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt = null;
        return $data;
    }

    static public function showPromotionRewards($id){
        $stmt = Connection::connect()->prepare("SELECT id_premios, nombre, puntos 
        FROM premios_vp 
        WHERE id_promocion = $id;");
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt = null;
        return $data;
    }
}

?>