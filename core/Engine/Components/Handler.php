<?php
namespace Core\Engine\Components;
use Core\Engine\Database\MySQLite;

class Handler
{
    public static function view($name, $data = [])
    {
        extract($data);
        return require __DIR__ . "/../../../core/App/Views/$name.view.php";
    }

    public static function redirect($path)
    {
        header("Location: /$path");
    }

    public static function requestUri()
    {
        return trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
    }

    public static function requestMethod()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    public static function arrToJson(array $arr)
    {
        return json_encode($arr, JSON_UNESCAPED_UNICODE);
    }

    public static function getDialogParam()
    {
        $mySQLite = new MySQLite;
        if(!$mySQLite)
        {
            echo $mySQLite->lastErrorMsg();
        }
        else
        {
            echo "Opened database successfully\n";
            $sql = "SELECT * FROM OPTIONS";
            $ret = $mySQLite->query($sql);
            while ($row = $ret->fetchArray()['dialogStart'])
            {
                return $row;
            }

            if(!$ret)
            {
                echo $mySQLite->lastErrorMsg();
            }
            else
            {
                echo "Success query\n";
            }

            $mySQLite->close();
        }
    }

    public static function setDialogParam($num)
    {
        $mySQLite = new MySQLite;
        if(!$mySQLite)
        {
            echo $mySQLite->lastErrorMsg();
        }
        else
        {
            echo "Opened database successfully\n";
            $sql = "UPDATE OPTIONS SET dialogStart = $num";
            return $ret = $mySQLite->query($sql);

            if(!$ret)
            {
                echo $mySQLite->lastErrorMsg();
            }
            else
            {
                echo "Success query\n";
            }

            $mySQLite->close();
        }
    }
}

