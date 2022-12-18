<?php
//use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\bootstrap5\Html
?>

<div class="course mb-2">
    <!--передаем id курса -->
    <?= Html::a('+ ', ['lecture/create', 'courseId' => $model->id], ['class' => ['btn btn-success']]) ?>
    <?= $model->name ?>
</div>
