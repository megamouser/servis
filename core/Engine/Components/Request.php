<?php
namespace Core\Engine\Components;

class Request
{
    public $method;
    public $url;
    public $jsonBody;

    public function __construct($method, $url, $jsonBody = '')
    {
        $this->method = $method;
        $this->url = $url;
        $this->jsonBody = $jsonBody;
    }

    public function send()
    {
        if($this->method == 'POST')
        {
            $options = stream_context_create(['http' => [
                'method' => $this->method,
                'header' => 'Content-type: application/json',
                'content' => $this->jsonBody
            ]]);

            $result = file_get_contents($this->url, false, $options);
            return $result;
        }
        else
        {
            $result = json_decode(file_get_contents($this->url));
            return $result;
        }
    }
    
}