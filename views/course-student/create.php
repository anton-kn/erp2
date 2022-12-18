<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CourseStudent $model */

$this->title = 'Курс ' . $course->name;
$this->params['breadcrumbs'][] = ['label' => 'Группы по курсам', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-student-create">

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
