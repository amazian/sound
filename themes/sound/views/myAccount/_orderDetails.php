<table class="table table-bordered">
    <thead>
        <tr>
            <th>PRODUCT</th>
            <th>PRICE</th>
            <th>QTY</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($order->products as $product): ?>
        <tr>
            <td><?php echo $product->product->description->name; ?></td>
            <td><?php echo $product->price; ?></td>
            <td><?php echo $product->quantity; ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>