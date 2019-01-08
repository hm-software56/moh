<?php

namespace app\models;

use Yii;
use \app\models\base\User as BaseUser;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "user".
 */
class User extends BaseUser implements \yii\web\IdentityInterface
{
    public $authKey;

    public function behaviors()
    {
        return ArrayHelper::merge(
            parent::behaviors(),
            [
                # custom behaviors
            ]
        );
    }

    public function rules()
    {
        return ArrayHelper::merge(
           
            [
                [['first_name', 'last_name', 'email', 'password', 'department_id'], 'required','message'=>'ຕ້ອງປ້ອນ {attribute}'],
				['password', 'string', 'min' =>4, 'max' => 8],
            ],
            parent::rules()
        );
    }

    public function attributeLabels()
    {
        return ArrayHelper::merge(
            parent::attributeLabels(),
            [
                'id' => Yii::t('models', 'ລະ​ຫັດ'),
                'first_name' => Yii::t('models', 'ຊື່'),
                'last_name' => Yii::t('models', 'ນ​າມ​ສະ​ກຸນ'),
                'email' => Yii::t('models', '​ອີ​ເມວ'),
                'password' => Yii::t('models', '​ລະ​ບ​ຫັດ​ຜ່ານ'),
                'department_id' => Yii::t('models', 'ພະ​ແນກ'),
                'mobile' => Yii::t('models', '​ເບີ​ໂທ'),
                'status' => Yii::t('models', 'ສ​ະ​ຖາ​ນະ'),
                'type' => Yii::t('models', 'ປະ​ເພດ'),
            ]
        );
    }

/////////////// for login function //////////////////////
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' =>1]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        foreach (self::$users as $user) {
            if ($user['accessToken'] === $token) {
                return new static($user);
            }
        }

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['email' => $username, 'status' =>1]);
    }

    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }
/**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $this->password === $password;
    }
}
