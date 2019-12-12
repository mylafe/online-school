<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use app\assets\AppAsset;
use app\models\onlineschoole\User;
use app\components\Util;
use app\models\onlineschoole\Question;
use app\models\onlineschoole\QuestionOption;
/* @var $this yii\web\View */

AppAsset::register($this);
$this->registerCssFile('/css/lesson.css', [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);

$this->title = $lessonInfo['name'];
?>
<style>
    @keyframes hover-color {
        from {
            border-color: #c0c0c0; }
        to {
            border-color: #3e97eb; } }

    .magic-radio,
    .magic-checkbox {
        position: absolute;
        display: none; }

    .magic-radio[disabled],
    .magic-checkbox[disabled] {
        cursor: not-allowed; }

    .magic-radio + label,
    .magic-checkbox + label {
        position: relative;
        display: block;
        padding-left: 30px;
        cursor: pointer;
        vertical-align: middle; }
    .magic-radio + label:hover:before,
    .magic-checkbox + label:hover:before {
        animation-duration: 0.4s;
        animation-fill-mode: both;
        animation-name: hover-color; }
    .magic-radio + label:before,
    .magic-checkbox + label:before {
        position: absolute;
        top: 0;
        left: 0;
        display: inline-block;
        width: 20px;
        height: 20px;
        content: '';
        border: 1px solid #c0c0c0; }
    .magic-radio + label:after,
    .magic-checkbox + label:after {
        position: absolute;
        display: none;
        content: ''; }

    .magic-radio[disabled] + label,
    .magic-checkbox[disabled] + label {
        cursor: not-allowed;
        color: #e4e4e4; }
    .magic-radio[disabled] + label:hover, .magic-radio[disabled] + label:before, .magic-radio[disabled] + label:after,
    .magic-checkbox[disabled] + label:hover,
    .magic-checkbox[disabled] + label:before,
    .magic-checkbox[disabled] + label:after {
        cursor: not-allowed; }
    .magic-radio[disabled] + label:hover:before,
    .magic-checkbox[disabled] + label:hover:before {
        border: 1px solid #e4e4e4;
        animation-name: none; }
    .magic-radio[disabled] + label:before,
    .magic-checkbox[disabled] + label:before {
        border-color: #e4e4e4; }

    .magic-radio:checked + label:before,
    .magic-checkbox:checked + label:before {
        animation-name: none; }

    .magic-radio:checked + label:after,
    .magic-checkbox:checked + label:after {
        display: block; }

    .magic-radio + label:before {
        border-radius: 50%; }

    .magic-radio + label:after {
        top: 7px;
        left: 7px;
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: #3e97eb; }

    .magic-radio:checked + label:before {
        border: 1px solid #3e97eb; }

    .magic-radio:checked[disabled] + label:before {
        border: 1px solid #c9e2f9; }

    .magic-radio:checked[disabled] + label:after {
        background: #c9e2f9; }

    .magic-checkbox + label:before {
        border-radius: 3px; }

    .magic-checkbox + label:after {
        top: 2px;
        left: 7px;
        box-sizing: border-box;
        width: 6px;
        height: 12px;
        transform: rotate(45deg);
        border-width: 2px;
        border-style: solid;
        border-color: #fff;
        border-top: 0;
        border-left: 0; }

    .magic-checkbox:checked + label:before {
        border: #3e97eb;
        background: #3e97eb; }

    .magic-checkbox:checked[disabled] + label:before {
        border: #c9e2f9;
        background: #c9e2f9; }
</style>
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
        <div class="col-lg-12" style="margin-bottom: 10px;">
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

    <!--问卷开始-->
    <div class="row">
        <div class="col-lg-12">
            <h4><i class="fa fa-line-chart" aria-hidden="true"></i>考试
                <?php if (Yii::$app->user->isGuest):?>
                    <span class="label label-info">请登录后开始考试!</span>
                <?php else:?>
                    <?php if (empty($paperInfo)):?>
                        <span class="label label-info">暂无关联考试!</span>
                    <?php else:?>
                        <h4>试卷：<?= $paperInfo['name']?></h4>
                        <span class="label label-danger">总分：<?= $paperInfo['total_score']?> 及格分数线：<?= $paperInfo['pass_score']?></span>
                    <?php endif;?>
                    <?php if (empty($paperQuestion)):?>
                        <span class="label label-info">暂无考试选项!</span>
                    <?php else:?>
                        <form role="form" action="<?=Url::toRoute('lesson/add-paper')?>" method="post">
                            <div class="form-group">
                                <?php foreach($paperQuestion as $key => $vo):?>
                                    <!--标题-->
                                    <h4>
                                        <?php $name = '';
                                        $info = Question::findOne(['code'=>$vo['question_code']]);
                                        if (!empty($info)) {
                                            $name = $info['content'];
                                        }
                                        echo $key+1 .'.'. $name;
                                        ?>
                                    </h4>
                                    <!--获取选项-->
                                    <?php
                                        $qusetion = [];
                                        $qusetionInfo = QuestionOption::find()
                                            ->where(['question_code'=>$vo['question_code']])
                                            ->orderBy('sort desc,gmt_create asc')
                                            ->asArray()->all();
                                    ?>
                                    <?php foreach($qusetionInfo as $k => $v):?>
                                        <input class="magic-radio" id="r<?=$v['id']?>" type="radio" name="<?=$v['question_code']?>" value="<?=$v['id']?>" required>
                                        <label class="" for="r<?=$v['id']?>"><?=$v['content']?></label>
                                    <?php endforeach;?>
                                <?php endforeach;?>
                            </div>
                            <input name="lesson_code" type="hidden" value="<?= $lessonInfo['code'];?>">
                            <input name="paper_code" type="hidden" value="<?= $paperInfo['code'];?>">
                            <input name="_csrf" type="hidden" id="_csrf" value="<?= Yii::$app->request->csrfToken ?>">
                            <div class="form-group">
                                <input class="btn btn-sm btn-primary" type="submit" value="提交">
                            </div>
                            </div>
                        </form>
                    <?php endif;?>
                <?php endif;?>
            </h4>
        </div>
    </div>
</div>
<?php $this->registerJsFile('/js/lesson.js', [AppAsset::className(), 'depends' => 'app\assets\AppAsset']);?>
