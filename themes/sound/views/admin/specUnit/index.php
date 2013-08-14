<?php
$this->pageTitle = Yii::app()->name . ' - ' . Yii::t('specUnit', 'Specs & Units');
$this->breadcrumbs = array(
    Yii::t('specUnit', 'Specs & Units'),
);
?>

<div class="row-fluid">
    <div class="span9"><h1><i class="icon-sitemap"></i>&nbsp;<?php echo Yii::t('specUnit', 'Specs & Units'); ?></h1></div>
</div>

<br />

<div class="row-fluid">
    <div class="span6">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th><?php echo Yii::t('specUnit', 'Spec Name'); ?></th>
                    <th><?php echo Yii::t('specUnit', 'Type'); ?></th>
                    <th style="width: 80px;"><?php echo Yii::t('specUnit', 'Action'); ?></th>
                </tr>
                <tr>
                    <td><input type="text" name="spec" id="spec" class="span12" /></td>
                    <td><?php echo CHtml::dropDownList('type', 1, array(1=>'Numerical', 2=>'Alphabetical'), array('class'=>'span12')); ?></td>
                    <td><button onclick="location='<?php echo $this->createUrl('addSpec'); ?>/?name=' + $('#spec').val() + '&type=' + $('#type').val();" class="btn btn-primary">Insert</button></td>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($specs as $spec): ?>
                    <tr>
                        <td><?php echo $spec->name; ?></td>
                        <td><?php echo $spec->getType(); ?></td>
                        <td><button onclick="location='<?php echo $this->createUrl('deleteSpec', array('id'=>$spec->spec_id)); ?>';" class="btn btn-small btn-danger">Delete</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="span6">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <td><?php echo Yii::t('specUnit', 'Unit Name'); ?></td>
                    <td style="width: 80px;"><?php echo Yii::t('specUnit', 'Action'); ?></td>
                </tr>
                <tr>
                    <th><input type="text" name="unit" id="unit" /></th>
                    <th><button onclick="location='<?php echo $this->createUrl('addUnit'); ?>/?name=' + $('#unit').val();" class="btn btn-primary">Insert</button></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($units as $unit): ?>
                    <tr>
                        <td><?php echo $unit->name; ?></td>
                        <td><button onclick="location='<?php echo $this->createUrl('deleteUnit', array('id'=>$unit->unit_id)); ?>';" class="btn btn-small btn-danger">Delete</button></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>