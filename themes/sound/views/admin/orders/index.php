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
            <td><?php foreach($order->products as $product): ?><a href="#" data-product-id="<?php echo $product->product_id; ?>" class="product_popover"><?php echo $product->name . '<br />'; ?></a><?php endforeach; ?></td>
            <td><?php foreach($order->products as $product) echo $product->quantity . '<br />'; ?></td>
            <td><?php echo '$' . $order->total; ?></td>
            <td><?php echo $order->shipping_method; ?></td>
            <td><?php echo $order->payment_method; ?></td>
            <td><?php echo $order->order_status_id == Order::STATUS_COMPLETED ? 'Yes' : 'No'; ?></td>
            <td><?php echo CHtml::dropDownList('order_status', $order->order_status_id, $orderStatuses, array('class'=>'order_status', 'data-order-id'=>$order->order_id)); ?></td>
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

    $('.order_status').on('change', function(){
        var orderId = $(this).attr('data-order-id');
        var status = $(this).val();
        $.post('<?php echo $this->createUrl('saveStatus'); ?>', {id: orderId, status: status}, function(){
            $('#myModal2').modal('hide');
        });
    });

    $('a.product_popover').popover({
        html: true,
        trigger: 'manual',
        container: 'body',
        placement: 'right',
        content: function () {
            var prodId = $(this).attr('data-product-id');
            var div_id =  'div-id-' + $.now();

            $.get('<?php echo $this->createUrl('/product/hoverCardNoBuyButton'); ?>', {id: prodId}, function(data){
                $('#'+div_id).html(data);
            });

            return '<div id=\"'+ div_id +'\">Loading...</div>';
        }
    }).on('mouseenter', function () {
            var _this = this;
            $(this).popover('show');
            $(this).siblings('.popover').on('mouseleave', function () {
                $(_this).popover('hide');
            });
        }).on('mouseleave', function () {
            var _this = this;
            setTimeout(function () {
                if (!$('.popover:hover').length) {
                    $(_this).popover('hide')
                }
            }, 100);
        });
</script>