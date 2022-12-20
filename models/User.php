<?php

namespace app\models;

use Yii;
use app\models\CourseStudent;
use app\models\Lesson;

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
class User extends \yii\db\ActiveRecord {
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
    private const TYPE_STUDENT = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
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
    public function attributeLabels() {
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
    public static function find() {
        return new UserQuery(get_called_class());
    }

    public function beforeSave($insert) {
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
    
    public static function typeUsers($rule = false) {
        $teacher = 'Преподаватель';
        $student = 'Студент';
        $admin = 'Администратор';
        //$rule == true ? $teacher = 'Преподаватели' : $teacher = 'Преподаватель';
        //$rule == true ? $student = 'Студенты' : $student = 'Студент';
        return
        [
            self::TYPE_ADMIN => $admin,
            self::TYPE_TEACHER => $teacher,
            self::TYPE_STUDENT => $student
        ];
    }
    
    
    

    public static function getAdmin() {
        return self::TYPE_ADMIN;
    }

    public static function getTeacher() {
        return self::TYPE_TEACHER;
    }

    public static function getStudent() {
        return self::TYPE_STUDENT;
    }

    /**
     * Возвращает полные имена всех пользователей
     * Пользователи возвращаются только те, которые не записаны на курс
     * @param type $const - true - студенты, false - преподаватели 
     */
    //  переделать или удалить!!!!
    public static function getFullName($const = false) {
        $const == false ? $type = self::getTeacher() : $type = self::getStudent();
        $users = self::find()->where(['type' => $type])->all();
        $teachers = [];
        foreach ($users as $user) {
            if (!CourseStudent::checkStudent($user->id)) { // если студент не записан на курс более одного раза
                $teachers[$user->id] = $user->firstname . " " . $user->surname . " " . $user->patronymic;
            }
        }
        return $teachers;
    }
    
    /**
     * Список студентов через список занятия
     */
    public static function studentsByLesson($lessonId)
    {
        $lesson = Lesson::findOne($lessonId);
        $courseId = $lesson->lecture->course_id; // находим id курса в лекции
        $courseStudents = CourseStudent::find()->where(['course_id' => $courseId])->all();
        $studentId = [];
        foreach ($courseStudents as $student){
            $studentId[] = $student->student_id;
        }
        
        return self::find()->where(['id' => $studentId])->all(); // студенты занятия
    }
    
    /**
     * Список студентов принадлежащих к курсам преподавателя или администратора
     */
    public static function studentsOfCourseIdentityUser() {
        $userIdentity = self::getIdentityUser();
        if ($userIdentity->type == self::TYPE_ADMIN) {
            $students = self::find()->where(['type' => self::TYPE_STUDENT])->all();
        }

        if ($userIdentity->type == self::TYPE_TEACHER) {
            $courses = Course::find()->where(['teacher_id' => $userIdentity->id])->all();
            //$students = self::find()->where(['type' => self::TYPE_STUDENT])->all();
            $studentId = [];
            foreach ($courses as $course){
                $students = $course->courseStudents;
                foreach ($students as $student){
                    $studentId[] = $student->student_id;
                }
            }
            
            $students = self::find()->where(['id' => $studentId ])->all();
        }
        
        $studentsList = [];
        foreach ($students as $student) {
            $studentsList[$student->id] = $student->firstname . " " . $student->surname . " " . $student->patronymic;
        }
        
        return $studentsList;
        
    }

    /**
     * Список студентов с проверкой на существование в таблице
     * @param $check - true (по умолчанию) - с проверкой на существование в таблице, 
     * false - без проверки на существование в таблице
     * @return string
     */
    public static function listStudents($check = true) {
        $students = self::find()->where(['type' => self::TYPE_STUDENT])->all();
        $studentsList = [];
        if ($check === true) {
            foreach ($students as $student) {
                if (!CourseStudent::checkStudent($student->id)) { // если студент не записан на курс более одного раза
                    $studentsList[$student->id] = $student->firstname . " " . $student->surname . " " . $student->patronymic;
                }
            }
        }
        if ($check === false) {
            foreach ($students as $student) {
                $studentsList[$student->id] = $student->firstname . " " . $student->surname . " " . $student->patronymic;
            }
        }

        return $studentsList;
    }

    /**
     * 
     * @return возвращает id - аутентифицированного пользователя студента или преподавателя
     * и объект администратора
     */
    public static function getIdentityUser() {
        if (isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == self::TYPE_ADMIN) {
            return Yii::$app->user->identity->user;
        }
        if (isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == self::TYPE_TEACHER) {
            return Yii::$app->user->identity->user;
        }
        if (isset(Yii::$app->user->identity->user) && Yii::$app->user->identity->user->type == self::TYPE_STUDENT) {
            return Yii::$app->user->identity->user;
        }
        return null;
    }

    /**
     * Все курсы преподавателя
     */
    public function getCourses() {
        return $this->hasMany(Course::class, ['teacher_id' => 'id']);
    }

}
