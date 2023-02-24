<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Settings $model */

$this->title = 'Settings ' ;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];

?>
<div class="settings-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
