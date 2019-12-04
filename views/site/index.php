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
    <!--搜索位-->
    <div class="col-sm-12">
        <div class="sb-widget">
            <div class="widget-content">
                <div>
                    <div class="col-sm-9">
                        <input class="form-control" style="padding-left: 40px;" type="text" value="<?= Yii::$app->request->getQueryParam('keywords');?>" placeholder="搜索感兴趣的课程" name="keywords" id="keywords" autocomplete="off">
                        <span class="seoicn"><i class="fa fa-search"></i></span>
                    </div>
                    <div class="col-sm-3">
                        <input class="btn btn-primary" type="submit" id="searchsubmit" value="搜索">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--全部课程-->
    <div class="col-sm-12" style="margin-top: 50px;">
        <div class="body-content">
            <h3><i class="fa fa-graduation-cap" aria-hidden="true"></i> 全部课程</h3>
            <div class="row">
                <?php if(empty($lessonArray)) :?>
                    <h4>暂无数据！</h4>
                <?php else:?>
                    <?php foreach($lessonArray as $vo):?>
                        <div class="col-lg-3" style="margin-bottom: 10px;">
                            <div class="loop-container">
                                <a class="lesson-list" href="<?=Url::toRoute(['site/list','code'=>$vo['code']])?>">
                                    <!--课程封面-->
                                    <p class="slimg">
                                        <img class="img-rounded" src="<?= $vo['cover']?>" width="100%" height="150">
                                    </p>
                                    <!--课程类型-->
                                    <span class="lesson-tag label
                                        <?php if ($vo['type'] == '0'):?>
                                        label-danger
                                        <?php elseif($vo['type'] == '1'):?>
                                        label-success
                                        <?php else:?>
                                        label-info
                                        <?php endif;?>
                                        ">
                                        <?= \Yii::$app->params['lesson_type'][$vo['type']]?>
                                    </span>
                                    <!--课程名称-->
                                    <h4 class="lesson-title"><?=$vo['name']?></h4>
                                    <!--课程副标题-->
                                    <h6 class="lesson-short-title"><?=$vo['short_name']?></h6>
                                    <!--学习人数-->
                                    <p class="detail">
                                        <i class="fa fa-user" aria-hidden="true"></i>
                                        <?=$vo['learn_count'] + $vo['show_learn_count']?>人学习
                                    </p>
                                </a>
                            </div>
                        </div>
                    <?php endforeach;?>
                <?php endif;?>

                <!--分页-->
                <div class="col-sm-12">
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
    </div>

</div>
<?php $this->registerJsFile('/js/index.js', [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);?>
