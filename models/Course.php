<?php

namespace app\models;

use Yii;
use app\models\CourseStudent;

/**
 * This is the model class for table "course".
 *
 * @property int $id
 * @property string $name Название
 * @property string|null $date_start Дата начала
 * @property string|null $date_end Дата конца
 * @property int $status Статус курса
 * @property int $teacher_id Преподаватель
 * @property float|null $rate_med Средняя оценка за курс
 *
 * @property User $teacher
 */
class Course extends \yii\db\ActiveRecord
{
    /*
     * @var SATUS_FORME - курс формируется
     */
    private const STATUS_FORME = 1;
    
    /*
     * @var STATUS_READY - курс готов
     */
    private const STATUS_READY= 2;
    
    /*
     * @var SATUS_OPEN - курс открыт
     */
    private const STATUS_OPEN = 3;
    
    /*
     * @var SATUS_CLOSE - курс закрыт
     */
    private const STATUS_CLOSE = 4;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'status', 'teacher_id'], 'required'],
            [['date_start', 'date_end'], 'safe'],
            [['status', 'teacher_id'], 'default', 'value' => null],
            [['status', 'teacher_id'], 'integer'],
            [['rate_med'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['teacher_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['teacher_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
            'name' => 'Название',
            'date_start' => 'Дата начала',
            'date_end' => 'Дата конца',
            'status' => 'Статус курса',
            'teacher_id' => 'Преподаватель',
            'rate_med' => 'Средняя оценка за курс',
        ];
    }

    /**
     * Gets query for [[Teacher]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getTeacher()
    {
        return $this->hasOne(User::class, ['id' => 'teacher_id']);
    }
    
    public function getCourseStudents(){
        return $this->hasMany(CourseStudent::class, ['course_id' => 'id']);
    }
    
    public function getLectures(){
        return $this->hasMany(Lecture::class, ['course_id' => 'id']);
    }
    

    /**
     * {@inheritdoc}
     * @return CourseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CourseQuery(get_called_class());
    }
    
    
    
    public static function getStatus(){
        return 
        [
            self::STATUS_FORME => "Формируется",
            self::STATUS_READY => "Готов",
            self::STATUS_OPEN => "Открыт",
            self::STATUS_CLOSE => "Закрыт",
        ];
    }
    
    /**
     * Формируте массив курсов
     * @return type
     */
    public static function listCourses(){
        $userIdentity = User::getIdentityUser();
        if($userIdentity->type == User::getAdmin()){
            $courses = self::find()->all();
        }
        
        if($userIdentity->type == User::getTeacher()){
            $courses = self::find()->where(['teacher_id' => $userIdentity->id])->all();
        }
        
        if($userIdentity->type == User::getStudent()){
             // студент может быть записан только на один курс
            $courseStudent = CourseStudent::find()->where(['student_id' => $userIdentity->id])->one();
            if($courseStudent){
                $course = self::find()->where(['id' => $courseStudent->course_id])->one();
                return [$course->id => $course->name];
            }
            return true;
            
        }
        
        $listCourses = [];
        foreach ($courses as $course){
            $listCourses[$course->id] = $course->name;
        }
        return $listCourses;
    }
}
