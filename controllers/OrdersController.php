<?php

namespace app\controllers;

use app\models\CartItems;
use Yii;

use app\models\Orders;
use app\models\Users;
use app\models\OrderItems;
use app\models\OrderAddresses;
use app\models\UserAddresses;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\web\Response;
use app\base\Model;
use yii\widgets\ActiveForm;
use yii\filters\AccessControl;
use Razorpay\Api\Api;
use app\models\Settings;
use Razorpay\Api\Errors\SignatureVerificationError;

/**
 * OrdersController implements the CRUD actions for Orders model.
 */
class OrdersController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ],
            [
                'access' => [
                    'class' => AccessControl::className(),
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                            'matchCallback' => function ($rule, $action) {
                                if(!Yii::$app->user->identity->admin) {
                                    return true;
                                }
                                return false;
                            }
                        ],
                        [
                            'actions' => ['cartlist','checkout', 'payment', 'verify'],
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
            ]
        );
    }

    public function beforeAction($action) 
    {
        $withoutCSRF = ['savecheckout','removecart', 'verify', 'payment'];
        if (in_array($action->id, $withoutCSRF)) {
            $this->enableCsrfValidation = false; 
        }
        return parent::beforeAction($action); 
    }

    /**
     * Lists all Orders models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Orders model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $items = OrderItems::find()->where(['order_id' => $id])->all();
        $addresses = OrderAddresses::find()->where(['order_id' => $id])->one();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'items' => $items,
            'addresses' => $addresses
        ]);
    }

    /**
     * Creates a new Orders model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Orders();

        if ($this->request->isPost) {
            $model->created_at = time();
            $model->created_by = \Yii::$app->session->getId();
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Orders model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $modelsItems = OrderItems::find()->where(["order_id" => $id])->all();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsItems, 'id', 'id');
            $modelsItems = Model::createMultiple(OrderItems::classname(), $modelsItems);
            Model::loadMultiple($modelsItems, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsItems, 'id', 'id')));
            $model->created_at = time();
            $model->created_by = Yii::$app->session->getId();
            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsItems),
                    ActiveForm::validate($model)
                );
            }
            // validate all models
            $valid = $model->validate();
            //var_dump($valid);
            $valid = Model::validateMultiple($modelsItems) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (! empty($deletedIDs)) {
                            OrderItems::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsItems as $modelsItem) {
                            $modelsItem->order_id = $model->id;
                            if (! ($flag = $modelsItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsItems' => (empty($modelsItems)) ? [new OrderItems] : $modelsItems
        ]);
    }

    /**
     * Deletes an existing Orders model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Orders model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Orders the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Orders::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionLists($id)
    {				
        $posts = UserAddresses::find()
				->where(['user_id' => $id])
				->orderBy('id DESC')
				->all();
				
		if (!empty($posts)) {
			foreach($posts as $post) {
				echo "<option value='".$post->id."'>".$post->address.",".$post->city.",".$post->state.",".$post->country."-".$post->zipcode  ."</option>";
			}
		} else {
			echo "<option>-</option>";
		}
		
    }

    public function actionCartlist()
    {
        $this->layout = 'mainpage';
        $productList = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->all();
        return $this->render('cartlist',["dataProvider" => $productList]);
    }

    public function actionCheckout()
    {
        $this->layout = 'mainpage';
        $cartItems = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->all();
        $totalPrice = 0;
        $productQuantity = count($cartItems);
        foreach ($cartItems as $productList) {
            $totalPrice+=($productList->product->price * $productList->quantity);
            //$productQuantity+=$productList->quantity;
        }
        $gst = 0;
        $setting = Settings::findOne(1);
        if (!empty($setting)) {
            $gst = $setting->gst;
        }

        $orderAddress = UserAddresses::find()->where(['user_id' => Yii::$app->user->identity->id,'type' => 'shipping'])->one();
        if(empty($orderAddress)) {
            $orderAddress = new OrderAddresses();
        }else{
            $order->shipping_address_id = $orderAddress->id;
        }

        $order = new Orders();
        $order->firstname = Yii::$app->user->identity->firstname;
        $order->lastname = Yii::$app->user->identity->lastname;
        $order->email = Yii::$app->user->identity->email;
        $order->total_price = $totalPrice;
        $order->status = 0;
        $order->created_at = time();
        $order->created_by = Yii::$app->user->identity->id;
        $order->customer_id = Yii::$app->user->identity->id;
        $order->phone = Yii::$app->user->identity->mobile_number;

        
        $transaction = Yii::$app->db->beginTransaction();
        if ($order->load(Yii::$app->request->post())
            && $order->save()
            && $order->saveOrderItems()) {
            $transaction->commit();
            CartItems::deleteAll(['created_by' => Yii::$app->user->identity->id]);
            $keyId = 'rzp_test_837Iw9MVhmAj9z';
            $keySecret = 'PcntHmmtBWoM2te93AIt2Uh7';
            $displayCurrency = 'INR';
            
            $api = new Api($keyId, $keySecret);
            
            $orderData = [
                'receipt'         => 'DW00'.$order->id,
                'amount'          => $totalPrice*100, // 2000 rupees in paise
                'currency'        => 'INR',
                'payment_capture' => 1 // auto capture
            ];
            
            $razorpayOrder = $api->order->create($orderData);
            
            $razorpayOrderId = $razorpayOrder['id'];
            
            $_SESSION['razorpay_order_id'] = $razorpayOrderId;
            
            $displayAmount = $amount = $orderData['amount'];
            
            if ($displayCurrency !== 'INR')
            {
                $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
                $exchange = json_decode(file_get_contents($url), true);
            
                $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
            }

            $data = [
                "key"               => $keyId,
                "amount"            => $amount,
                "name"              => "DeepWoods",
                /*"description"       => "Tron Legacy",
                "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",*/
                "prefill"           => [
                "name"              => "DeepWoods",
                "email"             => "customer@deepwoods.com",
                //"contact"           => "9999999999",
                ],
                "notes"             => [
                "address"           => "Hello World",
                "merchant_order_id" => $order->id,
                ],
                "theme"             => [
                "color"             => "#F37254"
                ],
                "order_id"          => $razorpayOrderId,
                'tax'=>100
            ];
            $order->transaction_id = $razorpayOrderId;
            $order->save();
            if ($displayCurrency !== 'INR')
            {
                $data['display_currency']  = $displayCurrency;
                $data['display_amount']    = $displayAmount;
            }
            
            $json = json_encode($data);

            return $this->render('payment',["json" => $json, 'order' => $order, 'orderAddress' => $orderAddress,
            'productQuantity' => $productQuantity,
            'totalPrice' => $totalPrice
        ]);
        }
        return $this->render('checkout',[
            'order' => $order,
            'orderAddress' => $orderAddress,
            'cartItems' => $cartItems,
            'productQuantity' => $productQuantity,
            'totalPrice' => $totalPrice
        ]);
    }

    public function actionPayment()
    {   
        $keyId = 'rzp_test_837Iw9MVhmAj9z';
        $keySecret = 'PcntHmmtBWoM2te93AIt2Uh7';
        $displayCurrency = 'INR';

        //$this->layout = false;
        $productLists = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->all();
        $amount = 0;
        foreach ($productLists as $productList) {
            $amount+=($productList->product->price * $productList->quantity);
        }
        $api = new Api($keyId, $keySecret);
        $setting = Settings::findOne(1);
        if (!empty($setting)) {
            $gst = $setting->gst;
        }
        $orderData = [
            'receipt'         => 3456,
            'amount'          => $amount*100, // 2000 rupees in paise
            'currency'        => 'INR',
            'payment_capture' => 1 // auto capture
        ];
        
        $razorpayOrder = $api->order->create($orderData);
        
        $razorpayOrderId = $razorpayOrder['id'];
        
        $_SESSION['razorpay_order_id'] = $razorpayOrderId;
        
        $displayAmount = $amount = $orderData['amount'];
        
        if ($displayCurrency !== 'INR')
        {
            $url = "https://api.fixer.io/latest?symbols=$displayCurrency&base=INR";
            $exchange = json_decode(file_get_contents($url), true);
        
            $displayAmount = $exchange['rates'][$displayCurrency] * $amount / 100;
        }

        $data = [
            "key"               => $keyId,
            "amount"            => $amount,
            "name"              => "DJ Tiesto",
            "description"       => "Tron Legacy",
            "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
            "prefill"           => [
            "name"              => "Daft Punk",
            "email"             => "customer@merchant.com",
            "contact"           => "9999999999",
            ],
            "notes"             => [
            "address"           => "Hello World",
            "merchant_order_id" => "12312321",
            ],
            "theme"             => [
            "color"             => "#F37254"
            ],
            "order_id"          => $razorpayOrderId,
            'tax'=>100
        ];
        
        if ($displayCurrency !== 'INR')
        {
            $data['display_currency']  = $displayCurrency;
            $data['display_amount']    = $displayAmount;
        }
        
        $json = json_encode($data);

        return $this->render('payment',["json" => $json]);
    }

    public function actionVerify()
    {
        $this->enableCsrfValidation = false;
        $success = true;
        $keyId = 'rzp_test_837Iw9MVhmAj9z';
        $keySecret = 'PcntHmmtBWoM2te93AIt2Uh7';
        $displayCurrency = 'INR';
        $error = "Payment Failed";

        if (empty($_POST['razorpay_payment_id']) === false)
        {
            $api = new Api($keyId, $keySecret);

            try
            {
                // Please note that the razorpay order ID must
                // come from a trusted source (session here, but
                // could be database or something else)
                $attributes = array(
                    'razorpay_order_id' => $_SESSION['razorpay_order_id'],
                    'razorpay_payment_id' => $_POST['razorpay_payment_id'],
                    'razorpay_signature' => $_POST['razorpay_signature']
                );

                $api->utility->verifyPaymentSignature($attributes);
            }
            catch(SignatureVerificationError $e)
            {
                $success = false;
                $error = 'Razorpay Error : ' . $e->getMessage();
            }
        }

        if ($success === true)
        {
            $html = "<p>Your payment was successful</p>
                    <p>Payment ID: {$_POST['razorpay_payment_id']}</p>";
            //$productList = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->deleteAll();
        }
        else
        {
            $html = "<p>Your payment failed</p>
                    <p>{$error}</p>";
        }

        //echo $html;

        $this->layout = 'mainpage';
        
        return $this->render('verify',["success" => $success, 'message' => $html]);
    }
}
