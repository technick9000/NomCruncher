<?php
/* Include ALL important Packages */

use Controllers\SiteController;
use Controllers\ExecController;



foreach(glob("../Core/__prerequisites/*.php") as $prq)
    {

        require_once($prq);

    }

    $root = dirname(getcwd()).'\Core';

    $app = new Application($root);

    $app->router->get('/', [SiteController::class, 'home']);

    $app->router->get('/prev-calc', function (){
        return 'JSON dump Previous calculations here';
    });

    $app->router->post('/calc', [ExecController::class, 'save_equation']);

    //home form test just so we can see the post is working, otherwise monster cruncher will not crunch ;)
    $app->router->post('/home-form-test', [SiteController::class, 'handleHomeTest']);


        $app->run();
//var_dump(phpinfo()); 7.4.9