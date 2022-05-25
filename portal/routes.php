<?php
$router = new Router;
$router->get('', 'PagesController@index');
$router->get('index', 'PagesController@index');
$router->get('countTime', 'ShowController@getAllTime');
$router->get('question', 'ShowController@getAllQuestion');
$router->get('login', 'PagesController@login');
$router->get("lockscreen", "PagesController@lockscreen");
$router->post("checkLogin", "loginController@loginAction");
$router->get("logoutAction", "loginController@logoutAction");
$router->get("Exam", "PagesController@Exam");
$router->get("autoCompleteStudent", "detailsController@autoCompleteStudent");
$router->post("StudentDetails", "PagesController@StudentDetails");
$router->post('result','SaveController@result');