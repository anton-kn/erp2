<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[CourseStudent]].
 *
 * @see CourseStudent
 */
class CourseStudentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return CourseStudent[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return CourseStudent|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
