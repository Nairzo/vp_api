<?php

Class RewardsController{
    public function index(){
        $rew = Rewards::index();
        $json = array(
            "detalle"=>$rew
        );
        echo json_encode($json,true);
        return;
    }
    
    public function showPromotionRewards($id){
        $rew = Rewards::showPromotionRewards($id);
        $json = array($rew);
        echo json_encode($json,true);
        return;
    }
    
    public function addReward($data){
        $rew = Rewards::addReward($data);
        $json = array($rew);
        echo json_encode($json,true);
        return;
    }
    public function editReward($data){
        $rew = Rewards::editReward($data);
        $json = array($rew);
        echo json_encode($json,true);
        return;
    }

    public function deleteReward($id){
        $rew = Rewards::deleteReward($id);
        $json = array($rew);
        echo json_encode($json,true);
        return;
    }

}

?>