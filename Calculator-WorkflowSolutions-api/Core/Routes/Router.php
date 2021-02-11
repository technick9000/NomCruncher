<?php

namespace Routes;

use __prerequisites\Request;
use __prerequisites\Response;
use Application;
use http\Exception;

class Router
{
    public array $routes = [];
    public Request $request;
    public Response $response;

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }


    public function get($path, $callback)
    {
        $this->routes['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }

    public function resolve()
    {

        $path = $this->request->getPath();
        $method = $this->request->method();

        if (is_null($method)) {

            $this->defaultRequestHandler();

        }

        $callback = $this->routes[$method][$path] ?? false;


        if ($callback === false) {

            //$this->invalidMethodHandler();
            $this->response->setStatusCode(405, 'Method Not Allowed');
            return $this->renderView("_405");
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if(is_array($callback))
        {

            Application::$app->controller = new $callback[0]();
            $callback[0] = Application::$app->controller;
        }

        return call_user_func($callback, $this->request);
    }

    private function invalidMethodHandler()
    {

        Application::$app->response->setStatusCode(405, 'Method Not Allowed');

        exit;
    }

    private function defaultRequestHandler()
    {

        Application::$app->response->setStatusCode();

        exit;

    }

    public function renderView($view, array $params = [])
    {
        //$baseViewPath = Application::$ROOT_DIR . '\Views\\';
        //$_avn = $baseViewPath . $view . '.php';
        $final_view='';
        $view_content = '';

        $layout_content = $this->layoutContent();
        $view_content = $this->renderOnlyView($view, $params);

        //!TODO if multiple layouts called in = DONE
        //!TODO handling of non existent placeholders or components/layouts

      foreach ($layout_content as $_k => $layout)
      {

          $view_content = str_replace($layout['_placeholder'], $layout['_content'], $view_content);
          $final_view = $view_content;
      }
        return $final_view;
    }

    protected function renderOnlyView($view, array $params = [])
    {

        if (is_array($params)) {

            foreach($params as $_k => $_v) {

                $$_k = $_v;

            }
        }

        $baseViewPath = Application::$ROOT_DIR . '\Views\\';
        $_avn = $baseViewPath . $view . '.php';


        if (file_exists($_avn)) {
            ob_start();
            include_once($_avn);
            return ob_get_clean();

        } else {
            Application::$app->response->setStatusCode(404, 'Can not read View! View does not exist or wrong');
            echo 'Can not read View! View does not exist or can not read';
            exit;

        }

    }

    protected function layoutContent()
    {

        $baseViewPath = Application::$ROOT_DIR . '\Views\layouts\\';
        $layouts = Application::$app->controller->layouts;



        if (empty($layouts))
        {

            $layouts = array(
                array('_placeholder' => '{{content}}',
                    '_layout' => Application::$app->controller->layout_base)
            );

        }

        foreach($layouts as $_k => $layout)
        {
            $_lyn = $baseViewPath . $layout['_layout'] .'.php';

            $layouts[$_k]['_content'] = file_get_contents($_lyn);
        }


        return $layouts;
    }

    private function renderContent($viewContent)
    {


        $layout_content = $this->layoutContent();
        //!TODO if multiple layouts called in
        return str_replace("{{content}}", $layout_content, $viewContent);

    }
}