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
//use Yii;
use yii\widgets\ListView;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$student = User::find();
$students = User::studentsOfCourseIdentityUser();

$course = Course::find();
$courses = Course::listCourses();

$this->title = 'Студенты курсов';
$this->params['breadcrumbs'][] = $this->title;
?>


<div class="course-student-index">
    
    <?php if(Yii::$app->user->identity->user->is_admin) {  ?>
    <h2>Cоздать группу</h2>
    <?=
    ListView::widget([
        'dataProvider' => $dataProviderCourse,
        'itemView' => '_list-course'
    ]);
    ?>
    <?php }?>
    <h2><?= Html::encode($this->title) ?></h2>
   

    <?php Pjax::begin(); ?>
    
    <?= GridView::widget([
     'dataProvider' => $dataProvider,
     'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'student_id' => [
                'attribute' => 'student_id',
                'value' => function ($data) use($student) {
                    $name = $student->where(['id' => $data->student_id])->one();
                    return $name->firstname . " " . $name->surname . " " . $name->patronymic;
                },
                'filter' => $students,
                'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control', 'id' => null],
            ],
            'course_id' => [
                'attribute' => 'course_id',
                'value' => function ($data) use ($course) {
                    $name = $course->where(['id' => $data->course_id])->one();
                    return $name->name;
                },
                'filter' => $courses,
                'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control', 'id' => null],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, CourseStudent $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id, 'courseId' => $model->course_id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
