<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->firstname;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Обновить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этого пользователя?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'surname',
            'firstname',
            'patronymic',
            'email:email',
            'phone',
            //'password_hash',
            'comment',
            'type'=>
            [
                'attribute' => 'type',
                'value' => function($data){
                    if(isset($data->type)) {return User::typeUsers()[$data->type];}
                },
            ],
            //'is_admin:boolean',
        ],
    ]) ?>

</div>
