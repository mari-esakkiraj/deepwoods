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
                                if(Yii::$app->user->identity->admin !=1) {
                                    return false;
                                }
                                return true;
                            }
                        ]
                    ],
                ],
            ]
        );
    }

    public function beforeAction($action) 
    {
        $withoutCSRF = ['savecheckout','removecart'];
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
                    $cartItems->quantity = 1;
                    $cartItems->product_id = $productId;
                    $cartItems->status = 'created';
                    $cartItems->created_by = $loginUserId;
                    $cartItems->created_date = date('Y-m-d H:i:s');
                    $cartItems->save();
                } else {
                    if($action != 'delete'){
                        if($action == 'increment'){
                            $cartItems->quantity = $quantity;
                        }else{
                            $cartItems->quantity = $cartItems->quantity + 1;
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
    public function actionCartlist()
    {
        $this->layout = 'mainpage';
        $productList = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->all();
        return $this->render('cartlist',["dataProvider" => $productList]);
    }

    public function actionUsercartcount()
    {
        $cartcount = 0;
        if(!Yii::$app->user->isGuest) {
            $productList = CartItems::find()->where(['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->all();
            $cartcount = count($productList);
        } 
        return json_encode(['data' => $cartcount]);
    }

    public function actionClearcartlist()
    {
        $this->layout = 'mainpage';
        \Yii::$app->db->createCommand()->delete('cart_items', ['created_by' => Yii::$app->user->identity->id, 'status' => 'created'])->execute();
        return $this->redirect(['cartlist']);
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
}
