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

$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="products-index">

    <div class="flex-container">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= Html::a('New Products', ['create'], ['class' => 'btn btn-success flex-container-last']) ?>
    </div>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'yii\grid\SerialColumn',
                'header' => 'SNo',
                'contentOptions' => ['style' => 'width:5%'],
            ],
            [
                'attribute' => 'name',
                'headerOptions' => ['style' => 'width:20%'],
            ],
            // [
            //     'attribute' => 'description',
            //     'format'=>'raw',
            //     'value' => function ($model) {
            //         return $model->description;
            //     }
            // ],
            [
                'attribute' => 'quantity',
                'headerOptions' => ['style' => 'width:10%'],
            ],
            [
                'attribute' => 'gst',
                'format'=>['decimal',0],
                'headerOptions' => ['style' => 'width:10%'],
            ],
            [
                'attribute' => 'hsn_sac',
                'headerOptions' => ['style' => 'width:10%'],
            ],
            [
                'attribute' => 'price',
                'headerOptions' => ['style' => 'width:10%'],
            ],
            [
                'header' => 'Actions',
                'class' => ActionColumn::className(),
                'headerOptions' => ['style' => 'width:8%'],
                'template'=>'{view}{update}{delete}',
                'urlCreator' => function ($action, Products $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
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