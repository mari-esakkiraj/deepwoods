<?php

namespace app\controllers;

use app\models\CartItems;
use Yii;

use app\models\Orders;
use app\models\Users;
use app\models\OrderItems;
use app\models\OrderAddresses;
use app\models\OrdersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

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
            ]
        );
    }

    public function beforeAction($action) 
    {
        $withoutCSRF = ['savecheckout'];
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
        $model = $this->findModel($id);

        if ($this->request->isPost) {
            $model->created_at = time();
            $model->created_by = Yii::$app->session->getId();
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        return $this->render('update', [
            'model' => $model,
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

    public function actionSavecheckout()
    {
        $returnData = false;
        if(!Yii::$app->user->isGuest) {
            $loginUserId = Yii::$app->user->identity->id ?? null;
            $productId = $_POST['productId'] ?? null;
            if($productId !== null){
                $cartItems = CartItems::find()->where(['product_id' => $productId, 'status' => 'created', 'created_by' => $loginUserId])->one();
                if(empty($cartItems)) {
                    $cartItems = new cartItems();
                    $cartItems->quantity = 1;
                    $cartItems->product_id = $productId;
                    $cartItems->status = 'created';
                    $cartItems->created_by = $loginUserId;
                    $cartItems->created_date = date('Y-m-d H:i:s');
                    $cartItems->save();
                } else {
                    $cartItems->quantity = $cartItems->quantity + 1;
                    $cartItems->save();
                }
                $returnData = true;
            } 
        } 
        return json_encode(['data' => $returnData]);
    }
    public function actionCartlist()
    {
        $this->layout = 'mainpage';
        $productList = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id])->all();
        return $this->render('cartlist',["dataProvider" => $productList]);
    }
}
