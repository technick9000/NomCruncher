<?php
namespace Controllers;

use __prerequisites\Request;

class SiteController extends Controller
{
    public function home()
    {

        $params = array('__author_name'=>'Nikolay Kremenliev');

        $this->setLayouts('main@{{content}},main@{{content2}}',true);

        return $this->render('home',$params);
    }

    public function handleHomeTest(Request $request)
    {

        $request->getBody();

    }
}