<?php namespace common\components\web;

class View extends \yii\web\View
{
    public function webUrl($path)
    {
        $path = ltrim($path, '/');
        return \Yii::getAlias("@web/$path");
    }

    public function jsVariable($name, $data)
    {
        if (is_array($data)) {
            $data = json_encode($data);
            return "<script>window.{$name}={$data}</script>";
        } elseif (is_string($data)) {
            return "<script>window.{$name}='{$data}'</script>";
        } elseif ($data === false) {
            return "<script>window.{$name}=false</script>";
        } elseif ($data === true) {
            return "<script>window.{$name}=true</script>";
        } elseif ($data === null) {
            return "<script>window.{$name}=null</script>";
        } else {
            return "<script>window.{$name}={$data}</script>";
        }
    }

}