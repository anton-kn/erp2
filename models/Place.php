<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "place".
 *
 * @property int $id
 * @property string $address Адрес
 * @property string $cabinet Кабинет
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'place';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['address', 'cabinet'], 'required'],
            [['address'], 'string', 'max' => 200],
            [['cabinet'], 'string', 'max' => 7],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'address' => 'Адрес',
            'cabinet' => 'Кабинет',
        ];
    }

    /**
     * {@inheritdoc}
     * @return PlaceQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlaceQuery(get_called_class());
    }
}
