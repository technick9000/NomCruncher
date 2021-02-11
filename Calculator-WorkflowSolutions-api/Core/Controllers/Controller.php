<?php


namespace Controllers;


use Application;

class Controller
{
    public string $layout_base = 'main';
    public array $layouts = array();

    public function render($view, array $params = [])
    {

        return Application::$app->router->renderView('home', $params);

    }

    public function setLayouts($layouts,$from_string = true)
    {
        //these are actually components now but too for the sake of it lets move on
        if (is_array($layouts)) {

            if (empty($layout)) {

                $this->layouts = array(
                            array('_placeholder' => '{{$content}}',
                                  '_layout' => $this->layout_base)
                          );

            }
            else
            {

                $this->layouts = $layouts;

            }

        }elseif($from_string && is_string($layouts) && $layouts!='')
        {
            $layouts = trim($layouts); //multiple layout requested sepreated by comma ,

            $break_layouts_rqst = explode(',', $layouts); // each lyaout/component request is broken into the following format Component/Layout name@Viewplaceholder string

            foreach($break_layouts_rqst as $k => $layout_string) {

               $component_name = strstr($layout_string,'@',true );
               $placeholder_string = str_replace('@','', strstr($layout_string,'@'));
               $this->layouts[$k] = array('_placeholder'=>$placeholder_string, '_layout' => $component_name);
            }


        }
        else
        {

            $this->layouts = array();

        }

    }
}