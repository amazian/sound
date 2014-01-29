<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'openpay-form',
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
        <?php echo $form->label($model, 'mid', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->textField($model, 'mid', array('class' => 'span4')); ?>
        </div>
    </div>
    <div class="control-group">
        <?php echo $form->label($model, 'language', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php echo $form->dropDownList($model, 'language', array("tchinese"=>"Traditional Chinese", "schinese"=>"Chinese", "english"=>"English"), array('class' => 'span3')); ?>
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