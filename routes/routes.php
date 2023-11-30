<?php

$arrayRoutes=explode("/", $_SERVER['REQUEST_URI']);

switch(array_filter($arrayRoutes)[2]){
    case "promotion":{
        $prom = new PromotionController();
        if(isset($_SERVER['REQUEST_METHOD'])){
            switch(array_filter($arrayRoutes)[3]){
                case 'index':{
                    $prom->index();
                    break;
                }
                case 'all':{
                    if($_SERVER['REQUEST_METHOD']=='GET'){
                        $prom->showAllPromotions();
                    }
                    break;
                }
                case 'current':{
                    if($_SERVER['REQUEST_METHOD']=='GET'){
                        $prom->showCurrentPromotions();
                    }
                    break;
                }
                case 'add':{
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $json_data = file_get_contents('php://input');
                        $data = json_decode($json_data, true);
                        $prom->addPromotion($data);
                    }
                    break;
                }
                case "rewards":{
                    if($_SERVER['REQUEST_METHOD']=='GET'){
                    $prom->showPromotionRewards(array_filter($arrayRoutes)[4]);
                    }
                    break;
                }
            }
        }
        break;
    }
    default:{
        $json= array(
            "detalle"=>"no encontrado"
        );
        echo json_encode($json,true);
        break;
    }
}
?>