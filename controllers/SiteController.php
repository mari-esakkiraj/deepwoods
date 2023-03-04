<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Users;

use app\models\Products;
use app\models\ProductImages;
use app\models\ProductsSearch;
use yii\data\ActiveDataProvider;


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

    public function beforeAction($action) 
    {
        $withoutCSRF = ['cus-login','register','forgotpassword'];
        if(in_array($action->id, $withoutCSRF)) {
            $this->enableCsrfValidation = false; 
        }
        return parent::beforeAction($action); 
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
        $this->layout = 'mainpage';
        return $this->render('mainpage');
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
        $productsList = Products::find()->all();
        $query = Products::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 1,
            ],
            'sort' => [
                'defaultOrder' => [
                    'created_at' => SORT_DESC,
                ]
            ],
        ]);
        
        // returns an array of Post objects
        //$productsList = $provider->getModels();

        return $this->render('productlist',["dataProvider" => $dataProvider]);
    }

    public function actionProductdetails($id)
    {
        $this->layout = 'mainpage';
        $model = Products::find()->where(['products.id' => $id])->joinWith(['imageslist'])->one();
        return $this->render('productdetails',["products" => $model]);
    }

    public function actionCart()
    {
        $this->layout = 'mainpage';
        return $this->render('cart');
    }

    public function actionAboutus()
    {
        $this->layout = 'mainpage';
        return $this->render('about');
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
            /*$username = Yii::$app->request->post('username');
            $password = Yii::$app->request->post('password');

            $user = Users::findByUsername($username);

            if (!$user || !$user->validatePassword($password)) {
                throw new \yii\web\UnauthorizedHttpException('Invalid username or password');
            }

            $user->access_token = Yii::$app->security->generateRandomString();
            $user->save(false);
            return $this->render('login', [
                'model' => $model,
            ]);
            return ['access_token' => $user->access_token];*/
            $this->redirect(['products/index']);
            

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
        $data = [];
        if (!$user) {
            $data['success']=false;
            $data['error']['username']="Invalid username";
            $data['message']="Invalid username";
            return json_encode($data,true);
        }
        if (!$user->validatePassword($password)) {
            $data['success']=false;
            $data['error']['password']="Invalid password";
            $data['message']="Invalid password";
            return json_encode($data,true);
        }

        $user->access_token = Yii::$app->security->generateRandomString();
        $user->save(false);
        Yii::$app->user->login($user, 3600*24*30);
        $data['success']=true;
        return json_encode($data,true);
        // return ['access_token' => $user->access_token];
    }

    public function actionCusLogout()
    {
        Yii::$app->user->logout();

        $this->redirect('index');
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        $this->redirect('login');
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

    public function actionCheckout()
    {
        $this->layout = 'mainpage';
        return $this->render('checkout');
    }

    public function actionRegister()
    {
        $username = $_POST['userName'] ?? null;
        $firstname = $_POST['firstname'] ?? null;
        $lastname = $_POST['lastname'] ?? null;
        $email = $_POST['email'] ?? null;
        $phoneNumber = $_POST['phoneNumber'] ?? null;
        $password = $_POST['password'] ?? null;
        $gstNumber = $_POST['gstNumber'] ?? null;
        
        $user = new Users();
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->username = $username;
        $user->email = $email;
        $user->mobile_number = $phoneNumber;
        $user->password = $password;
        $user->gst_number = $gstNumber;
        $user->status = 10;

        if($user->validate()){
            $user->save();
            $data = ['data'=> true];
            $this->sendRegisterMail($user, $password);
        } else {
            $data = ['data' => $user->getErrors()];
        }
        return json_encode($data);
    }

    public function sendRegisterMail($data, $password)
    {
        $to = $data['email'];
        $subject = "Your Login information to Deepwoods";
        $message = "<html>
                        <head>
                            <title>Credentials detail</title>
                        </head>
                        <body>
                            Hi <b>" . $data['firstname'] . ",</b><br><br>
                            A login has been created for you to access Deepwoods. Below are your credentials to access the Deepwoods system.
                            <br> username : " . $data['username'] . "<br>password : " . $password .
                            " <br> <br>
                            To login to the system click <a href='" . Yii::$app->urlManager->createAbsoluteUrl('') . "'>here</a> <br><br>
                            If you have any questions, please contact your Deepwoods admin.
                            <br> <br>
                            This is a system generated email. Please do not reply to this email.
                        </body>
                    </html>";
        $email = \Yii::$app->mailer->compose();
        $email->setFrom(['no.reply@deepwoods.com' => 'Login Details - Deepwoods']);
        $email->setTo($to);
        $email->setCharset('UTF-8');
        $email->setSubject($subject);
        $email->setHtmlBody($message);
        $email->send();
        return null;
    }

    public function resetmail($data,$password)
    {
        $to = $data['email'];
        $subject = "Your Reset Password to Deepwoods";
        $message = "<html>
                        <head>
                            <title>Credentials detail</title>
                        </head>
                        <body>
                            Hi <b>" . $data['name'] . ",</b><br><br>
                            Your password has been reset to access Deepwoods. Below are your credentials to access the Deepwoods system.
                            <br> username : " . $data['email'] . "<br>password : " . $password .
                            " <br> <br>
                            To login to the system click <a href='" . Yii::$app->urlManager->createAbsoluteUrl('') . "'>here</a> <br><br>
                            If you have any questions, please contact your Deepwoods admin.
                            <br> <br>
                            This is a system generated email. Please do not reply to this email.
                        </body>
                    </html>";
        $email = \Yii::$app->mailer->compose();
        $email->setFrom(['no.reply@asaltatechnologies.com' => 'Employee - EPTW']);
        $email->setTo($to);
        $email->setCharset('UTF-8');
        $email->setSubject($subject);
        $email->setHtmlBody($message);
        $email->send();
        return null;
    }

    public function actionForgotpassword()
    {
        $email = $_POST['email'] ?? null;
        $user = Users::find()->where(['email' => $email])->one();
        if(empty($user)) {
            $data = ['data'=> 'Email ID is invaild'];
        } else {
            $password = Yii::$app->getSecurity()->generateRandomString(8);
            $user->password = $password;
            $user->save();
            $data = ['email' => $user->email,'name' => $user->firstname];
            $this->resetmail($data, $password);
            $data = ['data'=> true];
        }
       return json_encode($data);

    }
}
