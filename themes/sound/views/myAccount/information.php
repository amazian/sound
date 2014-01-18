<?php
$this->renderPartial('_leftMenu');
?>

<div class="span9">

    <h3>Account information</h3>
    <br />

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

        <div class="control-group">
            <?php echo $form->labelEx($model,'name', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'name',array('class'=>'span4')); ?>
                <span class="help-block"><?php echo $form->error($model,'name'); ?></span>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'phone', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model,'phone',array('class'=>'span2')); ?>
                <span class="help-block"><?php echo $form->error($model,'phone'); ?></span>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->labelEx($model,'address', array('class'=>'control-label')); ?>
            <div class="controls">
                <?php echo $form->textArea($model,'address',array('class'=>'span5')); ?>
                <span class="help-block"><?php echo $form->error($model,'address'); ?></span>
            </div>
        </div>

    <?php echo CHtml::submitButton(Yii::t('register', 'Save'), array('id'=>'btnRegister', 'class'=>'btn btn-inverse pull-right')); ?>
        <div class="clearfix"></div>

    <?php $this->endWidget(); ?>

</div>