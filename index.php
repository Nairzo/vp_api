<?php

require_once "controllers/route_controller.php";
require_once "controllers/promotion_controller.php";

require_once "models/promotion.php";


$route = new RouteController();
$route->index();

?>