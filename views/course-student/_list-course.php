<?php
//use yii\helpers\Html;
use yii\helpers\HtmlPurifier;
use yii\bootstrap5\Html
?>

<div class="course mb-2">
    <?= Html::a($model->name, ['course-student/index', 'courseId' => $model->id], ['class' => 'btn btn-link'])?>
</div>
