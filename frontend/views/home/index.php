<?php
/**
 * @var \common\components\web\View $this
 * @var string $avatarUrl
 */

use yii\helpers\Url;

echo $this->jsVariable('uploadImgUrl', Url::toRoute('storage/save-tmp-img'));


\frontend\assets\HomeAsset::register($this);


?>

<div id="avatar">
    <img src="<?= $avatarUrl ?>" alt="Avatar">
    <a href="#">
        <input type="file" class="uploadable-input" name="avatar" data-url="<?= Url::toRoute('home/upload-avatar') ?>">
        <i class="fa fa-upload"></i>
        <div id="blackfone"></div>
    </a>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="avatar-preview-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><?= Yii::t('app/home', 'resizing') ?></h4>
            </div>
            <div class="modal-body">
                <div style="width: 560px; height: 600px;">
                    <img src="#" alt="Crop avatar" id="avatar-preview" >
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?= Yii::t('app/common', 'close') ?></button>
                <button type="button" class="btn btn-primary"><?= Yii::t('app/common', 'save') ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->