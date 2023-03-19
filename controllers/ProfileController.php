<?php 
namespace app\controllers;

use app\models\Users;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;

class ProfileController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if(!Yii::$app->user->identity->admin) {
                                return true;
                            }
                            return false;
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    $this->redirect("@web/");
                }
            ]
        ];
    }

    public function beforeAction($action) 
    {
        $withoutCSRF = ['profile-update'];
        if(in_array($action->id, $withoutCSRF)) {
            $this->enableCsrfValidation = false; 
        }
        return parent::beforeAction($action); 
    }

    public $layout = 'mainpage';
    public function actionIndex()
    {
        $userID = null;
        if (!Yii::$app->user->isGuest) {
            $userID = Yii::$app->user->identity->id ?? null;
        }
        $user = Users::find()->where(['id' => $userID])->one();
       
        return $this->render('index', ['user' => $user]);
    }

    public function actionProfileUpdate()
    {
        $fname = Yii::$app->request->post('fname') ?? null;
        $lname = Yii::$app->request->post('lname') ?? null;
        $userID = Yii::$app->user->identity->id;
        $user = Users::find()->where(['id' => $userID])->one();
        if(!empty($user)) {
            $user->firstname = $fname;
            $user->lastname = $lname;
            $user->save(false);
            return true;
        } else {
            return false;
        }
    }
}

