<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;

/** @var yii\web\View $this */
/** @var app\models\Course $model */
//$this->title = 'Update Course: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="course-update">

     <div class="course-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'date_start')->textInput() ?>

        <?= $form->field($model, 'date_end')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList(Course::getStatus()) ?>

        <?= $form->field($model, 'teacher_id')->dropDownList($teacher) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
