<?php

use app\models\CourseStudent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Course;
use Yii;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Студенты курсов';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="course-student-index">
    
    <h1><?= Html::encode($this->title) ?></h1>
    <?php foreach ($courses as $course) { ?>
        <?= Html::a($course->name, ['course-student/index', 'courseId' => $course->id], ['class' => 'btn btn-link'])  ?>
    <?php } ?>

    <?php if(Yii::$app->user->identity->user->is_admin) {  ?>
    <p>
        <?= Html::a('Создать группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php }?>

    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
     'dataProvider' => $dataProvider,
//     'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'student_id' => [
                'attribute' => 'student_id',
                'value' => function ($data) {
                    $name = User::find()->where(['id' => $data->student_id])->one();
                    return $name->firstname . " " . $name->surname . " " . $name->patronymic;
                }
            ],
            'course_id' => [
                'attribute' => 'course_id',
                'value' => function ($data) {
                    $name = Course::find()->where(['id' => $data->course_id])->one();
                    return $name->name;
                },
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CourseStudent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
