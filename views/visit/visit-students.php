<?php

use yii\helpers\Html;
use yii\widgets\ListView;


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
    <?= $this->render('_visit-students', [
        'model' => $model,
        'student' => $student,
        'lesson' => $lesson,
        'visit' => $visit,
        'lessonId' => $lessonId,
    ]) ?>
    </ol>
    
    
    <?php } 
    ?>
    

</div>
