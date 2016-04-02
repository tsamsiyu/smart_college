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

        $storageLevelPatternMarkup = Html::tag('div', $this->render('index', [
            'iterator' => new \ArrayIterator(),
            'folder' => '',
            'visible' => true,
            'storageLevel' => ''
        ]), [
            'class' => 'storage-pattern hidden'
        ]);

        return Html::tag('div', $storageLevelPatternMarkup . $folderPatternMarkup . $storageMarkup, [
            'class' => 'storage-wrapper storage-widget',
            'id' => $this->id
        ]);
    }

    protected function recursivelyStorageBuilder(\RecursiveDirectoryIterator $iterator, $visible = true, $html = '', $level = 1)
    {
        $html .= $this->render('index', [
            'iterator' => $iterator,
            'folder' => $this->lastFolderLevel,
            'visible' => $visible,
            'storageLevel' => $level
        ]);

        foreach ($iterator as $item) {
            if ($item->getFilename() != '.' && $item->getFilename() != '..') {
                if ($iterator->hasChildren()) {
                    if (!FileHelper::emptyPath($item->getPath(), $item->getFilename())) {
                        $html .= $this->recursivelyStorageBuilder($iterator->getChildren(), false, $html, $level + 1);
                    }
                }
            }
        }

        return $html;
    }

    public static function registerAssets(View $view)
    {
        StorageWidgetAsset::register($view);
    }

}