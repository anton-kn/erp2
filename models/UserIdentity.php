<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
use app\models\User;
use Yii;

class UserIdentity extends ActiveRecord implements IdentityInterface {

    public $id;
    public $username;
    public $password;
    public $authKey;
    public $accessToken;
    
    /**
     * Текущий пользователь
     * @var User
     */
    public $user;  
    
    protected static function createIdentity(User $user): UserIdentity {
        $identity = new UserIdentity();
        $identity->id = $user->id;
        $identity->username = $user->email;
        $identity->user = $user;
        return $identity;
    }
    
    
    /**
     * Идентифицируем по email
     */
    
    public static function findByUsername($username){
        $user = User::findOne(['email' => $username]);
        return $user ? self::createIdentity($user): null;
    }
    
    
    
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->user->password_hash);        
    }
    
    /**
     * Finds an identity by the given ID.
     *
     * @param string|int $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id) {
        $user = User::findOne($id);
        return $user ? self::createIdentity($user) : null;
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null) {
        //return static::findOne(['access_token' => $token]);
        return null;
    }

    /**
     * @return int|string current user ID
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey() {
        return $this->authKey;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey) {
        return $this->getAuthKey() === $authKey;
    }

}
