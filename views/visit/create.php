<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Visit $model */
$this->title = 'Create Visit';
$this->params['breadcrumbs'][] = ['label' => 'Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="visit-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'student_id')->textInput()->hiddenInput(['value' => $student->id])->label(false) ?>

        <?= $form->field($model, 'lesson_id')->textInput()->hiddenInput(['value' => $lesson->id])->label(false) ?>

        <?= $form->field($model, 'rate')->textInput()->dropDownList($rate, ['class' => 'orm-select', 'size' => '5']) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
