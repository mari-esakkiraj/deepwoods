<?php 
namespace app\controllers;
use yii\web\Controller;

class ProfileController extends Controller
{
    public $layout = 'mainpage';
    public function actionIndex()
    {
        return $this->render('index');
    }
}

