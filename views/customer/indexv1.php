<?php

use app\models\Customer;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\CustomerSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Dashboard';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="customer-index">
    <div class="flex-container">
        <h1><?= Html::encode($this->title) ?></h1>
        <?php //= Html::a('New Customer', ['create'], ['class' => 'btn btn-success flex-container-last']) ?>
    </div>
</div>
