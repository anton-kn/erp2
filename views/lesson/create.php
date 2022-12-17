<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use kartik\time\TimePicker;
use kartik\icons\Icon;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var app\models\Lesson $model */
$this->title = 'Создать занятие';
$this->params['breadcrumbs'][] = ['label' => 'Занятия', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="lesson-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'lecture_id')->dropDownList($lecture) ?>

        <?=
        $form->field($model, 'date')->widget(DatePicker::class, [
            'name' => 'dp_2',
            'type' => DatePicker::TYPE_COMPONENT_PREPEND,
            'value' => '23-Feb-1982',
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'dd-m-yyyy'
            ]
        ])
        ?>

        <?=
        $form->field($model, 'time_start')->widget(TimePicker::class, [
            'pluginOptions' => [
                'showMeridian' => false
            ],
        ])
        ?>

        <?=
        $form->field($model, 'time_end')->widget(TimePicker::class, [
            'pluginOptions' => [
                'showMeridian' => false
            ]
        ])
        ?>

        <?= $form->field($model, 'place_id')->dropDownList($place) ?>

        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
