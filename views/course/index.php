<?php

use app\models\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
//use Yii;
use yii\widgets\ListView;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Курсы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="course-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p> 
        <?php if(Yii::$app->user->identity->user->type == User::getAdmin()) { ?>
        <?= Html::a('Новый курс', ['create'], ['class' => 'btn btn-success']) ?>
        <?php } ?>
    </p>

    <?php Pjax::begin(); ?>
    
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            'date_start',
            'date_end',
            'status' => 
            [
                'attribute' => 'status',
                'value' => function($data){
                    return Course::getStatus()[$data->status];
                },
            ],
            'teacher_id' => [
                'attribute' => 'teacher_id',
                'value' => function($data) {
                    $user = User::findOne($data->teacher_id);
                    return $user->firstname . ' ' . $user->surname . ' ' . $user->patronymic; 
                }
            ],
            'rate_med',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Course $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>
    
    <?php Pjax::end(); ?>

</div>
