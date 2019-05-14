<?php
require_once __DIR__ . "/../vendor/autoload.php";

//use Core\Engine\Components\Main;
use Core\Engine\Components\Handler;
use Core\Engine\Components\Router;
use Core\Engine\Components\Request;

//$jsonBody = Handler::arrToJson(['phone' => '79055670252', 'body' => 'Hello, this is Pnevmotex']);
//$request = new Request('GET', 'https://eu2.chat-api.com/instance31164/messages?token=inbsci5zd5y1ixo5', $jsonBody); //get all messages
//$request = new Request('POST', 'https://eu2.chat-api.com/instance31164/sendMessage?token=inbsci5zd5y1ixo5', $jsonBody); //send to other number
//$request = new Request('GET', 'https://eu2.chat-api.com/instance31164/settings?token=inbsci5zd5y1ixo5'); //get options

Router::load('../core/routes.php')->direct(Handler::requestUri(), Handler::requestMethod());