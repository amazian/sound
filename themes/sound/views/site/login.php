<?php
$this->pageTitle = Yii::app()->name . ' - Login';
$this->breadcrumbs = array(
    'Login',
);
?>

<div class="span12">
    <div class="row">
        <div class="span9">
            <h1>Account login</h1>
        </div>
    </div>
    
    <hr>

    <div class="row">

        <div class="span5 well">
            <h2>New Customers</h2>
            <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p><br>
            <a class="btn btn-primary pull-right" href="<?php echo $this->createUrl('register'); ?>">Create an account</a>
        </div>	 		

        <div class="span5 well pull-right">
            <h2>Registered Customers</h2>
            <p>If you have an account with us, please log in.</p>

            <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                    'validateOnSubmit'=>true,
                ),
            )); ?>
                <fieldset>
                    <div class="control-group">
                        <label class="control-label" for="focusedInput">Email</label>
                        <div class="controls">
                            <?php echo $form->textField($model,'username', array('class'=>'input-xlarge focused', 'placeholder'=>'Enter your username')); ?>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Password</label>
                        <div class="controls">
                            <?php echo $form->passwordField($model,'password', array('class'=>'input-xlarge', 'placeholder'=>'Enter your password')); ?>
                        </div>
                    </div>

                    <?php echo CHtml::submitButton('Login', array('class'=>'btn btn-primary pull-right')); ?>
                </fieldset>
            <?php $this->endWidget(); ?>

        </div>

    </div>
</div>
