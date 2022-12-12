<?php

use app\models\CourseStudent;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\DetailView;
use app\models\User;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Группы по курсам';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="list-course">
    <h3>Список курсов</h3>
    <p>
        <?php foreach ($courses as $course) { ?>
            <?= Html::a($course->name, ['index', 'id' => $course->id], ['class' => 'btn btn-link']) ?>
        <?php }?>
    </p>
</div>
<div class="course-student-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Создать группу', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>
    
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            //'student_id',
        ],
    ]) ?>

    <?= GridView::widget([
     'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'student_id' => [
                'attribute' => 'student_id',
                'value' => function ($data) {
                    $name = User::find()->where(['id' => $data->student_id])->one();
                    return $name->firstname . " " . $name->surname . " " . $name->patronymic;
                }
            ],
            'course_id',
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
