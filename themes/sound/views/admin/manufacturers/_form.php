<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'manufacturer-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array(
        'class' => 'form-horizontal',
    )
));
?>
<?php echo $form->hiddenField($model, 'id'); ?>
<!--<ul class="nav nav-tabs" id="myTab">
    <li class="active"><a data-toggle="tab" href="#general">General</a></li>
</ul>-->
<!--<div class="tab-content" id="myTabContent">
    <div id="general" class="tab-pane fade in active">-->
        <div class="control-group">
            <?php echo $form->label($model, 'name', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'name', array('class' => 'span8')); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->label($model, 'image', array('class' => 'control-label')); ?>
            <div class="controls">
                <ul class="thumbnails">
                    <li class="span2">
                        <div class="thumbnail">
                            <img id="thumb" alt="" src="<?php if(!is_null($model->getManufacturer())) echo $model->getManufacturer()->getImageWithSize(100, 100); ?>">
                            <div class="caption">
                                <p>
                                    <?php
                                    $this->widget('application.extensions.yiiavatarupload.YiiAvatarUpload', array(
                                        'model' => $model,
                                        'attribute' => 'image',
                                        'thumb'=>'#thumb',
                                        'urlPost'=>$this->createUrl('/admin/fileManager/upload'),
                                        'urlGet'=>$this->createUrl('/admin/fileManager/image'),
                                        'directory'=>'brands',
                                        'htmlOptions'=>array('class'=>'btn btn-primary')
                                    ));
                                    ?>
                                </p>
                            </div>
                    </li>
                </ul>
            </div>
        </div>
    <!--</div>
</div>-->

<?php $this->endWidget(); ?>

<?php $this->renderPartial('/common/_fileManager'); ?>