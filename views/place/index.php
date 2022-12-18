<?php

use app\models\Place;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Адресы';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="place-index">

    <h1><?= Html::encode($this->title) ?></h1>
    
    <?php if(Yii::$app->user->identity->user->type == User::getAdmin()) { ?>
    <p>
        <?= Html::a('Добавить адрес', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php } ?>

    <?php Pjax::begin(); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'address',
            'cabinet',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Place $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
