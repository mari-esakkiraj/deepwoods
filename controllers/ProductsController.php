<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use app\models\Products;
use app\models\ProductImages;
use app\models\ProductsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\base\Model;
use yii\helpers\ArrayHelper;
use yii\web\UploadedFile;

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
        $modelImages = ProductImages::find()->where(['product_id' => $id])->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelImages' => $modelImages
        ]);
    }

    /**
     * Creates a new Products model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreateold()
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
            'modelImages' => $modelImages,
            'modelImagees' => []
        ]);
    }

    public function actionCreate()
    {
        $model = new Products();
        $modelImages = [new ProductImages];
        
        if ($this->request->isPost) {
            /*$model->load($this->request->post());
            $model->image = UploadedFile::getInstances($model, 'image');
            if ($model->validate()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }*/
            if (Yii::$app->request->isPost) {
                $model->load($this->request->post());
                $model->image = UploadedFile::getInstances($model, 'image');
                //var_dump($model->image);die;
                if ($model->validate() && $model->image) {
                    $filenames = [];
                    foreach ($model->image as $file) {
                        $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                        $filenames[] = $file->baseName . '.' . $file->extension;
                    }
                    $model->image = json_encode($filenames);
                    $transaction = \Yii::$app->db->beginTransaction();
                    $model->status = '1';
                    try {
                        if ($flag = $model->save(false)) {
                            foreach ($filenames as $filename) {
                                $modelImage = new ProductImages();
                                $modelImage->image = $filename;
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
            $model->image = '';
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelImages' => $modelImages,
            'modelImagees' => []
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
        $modelImages = [new ProductImages];
        
        if ($this->request->isPost) {
            /*$model->load($this->request->post());
            $model->image = UploadedFile::getInstances($model, 'image');
            if ($model->validate()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }*/
            if (Yii::$app->request->isPost) {
                $image = $model->image;
                $model->load($this->request->post());
                $model->image = UploadedFile::getInstances($model, 'image');
                //var_dump($model->image);die;
                if ($model->validate() && $model->image) {
                    $filenames = [];
                    foreach ($model->image as $file) {
                        $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
                        $filenames[] = $file->baseName . '.' . $file->extension;
                    }
                    $model->image = json_encode($filenames);
                    $transaction = \Yii::$app->db->beginTransaction();
                    $model->status = '1';
                    try {
                        if ($flag = $model->save(false)) {
                            ProductImages::deleteAll(['product_id'=>$model->id]);
                            foreach ($filenames as $filename) {
                                $modelImage = new ProductImages();
                                $modelImage->image = $filename;
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
                $model->image = $image;
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'modelImages' => $modelImages,
            'modelImagees' => []
        ]);
    }
    public function actionUpdateold($id)
    {
        $model = $this->findModel($id);
        $modelImages = [new ProductImages];
        $modelImagees = ProductImages::find()->where(['product_id' => $id])->all();
        if ($this->request->isPost && $model->load($this->request->post())) {
            //$modelImages = ProductImages::find()->where(['product_id' => $id])->all();
            $oldIDs = ArrayHelper::map($modelImagees, 'id', 'id');
            $modelImagees = Model::createMultiple(ProductImages::classname(), $modelImagees);
            Model::loadMultiple($modelImagees, $this->request->post());
            $i=0;
            //var_dump($_POST);
            foreach ($modelImagees as $index => $modelImage) {
                if ($modelImage->id == ''){
                    $modelImage->image = \yii\web\UploadedFile::getInstance($modelImage, "[{$i}]image");
                    $i++;
                    if (!empty($modelImage->image)){
                        $modelImage->image->saveAs('uploads/' . $modelImage->image->baseName . '.' . $modelImage->image->extension);
                    }
                }
                //var_dump($index);
            }
            //die;
            //var_dump($oldIDs);
            //var_dump(array_filter(ArrayHelper::map($modelImagees, 'id', 'id')));
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelImagees, 'id', 'id')));
            //var_dump($deletedIDs); //die;
            $valid = $model->validate();
            //var_dump(($valid)); 
            $valid = Model::validateMultiple($modelImagees) && $valid;
            //var_dump(($valid));// die;
            //Model::loadMultiple($modelImages, Yii::$app->request->post());
            if ($valid) {
                if ($valid) {
                    $i=0;
                    foreach ($modelImagees as $index => $modelImage) {
                        if ($modelImage->id == ''){
                            $modelImage->image = \yii\web\UploadedFile::getInstance($modelImage, "[{$i}]image");
                            
                            if (!empty($modelImage->image)){
                                $modelImage->image->saveAs('uploads/' . $modelImage->image->baseName . '.' . $modelImage->image->extension);
                            }
                            $i++;
                        }
                        {
                            if ($modelImage->id != ''){
                                $modeli = ProductImages::findOne($modelImage->id);//->where('id', $id)->findOne();
                                $modelImage->image = $modeli->image;
                            }
                        }
                        //echo $modelImage->image;
                        
                    }
                    
                    $transaction = \Yii::$app->db->beginTransaction();
                    $model->status = '1';
                    try 
                    {
                        if ($flag = $model->save(false)) {
                            if (!empty($deletedIDs)) {
                                $flag = ProductImages::deleteAll(['in', 'id', $deletedIDs]);
                            }
    
                            foreach ($modelImagees as $modelImage) {
                                $modelImage->product_id = $model->id;
                                $modelImage->status = '1';
                                $modelImage->isdesktop = '1';
                                if (($flag = $modelImage->save(false)) === false) {
                                    //var_dump($modelImage);
                                    $transaction->rollBack();
                                    break;
                                }
                                //var_dump($modelImage->id);
                            }
                            //die;
                        }
                        if ($flag) {
                            $transaction->commit();
                            //die;
                            return $this->redirect(['view', 'id' => $model->id]);
                        }
                    }
                    catch (Exception $e) 
                     {
                    
                        $transaction->rollBack();
                        
                    }
                    
                }
                
                return $this->redirect(['view', 'id' => $model->id]);
            }
            
        }

        return $this->render('update', [
            'model' => $model,
            'modelImages' => $modelImages,
            'modelImagees' => $modelImagees
        ]);
    }

    public function actionUpdate1($id)
    {
        $model = $this->findModel($id);
        $modelImages = ProductImages::find()->where(['product_id' => $id])->all();
        $modelImagees = [new ProductImages]; //ProductImages::find()->where(['product_id' => $id])->all();

        return $this->render('update1', [
            'model' => $model,
            'modelImages' => $modelImages,
            'modelImagees' => $modelImagees
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
        $model = $this->findModel($id);
        $transaction = \Yii::$app->db->beginTransaction();
        try {                    
            $this->findModel($id)->delete();
            ProductImages::deleteAll(['product_id' => $id]);
            $transaction->commit();
        }catch (Exception $ex) {                      
            $transaction->rollback();
            Yii::$app->user->setFlash('error', 'could not delete');
        }
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
