<?php
function getRecaptcha($secretKey) {
    $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeL0ooUAAAAAKJph3fMiuB0HGTEr9EyCOjitACj&response={$secretKey}");
    $result = json_decode($response);
    return $result;
};

if(getRecaptcha($_POST["g-recaptcha-response"])->success) {
    
    $client_name = $_POST["name"];
    $client_email = $_POST["email"];
    $client_tel = $_POST["tel"];
    $client_message = $_POST["message"];
    $client_date = date("Y:m:d H:i:s");
    $headers = 'From: servis@servis-cfo.ru' . "\r\n" .
        'Reply-To: servis@servis-cfo.ru' . "\r\n" .
        'Content-type: text/html; charset=utf-8' . "\r\n" .
        'X-Mailer: PHP/' . phpversion();


    $output_message = "<p> Вы оформили заявку на сайте servis-cfo.ru следующего содержания:
                       <br><br>Имя: " . $client_name .
                      "<br><br>E-mail: " . $client_email .
                      "<br><br>Номер телефона: " . $client_tel .
                      "<br><br>Сообщение: " . $client_message .
                      "<br><br>Дата: " . $client_date . "</p>";


    $input_message = "<b> Вас приветствует компания ПНЕВМОТЕХ! </b>
                      <p> Вы оформили заявку на сайте servis-cfo.ru следующего содержания:
                      <br><br>Имя: " . $client_name .
                      "<br><br>E-mail: " . $client_email .
                      "<br><br>Номер телефона: " . $client_tel . "
                      <br><br>Сообщение: " . $client_message . "
                      <br><br>Дата: " . $client_date . "</p>
                      <p> Ваше сообщение успешно отправлено, в течение 30 минут с вами свяжутся наши менеджеры </p>
                      <p> Если в течение 30 минут вы не получите ответа, просим сообщить: моб 8 (925) 748-61-61
                      Генеральному директору Шумилову Александру Юрьевичу (E-mail: <a href='sau@kompr.ru'>sau@kompr.ru</a>) </p>
                      <p> График работы компании (время московское): <p>
                      <p> В будние дни <br>
                      ПН-ЧТ с 9-00 ч. до 18-00 ч., <br>
                      ПТ - с 9-00 ч. до 17-45 ч. </p>
                      <p>
                        Суббота, воскресенье - выходные дни.
                        Все заявки поступившие в эти дни будут обработаны в ближайший рабочий день.
                      </p>
                      <p>Предлагаем доставку Вашего заказа транспортом нашей компании с гарантией сохранности груза.
                      Условия доставки можно посмотреть здесь - <a href='http://www.kompr.ru/dostavka/dostavka.htm'>http://www.kompr.ru/dostavka/dostavka.htm<a></p>";

    $result = [
            $client_name,
            $client_email,
            $client_tel,
            $client_message,
            $client_date,
            $headers,
            $output_message,
            $input_message
        ];

    mail($client_email, "Вы оставили заявку на сайте servis-cfo.ru", $input_message, $headers);
    mail("euronasos19@gmail.com", "Заявка на сервис", $output_message, $headers);

    echo "SUCCESS";
} else {
    echo "FAIL";
}
?>