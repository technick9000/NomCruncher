<?php

namespace Controllers;

use __prerequisites\Request;
use Models\CalcModel;
use Models\ExecutionModel;

class ExecController extends Controller
{
    public function save_equation(Request $request)
    {

        //$params = array();

        if ($request->checkMethodType('post')) {
            $saveCalcModel = new CalcModel();

            $user_data = $request->getBody();



            $saveCalcModel->loadData($user_data);

            $saveCalcModel->saveEquation();

            return json_encode($saveCalcModel, JSON_PRETTY_PRINT | JSON_FORCE_OBJECT);

        }


        return $this->render('home');
    }


}