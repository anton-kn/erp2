<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Course;

$course = Course::find();
/** @var yii\web\View $this */
/** @var app\models\Lecture $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Лекции', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="lecture-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'num',
            'name',
            'course_id' => [
                'attribute' => 'course_id',
                'value' => function($data) use($course) {
                    $course = $course->where(['id' => $data->course_id])->one();
                    return $course->name;
                }
            ],
            'rate',
        ],
    ]) ?>

</div>
