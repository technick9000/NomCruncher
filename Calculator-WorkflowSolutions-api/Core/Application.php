<?php

use Controllers\Controller;
use Routes\Router;
use __prerequisites\Request;
use __prerequisites\Response;

class Application
{
    public Request $request;
    public Router $router;
    public Response $response;
    public Controller $controller;
    public Database $db;
    public static Application $app;


    public static string $ROOT_DIR;

    /**
     * Application constructor.
     * @param app
     */
    public function __construct($rootPath)
    {

        self::$app = $this;
        self::$ROOT_DIR = $rootPath;
        $this->response = new Response();
        $this->request = new Request();
;       $this->router = new Router($this->request, $this->response);
        $this->db = new Database();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     * @return Application
     */
    public function setController(Controller $controller): Application
    {
        $this->controller = $controller;
        return $this;
    }


    public function run(){
        //!TODO
       echo $this->router->resolve();
    }

}