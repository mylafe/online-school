<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\components\Util;
/* @var $this yii\web\View */

$this->title = '个人中心';
?>
<div class="site-index">

    <div class="col-lg-8">

        <div class="body-content">

            <div class="row">

                <div class="col-lg-12">

                    <div class="loop-conleft">
                        <h4><i class="fa fa-address-card">登录名：</i><?=$data['username']?></h4>
                        <h4><i class="fa fa-address-card">昵称：</i><?=$data['nickname']?></h4>
                        <h4><i class="fa fa-envelope">手机号码：</i><?= Util::format_call($data['phone'])?></h4>
                        <h4><i class="fa fa-calendar-times-o">注册时间：</i><?=$data['gmt_create']?></h4>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>
