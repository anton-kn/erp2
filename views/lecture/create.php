<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lecture $model */
$this->title = 'Create Lecture';
$this->params['breadcrumbs'][] = ['label' => 'Lectures', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecture-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="lecture-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'num')->textInput() ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'course_id')->dropDownList($courses) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
