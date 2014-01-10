<?php echo $this->renderPartial('/common/leftMenu'); ?>

<div class="span9">
    <h2>Top Sales</h2>
    <br />
    

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
            <p><a href="#" class=""><?php echo $category->description->name; ?></a></p>
        </div>

    <?php if(count($categories) == $id+1): ?>
        <hr />
        </div>
    <?php endif; ?>
    <?php endforeach; ?>
</div>
