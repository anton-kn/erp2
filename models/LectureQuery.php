<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Lecture]].
 *
 * @see Lecture
 */
class LectureQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Lecture[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Lecture|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
