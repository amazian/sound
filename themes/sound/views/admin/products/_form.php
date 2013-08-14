<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'product-form',
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
    <li class="active"><a data-toggle="tab" href="#general"><?php echo Yii::t('products', 'General'); ?></a></li>
    <li><a data-toggle="tab" href="#data"><?php echo Yii::t('products', 'Data'); ?></a></li>
    <li><a data-toggle="tab" href="#links"><?php echo Yii::t('products', 'Links'); ?></a></li>
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
            <?php echo $form->label($model, 'description', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php $this->widget('application.extensions.yiickeditor.YiiCKEditor', array(
                    'model'=>$model,
                    'attribute'=>'description',
                )); ?>
            </div>
        </div>
    <!--</div>-->
    <!--<div id="data" class="tab-pane fade">-->
        <div class="control-group">
            <?php echo $form->label($model, 'model', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'model', array('class' => 'span2')); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->label($model, 'type', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'type', array('class' => 'span2')); ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->label($model, 'price', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php echo $form->textField($model, 'price', array('class' => 'span2')); ?> NTD
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->label($model, 'image', array('class' => 'control-label')); ?>
            <div class="controls">
                <ul class="thumbnails">
                  <li class="span2">
                  <div class="thumbnail">
                      <img id="thumb" alt="" src="<?php if(!is_null($model->getProduct())) echo $model->getProduct()->getImageWithSize(100, 100); ?>">
                      <div class="caption">
                        <p>
                            <?php
                            $this->widget('application.extensions.yiiavatarupload.YiiAvatarUpload', array(
                                'model' => $model,
                                'attribute' => 'image',
                                'thumb'=>'#thumb',
                                'urlPost'=>$this->createUrl('/admin/fileManager/upload'),                        
                                'urlGet'=>$this->createUrl('/admin/fileManager/image'),
                                'directory'=>'products',
                                'htmlOptions'=>array('class'=>'btn btn-primary')                        
                            ));
                            ?>
                        </p>
                    </div>
                  </li>
                </ul>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->label($model, 'manufacturer', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php $this->widget('TypeaheadSingle', array(
                    'model' => $model,
                    'attribute' => 'manufacturer',
                    'value' => $model->getProduct()->getManufacturerName(),
                    'htmlOptions' => array('class' => 'span2'),
                    'url'=>$this->createUrl('/admin/manufacturers/autocomplete')                    
                ))?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->label($model, 'categories', array('class' => 'control-label')); ?>
            <div id="categories-container" class="controls">
                <?php 
                $list = $model->getProduct()->getCategoriesIdList();
                $list = array_reverse($list);
                foreach($list as $index => $categoryId){ 
                    $category = Category::model()->findByPk($categoryId);
                    if(!is_null($category) && $category->hasParent())
                        $categories = $category->parent->childCategories;
                    else
                        $categories = Category::model()->findAllByAttributes (array('parent_id'=>0));
                    
                    $descriptions = array();
                    foreach($categories as $cat) $descriptions[] = $cat->description;
                    $values = CHtml::listData($descriptions, 'category_id', 'name');
                    $values[0] = '';
                    
                    if($categoryId === end($list))
                        echo $form->dropDownList($model, 'categories[]', $values, array('class'=>'categoryDropDownList'));
                    else
                        echo CHtml::dropDownList('', $categoryId, $values, array('class'=>'categoryDropDownList'));
                }   
                ?>
            </div>
        </div>
        <div class="control-group">
            <?php echo $form->label($model, 'Specs', array('class' => 'control-label')); ?>
            <div class="controls">
                <div id="specs-container">
                    <?php foreach($model->getProduct()->specs as $index => $spec): ?>
                    <div>
                        <?php echo CHtml::dropDownList(CHtml::activeName($model, 'specs') . "[{$index}]", $spec->spec_id, $specs, array('class'=>'span3')); ?><?php echo $form->textField($model, "value_init[{$index}]", array('class'=>'input-mini value_start', 'value'=>$spec->value_init)); ?><?php echo $form->textField($model, "value_end[{$index}]", array('class'=>'input-mini', 'value'=>$spec->value_end)); ?><?php echo CHtml::dropDownList(CHtml::activeName($model, 'units') . "[{$index}]", $spec->unit_id, $units, array('class'=>'span3')); ?>
                        <button type="button" onclick="$(this).parent('div').detach();" class="btn btn-small btn-danger">X</button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="#" id="addSpec" class="btn">+ Add Spec&amp;Unit</a>
            </div>
        </div>
    <!--</div>-->
    <!--<div id="links" class="tab-pane fade">-->
    <!--</div>
</div>-->
<?php echo $form->hiddenField($model, 'status', array('value'=>1)); ?>
<?php $this->endWidget(); ?>

<script>
    function onChange(){
        if(this.value != 0){
            $("#categories-container select:gt(" + $(this).index() + ")").remove();

            $.get('<?php echo $this->createUrl('/admin/products/addCategoryDownList'); ?>', {categoryId: this.value}, function(html){
                if(html != ''){
                    var activeField = $('#<?php echo CHtml::activeId($model, 'categories'); ?>');
                    activeField.attr('name', '');
                    activeField.attr('id', '');

                    $('.categoryDropDownList').off('change');
                    $('#categories-container').append(html);
                    $('.categoryDropDownList').on('change', onChange);
                }
            });
        }
    }
    $('.categoryDropDownList').on('change', onChange);
    
    var currentSpecsCount = '<?php echo count($model->getProduct()->specs); ?>';
    $('#addSpec').on('click', function(){
        html  = '<div>';
        html += <?php echo CJavaScript::encode($form->dropDownList($model, 'specs[:replaceById]', $specs, array('class'=>'span3'))); ?>;
        html += <?php echo CJavaScript::encode($form->textField($model, 'value_init[:replaceById]', array('class'=>'input-mini value_start'))); ?>;
        html += <?php echo CJavaScript::encode($form->textField($model, 'value_end[:replaceById]', array('class'=>'input-mini'))); ?>;
        html += <?php echo CJavaScript::encode($form->dropDownList($model, 'units[:replaceById]', $units, array('class'=>'span3'))); ?>;
        html += ' <button type="button" onclick="$(this).parent(\'div\').detach();" class="btn btn-small btn-danger">X</button>';
        html += '</div>';
        html  = html.replace(new RegExp(':replaceById', 'g'), currentSpecsCount);
        currentSpecsCount++;
        
        $('#specs-container').append(html);
        
        // reasign onKeyPress function
        $('.value_start').off('keyup');
        $('.value_start').on('keyup', onKeyPress);
        
        return false;
    });
    
    function onKeyPress(){
        if(isNaN(this.value)){
            $(this).next('input').val('');
            $(this).next('input').attr('disabled', true);
        }
        else{
            $(this).next('input').attr('disabled', false);
        }
    }    
    $('.value_start').on('keyup', onKeyPress);
    $('#specs-container > .value_start').each(onKeyPress);
</script>