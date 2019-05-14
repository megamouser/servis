<?php
namespace Core\App\Controllers;

use Core\Engine\Components\Handler;
use Core\Engine\Components\Mailer;
use Core\Engine\Database\MySQLite;
use Core\Engine\Components\Request;

class PagesController
{
    public function home()
    {
        return Handler::view('home');
    }

    public function posting()
    {
        if($_POST)
        {
            unset($_POST['g-recaptcha-response']);
            $_POST['date'] = date('Y:m:d H:i:s');

            $jsonData = Handler::arrToJson($_POST);

            $mySQLite = new MySQLite;
            if(!$mySQLite)
            {
                echo $mySQLite->lastErrorMsg();
            }
            else
            {
                echo "Opened database successfully\n";
                $sql = "INSERT INTO MESSAGES (CONTENT) VALUES ('$jsonData')";
                $ret = $mySQLite->exec($sql);

                if(!$ret)
                {
                    echo $mySQLite->lastErrorMsg();
                }
                else
                {
                    echo "Records created successfully\n";
                }

                $mySQLite->close();

                $mailer = new Mailer($_POST);
                $mailer->sendEmail();
            }
        }
    }
}
