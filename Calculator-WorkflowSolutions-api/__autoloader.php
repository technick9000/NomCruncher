<?php

    /*

        This is our class autoloader since the original __autoloader is depracated since PHP 5 i belive it was
        and for scalability with the everchanging versions its better to use <PSR-4> rather than PSR-0
        __autoload original PHP func is no longer supported and will be removed in the future

        Our autoloader uses namespaces so we can have our class structure in different directories if we want
        rather than having them bunched up in one Classes directory

        !IMPORTANT with each new class its important to now declare its namespace or make use of the use declarations :) (if in VS Code Better comments ext highlights this)
    */

    if(!function_exists('__autoloader')){

        function __autoloader($class){

            //get
            $classFile = '../Core/'.__NAMESPACE__.$class.'.php';



            (is_file($classFile) && !class_exists($class)) ? include_once $classFile : http_response_code(500);

        }

    }


    spl_autoload_register(__NAMESPACE__.'__autoloader');
?>