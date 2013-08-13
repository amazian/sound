<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('manufacturers', 'Brands');
$this->breadcrumbs = array(
    Yii::t('manufacturers', 'Brands'),
    Yii::t('common', 'Create'),
);
?>

<div class="row-fluid">
    <div class="span9"><h1><i class="icon-building"></i>&nbsp;<?php echo Yii::t('manufacturers', 'Brands'); ?></h1></div>
    <div class="span2">
        <div class="btn-group">
            <a onclick="$('#manufacturer-form').submit();" class="btn btn-primary"><?php echo Yii::t('common', 'Create'); ?></button>
            <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-danger"><?php echo Yii::t('common', 'Cancel'); ?></a>
        </div>
    </div>
</div>

<br />

<?php $this->renderPartial('_form', array('model'=>$model)); ?>