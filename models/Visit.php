<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visit".
 *
 * @property int $id
 * @property int $student_id Студент
 * @property int $lesson_id Занятие
 * @property int|null $rate Оценка
 *
 * @property Lesson $lesson
 * @property User $student
 */
class Visit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['student_id', 'lesson_id'], 'required'],
            [['student_id', 'lesson_id', 'rate'], 'default', 'value' => null],
            [['student_id', 'lesson_id', 'rate'], 'integer'],
            [['lesson_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lesson::class, 'targetAttribute' => ['lesson_id' => 'id']],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['student_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'student_id' => 'Студент',
            'lesson_id' => 'Занятие',
            'rate' => 'Оценка',
        ];
    }

    /**
     * Gets query for [[Lesson]].
     *
     * @return \yii\db\ActiveQuery|LessonQuery
     */
    public function getLesson()
    {
        return $this->hasOne(Lesson::class, ['id' => 'lesson_id']);
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

    /**
     * {@inheritdoc}
     * @return VisitQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new VisitQuery(get_called_class());
    }
    
    /**
     * Оценки за занятии
     */
    
    public static function rateLesson(){
        return ['1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5];
    }
}
