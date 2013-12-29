<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('products', 'Products');
$this->breadcrumbs = array(
    Yii::t('products', 'Products'),
);
?>

<div class="row-fluid">
    <div class="span9"><h1><i class="icon-cog"></i>&nbsp;<?php echo Yii::t('products', 'Products'); ?></h1></div>
    <div class="span2">
        <div class="btn-group">
            <a href="<?php echo $this->createUrl('create'); ?>" class="btn btn-success"><?php echo Yii::t('common', 'Insert'); ?></a>
            <a id="btnDeleteAll" href="#" class="btn btn-danger"><?php echo Yii::t('common', 'Delete'); ?></a>
        </div>
    </div>
</div>

<form class="form-inline">
    <label>Select category</label>
    <div id="categories-container" class="controls">
        <?php
        echo CHtml::dropDownList('categoryId', null, $categories, array('class' => 'categoryDropDownList'));
        ?>
    </div>
    <button type="button" onclick="location='<?php echo $this->createUrl('index'); ?>/?categoryId=' + $('#categoryId').val();" class="btn">Filter</button>
</form>

<br />

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th style="width: 1px;"><?php echo CHtml::checkBox('checkall', false); ?></th>
            <th style="width: 50px;"><?php echo Yii::t('products', 'Image'); ?></th>
            <th><a href="<?php echo $this->createUrl('index', array('sortBy'=>'name', 'sortOrder'=>$sortOrder == 'ASC' ? 'DESC' : 'ASC')); ?>"><?php echo Yii::t('products', 'Product Name'); ?></a></th>
            <th style="width: 80px;"><a href="<?php echo $this->createUrl('index', array('sortBy'=>'type', 'sortOrder'=>$sortOrder == 'ASC' ? 'DESC' : 'ASC')); ?>"><?php echo Yii::t('products', 'Type'); ?></a></th>
            <th style="width: 80px;"><a href="<?php echo $this->createUrl('index', array('sortBy'=>'model', 'sortOrder'=>$sortOrder == 'ASC' ? 'DESC' : 'ASC')); ?>"><?php echo Yii::t('products', 'Serial'); ?></a></th>
            <th style="width: 80px;"><?php echo Yii::t('products', 'Spec'); ?></th>
            <th><?php echo Yii::t('products', 'Category'); ?></th>
            <th style="width: 80px;"><a href="<?php echo $this->createUrl('index', array('sortBy'=>'price', 'sortOrder'=>$sortOrder == 'ASC' ? 'DESC' : 'ASC')); ?>"><?php echo Yii::t('products', 'Price'); ?></a></th>
            <th style="width: 20px;"><?php echo Yii::t('products', 'On'); ?></th>
            <th style="width: 80px;">&nbsp;</th>
        </tr>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th><?php echo CHtml::textField('productName', null, array('placeholder' => 'Product name')); ?></th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th><a onclick="location='<?php echo $this->createUrl('index'); ?>/?productName=' + $('#productName').val();" class="btn btn-primary btn-small" href="#"><?php echo Yii::t('common', 'Filter'); ?></a></th>
        </tr>
    </thead>
    <tbody>
<?php foreach ($products as $product): ?>
            <tr>
                <td><?php echo CHtml::checkBox('selected[]', false, array('value' => $product->product_id)); ?></td>
                <td><img src="<?php echo $product->getImageWithSize(40, 40); ?>" /></td>
                <td><?php echo $product->description->name; ?></td>
                <td><?php echo $product->type; ?></td>
                <td><?php echo $product->model; ?></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td><?php echo $product->getFormattedPrice(); ?></td>
                <td><?php echo ($product->status == 1) ? "<i class=\"icon-check\"></i>" : "<i class=\"icon-check-empty\"></i>"; ?></td>
                <td>
                    <a class="btn btn-success btn-mini" href="<?php echo $this->createUrl('update', array('id' => $product->product_id)); ?>"><?php echo Yii::t('common', 'Edit'); ?></a>
                    <a class="btn btn-danger btn-mini" href="<?php echo $this->createUrl('delete', array('ids' => $product->product_id)); ?>" onclick="if(!confirm('Are you sure you wish to delete this product')) return false;"><?php echo Yii::t('common', 'Delete'); ?></a>
                </td>
            </tr>
<?php endforeach; ?>
    </tbody>
</table>

<script>
    function onChange(){
        if(this.value != 0){
            $("#categories-container select:gt(" + $(this).index() + ")").remove();

            $.get('<?php echo $this->createUrl('/admin/products/addCategoryDownList'); ?>', {categoryId: this.value, form: 0}, function(html){
                if(html != ''){
                    var activeField = $('#categoryId');
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
    
    $(document).ready(function() {
        $('#btnDeleteAll').on('click', function(){   
            if(confirm('<?php echo Yii::t('common', 'Delete/Uninstall cannot be undone! Are you sure you want to do this?'); ?>')){
                var ids = $('input[name="selected[]"]').map(function(){
                    return this.checked ? this.value : null;
                }).get();

                document.location = '<?php echo $this->createUrl('delete'); ?>/?ids=' + ids;
            }
        });
    });
</script>