<?php

Class ParticipantsController{
    public function index(){
        $par = Participants::index();
        $json = array(
            "detalle"=>$par
        );
        echo json_encode($json,true);
        return;
    }
    public function paticipantsByPromotion($id){
        $par = Participants::participantsByProm($id);
        $json = array($par);
        echo json_encode($json,true);
        return;
    }
    public function pvpByMonth($id, $startDate, $endDate){
        $par = Participants::pvpByMonth($id, $startDate, $endDate);
        $json = array($par);
        echo json_encode($json,true);
        return;
    }
}

?>