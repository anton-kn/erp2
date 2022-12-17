<?php

namespace app\models;

use Yii;

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
    
   

    /**
     * {@inheritdoc}
     * @return LectureQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LectureQuery(get_called_class());
    }
    
    /**
     * Функция присваивает порядковый номер лекции
     * $count = 0 return $num = 1
     * $count = n (т.е. $count > 0) return $num = n+1 
     * @param type $count
     */
    
    public function valueNum($count)
    {
        
    }
}
