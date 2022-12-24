<?php

namespace app\models;

use Yii;
use app\models\Course;

/**
 * This is the model class for table "lecture".
 *
 * @property int $id
 * @property int $num Порядковый номер
 * @property string $name Тема лекции
 * @property int $course_id Курс
 * @property float $rate Оценка
 *
 * @property Course $course
 */
class Lecture extends \yii\db\ActiveRecord
{
    private $countNum;
    //private $num;
    
    private $courseId;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lecture';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['num', 'name', 'course_id'], 'required'],
            [['num', 'course_id'], 'default', 'value' => null],
            [['num', 'course_id'], 'integer'],
            [['rate'], 'number'],
            [['name'], 'string', 'max' => 100],
            [['course_id'], 'exist', 'skipOnError' => true, 'targetClass' => Course::class, 'targetAttribute' => ['course_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'num' => 'Номер',
            'name' => 'Тема',
            'course_id' => 'Курс',
            'rate' => 'Оценка',
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
    
    public function getLesson()
    {
        return $this->hasOne(Lesson::class, ['lecture_id' => 'id']);
    }
  
    
   

    /**
     * {@inheritdoc}
     * @return LectureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LectureQuery(get_called_class());
    }
    
    /**
     * Функция присваивает порядковый номер лекции курса
     * $count = 0 return $num = 1
     * $count = n (т.е. $count > 0) return $num = n+1 
     */
    
    public function autoNum($courseId){
        // находим курс
        $course = Course::findOne($courseId);
        // определить количество лекций в lecture для определенного курса
        $this->countNum = self::find()->where(['course_id' => $course->id])->count();
//        echo '<pre>';
//var_dump($this->countNum);
//echo '</pre>';
//exit();
        if(!$this->countNum){
            return '1';
        }
        
        $lecture = self::find()->where(['course_id' => $course->id])->max('num');
        return $lecture + 1;
        
    }
    
//    public function beforeSave($insert) {
//        if (!parent::beforeSave($insert)) {
//            return false;
//        }
//        $courseId = Yii::$app->request->get('courseId');
//        $this->num = $this->autoNum($courseId);
//        return true;
//    }
    
    public function beforeDelete() {
        parent::beforeDelete();
        $lecetureId = Yii::$app->request->get('id'); // id лекции, которую удалили
        $lecture = self::findOne($lecetureId);
        $this->courseId = $lecture->course->id;
        return true;
    }


    public function afterDelete() {
        parent::afterDelete();
        
        $lectures = self::find()->where(['course_id' => $this->courseId])->all();
            
        $i = 0;
        foreach ($lectures as $lecture){
            $i++;
            $lecture->num = $i;
            $lecture->save();
           
        }
        
//         echo '<pre>';
//            var_dump($lecture);
//            echo '</pre>';
//            exit();
        
        return true;
        
//                echo '<pre>';
//            var_dump($request);
//            echo '</pre>';
//            exit();
    }
    
}
