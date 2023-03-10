<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
$absoluteBaseUrl = Url::base(true);

/** @var yii\web\View $this */
/** @var app\models\Products $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="products-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'description:html',
            //'image',
            'price',
            'status',
            /*'created_at',
            'updated_at',
            'created_by',
            'updated_by',*/
        ],
        'template' => "<tr><th style='width: 15%;'>{label}</th><td>{value}.</td></tr>"
    ]) ?>
    <h1 class="mt-20">Product Images</h1>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th style='width: 15%;'>ID</th>
                <th>Images</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach($modelImages as $key => $imagelist){ ?>
                <tr data-key="<?= $key+1 ?>">
                    <td><?= $key+1 ?></td>
                    <td>
                        <img class="hover-img" style="width:150px;" src="<?=$absoluteBaseUrl."/uploads/".$imagelist->image?>" alt="">
                    </td>
                </tr>
            <?php 
            }?>
        </tbody>
    </table>
</div>
