<?php

namespace common\components\helpers;

class ArrayHelper extends \yii\helpers\ArrayHelper
{
    public static function groupBy(array $list, $key)
    {
        $res = [];

        foreach ($list as $item) {
            if (isset($item[$key])) {
                $res[$item[$key]][] = $item;
            }
        }

        return $res;
    }
}