<?php

namespace app\models;

use Yii;
use app\models\User;
use app\models\Course;

/**
 * This is the model class for table "lesson".
 *
 * @property int $id
 * @property int $lecture_id Лекции
 * @property string $date Дата проведения
 * @property string $time_start Время начала
 * @property string $time_end Время конца
 * @property int $place_id Место проведения
 *
 * @property Place $place
 */
class Lesson extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lesson';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['lecture_id', 'date', 'time_start', 'time_end', 'place_id'], 'required'],
            [['lecture_id', 'place_id'], 'default', 'value' => null],
            [['lecture_id', 'place_id'], 'integer'],
            [['date', 'time_start', 'time_end'], 'safe'],
            [['place_id'], 'exist', 'skipOnError' => true, 'targetClass' => Place::class, 'targetAttribute' => ['place_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'lecture_id' => 'Лекция',
            'date' => 'Дата проведения',
            'time_start' => 'Время начала',
            'time_end' => 'Время конца',
            'place_id' => 'Место проведения',
        ];
    }
    

    /**
     * Gets query for [[Place]].
     *
     * @return \yii\db\ActiveQuery|PlaceQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::class, ['id' => 'place_id']);
    }
    
    public function getLecture()
    {
        return $this->hasOne(Lecture::class, ['id' => 'lecture_id']);
    }
    
    public function getVisit(){
        return $this->hasOne(Visit::class, ['lesson_id' => 'id']);
    }
    
    /**
     * Список занятий для преподавателя и для админанистратора
     */
    public function listLesson(){
        $userIdentity = User::getIdentityUser();
        $listNameLesson = [];
        if($userIdentity->type == User::getAdmin()){
           $lessons = self::find()->all();
           foreach ($lessons as $lesson){
               $listNameLesson[$lesson->id] = $lesson->lecture->name;
           }
        }
        if($userIdentity->type == User::getTeacher()){
           $courses = Course::find()->where(['teacher_id' => $userIdentity->id])->all();
           foreach ($courses as $course){
               $lectures = $course->lectures;
               foreach ($lectures as $lecture){
                   if(isset($lecture->lesson->id)){
                       $listNameLesson[$lecture->lesson->id] = $lecture->name;
                   }
                   
               }
               
           }
           
        }
        return $listNameLesson;

    }

    /**
     * {@inheritdoc}
     * @return LessonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LessonQuery(get_called_class());
    }
}
