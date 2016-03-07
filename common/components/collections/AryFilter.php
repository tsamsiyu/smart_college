<?php namespace common\components\collections;

class AryFilter
{
    public static function rmEmpty(array &$data)
    {
        $removed = [];
        foreach ($data as $i => $v) {
            if (empty($v)) {
                unset($data[$i]);
                $removed[$i] = $v;
            }
        }

        return $removed;
    }
}