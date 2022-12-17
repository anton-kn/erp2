<?php

use app\models\Lecture;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\Course;
use yii\widgets\ListView;
use app\models\User;
use Yii;
use app\models\Lesson;

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Лекции по курсам';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecture-index">

    <h2><?= Html::encode($this->title) ?></h2>
    <?php if (Yii::$app->user->identity->user->type == User::getTeacher()) { ?>
        <?=
        ListView::widget([
            'dataProvider' => $dataProviderCourse,
            'itemView' => '_list-course'
        ])
        ?>

        <p>
            <?= Html::a('Новая лекция', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?php Pjax::begin(); ?>

    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'num',
            'name',
            'course_id' =>
            [
                'attribute' => 'course_id',
                'value' => function ($data) {
                    $course = Course::find()->where(['id' => $data->course_id])->one();
                    return $course->name;
                }
            ],
            'rate',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{course}',
                'visibleButtons' => [
                    'course' => true,
                ],
                'buttons' => [
                    'course' => function ($url, $model, $key) {
                        return Html::a('Занятия', ['/lesson/index', 'lectureId'=>$model->id], ['class' => 'btn btn-link', 'data-pjax' => 0,]);
                    },
                ],
                
            ],
            
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Lecture $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],
        ],
    ]);
    ?>

    <?php Pjax::end(); ?>

</div>
