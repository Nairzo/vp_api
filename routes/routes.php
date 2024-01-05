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
                case 'edit':{
                    if($_SERVER['REQUEST_METHOD']=='PUT'){
                        $json_data = file_get_contents('php://input');
                        $data = json_decode($json_data, true);
                        $prom->editPromotion($data);
                    }
                    break;
                }
                case 'delete':{
                    if($_SERVER['REQUEST_METHOD']=='DELETE'){
                        $id = filter_input(INPUT_GET, 'id_promocion', FILTER_VALIDATE_INT);
                        $prom->deletePromotion($id);
                    }
                    break;
                }
                case 'status':{
                    if($_SERVER['REQUEST_METHOD']=='PATCH'){
                        $json_data = file_get_contents('php://input');
                        $data = json_decode($json_data, true);
                        $prom->updatePromStatus($data);
                    }
                    break;
                }
            }
        }
        break;
    }
    case 'rewards':{
        $rew = new RewardsController();
        if(isset($_SERVER['REQUEST_METHOD'])){
            switch(array_filter($arrayRoutes)[3]){
                case 'index':{
                    $rew->index();
                    break;
                }
                case "promotion":{
                    if($_SERVER['REQUEST_METHOD']=='GET'){
                        $id = filter_input(INPUT_GET, 'id_promocion', FILTER_VALIDATE_INT);
                        $rew->showPromotionRewards($id);
                    }
                    break;
                }
                case 'add':{
                    if($_SERVER['REQUEST_METHOD']=='POST'){
                        $json_data = file_get_contents('php://input');
                        $data = json_decode($json_data, true);
                        $rew->addReward($data);
                    }
                    break;
                }
                case 'edit':{
                    if($_SERVER['REQUEST_METHOD']=='PUT'){
                        $json_data = file_get_contents('php://input');
                        $data = json_decode($json_data, true);
                        $rew->editReward($data);
                    }
                    break;
                }
                case 'delete':{
                    if($_SERVER['REQUEST_METHOD']=='DELETE'){
                        $id = filter_input(INPUT_GET, 'id_premios', FILTER_VALIDATE_INT);
                        $rew->deleteReward($id);
                    }
                    break;
                }
            }
        }
        break;
    }
    case 'participants':{
        $par = new ParticipantsController();
        if(isset($_SERVER['REQUEST_METHOD'])){
            switch(array_filter($arrayRoutes)[3]){
                case 'index':{
                    $par->index();
                    break;
                }
                case 'all':{
                    if($_SERVER['REQUEST_METHOD']=='GET'){
                        $id = filter_input(INPUT_GET, 'id_promocion', FILTER_VALIDATE_INT);
                        $par->paticipantsByPromotion($id);
                    }
                    break;
                }
                case 'month':{
                    if($_SERVER['REQUEST_METHOD']=='GET'){
                        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                        $startDate = filter_input(INPUT_GET, 'start',  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $endDate = filter_input(INPUT_GET, 'end',  FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                        $par->pvpByMonth($id, $startDate, $endDate);
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