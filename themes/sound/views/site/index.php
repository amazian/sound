<?php echo $this->renderPartial('/common/leftMenu'); ?>
<?php
    Yii::app()->clientScript->registerCssFile(Yii::app()->theme->baseUrl . '/css/jcarousel.responsive.css');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.jcarousel.min.js');
    Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jcarousel.responsive.js');
?>

<div class="span9">
    <h2>Top Sales</h2>
    <br />
    <div>
        <div class="jcarousel-wrapper">
            <div class="jcarousel">
                <ul>
                    <?php foreach($topSaleProducts as $product): ?>
                    <li>
                        <img src="<?php echo $product->product->getImageWithSize(125, 125); ?>" alt="<?php echo $product->product->description->name; ?>">
                        <p><?php echo $product->product->description->name; ?></p>
                        <span style="color: #0044cc;"><?php echo $product->product->getFormattedPrice(true); ?></span>
                        <a href="<?php echo $this->createUrl('/shoppingCart/add', array('id'=>$product->product_id, 'qty'=>1)); ?>" class="btn btn-mini btn-info">add to cart</a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <a href="#" class="jcarousel-control-prev">&lsaquo;</a>
            <a href="#" class="jcarousel-control-next">&rsaquo;</a>
        </div>
    </div>

    <h2>Categories</h2>
    <br />
    <?php foreach($categories as $id => $category): ?>
    <?php if($id == 0): ?>
    <div class="row-fluid">
    <?php elseif($id % 3 == 0): ?>
    </div>
    <hr />
    <div class="row-fluid">
    <?php endif; ?>

        <div class="span4" style="text-align: center;">
            <img alt="<?php echo $category->description->name; ?>" src="<?php echo $category->getImageWithSize(150, 150); ?>">
            <br />
            <br />
            <p><a href="<?php echo $this->createUrl('/category/view', array('id'=>$category->category_id)); ?>" class=""><?php echo $category->description->name; ?></a></p>
        </div>

    <?php if(count($categories) == $id+1): ?>
        <hr />
        </div>
    <?php endif; ?>
    <?php endforeach; ?>
</div>
