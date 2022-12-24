<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Place $model */

$this->title = 'Новый адрес';
$this->params['breadcrumbs'][] = ['label' => 'Адреса', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
