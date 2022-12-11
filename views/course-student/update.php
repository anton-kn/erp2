<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\CourseStudent $model */

$this->title = 'Update Course Student: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Course Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="course-student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
