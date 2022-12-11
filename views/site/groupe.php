<?php

use app\models\Course;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\models\User;
use yii\widgets\ActiveForm;
/** @var yii\web\View $this */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Список групп';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="groupe">
    <p>
        <?= Html::a('Новая группа', ['new-groupe'], ['class' => 'btn btn-primary']) ?>
    </p>
    
    <h1><?= Html::encode($this->title) ?></h1>
    

</div>
