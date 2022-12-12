<?php

namespace app\models;

use Yii;
use app\models\CourseStudent;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $surname Фамилия
 * @property string $firstname Имя
 * @property string $patronymic Отчество
 * @property string $email Почта
 * @property int|null $phone Телефон
 * @property string $password_hash Пароль
 * @property string|null $comment Описание о пользователе
 * @property int $type Пользователь
 * @property bool $is_admin Администратор
 */
class User extends \yii\db\ActiveRecord
{
    
    /*
     * @var TYPE_ADMIN
     */
    
    private const TYPE_ADMIN = 1;
    
    /*
     * @var TYPE_TEACHER
     */
    
    private const TYPE_TEACHER = 2;
    
    /*
     * @var TYPE_STUDENT
     */
    
    private const TYPE_STUDENT= 3;
    
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
            [['surname', 'firstname', 'patronymic', 'email', 'password_hash', 'type'], 'required'],
            [['phone', 'type'], 'default', 'value' => null],
            [['phone', 'type'], 'integer'],
            [['is_admin'], 'boolean'],
            [['surname', 'firstname', 'patronymic', 'email'], 'string', 'max' => 100],
            [['password_hash'], 'string', 'max' => 255],
            [['comment'], 'string', 'max' => 1000],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
            'surname' => 'Фамилия',
            'firstname' => 'Имя',
            'patronymic' => 'Отчество',
            'email' => 'Почта',
            'phone' => 'Телефон',
            'password_hash' => 'Пароль',
            'comment' => 'Описание о пользователе',
            //'type' => 'Пользователь',
            //'is_admin' => 'Администратор',
        ];
    }

    /**
     * {@inheritdoc}
     * @return UserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UserQuery(get_called_class());
    }
    
    
    public function beforeSave($insert) 
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }
        $this->password_hash = Yii::$app->getSecurity()->generatePasswordHash($this->password_hash);
        return true;
    }
    
     /*
      * @var false - единственное число
      * @var true - множественное число
     * @return TYPE_TEACHER and TYPE_STUDENT
     */
    public static function getUsers($rule = false){
        $teacher = 'Преподаватель';
        $student = 'Студент';
        $admin = 'Администратор';
        $rule == true ? $teacher = 'Преподаватели' : $teacher = 'Преподаватель';
        $rule == true ? $student = 'Студенты' : $student = 'Студент';
        return 
        [
            self::TYPE_ADMIN => $admin,
            self::TYPE_TEACHER =>  $teacher ,
            self::TYPE_STUDENT => $student
        ];
    }
    
    public static function getAdmin(){
        return self::TYPE_ADMIN;
    }
    
    public static function getTeacher(){
        return self::TYPE_TEACHER;
    }
    
    public static function getStudent(){
        return self::TYPE_STUDENT;
    }
    
        
    /**
     * Возвращает полные имена всех пользователей
     * @param type $const - true - студенты, false - преподаватели 
     */
    
    public static function getFullName($const = false){
        $const == false ? $type = self::getTeacher() : $type = self::getStudent();
        $users = self::find()->where(['type' => $type])->all();
        $teachers = [];
        foreach ($users as $user) {
            if(!CourseStudent::checkStudent($user->id)){
                $teachers[$user->id] = $user->firstname . " " . $user->surname . " " . $user->patronymic;
            }
        }
        return $teachers;
    }
    
    /**
     * 
     * @return возвращает id - аутентифицированного пользователя
     */
    public static function getIdentityUserId(){
        if(isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == self::TYPE_ADMIN){
            return Yii::$app->user->identity->user->id;
        }
        if(isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == self::TYPE_TEACHER){
            return Yii::$app->user->identity->user->id;
        }
        if(isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == self::TYPE_STUDENT){
            return Yii::$app->user->identity->user->id;
        }
        return null;
    }

}
