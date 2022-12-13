<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Lesson]].
 *
 * @see Lesson
 */
class LessonQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Lesson[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lesson|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
