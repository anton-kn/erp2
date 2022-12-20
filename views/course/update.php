<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use app\models\Course;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Course $model */
//$this->title = 'Update Course: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Изменить';
?>
<div class="course-update">

     <div class="course-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'date_start')->widget(DatePicker::class, [
            'name' => 'dp_2',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'value' => '23-Feb-1982',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-m-yyyy'
            ]
        ])
        ?>

        <?= $form->field($model, 'date_end')->widget(DatePicker::class, [
            'name' => 'dp_2',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'value' => '23-Feb-1982',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-m-yyyy'
            ]
        ])
                ?>

        <?= $form->field($model, 'status')->dropDownList(Course::getStatus()) ?>

        <?= $form->field($model, 'teacher_id')->dropDownList($teacher) ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
