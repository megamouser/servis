<?php
$router->get('', 'PagesController@home');
$router->post('posting', 'PagesController@posting');

$router->get('webhook', 'ApiController@webhook');
$router->post('webhook', 'ApiController@webhook');

$router->get('gettest', 'ApiController@getDialogParam');
$router->get('settest', 'ApiController@setDialogParam');