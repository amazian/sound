<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('orders', 'Orders');
$this->breadcrumbs = array(
    Yii::t('orders', 'Orders'),
);
?>

<div class="row-fluid">
    <div class="span9"><h1><i class="icon-cog"></i>&nbsp;<?php echo Yii::t('orders', 'Orders'); ?></h1></div>
</div>

<table class="table table-stripped">
    <thead>
        <tr>
            <th>Order No.</th>
            <th>Date</th>
            <th>User</th>
            <th>Products</th>
            <th>Qty</th>
            <th>Total Price</th>
            <th>Deliver way</th>
            <th>Pay way</th>
            <th>Paid</th>
            <th>Status</th>
            <th>Note</th>
            <th>User's Note</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($orders as $order): ?>
        <tr>
            <td><?php echo $order->order_id; ?></td>
            <td><?php echo $order->date_added; ?></td>
            <td><?php echo $order->firstname; ?></td>
            <td><?php foreach($order->products as $product) echo $product->name . '<br />'; ?></td>
            <td><?php foreach($order->products as $product) echo $product->quantity . '<br />'; ?></td>
            <td><?php echo '$' . $order->total; ?></td>
            <td><?php echo $order->shipping_method; ?></td>
            <td><?php echo $order->payment_method; ?></td>
            <td><?php echo $order->order_status_id == Order::STATUS_COMPLETED ? 'Yes' : 'No'; ?></td>
            <td><?php echo $order->getOrderStatus(); ?></td>
            <td><a class="write" data-id="<?php echo $order->order_id; ?>" href='#'>Write</a></td>
            <td><?php if(!empty($order->comment)) echo "<a class='read' data-id='".$order->order_id."' href='#'>Read</a>"; ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">User's Note</h3>
    </div>
    <div id="read-container" class="modal-body">
        <p>One fine body…</p>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<!-- Modal -->
<div id="myModal2" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModal2Label" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Write Note</h3>
    </div>
    <div class="modal-body">
        <input type="hidden" id="orderId" value="" />
        <textarea id="note" class="span5" rows="5"></textarea>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button id="saveNote" class="btn btn-primary">Save changes</button>
    </div>
</div>

<script>
    $('.read').on('click', function() {
        var id = $(this).attr('data-id');
        $.get('<?php echo $this->createUrl('read'); ?>', {id: id}, function(data) {
            $('#read-container').html(data);
            $('#myModal').modal('show');
        });
    });

    $('.write').on('click', function() {
        var orderId = $(this).attr('data-id');
        $('#orderId').val(orderId);

        $.get('<?php echo $this->createUrl('readAdmin'); ?>', {id: orderId}, function(data) {
            $('#note').val(data);
            $('#myModal2').modal('show');
        });
    });

    $('#saveNote').on('click', function(){
        var orderId = $('#orderId').val();
        var note = $('#note').val();
        $.post('<?php echo $this->createUrl('write'); ?>', {id: orderId, note: note}, function(){
            $('#myModal2').modal('hide');
        });
    });
</script>