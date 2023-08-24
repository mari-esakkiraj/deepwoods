<?php

use app\models\Orders;

//$orders = Orders::find()->where(['customer_id' => $userID])->orderBy(['id' => SORT_DESC])->all();
use yii\helpers\Html;
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\grid\ActionColumn;
?>

<style>
@media(max-width: 768px) {
	.mobileclass{
        display:none;
    }
}
</style>

<?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'filterModel' => false,
        'columns' => [
            [
                'attribute' => 'order_code'
            ],
            [
                'attribute' => 'created_at',
                'format' => ['datetime', 'php:d-m-Y'],
            ],
            //'status',
            
            [
                'attribute' => 'status',
                'label' => 'Status',
                'filter'=>array("1"=>"Success","2"=>"Failed","0"=>"Pending"),
                'value' => function ($model){
                    return (($model->status==2) ? 'Failed' : (($model->status==1) ? 'Success'  : (($model->qrcode==0) ? 'Pending'  : 'Verify Pending')));
                },
            ],
            'total_price',
            [
                'label' => 'Transaction No',
                'attribute' => 'paypal_order_id',
                'contentOptions' => ['class' => 'mobileclass'],
                'headerOptions' => ['class' => 'mobileclass']
            ],
            [
                'header' => 'Actions',
                'class' => ActionColumn::className(),
                'headerOptions' => ['style' => 'width:8%'],
                'template'=>'{myButton}{pdfIcon}',
                'buttons' => [
                    'myButton' => function($url, $model, $key) { 
                        $absoluteBaseUrl = Url::base(true);
                        $myUrl = $absoluteBaseUrl."/orders/vieworder?id=".$model->id;
                        return '<a href="'.$myUrl.'" title="View" aria-label="View" target="_blank" data-pjax="0"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path></svg></a>';
                    },
                    'pdfIcon' => function($url, $model, $key) { 
                        $absoluteBaseUrl = Url::base(true);
                        $myUrl = $absoluteBaseUrl."/orders/pdfreport?id=".$model->id."&option=pdf";
                        return '<a href="'.$myUrl.'" style="padding-left:10px;" target="_blank" data-pjax="0"><i style="font-size:14px" class="fa">&#xf1c1;</i></a>';
                    }
                ]
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>