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
use app\models\CartItems;
use app\models\ProductReview;
use app\models\ForgotPassword;
use app\models\Products;
use app\models\ProductImages;
use app\models\ProductsSearch;
use app\models\ContactUs;
use yii\data\ActiveDataProvider;
use app\models\UserAddresses;


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
        $withoutCSRF = ['cus-login','register','forgotpassword','savecheckout','clearcartlist','removecart', 'addreview','contact','changepassword','addressdelete','testing'];
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
        return $this->redirect('mainpage');
    }
    public function actionMainpage()
    {
        $this->layout = 'mainpage';
        $productsList = Products::find()->where(['!=',  'status', '0'])->limit(5)->orderBy(['id' => SORT_DESC])->all();
        return $this->render('mainpage',["productsList" => $productsList]);
    }

    public function actionProductlist()
    {
        $this->layout = 'mainpage';
        $query = Products::find()->where(['!=',  'status', '0']);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
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

    public function actionQuickview($id)
    {
        //$this->layout = 'mainpage';
        $model = Products::find()->where(['products.id' => $id])->joinWith(['imageslist'])->one();
        return $this->renderAjax('quickview',["products" => $model]);
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

    public function actionPrivacy()
    {
        $this->layout = 'mainpage';
        return $this->render('privacy');
    }

    public function actionTerms()
    {
        $this->layout = 'mainpage';
        return $this->render('terms');
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
            $this->redirect(['customer/indexv1']);
            

        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionForgotpasswordadmin(){
        $model = new ForgotPassword();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('forgotpassword', [
            'model' => $model,
        ]);
    }


    public function actionCusLogin()
    {
        $username = Yii::$app->request->post('username');
        $password = Yii::$app->request->post('password');

        $user = Users::findByUsername($username);
        $data = [];
        if (!$user || (!empty($user) && $user->admin==1)) {
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

    public function actionChangepassword(){
        $username = Yii::$app->user->identity->username;
        $password = Yii::$app->request->post('oldpass');
        $newpassword = Yii::$app->request->post('newpass');

        $user = Users::findByUsername($username);
        $data = [];
        if (!$user->validatePassword($password)) {
            $data['success']=false;
            $data['error']['password']="Invalid password";
            $data['message']="Invalid password";
            return json_encode($data,true);
        }else{
            $users = Yii::$app->user->identity;
            // Set the new password
            $users->setPassword($newpassword);
            if($users->save(false)){
                $data['success']=true;
                return json_encode($data,true);
            }
        }
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
        $model = new ContactUs();
        $this->layout = 'mainpage';
        $model->status = 1;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if($model->save()){
                $email = Yii::$app->params['adminEmail'];
                $email = $model->email; 
                $model->contact(Yii::$app->params['adminEmail']);
                Yii::$app->session->setFlash('contactFormSubmitted');
                //Yii::$app->session->setFlash('success', "Your message to display.");
                return $this->redirect('contact');
            }
           // return $this->refresh();
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

    public function actionTesting()
    {
        $this->layout = 'mainpage';
        return $this->render('testing');
    }

    public function actionCheckout()
    {
        $this->layout = 'mainpage';
        return $this->render('checkout');
    }

    public function actionUsercartcount()
    {
        $cartcount = 0;
        if(!Yii::$app->user->isGuest) {
            $cartcount = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->count();
        } 
        echo $cartcount;
    }

    public function actionSavecheckout()
    {
        $returnData = false;
        if(!Yii::$app->user->isGuest) {
            $loginUserId = Yii::$app->user->identity->id ?? null;
            $productId = $_POST['productId'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;
            $action = $_POST['action'];
            $id = $_POST['id'];
            if($productId !== null){
                $cartItems = CartItems::find()->where(['cart_items.product_id' => $productId, 'status' => 'created', 'created_by' => $loginUserId])->one();
                if(empty($cartItems)) {
                    $cartItems = new cartItems();
                    $cartItems->quantity = $quantity;
                    $cartItems->product_id = $productId;
                    $cartItems->status = 'created';
                    $cartItems->created_by = $loginUserId;
                    $cartItems->created_date = date('Y-m-d H:i:s');
                    $cartItems->save();
                } else {
                    if($action != 'delete'){
                        if($action == 'increment'){
                            $cartItems->quantity = (int)$cartItems->quantity + (int)$quantity;
                        }else{
                            if($action == 'cart'){
                                $cartItems->quantity = (int)$quantity;
                            }else{
                                $cartItems->quantity = (int)$cartItems->quantity + 1;
                            }
                        }
                        $cartItems->save(false);
                    }else{
                        CartItems::findOne(['id' => $id])->delete();
                    }
                }
                $returnData = true;
            } 
        } 
        return json_encode(['data' => $returnData]);
    }

    public function actionAddreview(){
        $productId = $_POST['productId'] ?? null;
        $reviewId = $_POST['reviewId'];
        $comment = $_POST['comment'] ?? null;
        $action = $_POST['action'];
        if($action === 'delete'){
            ProductReview::findOne(['id' => $reviewId])->delete();
            return json_encode(['data' => true]);
        }
        if(!Yii::$app->user->isGuest) {
            $loginUserId = Yii::$app->user->identity->id ?? null;
            if($reviewId !== ''){
                $model = ProductReview::findOne(['id' => $reviewId]);
                $model->review =  $comment;
            }else{
                $model = new ProductReview();
                $model->product_id = $productId;
                $model->user_id = $loginUserId;
                $model->review =  $comment;
                $model->created_by = $loginUserId;
                $model->review_type =  '2';
                $model->status =  '1';
                $model->created_at = time();
            }
            if($model->save(false)){
                return json_encode(['data' => true]);
            }
        }
        return json_encode(['data' => false]);
    }

    public function actionClearcartlist()
    {
        \Yii::$app->db->createCommand()->delete('cart_items', ['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->execute();
        return json_encode(['data' => 'success']);
    }

    public function actionRemovecart()
    {
        $returnData = false;
        $id = $_POST['productId'] ?? null;
        if($id !== null){
            CartItems::findOne(['id' => $id])->delete();
            $returnData = true;
        }
        return json_encode(['data' => $returnData]);
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
        $address = $_POST['address'] ?? null;
        $company = $_POST['company'] ?? null;
        $zipcode = $_POST['zipcode'] ?? null;
        $name_title = $_POST['name_title'] ?? '';
        
        $user = new Users();
        $user->firstname = $firstname;
        $user->lastname = $lastname;
        $user->username = $username;
        $user->email = $email;
        $user->mobile_number = $phoneNumber;
        $user->password = $password;
        $user->gst_number = $gstNumber;
        $user->company = $company;
        $user->status = 10;
        $user->name_title = $name_title;

        if($user->validate()){
            if($user->save()){
                $addresses = new UserAddresses();
                $addresses->address = $address;
                $addresses->user_id = $user->id;
                $addresses->city = "Chennai";
                $addresses->state = "Tamilnadu";
                $addresses->country = "India";
                $addresses->status = 1;
                $addresses->zipcode = $zipcode;
                $addresses->mobile_number = $phoneNumber;
                $addresses->save(false);
                $data = ['success' => true, 'data'=> true];
                $this->sendRegisterMail($user, $password);
            }else{
                $data = ['success' => false, 'data' => $user->getErrors()];
            }
        } else {
            $data = ['success' => false, 'data' => $user->getErrors()];
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
                            <br> UserName : " . $data['username'] . "<br>Password : " . $password .
                            " <br> <br>
                            To login to the system click <a href='" . Yii::$app->urlManager->createAbsoluteUrl('') . "'>here</a> <br><br>
                            If you have any questions, please contact us info@deepwoodsorganics.com
                            <br>
                        </body>
                    </html>";
        $email = \Yii::$app->mailer->compose();
        $email->setFrom([Yii::$app->params['adminEmail'] => 'Deepwoods - Admin']);
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
                            <br> UserName : " . $data['email'] . "<br>Password : " . $password .
                            " <br> <br>
                            To login to the system click <a href='" . Yii::$app->urlManager->createAbsoluteUrl('') . "'>here</a> <br><br>
                            If you have any questions, please contact us info@deepwoodsorganics.com.
                            
                        </body>
                    </html>";
        $email = \Yii::$app->mailer->compose();
        $email->setFrom([Yii::$app->params['adminEmail'] => 'Deepwoods - Admin']);
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

    public function actionForgot_password()
    {
        $model = new ForgotPassword();

    
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Generate a new password reset token
            $user = Users::find()->where(['email' => $model->email])->one();
            if ($user) {
                $password = Yii::$app->getSecurity()->generateRandomString(8);
                $user->password = $password;
                $user->save();
                $data = ['email' => $user->email,'name' => $user->firstname];
                $this->resetmail($data, $password);
                // $user->generatePasswordResetToken();
                // $user->save();

                // // Send password reset email
                // Yii::$app->mailer->compose('passwordResetToken', ['user' => $user])
                //     ->setFrom(Yii::$app->params['adminEmail'])
                //     ->setTo($user->email)
                //     ->setSubject('Password Reset')
                //     ->send();

                Yii::$app->session->setFlash('success', 'Please check your email for instructions on how to reset your password.');
                return $this->redirect(['site/login']);
            } else {
                Yii::$app->session->setFlash('error', 'Email address not found.');
            }
        }

        return $this->render('forgotpassword', [
            'model' => $model,
        ]);
    }

    public function actionRefund_policy()
    {
        $this->layout = 'mainpage';
        return $this->render('refund_policy');
    }

    public function actionAddressdelete()
    {
        $returnData = false;
        $addressId = $_POST['addressId'] ?? null;
        if($addressId !== null){
            $returnData = true;
            $user = UserAddresses::findOne(['id' => $addressId]);
            $user->status = 0;
            $user->save(false);
        }
        return json_encode(['data' => $returnData]);
    }
}
