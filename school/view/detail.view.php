<?php
session_start();
$loguserid = $_SESSION['loguserid'];
$logusrnme = $_SESSION['username'];

$obj = new privilegeController;
$objpage = new pageController;

$result = $obj->getSamePage();
$output = '';
foreach($result as $row)
{
    $output = $row['pages'];
}
echo $output;