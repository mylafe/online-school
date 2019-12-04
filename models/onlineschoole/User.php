<?php

namespace app\models\onlineschoole;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $uuid 身份唯一标识
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
            ['rememberMe', 'boolean'],
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

}
