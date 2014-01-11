<tr>
    <td><?php echo CHtml::checkBox('selected[]', false, array('value'=>$category->category_id)); ?></td>
    <td><?php echo $order+1; ?></td>
    <td style="<?php if($category->getLevel() == 1): ?>color: #006ef5;<?php elseif($category->getLevel() == 2): ?>color: #12aa13;<?php endif; ?>"><?php if(count($parents) > 0) foreach($parents as $p) echo "{$p} > "; ?><?php echo $category->description->name; ?></td>
    <td><?php echo $category->status ? "On" : "Off"; ?></td>
    <td><a href="<?php echo $this->createUrl('update', array('id' => $category->category_id)); ?>" class="btn btn-success btn-mini"><?php echo Yii::t('common', 'Edit'); ?></a></td>
</tr>
<?php if($category->hasChildCategories()): ?>
<?php $parents[] = $category->description->name; ?>
<?php foreach($category->childCategories as $order => $child): ?>
    <?php $this->renderPartial('_view', array('category'=>$child, 'parents'=>$parents, 'order'=>$order)) ?>
<?php endforeach; ?>
<?php endif; ?>
