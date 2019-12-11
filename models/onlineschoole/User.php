<?php

namespace app\models\onlineschoole;

use app\components\Util;
use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $uuid 身份唯一标识
 * @property string $auth_key key
 * @property string $username 登陆名
 * @property string $nickname 昵称
 * @property string $phone 手机号
 * @property string $password 密码
 * @property string $password_salt 盐
 * @property string $avatar 头像的地址
 * @property int $is_delete 是否删除：0 否，1 是
 * @property string $delete_time 删除时间
 * @property string $gmt_create 创建时间
 * @property string $gmt_modified 更新时间
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public $rememberMe = true;
    public $_user;
    public $rePassword;
    public $verifyCode;

    //用户未删除
    const STATUS_ACTIVE = 0;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_delete', 'delete_time'], 'integer', 'on'=>['add']],//场景为add校验
            [['gmt_create', 'gmt_modified'], 'safe'],
            [['uuid'], 'string', 'max' => 32 ,'on'=>['add']],
            [['username', 'nickname'], 'string', 'max' => 50, 'on'=>['add']],
            [['phone'], 'string', 'max' => 11, 'on'=>['add']],
            [['password', 'avatar'], 'string', 'max' => 255, 'on'=>['add']],
            [['uuid'], 'unique', 'on'=>['add']],
            [['phone'], 'unique', 'on'=>['add']],

            [['username'],'required','message'=>'请输入账户'],
            [['password'],'required','message'=>'请输入密码'],

            [['phone'],'required','message'=>'请输入手机号', 'on'=>['reg']],
            [['rePassword'],'required','message'=>'请确认密码', 'on'=>['reg']],
            [['verifyCode'],'required','message'=>'请输入验证码', 'on'=>['reg']],
            ['username', 'unique', 'message' => '登录名已经存在。', 'on'=>['reg']],
            ['phone', 'unique', 'message' => '手机号已经存在。', 'on'=>['reg']],
            ['username', 'match','pattern'=>'/^[(\x{4E00}-\x{9FA5})a-zA-Z]+[(\x{4E00}-\x{9FA5})a-zA-Z_\d]*$/u','message'=>'用户名由字母，汉字，数字，下划线组成，且不能以数字和下划线开头。', 'on'=>['reg']],
            ['phone', 'match','pattern'=>'/^[1][0-9]{10}$/','message'=>'请输入正确的手机号码。', 'on'=>['reg']],
            ['rePassword','compare','compareAttribute' => 'password','message' => '两次密码不一样', 'on'=>['reg']],
            ['rememberMe', 'boolean'],
            ['verifyCode','captcha', 'on'=>['reg']]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'uuid' => 'Uuid',
            'username' => 'Username',
            'nickname' => 'Nickname',
            'phone' => 'Phone',
            'password' => 'Password',
            'avatar' => 'Avatar',
            'is_delete' => 'Is Delete',
            'delete_time' => 'Delete Time',
            'gmt_create' => 'Gmt Create',
            'gmt_modified' => 'Gmt Modified',
            'rememberMe' => '30天免密登录',
        ];
    }

    //登录校验
    public function login()
    {
        //字段校验required
        if ($this->validate()) {
            //验证都通过
            if (!$this->hasErrors()) {
                $user = $this->getUserInfo();
                if (!$user) {
                    $this->addError('username', '暂无该账户！');
                    return;
                }
                if ($user['password'] != $this->getEnPwd($user['password_salt'], $this->password)) {
                    $this->addError('password', '请输入正确的密码！');
                    return;
                }
                return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
            }
        }
        return false;
    }

    //密码原文到加密
    public function getEnPwd($salt, $pwd)
    {
        return md5($salt.md5($pwd));
    }

    //根据用户名查询用户信息
    public function getUserInfo()
    {
        $userInfo = self::find()->where(['username' => $this->username, 'is_delete' => self::STATUS_ACTIVE])->asArray()->one();
        if ($userInfo) {
            return $userInfo;
        }
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = self::findByUsername($this->username);
        }
        return $this->_user;
    }

    /**
     * @inheritdoc
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    //注册新用户
    public function signup($data)
    {
        if (!$this->validate()) {
            return null;
        }
        //生成随机盐
        $salt = Util::random_number('12', 'alnum');
        $user = new User();
        $user->uuid = Util::random_number('32', 'alnum');
        $user->username = $data['User']['username'];
        $user->nickname = $data['User']['username'];
        $user->phone = $data['User']['phone'];
        $user->password = $this->getEnPwd($salt, $data['User']['password']);
        $user->password_salt = $salt;
        $user->generateAuthKey();

        try {
            $user->save();
            return $user;
        } catch (Exception $e) {
            //捕获异常，写入日志
            $message = "\n".date("Y-m-d H:i:s")."数据插入失败，原因:".$e->getMessage()."|数据:".json_encode($data);
            Yii::error($message, 'sql');
            return null;
        }
    }

    //key生成
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

}
