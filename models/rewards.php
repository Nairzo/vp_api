<?php 

require_once "connection.php";

Class Rewards{

    static public function index(){
        return "Estas en la vista rewards";
    }
    
    static public function showPromotionRewards($id){
        $stmt = Connection::connect()->prepare("SELECT id_premios, nombre, puntos 
        FROM premios_vp 
        WHERE id_promocion = :id;");

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);
        $stmt = null;
        return $data;
    }

    static public function addReward($promotionData){
        $stmt = Connection::connect()->prepare("INSERT 
        INTO premios_vp (id_promocion, nombre, puntos) 
        VALUES (:value1, :value2, :value3);");
        
        $stmt->bindParam(':value1', $promotionData['id_promocion']);
        $stmt->bindParam(':value2', $promotionData['nombre']);
        $stmt->bindParam(':value3', $promotionData['puntos']);
        
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);

        $stmt = null;
        return $data;
    }

    static public function editReward($promotionData){
        $stmt = Connection::connect()->prepare("UPDATE premios_vp 
        SET nombre = :value1, puntos = :value2 
        WHERE id_premios = :id;");
        
        $stmt->bindParam(':id', $promotionData['id_premios']);
        $stmt->bindParam(':value1', $promotionData['nombre']);
        $stmt->bindParam(':value2', $promotionData['puntos']);
        
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);

        $stmt = null;
        return $data;
    }

    static public function deleteReward($id){
        $stmt = Connection::connect()->prepare("DELETE FROM premios_vp 
        WHERE id_premios = :id;");
        
        $stmt->bindParam(':id', $id);
        
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_CLASS);

        $stmt = null;
        return $data;
    }

}

?>