<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

<?php if(!Yii::app()->user->isGuest): ?>

<?php
$this->renderPartial('/myAccount/_leftMenu');
?>

<div class="span9">
<?php else: ?>
<div class="span12">
<?php endif; ?>


    <h1> Shopping Cart</h1><br>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Remove</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Model</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($products as $product): ?>
            <tr>
                <td class=""><input type="checkbox" id="optionsCheckbox" value="option1"></td>
                <td class="muted center_text"><a href="<?php echo $this->createUrl('/product/view', array('id'=>$product->product_id)); ?>"><img alt="" src="<?php echo $product->getImageWithSize(60, 60); ?>" /></a></td>
                <td><?php echo $product->description->name; ?></td>
                <td><?php echo $product->model; ?></td>
                <td><input type="text" class="input-mini" placeholder="1"></td>
                <td><?php echo $product->getFormattedPrice(true); ?></td>
                <td><?php echo $product->getFormattedPrice(true); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form class="form-horizontal">
        <fieldset>

            <div class="row">
                <div class="span5">
                    <a id="update" type="submit" class="btn btn-primary" href="#">Update</a>
                </div>		  
                <div class="span2">
                    <a type="submit" class="btn btn-primary" href="<?php echo $this->createUrl('/site/index'); ?>">Continue shopping</a>
                </div>		  
                <div class="span5">
                    <a class="btn btn-primary pull-right" href="<?php echo $this->createUrl('checkout'); ?>">Checkout</a>
                </div>
            </div>
        </fieldset>
    </form>

</div>

<script>
    $('#update').on('click', function(){
        $.post('<?php echo $this->createUrl('update'); ?>', $('form').serialize(), function() {
            //location.reload();
            alert(1);
        })
    })
</script>