<?php
namespace Core\App\Controllers;

use Core\Engine\Components\Handler;
use Core\Engine\Components\Request;
use Core\Engine\Database\MySQLite;

class ApiController
{
    public function getDialogParam()
    {
        $dialogParam = (bool)Handler::getDialogParam();
        var_dump($dialogParam);
    }

    public function setDialogParam()
    {
        Handler::setDialogParam(1);
    }

    public function webhook()
    {
        $json = file_get_contents('php://input');
        $decoded = json_decode($json, true);
        $dialogParam = (bool)Handler::getDialogParam();

        if($dialogParam)
        {
            if($decoded['messages'][0]['body'] == 'Хочу узнать больше о компрессорах')
            {
                $chatId = $decoded['messages'][0]['author'];
                $body = "Вас приветствует компания ПНЕВМОТЕХ!\n\nВаш запрос отправлен!\n\nНаши менеджеры свяжутся с вами в ближайшее время для уточнения деталей.\n\nОтправь в сообщении номер необходимого пункта меню:\n\n 1️⃣Подробнее о компании\n\n 2️⃣Получить презентацию\n\n";
                $jsonBody = Handler::arrToJson(['chatId' => $chatId, 'body' => $body]);
                $request = new Request('POST', 'https://eu5.chat-api.com/instance32283/sendMessage?token=nhlhk9oykrcekw07', $jsonBody);
                $request->send();
            } 
            elseif($decoded['messages'][0]['body'] == '1')
            {
                $chatId = $decoded['messages'][0]['author'];
                $jsonBody = Handler::arrToJson(['chatId' => $chatId, 'body' => "Компания ПНЕВМОТЕХ осуществляет поставки компрессоров любого вида!\n\n Винтовых, Поршневых, Передвижных, Дизельных\n\n Подробная информация на сайте: www.engineer.kompr.ru"]);
                $request = new Request('POST', 'https://eu5.chat-api.com/instance32283/sendMessage?token=nhlhk9oykrcekw07', $jsonBody);
                $request->send();
            } 
            elseif($decoded['messages'][0]['body'] == '2') 
            {
                $chatId = $decoded['messages'][0]['author'];
                $jsonBody = Handler::arrToJson(['chatId' => $chatId, 'body' => 'https://www.servis-cfo.ru/pnevmo.pdf', 'filename' => 'test.pdf']);
                $request = new Request('POST', 'https://eu5.chat-api.com/instance32283/sendFile?token=nhlhk9oykrcekw07', $jsonBody);
                $request->send();
            }
            /*
            elseif($decoded['messages'][0]['body'] == '3')
            {
                $chatId = $decoded['messages'][0]['author'];
                $jsonBody = Handler::arrToJson(['chatId' => $chatId, 'body' => "Ответьте на несколько вопросов: \n\n 1. Укажите производительность компрессора в литрах или м3"]);
                $request = new Request('POST', 'https://eu5.chat-api.com/instance32283/sendMessage?token=nhlhk9oykrcekw07', $jsonBody);
                $request->send();
                Handler::setDialogParam(0);
            }
            */
        } 
        else 
        {
            if($decoded['messages'][0]['body'] == '4')
            {
                $chatId = $decoded['messages'][0]['author'];
                $jsonBody = Handler::arrToJson(['chatId' => $chatId, 'body' => '2. Укажите давление в барах, атмосферах, паскалях']);
                $request = new Request('POST', 'https://eu5.chat-api.com/instance32283/sendMessage?token=nhlhk9oykrcekw07', $jsonBody);
                $request->send();
            }
            if($decoded['messages'][0]['body'] == '5')
            {
                $chatId = $decoded['messages'][0]['author'];
                $jsonBody = Handler::arrToJson(['chatId' => $chatId, 'body' => '3. На какой бюджет расчитываете?']);
                $request = new Request('POST', 'https://eu5.chat-api.com/instance32283/sendMessage?token=nhlhk9oykrcekw07', $jsonBody);
                $request->send();
            }
            elseif($decoded['messages'][0]['body'] == '6')
            {
                $chatId = $decoded['messages'][0]['author'];
                $jsonBody = Handler::arrToJson(['chatId' => $chatId, 'body' => 'Спасибо за предоставленную информацию, наши менеджеры перезвонят Вам!']);
                $request = new Request('POST', 'https://eu5.chat-api.com/instance32283/sendMessage?token=nhlhk9oykrcekw07', $jsonBody);
                $request->send();
                Handler::setDialogParam(1);
            }
        }
    }
}