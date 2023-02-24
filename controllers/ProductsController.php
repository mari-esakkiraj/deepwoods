<?php

namespace app\controllers;

use app\models\Products;
use app\models\ProductImages;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\base\Model;

/**
 * ProductsController implements the CRUD actions for Products model.
 */
class ProductsController extends Controller
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

    /**
     * Lists all Products models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Products model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Products();
        $modelImages = [new ProductImages];
        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {
                $modelImages = Model::createMultiple(ProductImages::classname());
                Model::loadMultiple($modelImages, $this->request->post());
                foreach ($modelImages as $index => $modelImage) {
                    $modelImage->image = \yii\web\UploadedFile::getInstance($modelImage, "[{$index}]image");
                    $modelImage->image->saveAs('uploads/' . $modelImage->image->baseName . '.' . $modelImage->image->extension);
                }

                // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelImages) && $valid;
                if ($valid) {
                    foreach ($modelImages as $index => $modelImage) {
                        $modelImage->image = \yii\web\UploadedFile::getInstance($modelImage, "[{$index}]image");
                        $modelImage->image->saveAs('uploads/' . $modelImage->image->baseName . '.' . $modelImage->image->extension);
                    }
                    $transaction = \Yii::$app->db->beginTransaction();
                    $model->status = '1';
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($modelImages as $modelImage) {
                                $modelImage->product_id = $model->id;
                                $modelImage->status = '1';
                                $modelImage->isdesktop = '1';
                                if (($flag = $modelImage->save(false)) === false) {
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
        } else {
            //var_dump($modelImages[0]);die;
            $model->loadDefaultValues();
        }
        
        return $this->render('create', [
            'model' => $model,
            'modelImages' => $modelImages
        ]);
    }

    /**
     * Updates an existing Products model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        //$modelImages = [new ProductImages];
        $modelImages = ProductImages::find()->where(['product_id' => $id])->all();
        if ($this->request->isPost && $model->load($this->request->post())) {
            $modelImages = Model::createMultiple(OptionValue::classname());
            Model::loadMultiple($modelImages, Yii::$app->request->post());
            if ($model->validate()) {
                $model->save();
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'modelImages' => $modelImages
        ]);
    }

    /**
     * Deletes an existing Products model.
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
     * Finds the Products model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Products the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Products::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
