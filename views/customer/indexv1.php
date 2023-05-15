
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
                'attribute' => 'id'
            ],
            [
                'attribute' => 'created_at',
                'format' => ['datetime', 'php:d-M-Y'],
            ],
            //'status',
            [
                'attribute' => 'status',
                'label' => 'Status',
                'filter'=>array("1"=>"Success","2"=>"Failed","0"=>"Pending"),
                'value' => function ($model){
                    return (($model->status==2) ? 'Failed' : (($model->status==1) ? 'Success'  : 'Pending'));
                },
            ],
            'total_price',
            [
                'header' => 'Actions',
                'class' => ActionColumn::className(),
                'headerOptions' => ['style' => 'width:8%'],
                'template'=>'{myButton}',
                'buttons' => [
                    'myButton' => function($url, $model, $key) { 
                        $absoluteBaseUrl = Url::base(true);
                        $myUrl = $absoluteBaseUrl."/orders/vieworderv1?id=".$model->id;
                        return '<a href="'.$myUrl.'">View</a>';
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