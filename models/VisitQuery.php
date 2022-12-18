<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Visit]].
 *
 * @see Visit
 */
class VisitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Visit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Visit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
