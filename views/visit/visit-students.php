<?php

use yii\helpers\Html;
use yii\widgets\ListView;
use yii\bootstrap5\ActiveForm;
use app\models\Visit;

/** @var yii\web\View $this */
/** @var app\models\Visit $model */
$this->title = 'Журнал';
$this->params['breadcrumbs'][] = ['label' => 'Занятия', 'url' => ['lesson/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-create">

    <h2><?= 'Занятие ' . $lesson->lecture->name ?></h2>
    <h4>Список студентов</h4>

    <?php foreach ($students as $student) { ?>
        <ol class="list-group">
            <li class="list-group-item">

                <?php $form = ActiveForm::begin(); ?>
                <?= $form->field($model, 'student_id')->textInput()->hiddenInput(['value' => $student->id])->label($student->firstname . ' ' . $student->surname) ?>

                <?= $form->field($model, 'lesson_id')->textInput()->hiddenInput(['value' => $lesson->id])->label(false) ?>

                <?php
                $isVisit = $model->find()
                        ->andWhere(['lesson_id' => $lessonId])
                        ->andWhere(['student_id' => $student->id])->one();
                if (isset($isVisit)) {
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отметить', ['class' => 'btn btn-light', 'disabled' => 'disabled']) ?>
                    </div>
                <?php } else {
                    ?>
                    <div class="form-group">
                        <?= Html::submitButton('Отметить', ['class' => 'btn btn-success']) ?>
                    </div>

                <?php } ?>


                <?php ActiveForm::end(); ?>

            </li>
        </ol>


    <?php }
    ?>


</div>
