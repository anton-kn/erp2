<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lecture $model */
$this->title = 'Новая лекция для курса ' . $course->name;
$this->params['breadcrumbs'][] = ['label' => 'Лекции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecture-create">

    <h2><?= Html::encode($this->title) ?></h2>

    <div class="lecture-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'num')->textInput() ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'course_id')->textInput()->hiddenInput(['value' => $course->id, 'name' => $model->course_id])->label(false) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
