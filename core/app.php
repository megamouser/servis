<?php
require_once __DIR__ . "/../vendor/autoload.php";
use Core\MyDB;
use Core\Mailer;

if($_POST) {
    $mailer = new Mailer($_POST);
    $mailer->sendEmail();
    print_r($mailer);
    
    $db = new MyDB();
    if(!$db) {
        echo $db->lastErrorMsg();
    } else {
        echo "Opened database successfully\n";

        $sql = "INSERT INTO MESSAGES (CONTENT) VALUES ('$mailer->emailTemplate')";

        print_r($sql);

        $ret = $db->exec($sql);
        if(!$ret) {
            echo $db->lastErrorMsg();
        } else {
            echo "Records created successfully\n";
        }

        $db->close();
    }
  } else {
    print_r("\$_POST is not defined");
}