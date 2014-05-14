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
                <th>Status</th>
                <th>Total</th>
                <th>&nbsp;</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($orders as $order): ?>
            <tr>
                <td><?php echo $order->order_id; ?></td>
                <td><?php echo $order->date_modified; ?></td>
                <td><?php echo $order->getOrderStatus(); ?></td>
                <td><?php echo $order->total; ?></td>
                <td><a class="details" data-id="<?php echo $order->order_id; ?>" href="#">Details</a></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Modal -->
<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Order details</h3>
    </div>
    <div id="order-details" class="modal-body">
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
    </div>
</div>

<script>
    $('.details').on('click', function(){
        var id = $(this).attr('data-id');

        $.get('<?php echo $this->createUrl('orderDetails'); ?>', {id: id}, function(data){
            $('#order-details').html(data);
            $('#myModal').modal('show');
        });
    });
</script>