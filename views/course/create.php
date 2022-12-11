<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;

/** @var yii\web\View $this */
/** @var app\models\Course $model */
$this->title = 'Создать курс';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="course-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'date_start')->textInput() ?>

        <?= $form->field($model, 'date_end')->textInput() ?>

        <?= $form->field($model, 'status')->dropDownList(Course::getStatus()) ?>

        <?= $form->field($model, 'teacher_id')->dropDownList($teacher) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
