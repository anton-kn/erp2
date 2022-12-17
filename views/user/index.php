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
if(Yii::$app->user->identity->user->type == User::getTeacher()){
    $this->title = 'Студенты';
    $this->params['breadcrumbs'][] = $this->title;
}
if(Yii::$app->user->identity->user->is_admin){
    $this->title = 'Новый '. User::getUsers()[$type];
    $this->params['breadcrumbs'][] = $this->title;
}


?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?php if(Yii::$app->user->identity->user->is_admin) { ?>
        <?= Html::a("Новый " . User::getUsers()[$type], ['create', 'type' => $type], [ 'class' => 'btn btn-success']) ?>
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
                'value' => function($data){
                    if(isset($data->type)) {return User::getUsers()[$data->type];}
                },
            ],
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
