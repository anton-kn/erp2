<?php

use yii\helpers\Html;
use app\models\User;
use Yii;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\User $model */
$type = Yii::$app->request->get('type');
$this->title = 'Новый ' . User::getUsers()[$type];

$this->params['breadcrumbs'][] = ['label' => User::getUsers()[$type], 'url' => ['index', 'type' => $type]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="user-form">

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'patronymic')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'phone')->textInput() ?>

        <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'comment')->textInput(['maxlength' => true]) ?>
        
        <?php if ($type == User::getTeacher()) { ?>
            <?= $form->field($model, 'type')->textInput()->hiddenInput(['value'=> User::getTeacher()])->label(false) ?>
        <?php } ?>

        <?php if ($type == User::getStudent()) { ?>
        <?= $form->field($model, 'type')->textInput()->hiddenInput(['value'=> User::getStudent()])->label(false) ?>
        <?php } ?>

        <?php //$form->field($model, 'is_admin')->checkbox() ?>

        <div class="form-group">
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

</div>
