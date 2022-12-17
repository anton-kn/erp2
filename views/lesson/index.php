<?php

use app\models\Lesson;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
use app\models\Lecture;
use app\models\Place;
use app\models\User;
/** @var yii\web\View $this */
/** @var app\models\LessonSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Все занятия';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lesson-index">
    
    <?php if (Yii::$app->user->identity->user->type == User::getAdmin()) { ?>
    <h2>Создать занятие по курсу</h2>
    <?=
    ListView::widget([
        'dataProvider' => $dataProviderCourse,
        'itemView' => '_list-course'
    ]);
    ?>
    
    <?php } ?>
    <h2><?= Html::encode($this->title) ?></h2>
    
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'lecture_id' => 
            [
                'attribute' => 'lecture_id',
                'value' => function($data){
                    $lecture = Lecture::findOne($data->lecture_id);
                    return $lecture->name;
                }
            ],
            'date',
            'time_start',
            'time_end',
            'place_id' => 
            [
                'attribute' => 'place_id',
                'value' => function($data){
                    $place = Place::findOne($data->place_id);
                    return $place->address . ' ' . $place->cabinet;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Lesson $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
