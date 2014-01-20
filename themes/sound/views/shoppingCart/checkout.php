<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'register-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-register form-horizontal'
    ),
));
?>
<div class="accordion" id="accordion2">
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" href="#">
                Your Address
            </a>
        </div>
        <div id="collapseOne" class="accordion-body collapse in">
            <div class="accordion-inner">
                <?php echo $form->textArea($model, 'address', array('class'=>'span12')); ?>
                <br /><br />
                <a class="btn btn-success pull-right" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Next</a>
                <br />
                <br />
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle" href="#">
               Delivery
            </a>
        </div>
        <div id="collapseTwo" class="accordion-body collapse">
            <div class="accordion-inner">
                <?php echo $form->radioButtonList($model, 'deliveryType', $shippingOptions); ?>
                <br /><br />
                <a class="btn btn-success pull-right" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Next</a><a class="btn pull-right" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Back</a>
                <br />
                <br />
            </div>
        </div>
    </div>
    <div class="accordion-group">
        <div class="accordion-heading">
            <a class="accordion-toggle">
                Payment
            </a>
        </div>
        <div id="collapseThree" class="accordion-body collapse">
            <div class="accordion-inner">
                <?php echo $form->radioButtonList($model, 'paymentGateway', $paymentGateways); ?>
                <br /><br />
                <button type="submit" class="btn btn-success pull-right">Continue</button><a class="btn pull-right" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Back</a>
                <br />
                <br />
            </div>
        </div>
    </div>
</div>
<?php $this->endWidget(); ?>