<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'category-form',
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
<div class="control-group">
    <?php echo $form->label($model, 'name', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model, 'name', array('class' => 'span8')); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->label($model, 'description', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php
        $this->widget('application.extensions.yiickeditor.YiiCKEditor', array(
            'model' => $model,
            'attribute' => 'description',
        ));
        ?>
    </div>
</div>
<div class="control-group">
        <?php echo $form->label($model, 'parent', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo CHtml::checkBox("noparent", ($model->parent == 0)); ?>&nbsp; No parent<br /><br />
        <?php
        $this->widget('TypeaheadSingle', array(
            'model' => $model,
            'attribute' => 'parent',
            'value' => $model->getCategory()->getParentName(),
            'htmlOptions' => array('class' => 'span8'),
            'url' => $this->createUrl('/admin/categories/autocomplete', array('categoryId' => $model->id))
        ))
        ?>
    </div>
</div>
<div class="control-group">
<?php echo $form->label($model, 'image', array('class' => 'control-label')); ?>
    <div class="controls">
        <ul class="thumbnails">
            <li class="span2">
                <div id="preview" class="preview thumbnail">
                    <img id="thumb" alt="" src="<?php if (!is_null($model->getCategory())) echo $model->getCategory()->getImageWithSize(100, 100); ?>">
                    <div class="caption">
                        <p>
                            <?php
                            $this->widget('application.extensions.yiiavatarupload.YiiAvatarUpload', array(
                                'model' => $model,
                                'attribute' => 'image',
                                'thumb'=>'#thumb',
                                'urlPost'=>$this->createUrl('/admin/fileManager/upload'),                        
                                'urlGet'=>$this->createUrl('/admin/fileManager/image'),
                                'directory'=>'categories',
                                'htmlOptions'=>array('class'=>'btn btn-primary')                        
                            ));
                            ?>
                        </p>
                    </div>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="control-group">
<?php echo $form->label($model, 'status', array('class' => 'control-label')); ?>
    <div class="controls">
<?php echo $form->dropDownList($model, 'status', $statuses, array('class' => 'span2')); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->label($model, 'bottomMost', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->dropDownList($model, 'bottomMost', array(0=>"No", 1=>"Yes"), array('class' => 'span1', 'disabled'=>(count($model->getCategory()->childCategories) > 0 ? true : false))); ?>
    </div>
</div>
<div class="control-group">
    <?php echo $form->label($model, 'sortOrder', array('class' => 'control-label')); ?>
    <div class="controls">
        <?php echo $form->textField($model, 'sortOrder', array('class' => 'span1')); ?>
    </div>
</div>

<?php $this->endWidget(); ?>

<script>
    if($('#noparent').is(':checked')){
        $('#parent').attr('disabled', 'disabled');
    };

    $('#noparent').on('change', function(){
        if ($('#parent').attr('disabled')) $('#parent').removeAttr('disabled');
        else {
            $('#CategoryForm_parent').val('0');
            $('#parent').attr('disabled', 'disabled');
        }
    });
</script>