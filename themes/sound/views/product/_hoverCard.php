<div class="row">
    <div class="span4">
        <div class="row-fluid">
            <div class="span5">
                <?php echo CHtml::image($product->getImageWithSize(125, 125)); ?>
                <br />
                <br />
                <?php if($product->getFormattedPrice(false) != $product->getFormattedPrice(true)): ?>
                <span style='color:red;text-decoration:line-through; text-align: right; font-weight: bold;'>
                    <?php echo $product->getFormattedPrice(false); ?>
                </span>
                &nbsp;
                <?php endif; ?>
                <span style="text-align: right; font-weight: bold;"><?php echo $product->getFormattedPrice(true); ?></span>
                <br />
                <br />
                <form class="form-inline">
                    <?php echo CHtml::telField('quantity', 1, array('class'=>'span4')); ?>
                    <?php echo CHtml::button('Buy', array('id'=>'add-to-cart', 'class'=>'btn')); ?>
                </form>
            </div>
            <div class="span7">
                <?php echo $product->manufacturer->name; ?>
                <?php echo CHtml::image($product->manufacturer->getImageWithSize(80, 80)); ?>
                <br />
                <?php
                $primerySpec = $product->getPrimarySpec();
                if(!is_null($primerySpec)):
                    if($primerySpec->description->type_id == Spec::TYPE_NUMERICAL)
                        echo "<b>{$primerySpec->description->name}: </b>&nbsp;{$primerySpec->value_init} ~ {$primerySpec->value_end}<br />";
                    else
                        echo "<b>{$primerySpec->description->name}: </b>&nbsp;{$primerySpec->value_init}<br />";
                ?>
                <?php endif; ?>
                <?php foreach($product->specs as $spec) {
                    if($primerySpec->product_spec_id == $spec->product_spec_id) continue;
                    
                    if($spec->description->type_id == Spec::TYPE_NUMERICAL)
                        echo "<b>{$spec->description->name}: </b>&nbsp;{$spec->value_init} ~ {$spec->value_end}<br />";
                    else
                        echo "<b>{$spec->description->name}: </b>&nbsp;{$spec->value_init}<br />";
                }
                ?>
                <br />
                <br />
                <a href="<?php echo $this->createUrl('product/view', array('id'=>$product->product_id)); ?>">See more >></a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#add-to-cart').on('click', function(){
        if($('#quantity').val() <= 0)
            alert('Qty must be at least 1. Please enter a qty and try again.');
        else
            document.location = '<?php echo $this->createUrl('/shoppingCart/add'); ?>/?id=<?php echo $product->product_id; ?>&qty=' + $('#quantity').val();

        return false;
    });
</script>