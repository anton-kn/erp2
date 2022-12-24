<?php

use app\models\Visit;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var app\models\VisitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$users = $user->studentsOfCourseIdentityUser();
$lessons = $lesson->listLesson();
//echo '<pre>';
//var_dump($lessons);
//echo '</pre>';
//exit();

$this->title = 'Все оценки по занятиям';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visit-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'student_id',
                'value' => function ($data) use ($user) {
                    $student = $user->findOne($data->student_id);
                    return $student->firstname . ' ' . $student->surname . ' ' . $student->patronymic;
                },
                'filter' => $users,
                'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control', 'id' => null],
            ],
            [
                'attribute' => 'lesson_id',
                'value' => function ($data) use ($lesson) {
                    $lesson = $lesson->findOne($data->lesson_id);
                    return $lesson->lecture->name;
                },
                'filter' => $lessons,
                'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control', 'id' => null],
            ],
            'rate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Visit $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
