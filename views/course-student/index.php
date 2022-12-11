<?php

use app\models\CourseStudent;
use yii\helpers\Html;
//use yii\helpers\Url;
//use yii\grid\ActionColumn;
//use yii\grid\GridView;
//use yii\widgets\Pjax;
//use yii\widgets\ListView;
use app\models\Course;
use app\models\User;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список групп';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    
    <?php
    foreach ($students as $student) { 
        $course = Course::find()->where(['id' => $student->course_id])->one();
        ?>
        <h2> <?= $course->name ?> </h2>
    
    
            
    <?php
        //}
    }
    ?>

</div>
