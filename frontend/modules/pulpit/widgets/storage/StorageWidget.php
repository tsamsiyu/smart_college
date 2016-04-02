<?php namespace frontend\modules\pulpit\widgets\storage;

use common\components\helpers\FileHelper;
use yii\base\InvalidConfigException;
use yii\web\View;
use yii\base\Widget;
use yii\helpers\Html;
use \frontend\modules\pulpit\widgets\storage\StorageWidgetAsset;


class StorageWidget extends Widget
{
    public $path;
    public $id;
    public $initFolder;

    protected $lastFolderLevel;


    public function run()
    {
        if (!$this->id) {
            throw new InvalidConfigException('`Id` must be set');
        }

        $this->lastFolderLevel = $this->initFolder;
        $storageMarkup = $this->recursivelyStorageBuilder(new \RecursiveDirectoryIterator($this->path));
        $folderPatternMarkup = Html::tag('div', $this->render('_folder', [
            'folder' => ''
        ]), [
            'class' => 'folder-pattern hidden'
        ]);

        return Html::tag('div', $folderPatternMarkup . $storageMarkup, [
            'class' => 'storage-wrapper storage-widget',
            'id' => $this->id
        ]);
    }

    protected function recursivelyStorageBuilder(\RecursiveDirectoryIterator $iterator, $visible = true, $html = '')
    {
        $html .= $this->render('index', [
            'iterator' => $iterator,
            'folder' => $this->lastFolderLevel,
            'visible' => $visible
        ]);

        if ($iterator->hasChildren()) {
            var_dump($iterator->getSubPath());
            die;
//            $this->lastFolder = FileHelper::join($this->lastFolder, );
            $this->recursivelyStorageBuilder($iterator->getChildren(), false, $html);
        }

        return $html;
    }

    public static function registerAssets(View $view)
    {
        StorageWidgetAsset::register($view);
    }

}