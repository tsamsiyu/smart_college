<?php namespace common\components\db;

class ActiveQuery extends \yii\db\ActiveQuery
{
    public function byPk($val)
    {
        $alias = $this->getAlias();
        /* @var ActiveRecord $modelClass string of className */
        $modelClass = $this->modelClass;
        $pkName = $modelClass::getIdName();
        $this->andWhere(["$alias.$pkName" => $val]);

        return $this;
    }

    public function getAlias()
    {
        /* @var ActiveRecord $modelClass string of className */
        $modelClass = $this->modelClass;
        $tableName = $modelClass::tableName();

        if ($this->from) {
            $alias = key($this->from);
            if (!is_numeric($alias)) {
                $tableName = $alias;
            }
        }

        return $tableName;
    }

}