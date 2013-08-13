<?php $categories = Category::model()->firstLevel()->active()->orderBySortOrder()->findAll(); ?>
<div class="span3">
    <!-- start sidebar -->
    <ul class="breadcrumb">
        <li>Categories</span></li>
    </ul>
    <div class="span3 product_list">
        <ul class="nav">
            <?php foreach($categories as $category): ?>
            <li>
                <a class="active" href="<?php echo $this->createUrl('/category/view', array('id'=>$category->category_id)); ?>"><?php echo $category->description->getName(); ?> (<?php echo $category->getProductsCount(); ?>)</a>
                <?php if($category->hasChildCategories()): ?>
                <ul>
                    <?php foreach($category->childCategories as $childCategory): ?>
                    <li>
                        <a href="<?php echo $this->createUrl('/category/view', array('id'=>$childCategory->category_id)); ?>"> - <?php echo $childCategory->description->getName(); ?> (<?php echo $childCategory->getProductsCount(); ?>)</a>
                        <?php if($childCategory->hasChildCategories()): ?>
                        <ul>
                            <?php foreach($childCategory->childCategories as $childCategory2): ?>
                            <li><a href="<?php echo $this->createUrl('/category/view', array('id'=>$childCategory2->category_id)); ?>"> - <?php echo $childCategory2->description->getName(); ?> (<?php echo $childCategory2->getProductsCount(); ?>)</a></li>
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