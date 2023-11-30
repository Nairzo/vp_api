<?php

Class PromotionController{
    public function index(){
        $prom = Promotion::index();
        $json = array(
            "detalle"=>$prom
        );
        echo json_encode($json,true);
        return;
    }

    public function showAllPromotions(){
        $prom = Promotion::showAllPromotions();
        $json = array($prom);
        echo json_encode($json,true);
        return;
    }

    public function showCurrentPromotions(){
        $prom = Promotion::showCurrentPromotion();
        $json = array($prom);
        echo json_encode($json,true);
        return;
    }

    public function showPromotionRewards($id){
        $prom = Promotion::showPromotionRewards($id);
        $json = array($prom);
        echo json_encode($json,true);
        return;
    }

    public function addPromotion($data){
        $prom = Promotion::addPromotion($data);
        $json = array($prom);
        echo json_encode($json,true);
        return;
    }
}

?>