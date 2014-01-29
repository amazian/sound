<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('paypal', 'PayPal Configuration');
$this->breadcrumbs = array(
    Yii::t('paypal', 'Payment Gateways'),
    Yii::t('paypal', 'PayPal'),
);
?>

    <div class="row-fluid">
        <div class="span9"><h1><i class="icon-cog"></i>&nbsp;<?php echo Yii::t('paypal', 'PayPal Configuration'); ?></h1></div>
        <div class="span2">
            <div class="btn-group">
                <a onclick="$('#paypal-form').submit();" class="btn btn-primary"><?php echo Yii::t('common', 'Save'); ?></a>
            </div>
        </div>
    </div>

    <br />

<?php $this->renderPartial('_form', array(
    'model'=>$model,
)); ?>