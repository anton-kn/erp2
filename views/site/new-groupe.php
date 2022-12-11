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
$this->title = 'Новая группа';
$this->params['breadcrumbs'][] = ['label' => 'Группы по курсам', 'url' => ['groupe']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="new-groupe">

    <h1><?= Html::encode($this->title) ?></h1>
    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Создать группу', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
