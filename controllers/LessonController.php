<?php

namespace app\controllers;

use app\models\onlineschoole\Lesson;
use app\models\onlineschoole\LessonComment;
use app\models\onlineschoole\LessonPaper;
use app\models\onlineschoole\Paper;
use app\models\onlineschoole\PaperQuestion;
use app\models\onlineschoole\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;

class LessonController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * 课程详情
     * @return string
     */
    public function actionDetail()
    {
        //获取url code
        $code = Yii::$app->request->get('code', '');
        $lessonInfo = Lesson::findOne(['code'=>$code, 'is_release'=>'1']);
        //请求数据不存在
        if (empty($lessonInfo)) {
            return $this->redirect(['site/error']);
        }

        //学习人数+1
        $lessonInfo->learn_count += 1;
        $lessonInfo->save(false);

        $query = LessonComment::find()
            ->select('code,uuid,content,level,gmt_create')
            ->where(['lesson_code'=>$code, 'is_delete'=>'0']);
        //评论总量
        $commentCount = $query->count();
        //获取评论列表
        $commentInfo = $query->orderBy('is_top desc,gmt_create desc');
        //分页
        $pages = new Pagination(['totalCount' =>$commentCount, 'pageSize' => \Yii::$app->params['page_size_ten']]);
        //offset偏移量 limit分页数
        $commentInfo = $commentInfo->offset($pages->offset)->limit($pages->limit)->all();

        //获取课程对应的考卷
        $paperInfo = '';
        $paperQuestion = [];
        //获取考卷
        $paper = LessonPaper::findOne(['lesson_code'=>$code]);
        if ($paper) {
            //考卷信息
            $paperInfo = Paper::findOne(['code'=>$paper['paper_code']]);
            //考卷问题
            $paperQuestion = PaperQuestion::find()
                ->where(['paper_code'=>$paper['paper_code']])
                ->orderBy('sort desc,gmt_create asc')
                ->asArray()
                ->all();
        }

        $data = [
            'lessonInfo' => $lessonInfo,
           'commentInfo' => $commentInfo,
                 'pages' => $pages,
             'paperInfo' => $paperInfo,
         'paperQuestion' => $paperQuestion
        ];

        return $this->render('detail', $data);
    }

    //新增留言
    public function actionAddNote()
    {
        //游客模式请求返回首页
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $request = Yii::$app->request;
        //非post请求
        if (!$request->isPost) {
            return $this->redirect(['site/error']);
        }
        //获取提交数据
        $data = Yii::$app->request->post();
        $uuid = Yii::$app->user->identity->uuid;

        $addContent = new LessonComment();
        $addContent->code = 'LC' . date("Ymd", time()) . rand(10000, 99999);
        $addContent->uuid = $uuid;
        $addContent->lesson_code = $data['lesson_code'];
        $addContent->content = $data['content'];
        $addContent->level = $data['level'];

        //保存成功跳转回去
        if ($addContent->save(false)) {
            return $this->redirect(['lesson/detail','code'=>$data['lesson_code']]);
        } else {
            return $this->redirect(['site/error']);
        }
    }

    //答题
    public function actionAddPaper()
    {
        //游客模式请求返回首页
        if (Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $request = Yii::$app->request;
        //非post请求
        if (!$request->isPost) {
            return $this->redirect(['site/error']);
        }
        //获取提交数据
        $data = Yii::$app->request->post();
        $uuid = Yii::$app->user->identity->uuid;
        //var_dump($data);exit();
        //todo 提交答案匹配

        return $this->redirect(['lesson/detail','code'=>$data['lesson_code']]);
    }

}
