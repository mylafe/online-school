<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\assets\AppAsset;
/* @var $this yii\web\View */

AppAsset::register($this);
$this->registerCssFile('/css/index.css', [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);

$this->title = 'demo';
?>
<div class="site-index">

    <div class="col-sm-12 col-lg-8">

        <div class="body-content">

            <div class="row">

                <div class="col-lg-12">
                    <?php if(empty($lessonArray)) :?>
                        <h3>暂无数据！</h3>
                    <?php else:?>
                        <?php foreach($lessonArray as $vo):?>
                            <div class="loop-container">
                                <h3><?=$vo['name']?><!--课程名称-->
                                    <span style="font-size: 12px;" class="label
                                    <?php if ($vo['type'] == '0'):?>
                                    label-danger
                                    <?php elseif($vo['type'] == '1'):?>
                                    label-success
                                    <?php else:?>
                                    label-info
                                    <?php endif;?>
                                    ">
                                    <?= \Yii::$app->params['lesson_type'][$vo['type']]?><!--课程类型-->
                                </span>
                                </h3>
                                <h6>
                                    <?=$vo['short_name']?><!--课程副标题-->
                                </h6>
                                <p class="content">
                                    <?=strip_tags(mb_substr($vo['detail'], 0 , 100))?>...<!--课程简介-->
                                </p>
                                <p class="slimg">
                                    <img src="<?= $vo['cover']?>" width="542" height="343"><!--课程封面-->
                                </p>
                                <p class="canyu">
                                    <a class="btn btn-default" href="<?=Url::toRoute(['site/list','code'=>$vo['code']])?>">查看详情 &raquo;</a>
                                </p>
                            </div>
                        <?php endforeach;?>
                    <?php endif;?>
                </div>

                <!--分页-->
                <div class="f-r">
                    <?= LinkPager::widget([
                        'pagination'=>$pages,
                        'firstPageLabel' => '首页',
                        'nextPageLabel' => '下一页',
                        'prevPageLabel' => '上一页',
                        'lastPageLabel' => '末页',
                    ]) ?>
                </div>

            </div>

        </div>

    </div>
    <div class="col-sm-12 col-lg-4">
        <div class="sb-widget">
            <div class="widget-content">
                <form action="<?=Url::toRoute('site/index')?>" class="searchform" id="searchform" method="post">
                    <div>
                        <input type="text" value="" placeholder="搜索感兴趣的课程" name="keywords" required oninvalid="setCustomValidity('搜索内容不能为空')" oninput="setCustomValidity('')" id="keywords">
                        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                        <input type="submit" id="searchsubmit" value="搜索">
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

