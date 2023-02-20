<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        /*return [
            'authenticator' => [
                'class' => \yii\filters\auth\HttpBearerAuth::class,
                'except' => ['login', 'cus-login'],
            ],
        ];*/

        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionMainpage()
    {
        $this->layout = 'mainpage';
        return $this->render('mainpage');
    }

    public function actionProductlist()
    {
        $this->layout = 'mainpage';
        return $this->render('productlist');
    }

    public function actionProductdetails()
    {
        $this->layout = 'productdetails';
        return $this->render('productlist');
    }

    public function actionAboutus()
    {
        $this->layout = 'about';
        return $this->render('productlist');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    
     public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');

            $user = Users::findByUsername($username);

            if (!$user || !$user->validatePassword($password)) {
                throw new \yii\web\UnauthorizedHttpException('Invalid username or password');
            }

            $user->access_token = Yii::$app->security->generateRandomString();
            $user->save(false);

            return ['access_token' => $user->access_token];
            //return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionCusLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $user = Users::findByUsername($username);

        if (!$user || !$user->validatePassword($password)) {
            throw new \yii\web\UnauthorizedHttpException('Invalid username or password');
        }

        $user->access_token = Yii::$app->security->generateRandomString();
        $user->save(false);

        return ['access_token' => $user->access_token];
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
