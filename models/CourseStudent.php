<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\Course;

/**
 * This is the model class for table "course_student".
 *
 * @property int $id
 * @property int $course_id Курс
 * @property int $student_id Студент
 *
 * @property Course $course
 * @property User $student
 */
class CourseStudent extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'course_student';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['course_id', 'student_id'], 'required'],
            [['course_id', 'student_id'], 'default', 'value' => null],
            [['course_id', 'student_id'], 'integer'],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
//            'id' => 'ID',
            'course_id' => 'Курс',
            'student_id' => 'Студент',
        ];
    }
    

    /**
     * Gets query for [[Course]].
     *
     * @return \yii\db\ActiveQuery|CourseQuery
     */
    public function getCourse()
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    /**
     * Gets query for [[Student]].
     *
     * @return \yii\db\ActiveQuery|UserQuery
     */
    public function getStudent()
    {
        return $this->hasOne(User::class, ['id' => 'student_id']);
    }
    
    public function getCourseStudent()
    {
        return $this->hasOne(Course::class, ['id' => 'course_id']);
    }

    /**
     * {@inheritdoc}
     * @return CourseStudentQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CourseStudentQuery(get_called_class());
    }
    
    /**
     * Проверка студента: один курс - один студент
     * @property int id 
     */
    public static function checkStudent($id){
        $user = User::findOne($id);
        $check = self::find()->where(['student_id' => $user->id])->one();
        if ($check){
            return true;
        }
        return false;
    }
}
