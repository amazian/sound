<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('openPay', 'OpenPay Configuration');
$this->breadcrumbs = array(
    Yii::t('openPay', 'Payment Gateways'),
    Yii::t('openPay', 'OpenPay'),
);
?>

<div class="row-fluid">
    <div class="span9"><h1><i class="icon-cog"></i>&nbsp;<?php echo Yii::t('openPay', 'OpenPay Configuration'); ?></h1></div>
    <div class="span2">
        <div class="btn-group">
            <a onclick="$('#openpay-form').submit();" class="btn btn-primary"><?php echo Yii::t('common', 'Save'); ?></a>
        </div>
    </div>
</div>

<br />

<?php $this->renderPartial('_form', array(
    'model'=>$model,
)); ?>