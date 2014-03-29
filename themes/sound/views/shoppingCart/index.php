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

    <form id="shopping-cart-form" class="form-horizontal" action="<?php echo $this->createUrl('update'); ?>" method="post">

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
                <?php foreach($items as $item): ?>
                    <?php $product = $item['product']; $qty = $item['qty']; ?>
                <tr>
                    <td class=""><input type="checkbox" name="ids[]" value="<?php echo $product->product_id; ?>"></td>
                    <td class="muted center_text"><a href="<?php echo $this->createUrl('/product/view', array('id'=>$product->product_id)); ?>"><img alt="" src="<?php echo $product->getImageWithSize(60, 60); ?>" /></a></td>
                    <td><?php echo $product->description->name; ?></td>
                    <td><?php echo $product->model; ?></td>
                    <td><input type="text" class="input-mini" name="amount[<?php echo $product->product_id; ?>]" value="<?php echo $qty; ?>"/></td>
                    <td><?php echo $product->getFormattedPrice(true); ?></td>
                    <td><?php echo $product->getFormattedPriceWithQuantity(true, $qty); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>


        <fieldset>

            <div class="row">
                <div class="span5">
                    <button type="submit" id="update" class="btn btn-primary" href="#">Update</button>
                </div>		  
                <div class="span2">
                    <a class="btn btn-primary" href="<?php echo $this->createUrl('/site/index'); ?>">Continue shopping</a>
                </div>		  
                <div class="span5">
                    <a class="btn btn-primary pull-right" href="<?php echo $this->createUrl('checkout'); ?>">Checkout</a>
                </div>
            </div>
        </fieldset>
    </form>

</div>