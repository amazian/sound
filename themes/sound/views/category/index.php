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
    <div id="accordion-<?php echo $category->category_id; ?>" class="accordion">
        <?php foreach($category->childCategories as $child): ?>
        <div class="accordion-group">
            <div class="accordion-heading">
                <img src="<?php echo $child->getImageWithSize(50, 50); ?>" />
                <a style="float: right;" href="#category-<?php echo $child->category_id; ?>" data-parent="#accordion<?php echo $category->category_id; ?>" data-toggle="collapse" class="accordion-toggle">
                    <?php echo $child->description->getName(); ?>&nbsp;(<?php echo $child->getProductsCount(); ?> products)
                </a>
            </div>
            <div class="accordion-body collapse in" id="category-<?php echo $child->category_id; ?>">
                <div class="accordion-inner">
                    <?php if($child->hasChildCategories()): ?>
                    <div id="accordion<?php echo $child->category_id; ?>" class="accordion">                        
                        <?php foreach($child->childCategories as $child2): ?>
                        <div class="accordion-group">
                            <div class="accordion-heading">
                                <a href="#category-<?php echo $child2->category_id; ?>" data-parent="#accordion<?php echo $child->category_id; ?>" data-toggle="collapse" class="accordion-toggle">
                                    <?php echo $child2->description->getName(); ?>
                                </a>
                            </div>
                            <div class="accordion-body collapse" id="category-<?php echo $child2->category_id; ?>">
                                <div class="accordion-inner">
                                    <?php $this->renderPartial('_categoryProducts', array('category'=>$child2, 'seeall'=>true)); ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>                        
                    </div>
                    <?php elseif(count($child->activeProducts)): ?>
                        <?php $this->renderPartial('_categoryProducts', array('category'=>$child, 'seeall'=>true)); ?>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <br />
        <?php endforeach; ?>
    </div>
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