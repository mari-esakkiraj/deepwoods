<?php

namespace app\controllers;

use app\models\Settings;
use app\models\SettingsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * SettingsController implements the CRUD actions for Settings model.
 */
class SettingsController extends Controller
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
     * Lists all Settings models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $model = $this->findModel(1);
        if ($this->request->post()) {
            if ($model->load($this->request->post())) {
                $file_name = $model->company_logo;
                $model->company_logo = \yii\web\UploadedFile::getInstance($model, 'company_logo');
                $model->company_logo->saveAs('uploads/' . $model->company_logo->baseName . '.' . $model->company_logo->extension);
                $model->company_logo = 'uploads/' . $model->company_logo->baseName . '.' . $model->company_logo->extension;
                
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
           
        }
        

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    
    /**
     * Finds the Settings model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Settings the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Settings::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
