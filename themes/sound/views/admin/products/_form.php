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

<?php echo CHtml::hiddenField('copy', 0); ?>
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


        <div class="row-fluid">
            <div class="span3">
                <div class="control-group">
                    <?php echo $form->label($model, 'price', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'price', array('class' => 'span12')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo $form->label($model, 'discount', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->textField($model, 'discount', array('class' => 'span6')); ?> %
                    </div>
                </div>
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
        <div class="row-fluid">
            <div class="span4">
                <div class="control-group">
                    <?php echo $form->label($model, 'manufacturer', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php $this->widget('TypeaheadSingle', array(
                            'model' => $model,
                            'attribute' => 'manufacturer',
                            'value' => (!is_null($model->getProduct()) ? $model->getProduct()->getManufacturerName() : ""),
                            'htmlOptions' => array('class' => 'span12'),
                            'url'=>$this->createUrl('/admin/manufacturers/autocomplete')
                        ))?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <?php if(isset($model->getProduct()->manufacturer)): ?>
                <img id="brand-img" alt="" src="<?php echo $model->getProduct()->manufacturer->getImageWithSize(80, 80); ?>" />
                <?php endif; ?>
            </div>
        </div>

        <div class="control-group">
            <?php echo $form->label($model, 'categories', array('class' => 'control-label')); ?>
            <div id="categories-container" class="controls">
                <?php
                $list = array_reverse($model->getProduct()->getCategoriesIdList());
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
                    <?php $productSpecs = !is_null($model->getProduct()) ? $model->getProduct()->specs : array(); ?>
                    <?php foreach($productSpecs as $index => $spec): ?>
                    <div>
                        <?php echo $form->radioButton($model, 'primarySpec', array('value'=>$spec->spec_id, 'uncheckValue'=>null)); ?>
                        <?php echo CHtml::dropDownList(CHtml::activeName($model, 'specs') . "[{$index}]", $spec->spec_id, $specs, array('class'=>'span3')); ?><?php echo $form->textField($model, "value_init[{$index}]", array('class'=>'input-mini value_start', 'value'=>$spec->value_init)); ?><?php echo $form->textField($model, "value_end[{$index}]", array('class'=>'input-mini', 'value'=>$spec->value_end)); ?><?php echo CHtml::dropDownList(CHtml::activeName($model, 'units') . "[{$index}]", $spec->unit_id, $units, array('class'=>'span3')); ?>
                        <button type="button" onclick="$(this).parent('div').detach();" class="btn btn-small btn-danger">X</button>
                    </div>
                    <?php endforeach; ?>
                </div>
                <a href="#" id="addSpec" class="btn">+ Add Spec&amp;Unit</a>
            </div>
        </div>
            
        <div class="control-group">
            <?php echo $form->label($model, 'Tags', array('class' => 'control-label')); ?>
            <div class="controls">
                <?php
                    $this->widget('ext.yii-selectize.YiiSelectize', array(
                        'model' => $model,
                        'attribute' => 'tags',
                        'data' => $model->tags,
                        'selectedValues' => $model->tags,
                        'useWithBootstrap' => true,
                        'cssTheme' => 'bootstrap2',
                        'fullWidth' => false,
                        'multiple' => true,
                        'selectedValues' => array('hello', 'world'),
                    ));
                ?>
            </div>
        </div>

        <div class="row-fluid">
            <div class="span4">
                <div class="control-group">
                    <?php echo $form->label($model, 'status', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->dropDownList($model, 'status', array(0=>"Off", 1=>"On"), array('class' => 'span12')); ?>
                    </div>
                </div>
            </div>
            <div class="span4">
                <div class="control-group">
                    <?php echo $form->label($model, 'preview', array('class' => 'control-label')); ?>
                    <div class="controls">
                        <?php echo $form->dropDownList($model, 'preview', array(0=>"Off", 1=>"On"), array('class' => 'span12')); ?>
                    </div>
                </div>
            </div>
        </div>

    <!--</div>-->
    <!--<div id="links" class="tab-pane fade">-->
    <!--</div>
</div>-->

<?php
// This is used for the duplicate option!
if(isset($_POST['copy']) && $_POST['copy'] == 1) {
    // Nullify id to create a new product.
    $model->id = null;
}
echo $form->hiddenField($model, 'id');
?>

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

    var currentSpecsCount = '<?php echo count($productSpecs); ?>';
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

    $('#manufacturer').on('change', function(){
        var id = $('#<?php echo CHtml::activeId($model, 'manufacturer'); ?>').val();
        $.get('<?php echo $this->createUrl('getBrandPhotoUrl'); ?>', {brand: id}, function(data){
            $('#brand-img').attr('src', data);
        });

        return true;
    });

</script>