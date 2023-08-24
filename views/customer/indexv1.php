
<?php

use app\models\Products;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\ProductsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dashboard';
//$this->params['breadcrumbs'][] = $this->title;
$absoluteBaseUrl = Url::base(true);
?>
<div class="order-index">
    <div class="flex-container">
        <h1>Recent Orders</h1>
    </div>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
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
                'attribute' => 'customer_id',
                'label' => 'Customer',
                'value' => function( $data ) {
                    return $data->createdBy->firstname;  
                },
            ],
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
                'header' => 'Actions',
                'class' => ActionColumn::className(),
                'headerOptions' => ['style' => 'width:8%'],
                'template'=>'{myButton}{pdfIcon}',
                'buttons' => [
                    'myButton' => function($url, $model, $key) { 
                        $absoluteBaseUrl = Url::base(true);
                        $myUrl = $absoluteBaseUrl."/orders/vieworderv1?id=".$model->id;
                        return '<a href="'.$myUrl.'" title="View" aria-label="View" data-pjax="0"><svg aria-hidden="true" style="display:inline-block;font-size:inherit;height:1em;overflow:visible;vertical-align:-.125em;width:1.125em" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path fill="currentColor" d="M573 241C518 136 411 64 288 64S58 136 3 241a32 32 0 000 30c55 105 162 177 285 177s230-72 285-177a32 32 0 000-30zM288 400a144 144 0 11144-144 144 144 0 01-144 144zm0-240a95 95 0 00-25 4 48 48 0 01-67 67 96 96 0 1092-71z"></path></svg></a>';
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

</div>
<?php $style= <<< CSS

   a[title='Delete'], a[title='Update']{
    padding-left : 10px;
   }

 CSS;
 $this->registerCss($style);
?>