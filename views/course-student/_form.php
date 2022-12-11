<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CourseStudent $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="course-student-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'course_id')->textInput() ?>

    <?= $form->field($model, 'student_id')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
