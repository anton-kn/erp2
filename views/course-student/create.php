<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CourseStudent $model */

$this->title = 'Создать новый курс';
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="course-student-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'course_id')->dropDownList($course)->label('Курсы') ?>

        <?= $form->field($model, 'student_id')->dropDownList($user)->label('Студенты') ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
