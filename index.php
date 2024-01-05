<?php

require_once "controllers/route_controller.php";
require_once "controllers/promotion_controller.php";
require_once "controllers/rewards_controller.php";
require_once "controllers/participants_controller.php";

require_once "models/promotion.php";
require_once "models/rewards.php";
require_once "models/participants.php";


$route = new RouteController();
$route->index();

?>