<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('products', 'Products');
$this->breadcrumbs = array(
    Yii::t('products', 'Products'),
    Yii::t('common', 'Create'),
);
?>

<div class="row-fluid">
    <div class="span9"><h1><i class="icon-cog"></i>&nbsp;<?php echo Yii::t('products', 'Products'); ?></h1></div>
    <div class="span2">
        <div class="btn-group">
            <a onclick="$('#copy').val(1); $('#product-form').submit();" class="btn btn-primary"><?php echo Yii::t('common', 'Create & Copy'); ?></button>
            <a onclick="$('#product-form').submit();" class="btn btn-primary"><?php echo Yii::t('common', 'Create'); ?></button>
            <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-danger"><?php echo Yii::t('common', 'Cancel'); ?></a>
        </div>
    </div>
</div>

<br />

<?php $this->renderPartial('_form', array(
    'model'=>$model, 
    'statuses'=>$statuses,
    'yes_no'=>$yes_no,
    'stockStatuses'=>$stockStatuses,
    'weightClasses'=>$weightClasses,
    'lengthClasses'=>$lengthClasses,
    'specs'=>$specs,
    'units'=>$units
)); ?>

<div class="row-fluid">
    <div class="span9">&nbsp;</div>
    <div class="span2">
        <div class="btn-group">
            <a onclick="$('#copy').val(1); $('#product-form').submit();" class="btn btn-primary"><?php echo Yii::t('common', 'Create & Copy'); ?></button>
                <a onclick="$('#product-form').submit();" class="btn btn-primary"><?php echo Yii::t('common', 'Create'); ?></button>
                    <a href="<?php echo $this->createUrl('index'); ?>" class="btn btn-danger"><?php echo Yii::t('common', 'Cancel'); ?></a>
        </div>
    </div>
</div>

<br />