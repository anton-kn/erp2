<?php
//use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\bootstrap5\Html
?>

<div class="course mb-2">
    <?= Html::a('Создать занятие' , ['create', 'courseId' => $model->id], ['class' => ['btn btn-success']]) ?>
    <?= 'Курс:' . $model->name ?>
</div>
