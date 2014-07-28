<?php echo $this->renderPartial('/common/leftMenu'); ?>
<div class="span9">
    <ul class="breadcrumb">
        <li>
            <?php echo $category->getFullname(); ?>
        </li>
    </ul>
    <p><?php echo $category->description->description; ?></p>
    <br />

    <?php if($category->hasChildCategories()): ?>
        <ul class="thumbnails">
        <?php foreach($manufacturers as $manufacturer): ?>
                <?php if(!$category->hasProductsFromManufacturer($manufacturer->manufacturer_id)) continue; ?>
                <li class="span4">
                    <div class="thumbnail">
                        <img src="<?php echo $manufacturer->getImageWithSize(100, 50); ?>" />
                        <div class="caption">
                            <ul class="nav nav-pills nav-stacked">
                                <?php foreach($category->childCategories as $child): ?>
                                    <?php if(!$child->hasProductsFromManufacturer($manufacturer->manufacturer_id)) continue; ?>
                                <li><a href="<?php echo $this->createUrl('view', array('id'=>$child->category_id)); ?>"><?php echo $child->description->name; ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </li>
        <?php endforeach; ?>
        </ul>
    <?php elseif(count($category->activeProducts)): ?>
    <div class="accordion">
        <div class="accordion-group">
            <div class="accordion-heading">
                <img src="<?php echo $category->getImageWithSize(50, 50); ?>" />&nbsp;<?php echo $category->description->getName(); ?>&nbsp;(<?php echo $category->getProductsCount(); ?> products)
            </div>
            <div class="accordion-body collapse in">
                <div class="accordion-inner">
                    <?php $this->renderPartial('_categoryProducts', array('category'=>$category, 'seeall'=>false)); ?>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php 
$js = "
$('.add-to-cart').on('click', function(){
    var qty = $(this).parent('td').parent('tr').find('td input.quantity').val();
    if(qty <= 0)
        alert('Qty must be at least 1. Please enter a qty and try again.');
    else {
        $.get($(this).attr('data-href') + '?qty=' + qty, null, function(){
            alert('Product added to cart');
        });
    }

    return false;
});

$('a.product_popover').popover({
    html: true,
    trigger: 'manual',
    container: 'body',
    placement: 'right',
    content: function () {
        var prodId = $(this).attr('data-product-id');
        var div_id =  'div-id-' + $.now();
            
        $.get('{$this->createUrl('product/hoverCard')}', {id: prodId}, function(data){
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
});";

Yii::app()->clientScript->registerScript("product_popover", $js, CClientScript::POS_READY);
?>
