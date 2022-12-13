<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lesson $model */
$this->title = 'Update Lesson: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Lessons', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lesson-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="lesson-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'lecture_id')->textInput() ?>

        <?= $form->field($model, 'date')->textInput() ?>

        <?= $form->field($model, 'time_start')->textInput() ?>

        <?= $form->field($model, 'time_end')->textInput() ?>

        <?= $form->field($model, 'place_id')->textInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
