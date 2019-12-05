<?php

namespace app\controllers;

use app\models\onlineschoole\Lesson;
use app\models\onlineschoole\User;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\Pagination;

class SiteController extends Controller
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
     * 首页
     * @return string
     */
    public function actionIndex()
    {
        //获取urlget参数
        $getParme = Yii::$app->request->getQueryParams();

        //创建查询
        $query = Lesson::find();
        //课程列表
        $lessonArray = $query->where(['is_release'=>'1']);
        //url包含搜索参数,拼接搜索条件
        if (isset($getParme['keywords'])) {
            $lessonArray->andWhere(["like","name",$getParme['keywords']]);
        }
        $lessonArray = $lessonArray->orderBy('gmt_create DESC');
        //课程总量
        $lessonCount = $query->where(['is_release'=>'1']);
        //url包含搜索参数,拼接搜索条件
        if (isset($getParme['keywords'])) {
            $lessonCount->andWhere(["like","name",$getParme['keywords']]);
        }
        $lessonCount = $lessonCount->count();

        //分页
        $pages = new Pagination(['totalCount' =>$lessonCount, 'pageSize' => \Yii::$app->params['page_size']]);
        //offset偏移量 limit分页数
        $lessonArray = $lessonArray->offset($pages->offset)->limit($pages->limit)->all();

        $data = [
            'lessonArray'=>$lessonArray,
            'pages' => $pages
        ];
        //组装好的数据render到对应view
        return $this->render('index', $data);
    }

    /**
     * 登录
     * @return Response|string
     */
    public function actionLogin()
    {
        //非游客模式
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        //实例化user类
        $model = new User();
        //载入post数据登录校验
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            //登录成功返回首页
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * 退出
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * 请求资源404 error
     * @return string
     */
    public function actionError()
    {
        return $this->render('error');
    }
}
