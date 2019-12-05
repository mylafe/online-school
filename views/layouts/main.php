<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => "在线网课",//Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    if (Yii::$app->user->isGuest) {
        $rightMenus[] = ['label' => '首页', 'url' => ['/site/index']];
        $rightMenus[] = ['label' => '登录', 'url' => ['/site/login']];
//        $rightMenus[] = ['label' => '注册', 'url' => ['/site/signup']];
    } else {
        $rightMenus[] = ['label' => '首页', 'url' => ['/site/index']];
        $rightMenus[] = [
            'label'=> ' 欢迎您，' . Yii::$app->user->identity->username,
            'linkOptions' => ['class'=>'avatar'],
            'items'=>[
                ['label'=>'<i class="fa fa-user">个人中心</i>','url'=>['/site/percenter'],'linkOptions'=>['data-method'=>'post']],
                ['label'=>'<i class="fa fa-sign-out">退出</i>','url'=>['/site/logout'],'linkOptions'=>['data-method'=>'post']],
            ],
        ];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' =>false,
        'items' => $rightMenus,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">备案号xxxxxxxx &copy; 在线网课 <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
