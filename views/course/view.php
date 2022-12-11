<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;
use app\models\Course;

/** @var yii\web\View $this */
/** @var app\models\Course $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Курсы', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="course-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы точно уверены, что хотите удалить этот курс?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'date_start',
            'date_end',
            'status' => [
                'attribute' => 'status',
                'value' => function($data) {
                    $courseStatus = Course::getStatus()[$data->status];
                    return $courseStatus;
                }
            ],
            'teacher_id' => [
                'attribute' => 'teacher_id',
                'value' => function($data) {
                    $user = User::findOne($data->teacher_id);
                    return $user->firstname . ' ' . $user->surname . ' ' . $user->patronymic; 
                }
            ],
                
            'rate_med',
        ],
    ]) ?>

</div>
