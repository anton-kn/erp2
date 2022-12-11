<?php

use yii\helpers\Html;
//use yii\widgets\ActiveForm;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\CourseStudent $model */

$this->title = 'Новая группа';
$this->params['breadcrumbs'][] = ['label' => 'Список групп', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-student-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="course-student-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'course_id')->dropDownList($courses) ?>

        <?= $form->field($model, 'student_id')->checkboxList($students)->label('Студенты') ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
