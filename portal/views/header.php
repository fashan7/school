<?php 
if(!isset($_SESSION['logusersid']))
    return header("location: login");
//if(!isset($_COOKIE['usrname']))
//    return header("location: login");

$loguserid = $_SESSION['logusersid'];
$logusrnme = $_SESSION['usrname'];
?>
<!DOCTYPE html>
<html>
<head>
  <title><?php echo $title; ?></title>
  <link rel="shortcut icon" href="../public/media/fashan/logo.png" />
  <?php get_link('css'); ?>
</head>
