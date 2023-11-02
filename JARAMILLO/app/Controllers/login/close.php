<?php

session_start();
$routeResut="Location: ../../view/login/";
unset($_SESSION["newsession"]);
header( $routeResut);

?>