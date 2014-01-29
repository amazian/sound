<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('deliveryMethod', 'Delivery Methods');
$this->breadcrumbs = array(
    Yii::t('deliveryMethod', 'Delivery Methods'),
);
?>

<div class="row-fluid">
    <div class="span9"><h1><i class="icon-sitemap"></i>&nbsp;<?php echo Yii::t('deliveryMethod', 'Delivery Methods'); ?></h1></div>
</div>

<br />

<div class="row-fluid">
    <div class="span12">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><?php echo Yii::t('deliveryMethod', 'Delivery Method Name'); ?></th>
                    <th style="width: 80px;"><?php echo Yii::t('deliveryMethod', 'Action'); ?></th>
                </tr>
                <tr>
                    <td><input type="text" name="text" id="text" class="span12" /></td>
                    <td><button onclick="location='<?php echo $this->createUrl('add'); ?>/?text=' + $('#text').val();" class="btn btn-primary">Insert</button></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($deliveryMethods as $method): ?>
                    <tr>
                        <td><?php echo $method->text; ?></td>
                        <td><button onclick="location='<?php echo $this->createUrl('delete', array('id'=>$method->delivery_method_id)); ?>';" class="btn btn-small btn-danger">Delete</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>