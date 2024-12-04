<?php

Class CatalogController{
    public function index(){
        $par = Catalog::index();
        $json = array(
            "detalle"=>$par
        );
        echo json_encode($json,true);
        return;
    }
    public function allCatalog($nombre){
        $par = Catalog::allCatalog($nombre);
        $json = array($par);
        echo json_encode($json,true);
        return;
    }
    
}

?>