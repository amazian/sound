<?php
$this->renderPartial('_leftMenu');
?>

<div class="span9">

    <h3>Change Password</h3>
    <br />

    <?php
    $form = $this->beginWidget('CActiveForm', array(
        'id' => 'changePassword-form',
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

    <?php echo CHtml::submitButton(Yii::t('register', 'Save'), array('id'=>'btnRegister', 'class'=>'btn btn-inverse pull-right')); ?>
        <div class="clearfix"></div>

    <?php $this->endWidget(); ?>

</div>