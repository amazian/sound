
<table class="table table-condensed">
    <tbody>
    <?php foreach($products as $product): ?>
        <tr>
            <td><img src="<?php echo $product->getImageWithSize(100, 100); ?>" /></td>
            <td>
                <table>
                    <tr>
                        <td><?php echo $product->description->name; ?></td>
                        <td><img src="<?php echo $product->category->getImageWithSize(50, 50); ?>" /></td>
                        <td>Price: <?php echo $product->getFormattedPrice(true); ?> NTD</td>
                        <td>Qty: <input type="text" id="qty-<?php echo $product->product_id; ?>" value="1" class="span1" /></td>
                        <td><button class="btn btn-small btn-primary add-to-cart" data-id="<?php echo $product->product_id; ?>">Add to cart</button> </td>
                    </tr>
                    <tr>
                        <td colspan="5">
                            <p>
                            <?php foreach($product->specs as $spec): ?>
                            <strong><?php echo $spec->description->name; ?></strong>&nbsp;&nbsp;<?php echo $spec->value_init; ?><?php echo ($spec->value_end != '') ? ' ~ ' . $spec->value_end : ''; ?><?php echo (!is_null($spec->unit)) ? ' ' . $spec->unit->name : ''; ?>
                            <?php endforeach; ?>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>