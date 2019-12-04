<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '登录';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写以下内容进行登录:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <label for="loginform-username">账号</label>
            <?= $form->field(
                $model,
                'username',
                [
                    'inputOptions' => [
                        'placeholder'=>'请输入账号',
                        'class' => 'form-control',
                        'autocomplete' => 'off'
                    ],
                    'template'=>'{input}{error}'
                ]
            )->textInput(['autofocus' => true]) ?>

            <label for="loginform-username">密码</label>
            <?= $form->field(
                    $model,
                    'password',
                [
                    'inputOptions' => [
                        'placeholder'=>'请输入密码',
                        'class' => 'form-control',
                        'autocomplete' => 'off'
                    ],
                    'template'=>'{input}{error}'
                ]
            )->passwordInput() ?>

            <?= $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('登录', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
