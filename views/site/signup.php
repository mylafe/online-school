<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = '注册';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>请填写以下内容进行注册:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <label for="user-username">登录名</label>
            <?= $form->field($model, 'username', [
                'inputOptions' => [
                    'placeholder'=>'请输入登录名',
                    'class' => 'form-control',
                    'autocomplete' => 'off'
                ],
                'template'=>'{input}{error}'
            ])->textInput(['autofocus' => true]) ?>

            <label for="user-phone">手机</label>
            <?= $form->field($model, 'phone', [
                'inputOptions' => [
                    'placeholder'=>'手机号码',
                    'class' => 'form-control',
                    'autocomplete' => 'off'
                ],
                'template'=>'{input}{error}'
            ])->textInput() ?>

            <label for="user-password">密码</label>
            <?= $form->field($model, 'password',
                [
                    'inputOptions' => [
                        'placeholder'=>'请输入密码',
                        'class' => 'form-control',
                        'autocomplete' => 'off'
                    ],
                    'template'=>'{input}{error}'
                ])->passwordInput() ?>

            <label for="user-rePassword">确认密码</label>
            <?= $form->field($model, 'rePassword', [
                'inputOptions' => [
                    'placeholder'=>'请确认密码',
                    'class' => 'form-control',
                    'autocomplete' => 'off'
                ],
                'template'=>'{input}{error}'
            ])->passwordInput() ?>

            <label for="user-verifyCode">验证码</label>
            <?= $form->field($model, 'verifyCode', [
                'inputOptions' => [
                    'placeholder'=>'验证码',
                    'class' => 'form-control',
                    'autocomplete' => 'off'
                ],
                'template'=>'{input}{error}'
            ])->widget(Captcha::className(), [
                'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
            ]) ?>

            <div class="form-group">
                <?= Html::submitButton('注册', ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
