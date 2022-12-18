<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ListView;
//use Yii;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

//$type = $searchModel->type;
$types = User::typeUsers();

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;


?>
<div class="user-index">
    
    
    <p>
        <?php if(Yii::$app->user->identity->user->type == User::getAdmin()) { ?>
        <?= Html::a("Новый преподаватель", ['create', 'type' => User::getTeacher()], [ 'class' => 'btn btn-success']) ?>
        <?= Html::a("Новый студент", ['create', 'type' => User::getStudent()], [ 'class' => 'btn btn-success']) ?>
        <?php }?>
    </p>

    
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'surname',
            'firstname',
            'patronymic',
            'email:email',
            'phone',
            'comment',
            'type' =>
            [
                'attribute' => 'type',
                'value' => function($data) use($types){
                    if(isset($data->type)) {return $types[$data->type];}
                },
                'filter' => $types,
                'filterInputOptions' => ['prompt' => 'Все', 'class' => 'form-control', 'id' => null],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
        
    ]); ?>

    <?php Pjax::end(); ?>

</div>
