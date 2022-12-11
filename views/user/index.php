<?php

use app\models\User;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use Yii;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$type = Yii::$app->request->get('type');
$this->title = 'Новый '. User::getUsers()[$type];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a("Новый " . User::getUsers()[$type], ['create', 'type' => $type], [ 'class' => 'btn btn-success']) ?>
    </p>
    
    <p>
        <?php // var_dump(Yii::$app->request->get('type'));?>
    </p>
    
    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'surname',
            'firstname',
            'patronymic',
            'email:email',
            'phone',
            //'password_hash',
            'comment',
            'type' =>
            [
                'attribute' => 'type',
                'value' => function($data){
                    if(isset($data->type)) {return User::getUsers()[$data->type];}
                },
            ],
            
//            'is_admin:boolean',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, User $model, $key, $index, $column) use ($type) {
                    return Url::toRoute([$action, 'id' => $model->id, 'type' => $type]);
                 }
            ],
        ],
        
    ]); ?>

    <?php Pjax::end(); ?>

</div>
