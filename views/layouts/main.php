<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use app\models\User;
use kartik\icons\Icon;

AppAsset::register($this);
Icon::map($this); 

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
    if(isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == User::getAdmin()){
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Курсы', 'url' => ['/course/index']],
            ['label' => 'Пользователи', 'url' => ['/user/index']],
            ['label' => 'Группы по курсам', 'url' => ['/course-student/index']],
            ['label' => 'Занятия по лекциям', 'url' => ['/lesson/index']],
            ['label' => 'Оценки по всем занятия', 'url' => ['/visit/index']],
            ['label' => 'Адреса', 'url' => ['/place/index']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->user->surname . ' ' . Yii::$app->user->identity->user->firstname . ' ' . Yii::$app->user->identity->user->email .')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
            ]
        ]);
        NavBar::end();
    }
    elseif (isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == User::getTeacher()) {
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Курсы', 'url' => ['/course/index']],
            ['label' => 'Лекции', 'url' => ['/lecture/index']],
            ['label' => 'Группы по курсам', 'url' => ['/course-student/index']],
            ['label' => 'Занятия по лекциям', 'url' => ['/lesson/index']],
            ['label' => 'Оценки по всем занятия', 'url' => ['/visit/index']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->user->surname . ' ' . Yii::$app->user->identity->user->firstname . ' ' . Yii::$app->user->identity->user->email .')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
            ]
        ]);
        NavBar::end();
    }
    elseif (isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == User::getStudent()) {
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Курс', 'url' => ['/course/index']],
            ['label' => 'Лекции', 'url' => ['/lecture/index']],
            ['label' => 'Занятия по лекциям', 'url' => ['/lesson/index']],
            Yii::$app->user->isGuest
                ? ['label' => 'Login', 'url' => ['/site/login']]
                : '<li class="nav-item">'
                    . Html::beginForm(['/site/logout'])
                    . Html::submitButton(
                        'Выйти (' . Yii::$app->user->identity->user->surname . ' ' . Yii::$app->user->identity->user->firstname . ' ' . Yii::$app->user->identity->user->email .')',
                        ['class' => 'nav-link btn btn-link logout']
                    )
                    . Html::endForm()
                    . '</li>'
            ]
        ]);
        NavBar::end();
    }
    else{
        echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
        'items' => [
            ['label' => 'Войти', 'url' => ['/site/login']]
        ]
    ]);
    NavBar::end();
    }
    ?>
</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; erp Цифра <?= date('Y') ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
