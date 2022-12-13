<?php

namespace app\models;

use Yii;

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

    /**
     * {@inheritdoc}
     * @return LessonQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new LessonQuery(get_called_class());
    }
}
