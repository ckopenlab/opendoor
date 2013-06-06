<?php $this->beginContent('//layouts/root'); ?>
<div id="header" class="<?= Yii::app()->user->isGuest ? 'guest' : '' ?>">
    <a href="/admin" class="logo"><h1><?= Yii::app()->name ?></h1></a>
    <div class="buttons">
        <a href="javascript:location.reload();" class="refresh"></a>
        <a href="/admin" class="home"></a>
    </div>
</div>
<div id="page">
<?php echo $content; ?>
</div>
<?php $this->endContent('//layouts/root'); ?>