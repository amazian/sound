<?php
Yii::app()->clientScript->registerCoreScript('cookie');
?>

<?php $categories = Category::model()->firstLevel()->active()->orderBySortOrder()->findAll(); ?>
<div class="span3">
    <!-- start sidebar -->
    <div class="categories-container">
        <ul class="breadcrumb">
            <li>Account settings</li>
        </ul>
        <div id="column-left" class="span3">
            <ul class="nav-pills">
                <li><a href="<?php echo $this->createUrl('information'); ?>">Information</a></li>
                <li><a href="<?php echo $this->createUrl('changePassword'); ?>">Change password</a></li>
            </ul>
        </div><!-- end sidebar -->
    </div>
    <div class="clearfix"></div>
    <br />
    <!-- start sidebar -->
    <div class="categories-container">
        <ul class="breadcrumb">
            <li>Purchase</li>
        </ul>
        <div id="column-left" class="span3">
            <ul class="nav-pills">
                <li><a href="<?php echo $this->createUrl('/shoppingCart/index'); ?>">My Cart</a></li>
                <li><a href="<?php echo $this->createUrl('orders'); ?>">Purchase Records</a></li>
            </ul>
        </div><!-- end sidebar -->
    </div>
</div>