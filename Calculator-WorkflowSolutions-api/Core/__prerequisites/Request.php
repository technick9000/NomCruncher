<?php
namespace __prerequisites;

use Application;

class Request
{

    public static array $_validMethods = array('get','post', 'put','delete');
    public string $_method;


    public function __construct()
    {
        $this->_method =  $this->method();
    }

    public function getPath()
    {


        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path,'?');

        return ($position === false) ? $path : substr($path,$position+1);

    }

    public function method(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function checkMethodType(string $compare_method='')
    {

        if($this->isValidMethod($compare_method))
        {

            return $this->_method === $compare_method;

        }

        return false;
    }

    public function getBody()
    {



        $body = array();
        $_method = $this->method();

        if($this->isValidMethod($_method))
        {

            $body = $this->sanitizeInput($_method);

        }
        else
        {

            Application::$app->response->setStatusCode(405, 'Method Unrecognized');
            echo '405 Method Unrecognized';
            exit;

        }


        return $body;
    }

    public function isValidMethod(string $method='')
    {
        if(is_string($method) && $method!='')
        {

            return in_array($method,self::$_validMethods);

        }

        return false;
    }

    private function sanitizeInput(string $method): array
    {
        $sanitized = array();


        if(is_string($method) && $method !='')
        {

            switch($method)
            {
                //!TODO implement the put(update) and delete methods

                case 'get':

                    foreach($_GET as $_k => $_v)
                    {

                        $sanitized[$_k] = filter_input(INPUT_GET,$_k,FILTER_SANITIZE_SPECIAL_CHARS);

                    }
                    break;
                case 'post':

                    foreach($_POST as $_k => $_v)
                    {

                        $sanitized[$_k] = filter_input(INPUT_POST,$_k,FILTER_SANITIZE_SPECIAL_CHARS);

                    }
                    break;

            }

        }

        return $sanitized;
    }
}


