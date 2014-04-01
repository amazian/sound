<?php
$this->renderPartial('_leftMenu');
?>

<h3>Purchase Records</h3>
<br />

<div class="span9">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Order #</th>
                <th>Date</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order): ?>
            <tr>
                <td><?php echo $order->order_id; ?></td>
                <td><?php echo $order->date_modified; ?></td>
                <td><?php echo $order->total; ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>