<?php $categories = Category::model()->firstLevel()->active()->orderBySortOrder()->findAll(); ?>
<div class="span3">
    <!-- start sidebar -->
    <ul class="breadcrumb">
        <li>Categories</span></li>
    </ul>
    <div id="column-left" class="span3 product_list">
        <ul class="nav">
            <?php foreach($categories as $category): ?>
            <li>
                <a class="cat" style="display: inline;" data-cat-id="cat-<?php echo $category->category_id; ?>" href="<?php echo $this->createUrl('/category/view', array('id'=>$category->category_id)); ?>"><i id="img-cat-<?php echo $category->category_id; ?>" class="icon-angle-right"></i> </a><a href="<?php echo $this->createUrl('/category/view', array('id'=>$category->category_id)); ?>" style="display: inline;"><?php echo $category->description->getName(); ?> (<?php echo $category->getProductsCount(); ?>)</a>
                <?php if($category->hasChildCategories()): ?>
                <ul id="cat-<?php echo $category->category_id; ?>" style="display: none;">
                    <?php foreach($category->childCategories as $childCategory): ?>
                    <li>
                        <a class="cat" data-cat-id="cat-<?php echo $childCategory->category_id; ?>" href="<?php echo $this->createUrl('/category/view', array('id'=>$childCategory->category_id)); ?>"> <i id="img-cat-<?php echo $childCategory->category_id; ?>" class="icon-angle-right"></i> <?php echo $childCategory->description->getName(); ?> (<?php echo $childCategory->getProductsCount(); ?>)</a>
                        <?php if($childCategory->hasChildCategories()): ?>
                        <ul id="cat-<?php echo $childCategory->category_id; ?>"  style="display: none;">
                            <?php foreach($childCategory->childCategories as $childCategory2): ?>
                            <li><a href="<?php echo $this->createUrl('/category/view', array('id'=>$childCategory2->category_id)); ?>"> <?php echo $childCategory2->description->getName(); ?> (<?php echo $childCategory2->getProductsCount(); ?>)</a></li>
                            <?php endforeach; ?>
                        </ul>
                        <?php endif; ?>
                    </li>
                    <?php endforeach; ?>
                </ul>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </div><!-- end sidebar -->		
</div>

<?php
$js = "
    function toggleImage(imgSelector) {
        var c = $(imgSelector).attr('class');
        if(c == 'icon-angle-right') 
            $(imgSelector).attr('class', 'icon-angle-down');
        else
            $(imgSelector).attr('class', 'icon-angle-right');
    }

    $('.cat').on('click', function(){
        var catId = $(this).attr('data-cat-id');
        $('#' + catId).toggle(200);
        toggleImage('#img-' + catId);
        
        return false;
    });
";

Yii::app()->clientScript->registerScript('leftMenu', $js);
?>