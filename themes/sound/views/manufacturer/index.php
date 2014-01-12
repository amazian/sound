<?php echo $this->renderPartial('/common/leftMenu'); ?>
<div class="span9">
    <ul class="breadcrumb">
        <li>
            Brand > <?php echo $manufacturer->name; ?>
        </li>
    </ul>
    <table class="table table-striped">
        <tbody>
        <?php foreach ($manufacturer->products as $product): ?>
            <?php if(is_null($product)) continue; ?>
            <tr>
                <td><a href="<?php echo $this->createUrl('/product/view', array('id' => $product->product_id)); ?>"><img src="<?php echo $product->getImageWithSize(60, 60); ?>" id="tmp" alt=""></a></td>
                <td><a class="product_popover" data-title="<?php echo $product->description->getName(); ?> / <?php echo $product->type; ?> / <?php echo $product->model; ?>" data-product-id="<?php echo $product->product_id; ?>" href="<?php echo $this->createUrl('/product/view', array('id' => $product->product_id)); ?>"><?php echo $product->description->getName(); ?></a></td>
                <td><?php echo $product->model; ?></td>
                <td>&nbsp;</td>
                <td><?php echo!is_null($product->manufacturer) ? $product->manufacturer->name : '' ?></td>
                <td><?php echo $product->getFormattedPrice(true); ?></td>
                <td>Qty: <?php echo CHtml::textField('qty', 1, array('class'=>'span1 quantity')); ?></td>
                <td><a href="#" class="btn btn-primary add-to-cart" data-href="<?php echo $this->createUrl('/shoppingCart/add', array('id'=>$product->product_id)); ?>">Add to cart</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

<?php
$js = "
$('.add-to-cart').on('click', function(){
    var qty = $(this).parent('td').parent('tr').find('td input.quantity').val();
    if(qty <= 0)
        alert('Qty must be at least 1. Please enter a qty and try again.');
    else
        document.location = $(this).attr('data-href') + '?qty=' + qty;

    return false;
});
";

Yii::app()->clientScript->registerScript("tags", $js, CClientScript::POS_READY);
?>