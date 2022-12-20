<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Visit $model */
$this->title = 'За занятие ' . $lesson->lecture->name;
$this->params['breadcrumbs'][] = ['label' => 'Отметки', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $lesson->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="visit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="visit-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'student_id')->textInput()->hiddenInput(['value' => $student->id])->label(false) ?>

        <?= $form->field($model, 'lesson_id')->textInput()->hiddenInput(['value' => $lesson->id])->label(false) ?>

        <?= $form->field($model, 'rate')->textInput()->dropDownList($rate, ['class' => 'orm-select', 'size' => '5']) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
