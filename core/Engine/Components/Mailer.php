<?php
namespace Core\Engine\Components;

class Mailer
{
  public $postData;
  public $emailTemplate;

  function __construct($postData)
  {
    $this->postData = $postData;
    $this->generateTemplate();
  }

  protected function generateTemplate()
  {
    $this->postData["name"] ? $this->emailTemplate .= "<p>Имя: " . $this->postData["name"] . "</p>" : $this->emailTemplate .= "";
    $this->postData["tel"] ? $this->emailTemplate .= "<p>Телефон: " . $this->postData["tel"] . "</p>" : $this->emailTemplate .= "";
    $this->postData["email"] ? $this->emailTemplate .= "<p>Email: " . $this->postData["email"] . "</p>" : $this->emailTemplate .= "";
    $this->postData["message"] ? $this->emailTemplate .= "<p>Сообщение " . $this->postData["message"] . "</p>" : $this->emailTemplate .= "";
    $this->emailTemplate .= "<p>Дата: " . date("Y:m:d H:i:s") . "</p>";

    return $this->emailTemplate;
  }

  public function sendEmail()
  {
    $headers = 'From: servis@servis-cfo.ru' . "\r\n" .
               'Reply-To: servis@servis-cfo.ru' . "\r\n" .
               'Content-type: text/html; charset=utf-8' . "\r\n" .
               'X-Mailer: PHP/' . phpversion();

    $clientEmail = $this->postData["email"];
    $ownMessage = "<p><b>Заявка с servis-cfo.ru</b></p>" . $this->emailTemplate;
    $clientMessage = "<p>Здравствуйте, вы оформили заявку на servis-cfo.ru следующего содержания: </p>" . $this->emailTemplate;

   mail($clientEmail, "Вы оставили заявку на сайте servis@servis-cfo.ru", $clientMessage, $headers);
   mail("euronasos19@gmail.com", "servis@servis-cfo.ru", $ownMessage, $headers);
  }
}
?>
