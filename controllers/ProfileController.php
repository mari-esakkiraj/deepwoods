<?php 
namespace app\controllers;

use app\models\UserAddresses;
use app\models\Users;
use app\models\ChangePasswordForm;
use Yii;
use yii\filters\AccessControl;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use app\models\OrdersSearch;

class ProfileController extends Controller
{

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            if(!Yii::$app->user->identity->admin) {
                                return true;
                            }
                            return false;
                        }
                    ],
                ],
                'denyCallback' => function ($rule, $action) {
                    $this->redirect("@web/");
                }
            ]
        ];
    }

    public function beforeAction($action) 
    {
        $withoutCSRF = ['profile-update', 'address-update', 'address-save'];
        if(in_array($action->id, $withoutCSRF)) {
            $this->enableCsrfValidation = false; 
        }
        return parent::beforeAction($action); 
    }

    public $layout = 'mainpage';
    public function actionIndex()
    {
        $userID = null;
        if (!Yii::$app->user->isGuest) {
            $userID = Yii::$app->user->identity->id ?? null;
        }
        $user = Users::find()->where(['id' => $userID])->one();
        $model = new ChangePasswordForm();
        $searchModel = new OrdersSearch();
        $dataProvider = $searchModel->customerorder($this->request->queryParams);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Get the current user
            $users = Yii::$app->user->identity;
            // Set the new password
            $users->setPassword($model->newPassword);
            if($users->save(false)){
                Yii::$app->getSession()->setFlash('success', 'Password changed successfully.');
                return $this->redirect(['site/cus-logout']);
            }
        }

        return $this->render('index', ['user' => $user,'model' => $model, 'searchModel' => $searchModel, 'dataProvider' => $dataProvider]);
    }

    public function actionVieworder($id)
    {
        $userID = null;
        if (!Yii::$app->user->isGuest) {
            $userID = Yii::$app->user->identity->id ?? null;
        }
        $user = Users::find()->where(['id' => $userID])->one();
       
        return $this->render('vieworder', ['id' => $id]);
    }
    public function actionPdforder($id)
    {
        $destination = "I";
        $content =  $this->renderPartial('_invoice_pdf', ['id' => $id]);

        $pdf = new Pdf([
            'mode' => Pdf::MODE_UTF8,
            'format' => Pdf::FORMAT_A4,
            'marginTop'    => 6,
            'marginBottom' => 4,
            'defaultFontSize' => 10,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'filename' => 'Invoice ' . time() . '.pdf',
            'destination' => $destination,
            'content' => $content,
            'options' => ['title' => 'Invoice'],
            'methods' => [ 
                //'SetHeader'=>['Krajee Report Header'], 
                'SetFooter'=>['{PAGENO}'],
            ]
    ]);
    return $pdf->render();
       
    }

    public function actionProfileUpdate()
    {
        $fname = Yii::$app->request->post('fname') ?? null;
        $lname = Yii::$app->request->post('lname') ?? null;
        $company = Yii::$app->request->post('company') ?? null;
        $gstNumber = Yii::$app->request->post('gstNumber') ?? null;
        $userID = Yii::$app->user->identity->id;
        $user = Users::find()->where(['id' => $userID])->one();
        if(!empty($user)) {
            $user->firstname = $fname;
            $user->lastname = $lname;
            $user->gst_number = $gstNumber;
            $user->company = $company;
            $user->save(false);
            return true;
        } else {
            return false;
        }
    }
    public function actionAddressUpdate()
    {
        $addressId = Yii::$app->request->post('addressId') ?? 'new';
        $addressType = Yii::$app->request->post('addressType') ?? null;
        $addresses = UserAddresses::find()->where(['id' => $addressId])->one();
        if(empty($addresses)) {
            $addresses = new UserAddresses();
            $addresses->type = $addressType;
        } 
        return $this->renderPartial('address_upadte', ['addresses' => $addresses]);
    }
    public function actionAddressSave()
    {
        $address = Yii::$app->request->post('address') ?? null;
        $city = Yii::$app->request->post('city') ?? null;
        $state = Yii::$app->request->post('state') ?? null;
        $country = Yii::$app->request->post('country') ?? null;
        $zipcode = Yii::$app->request->post('pinCode') ?? null;
        $addressId = Yii::$app->request->post('addressid') ?? 'new';
        $addresstype = Yii::$app->request->post('addresstype') ?? null;
        $addresses = UserAddresses::find()->where(['id' => $addressId])->one();
        if(empty($addresses)) {
            $addresses = new UserAddresses();
        }
        $addresses->address = $address;
        $addresses->city = $city;
        $addresses->state = $state;
        $addresses->country = $country;
        $addresses->zipcode = $zipcode;
        $addresses->user_id = Yii::$app->user->identity->id ?? null;
        $addresses->type = $addresstype;
        if($addresses->save(false)){
            return true;
        }
        return false;
    }

    public function actionChangePassword()
    {
        $model = new ChangePasswordForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // Get the current user
            $user = Yii::$app->user->identity;

            // Set the new password
            $user->setPassword($model->newPassword);
            $user->save();

            Yii::$app->getSession()->setFlash('success', 'Password changed successfully.');

            return $this->redirect(['view']);
        }

        return $this->render('change_password', [
            'model' => $model,
        ]);
    }

}

