<?php
Yii::app()->clientScript->registerCoreScript('jquery');
$this->pageTitle = Yii::app()->name . ' - Register';
$this->breadcrumbs = array(
    'Register',
);
?>

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

<h3>Register</h3>

<br />

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
    <?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model,'email',array('class'=>'span2')); ?>
        <span class="help-block"><?php echo $form->error($model,'email'); ?></span>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->passwordField($model,'password',array('class'=>'span3')); ?>
        <span class="help-block"><?php echo $form->error($model,'password'); ?></span>
    </div>
</div>
<div class="control-group">
    <?php echo $form->labelEx($model,'passwordAgain', array('class'=>'control-label')); ?>
    <div class="controls">
        <?php echo $form->passwordField($model,'passwordAgain', array('class'=>'span3')); ?>
        <span class="help-block"><?php echo $form->error($model,'passwordAgain'); ?></span>
    </div>
</div>

<?php echo CHtml::submitButton(Yii::t('register', 'Register'), array('id'=>'btnRegister', 'class'=>'btn btn-inverse pull-right')); ?>
<div class="clearfix"></div>

<?php $this->endWidget(); ?>