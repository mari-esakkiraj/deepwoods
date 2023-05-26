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
use app\models\Promotion;
use kartik\mpdf\Pdf;

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
                            'actions' => ['cartlist','checkout', 'payment', 'verify', 'applycoupon', 'vieworder', 'vieworderv1','pdfreport'],
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
        $withoutCSRF = ['savecheckout','removecart', 'verify', 'payment', 'applycoupon'];
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
        if (empty($cartItems)) {
            return $this->redirect(['site/productlist']);
        }
        $notavilableproduct = [];
        
        $totalPrice = 0;
        $productQuantity = count($cartItems);
        $product_gst = [];
        foreach ($cartItems as $productList) {
            $totalPrice+=($productList->product->price * $productList->quantity);
            $product_gst[$productList->product->id] = 0;
            if($productList->product->gst !=0 && $productList->product->gst != null){
                $product_gst[$productList->product->id] = ($productList->product->price * $productList->quantity) * ($productList->product->gst / 100);
            }
            if ($productList->quantity > $productList->product->quantity) {
                $notavilableproduct[$productList->product->id] = ['available' => $productList->product->quantity];
            }
            //$productQuantity+=$productList->quantity;
        }

        $product_price = $totalPrice;
        $setting = Settings::findOne(1);
        $gst = 0;
        $gstenable = false;
        $gst_amount = 0;
        if (!empty($setting)) {
            $gst = $setting->gst;
        }
        if ($gst>0) {
            $gstenable = true;
            $gst_amount = $product_price * ($gst / 100);
            $totalPrice+=$gst_amount;
        }
        
        if (array_sum($product_gst)>0) {
            $totalPrice+=array_sum($product_gst);
        }

        $freight_charges = 0;
        $freight_chargesenable = false;
        $freight_amount = 0;
        if (!empty($setting)) {
            $freight_charges = $setting->freight_charges;
        }
        if ($freight_charges>0) {
            $freight_chargesenable = true;
            $freight_amount = $product_price * ($freight_charges / 100);
            $totalPrice+=$freight_amount;
        }

        

        $order = new Orders();

        

        $orderAddress = UserAddresses::find()->where(['user_id' => Yii::$app->user->identity->id,'type' => 'shipping'])->one();
        if(empty($orderAddress)) {
            $orderAddress = new UserAddresses();
        }

        
        $order->firstname = Yii::$app->user->identity->firstname;
        $order->lastname = Yii::$app->user->identity->lastname;
        $order->email = Yii::$app->user->identity->email;
        $order->total_price = $totalPrice;
        $order->products_gst_price = array_sum($product_gst);
        if (isset($_POST['promotion_id']) && $_POST['promotion_id']!='') {
            $promotion = Promotion::findOne($_POST['promotion_id']);
            if(!empty($promotion)) {
                $order->promotion_price = 0;
                if($promotion->discount_type == 'Flat') {
                    $order->promotion_price = $promotion->price;
                }
                if($promotion->discount_type == 'Percentage') {
                    $order->promotion_price = round(($product_price*$promotion->price)/100, 2);
                }

                $order->total_price = $totalPrice - $order->promotion_price;
            }
            
        }
        $order->gst = $gst_amount;
        $order->freight_charges = $freight_amount;
        $order->product_price = $product_price;
        $order->status = 0;
        $order->created_at = time();
        $order->created_by = Yii::$app->user->identity->id;
        $order->customer_id = Yii::$app->user->identity->id;
        $order->phone = Yii::$app->user->identity->mobile_number;

        $cashondelivery = 0;
        if (isset($_POST['cashondelivery']) && $_POST['cashondelivery']=='1') {
            $cashondelivery = 1;
            $order->cashondelivery = 1;
        }
        
        $transaction = Yii::$app->db->beginTransaction();
        if (empty($notavilableproduct)) {
            if ($order->load(Yii::$app->request->post())
                && $order->save()
                && $order->saveOrderItems()) {
                    
                if(!isset($orderAddress->id)){
                    $orderAddress->load(Yii::$app->request->post());
                    $orderAddress->user_id = Yii::$app->user->identity->id;
                    $orderAddress->save(false);
                    $order->shipping_address_id = $orderAddress->id;
                }
                $orderAddress = UserAddresses::find()->where(
                        [
                            'id' => $order->shipping_address_id
                        ]
                    )->one();
                $transaction->commit();
                //CartItems::deleteAll(['created_by' => Yii::$app->user->identity->id]);

                /*if ($cashondelivery==1) {
                    $order->status = 1;
                    $order->paypal_order_id = 'DW00'.$order->id;
                    $html = "<p>Your payment was successful</p>
                            <p>Payment ID: {$order->paypal_order_id}</p>";
                    $order->save();
                    $this->layout = 'mainpage';
            
                    return $this->render('verify',["success" => $success, 'message' => $html]);
                }*/

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
                $order->save(false);
                if ($displayCurrency !== 'INR')
                {
                    $data['display_currency']  = $displayCurrency;
                    $data['display_amount']    = $displayAmount;
                }
                
                $json = json_encode($data);

                $order_count = Orders::find()->where(['customer_id' => Yii::$app->user->identity->id])->count();

                return $this->render('payment',["json" => $json, 'order' => $order, 'orderAddress' => $orderAddress,
                    'productQuantity' => $productQuantity,
                    'totalPrice' => $totalPrice,
                    'gstenable' => $gstenable,
                    'gst' => $gst,
                    'freight_chargesenable' => $freight_chargesenable,
                    'freight_charges' => $freight_charges,
                    'product_price' => $product_price,
                    'gst_amount' => $gst_amount,
                    'freight_amount' => $freight_amount,
                    'order_count' => $order_count,
                    'product_gst' => $product_gst
                ]);
            }
        }
        //echo "aa";die;
        return $this->render('checkout',[
            'order' => $order,
            'orderAddress' => $orderAddress,
            'cartItems' => $cartItems,
            'productQuantity' => $productQuantity,
            'totalPrice' => $totalPrice,
            'gstenable' => $gstenable,
            'gst' => $gst,
            'freight_chargesenable' => $freight_chargesenable,
            'freight_charges' => $freight_charges,
            'product_price' => $product_price,
            'gst_amount' => $gst_amount,
            'freight_amount' => $freight_amount,
            'notavilableproduct' => $notavilableproduct,
            'product_gst' => $product_gst
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
        $gst = 0;
        $gstenable = false;
        if (!empty($setting)) {
            $gst = $setting->gst;
        }
        if ($gst>0) {
            $gstenable = true;
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
        $order_count = Orders::find()->where(['customer_id' => Yii::$app->user->identity->id])->count();

        return $this->render('payment',["json" => $json, 'order_count' => $order_count]);
    }

    public function actionApplycoupon(){
        $returnData = ['success'=>false];
        $coupon_code=$_POST['coupon_code'];
        $product_price=$_POST['product_price'];
        if ($coupon_code!= '') {
            $promotion = Promotion::find()->where(['name' => $coupon_code])->andWhere(['promotion_type' => 'coupon'])->andWhere(['user_id' => Yii::$app->user->identity->id])->one();
            if (!empty($promotion)) {
                $returnData['success'] = true;
                $returnData['promotion_id'] = $promotion->id;
                $returnData['promotion_code'] = $coupon_code;
                if($promotion->discount_type == 'Flat') {
                    $returnData['promotion_price'] = $promotion->price;
                }
                if($promotion->discount_type == 'Percentage') {
                    $returnData['promotion_price'] = round(($product_price*$promotion->price)/100, 2);
                }
            }
        }
        
        return json_encode(['data' => $returnData]);
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
        if (isset($_POST['order_id']) && $_POST['order_id'] != '') {
            $order_id = $_POST['order_id'];
            $order = Orders::findOne($order_id);
        }
        else {
            $order = Orders::find()->where(['transaction_id' => $_SESSION['razorpay_order_id']])->one();
        }
        if ($order->status != '0') {
            $this->layout = 'mainpage';
            return $this->render('vieworder',["success" => "", 'message' => "", 'order' => $order]);
        }
        if ($success === true)
        {
            $order->status = 1;
            $order->paypal_order_id = $_POST['razorpay_payment_id'];
            $html = "<div class='alert alert-success'>Your payment was successful and Your Payment ID: <b>{$_POST['razorpay_payment_id']}</b></div>";
            $order->save(false);

            foreach ($order->orderItems as $item) {
                $item->product->quantity = $item->product->quantity - $item->quantity;
                $item->product->save();
            }

            CartItems::deleteAll(['created_by' => Yii::$app->user->identity->id]);
            //echo $html;
    
            $this->layout = 'mainpage';
            
            return $this->render('vieworder',["success" => $success, 'message' => $html, 'order' => $order]);
            //$productList = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->deleteAll();
        }
        else
        {
            $order->status = 2;
            $order->paypal_order_id = $_POST['razorpay_payment_id'];
            
            $html = "<p>Your payment failed</p>
                    <p>{$error}</p>";

            /*$items = OrderItems::find()->where(['order_id' => $order->id])->all();
            foreach ($items as $item) {
                $cartItems = new cartItems();
                $cartItems->quantity = $item->quantity;
                $cartItems->product_id = $item->quantity;
                $cartItems->status = 'created';
                $cartItems->created_by = Yii::$app->user->identity->id;
                $cartItems->created_date = date('Y-m-d H:i:s');
                $cartItems->save();
            }*/
        }
        $order->save();

        //echo $html;

        $this->layout = 'mainpage';
        
        return $this->render('verify',["success" => $success, 'message' => $html]);
    }

    public function actionVieworder($id){
        $html = "";
        $order = Orders::findOne($id);

        $this->layout = 'mainpage';
        
        return $this->render('vieworder',["success" => "", 'message' => $html, 'order' => $order]);
        
    }

    public function actionVieworderv1($id){
        $html = "";
        $order = Orders::findOne($id);

        //$this->layout = 'mainpage';
        
        return $this->render('vieworder',["success" => "", 'message' => $html, 'order' => $order]);
        
    }

    public function actionSendordermail($order_id){
        if(!empty($order_id)) {
            $model = $this->findModel($order_id);
            if(!empty($model)) {
                $setting = Settings::findOne(1);
                $items = OrderItems::find()->where(['order_id' => $id])->all();

                $to = $model->email; 
                $from = $setting->company_email; 
                $fromName = $setting->company_name; 
                
                $subject = "Your order total amount is Rs.".$model->total_price; 
                $htmlContent = ' 
        <html> 
        <head> 
            <title>Your order</title> 
        </head> 
        <body> 
                <h1>Thanks you for ordering '.$fromName.'</h1> 
            <table cellspacing="0" style="border: 2px dashed #FB4314; width: 100%;"> 
                <tr> 
                    <th>Product Name:</th><th>Quantity</th> <th>Unit Price</th> 
                </tr> ';
                if(!empty($items)) {
                    foreach($items as $item){
                        $htmlContent = '     
                        <tr style="background-color: #e0e0e0;"> 
                            <td>'.$item->product_name.'</td><td>'.$item->quantity.'</td> <td>'.$item->unit_price.'</td> 
                        </tr> ';
                    }
                }
                $htmlContent = '     
                        <tr style="background-color: #e0e0e0;"> 
                            <th colspan="2">Total:</th><td>'.$model->total_price.'</td> 
                        </tr> 
                        </table> 
                </body> 
                </html>'; 
                 // Set content-type header for sending HTML email 
            $headers = "MIME-Version: 1.0" . "\r\n"; 
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
            
            // Additional headers 
            $headers .= 'From: '.$fromName.'<'.$from.'>' . "\r\n"; 
            $headers .= 'Cc: welcome@example.com' . "\r\n"; 
            $headers .= 'Bcc: welcome2@example.com' . "\r\n"; 
            
            // Send email 
            if(mail($to, $subject, $htmlContent, $headers)){ 
                echo 'Email has sent successfully.'; 
            }else{ 
                echo 'Email sending failed.'; 
            }
            }
        
        }
           
    }

    public function actionPdfreport($id, $destination='print') {
        $order = Orders::findOne($id);
        $content = $this->renderPartial('pdforder',['order' => $order]);
        if($destination === 'print') {
            $destination = "I";
        } else {
            $destination = "D";
        }
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => $destination, 
            // your html content input
            'content' => $content,//$content,  
            'filename' => 'Invoice ' . time() . '.pdf',
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Invoice Pdf'],
             // call mPDF methods on the fly
            'methods' => [ 
                //'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
        ]);
        
        // return the pdf output as per the destination setting
        return $pdf->render(); 
    }
}