<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Visit $model */
$this->title = 'Оценка по теме: ' . $lesson->lecture->name;
$this->params['breadcrumbs'][] = ['label' => 'Назад', 'url' => ['lesson/index']];
//$this->params['breadcrumbs'][] = ['label' => $lesson->id, 'url' => ['view', 'id' => $model->id]];
//$this->params['breadcrumbs'][] = '';
?>
<div class="visit-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="visit-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'student_id')->textInput()->hiddenInput(['value' => $model->student_id])->label(false) ?>

        <?= $form->field($model, 'lesson_id')->textInput()->hiddenInput(['value' => $model->lesson_id])->label(false) ?>

        <?= $form->field($model, 'rate')->textInput()->dropDownList($rate, ['class' => 'orm-select', 'size' => '5']) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
