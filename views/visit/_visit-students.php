<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Html;
use app\models\Visit;

?>

<li class="list-group-item">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'student_id')->textInput()->hiddenInput(['value' => $student->id])->label($student->firstname . ' ' . $student->surname) ?>

    <?= $form->field($model, 'lesson_id')->textInput()->hiddenInput(['value' => $lesson->id])->label(false) ?>
    
    <?php 
    $visit = $visit->where(['student_id' => $student->id])->one();
    if(isset($visit->student_id) && $visit->lesson_id == $lessonId) { 
        ?>
    <div class="form-group">
        <?= Html::submitButton('Отметить', ['class' => 'btn btn-light' , 'disabled' => 'disabled']) ?>
    </div>
    <?php } 
    else { ?>
    <div class="form-group">
        <?= Html::submitButton('Отметить', ['class' => 'btn btn-success']) ?>
    </div>
    
    <?php } ?>
    

<?php ActiveForm::end(); ?>

</li>

