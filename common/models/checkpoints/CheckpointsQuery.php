<?php

namespace common\models\checkpoints;

/**
 * This is the ActiveQuery class for [[Checkpoint]].
 *
 * @see Checkpoint
 */
class CheckpointsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Checkpoint[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Checkpoint|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
