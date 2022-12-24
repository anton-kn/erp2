<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\VisitSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Ошибка доступа';
$this->params['breadcrumbs'][] = ['label' => 'Занятия по лекциям', 'url' => ['lesson/index']];
?>
<div class="visit-error">
    <p>У вас нет доступа для оценки занятия!</p>
</div>
