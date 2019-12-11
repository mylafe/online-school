<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\assets\AppAsset;
use app\models\onlineschoole\User;
use app\components\Util;
/* @var $this yii\web\View */

AppAsset::register($this);
$this->registerCssFile('/css/lesson.css', [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);

$this->title = $lessonInfo['name'];
?>
<div class="site-index">
    <!--全部詳情-->
    <div class="col-sm-12">
        <div class="body-content">
            <div class="row">
                <div class="col-lg-12" style="margin-bottom: 10px;">
                    <div class="loop-container">
                        <!--课程名称-->
                        <h4 class="text-center lesson-title"><?=$lessonInfo['name']?>
                            <!--课程类型-->
                            <span class="label
                            <?php if ($lessonInfo['type'] == '0'):?>
                            label-danger
                            <?php elseif($lessonInfo['type'] == '1'):?>
                            label-success
                            <?php else:?>
                            label-info
                            <?php endif;?>
                            ">
                            <?= \Yii::$app->params['lesson_type'][$lessonInfo['type']]?>
                        </span>
                        </h4>
                        <!--课程副标题-->
                        <h6 class="text-center lesson-short-title"><?=$lessonInfo['short_name']?></h6>
                        <!--学习人数-->
                        <p class="detail text-center">
                            <i class="fa fa-user" aria-hidden="true"></i>
                            <?=$lessonInfo['learn_count'] + $lessonInfo['show_learn_count']?>人学习
                        </p>
                        <!--视频资源-->
                        <?php if ($lessonInfo['type'] == '0'):?>
                            <video style="width: 100%" src="<?= $lessonInfo['source_url']?>" controls="controls" poster="<?= $lessonInfo['cover']?>">您的浏览器不支持 video 标签。</video>
                        <!--音频资源-->
                        <?php elseif($lessonInfo['type'] == '1'):?>
                            <audio style="width: 100%" controls><source src="<?= $lessonInfo['source_url']?>" type="audio/mpeg">您的浏览器不支持 audio 元素。</audio>
                        <!--图文资源-->
                        <?php else:?>
                        <?php endif;?>
                        <!--课程详情-->
                        <div>
                            <?= $lessonInfo['details']?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--评论详情-->
    <div class="row">
        <div class="col-lg-12">
            <h4><i class="fa fa-comments" aria-hidden="true"></i>评论：
            <?php if (Yii::$app->user->isGuest):?>
                <span class="label label-info">请登录后才能评论!</span>
            <?php else:?>
                <form role="form" action="<?=Url::toRoute('lesson/add-note')?>" method="post">
                    <div class="form-group">
                        <textarea name="content" placeholder="请填写评论" class="form-control" required oninvalid="setCustomValidity('评论内容不能为空')" oninput="setCustomValidity('')" aria-required="true" style="width: 100%; height: 100px;"></textarea>
                        <div class="radio">
                            <label>
                                <input type="radio" value="1" name="level">一星
                            </label>
                            <label>
                                <input type="radio" value="2" name="level">两星
                            </label>
                            <label>
                                <input type="radio" value="3" name="level">三星
                            </label>
                            <label>
                                <input type="radio" value="4" name="level">四星
                            </label>
                            <label>
                                <input type="radio" checked value="5" name="level">五星
                            </label>
                        </div>
                        <input name="lesson_code" type="hidden" value="<?= $lessonInfo['code'];?>">
                        <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                    <div class="form-group">
                        <input class="btn btn-sm btn-primary" type="submit" value="评论">
                    </div>
                    </div>
                </form>
            <?php endif;?>
            </h4>
            <?php if(empty($commentInfo)):?>
                <h4>暂无评论！</h4>
            <?php else:?>
                <?php foreach($commentInfo as $key => $vo):?>
                    <div class="social-feed-box" style="border: 1px solid #e7eaec;">
                        <div class="social-avatar" style="padding: 15px 15px 0 15px;">
                            <div class="media-body">
                                <a href="javascript:;"><?php
                                    $name = '';
                                    $info = User::findOne(['uuid'=>$vo['uuid']]);
                                    if ($info) {
                                        $name = $info['username'];
                                    }
                                    echo $name; ?></a>
                                <small class="text-muted"><?php echo Util::format_time(strtotime($vo['gmt_create']));?></small>
                                <small class="text-muted">
                                    <?php
                                    $tem = '';
                                    for ($x=1; $x<=$vo['level']; $x++) {
                                        $tem .= '★';
                                    }
                                    echo $tem;
                                    ?>
                                </small>
                            </div>
                        </div>
                        <div class="social-body" style="padding: 15px 15px 0 15px;">
                            <p><?=$vo['content']?></p>
                        </div>
                    </div>
                <?php endforeach;?>
                <!--分页-->
                <div>
                    <div>
                        <?= LinkPager::widget([
                            'pagination'=>$pages,
                            'firstPageLabel' => '首页',
                            'nextPageLabel' => '下一页',
                            'prevPageLabel' => '上一页',
                            'lastPageLabel' => '末页',
                        ]) ?>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </div>

</div>
<?php $this->registerJsFile('/js/lesson.js', [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);?>
