<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Lecture $model */
$this->title = 'Изменить лекцию ' . $model->name . ' курса ' .$course->name ;
$this->params['breadcrumbs'][] = ['label' => 'Lectures', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="lecture-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="lecture-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'num')->textInput() ?>

        <?= $form->field($model, 'name')->textInput([$model->name]) ?>
        
        
        <?= $form->field($model, 'course_id')->textInput([$course->id])->hiddenInput()->label(false) ?>


        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
