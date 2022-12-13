<?php

use app\models\Lecture;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Lectures';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lecture-index">
    
    <h1>Список курсов</h1>
    
    <p>
        <?php foreach ( $courses as $course ){ ?>
            <?= Html::a( $course->name, ['index', 'id' => $course->id], ['class' => 'btn btn-link']) ?>
        <?php } ?>
    </p>
    
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Lecture', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'num',
            'name',
            'course_id',
            'rate',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Lecture $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
