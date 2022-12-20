<?php

use yii\helpers\Html;
use app\models\User;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */

$this->title = $model->surname . ' ' . $model->firstname . ' ' . $model->patronymic;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи' , 'url' => ['index', 'type' => $model->type]];
$this->params['breadcrumbs'][] = ['label' => $model->surname . ' ' . $model->firstname . ' ' . $model->patronymic, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновить';
?>
<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
        

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
