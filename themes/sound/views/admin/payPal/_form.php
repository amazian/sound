<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'paypal-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    )
));
?>

    <div class="control-group">
        <?php echo $form->label($model, 'business_email', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'business_email', array('class' => 'span4')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->label($model, 'sandbox', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'sandbox', array(0=>"Off", 1=>"On"), array('class' => 'span2')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->label($model, 'return_url', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'return_url', array('class' => 'span4')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->label($model, 'cancel_url', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'cancel_url', array('class' => 'span4')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->label($model, 'notify_url', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'notify_url', array('class' => 'span4')); ?>
        </div>
    </div>

<?php $this->endWidget(); ?>