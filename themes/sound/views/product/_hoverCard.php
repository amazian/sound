<div class="row">
    <div class="span4">
        <div class="row-fluid">
            <div class="span5">
                <?php echo CHtml::image($product->getImageWithSize(125, 125)); ?>
                <br />
                <br />
                <span style="text-align: right; font-weight: bold;"><?php echo "\${$product->price}"; ?></span>
                <br />
                <br />
                <form class="form-inline">
                    <?php echo CHtml::telField('price', 1, array('class'=>'span4')); ?>
                    <?php echo CHtml::button('Buy', array('class'=>'btn')); ?>
                </form>
            </div>
            <div class="span7">
                <?php echo $product->manufacturer->name; ?>
                <?php echo CHtml::image($product->manufacturer->getImageWithSize(80, 80)); ?>
                <br />
                <?php foreach($product->specs as $spec) {
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