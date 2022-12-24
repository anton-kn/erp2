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
//use Yii;
use app\models\Lesson;

$courses = Course::listCourses();
$course = Course::find();
$userIdentity = User::getIdentityUser();

/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */
$this->title = 'Лекции';
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
        <?php } ?>
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
                'value' => function ($data) use($course) {
                    $name = $course->where(['id' => $data->course_id])->one();
                    return $name->name;
                },
                'filter' => $courses,
                'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control', 'id' => null],
            ],
            'rate',
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
