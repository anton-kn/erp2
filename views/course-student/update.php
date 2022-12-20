<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CourseStudent $model */

$this->title = 'Изменить студена ' . $model->student->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Группы студентов', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->student->firstname , 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="course-student-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="course-student-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'course_id')->textInput()->hiddenInput(['value' => $course->id, 'name' => $model->course_id])->label(false) ?>

        <?= $form->field($model, 'student_id')->dropDownList($user)->label('Студент(ы)') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
