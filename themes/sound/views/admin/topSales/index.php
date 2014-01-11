<form class="form-horizontal">
    <div class="control-group">
        <?php echo CHtml::label('Products', 'products', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php
            $this->widget('TypeaheadSingle', array(
                'model' => $model,
                'attribute' => 'products',
                'value' => '',
                'htmlOptions' => array('class' => 'span4'),
                'url' => $this->createUrl('/admin/topSales/autocomplete')
            ))
            ?>
        </div>
    </div>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Product Name</th>
            <th>Type</th>
            <th>Serial</th>
            <th>Spec</th>
            <th>Price</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody id="top-sales-products-container">

    </tbody>
</table>

<?php $js = "
    $('#products').on('change', function(){
        var id = $('#TopSalesForm_products').val();
        $.get('{$this->createUrl('add')}', {id: id}, function(){
            reloadTable();
        });

        return false;
    });

    function reloadTable() {
        $.get('{$this->createUrl('products')}', null, function(data){
            $('#top-sales-products-container').html(data);

            $('.remove').on('click', function(){
                var id = $(this).attr('data-product-id');
                $.get('{$this->createUrl('delete')}', {id: id}, function(){
                    reloadTable();
                });

                return false;
            });
        });
    } reloadTable();
";

Yii::app()->clientScript->registerScript('topSales', $js, CClientScript::POS_READY);
?>