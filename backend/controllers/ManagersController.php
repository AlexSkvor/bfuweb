<?php

namespace backend\controllers;

class ManagersController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

}
