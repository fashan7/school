<?php
include 'controller/loginController.php';
$obj = new loginController;
echo $obj->loginAction();