<?php
Yii::app()->clientScript->registerCoreScript('cookie');
?>

<?php $categories = Category::model()->firstLevel()->active()->orderBySortOrder()->findAll(); ?>
<div class="span3">
    <!-- start sidebar -->
    <div class="categories-container">
        <ul class="breadcrumb">
            <li>Categories</li>
        </ul>
        <div id="column-left" class="span3">
            <?php
            /*$this->widget(
                'CTreeView',
                array(
                    'url' => array('/site/ajaxFillTree'),
                    'persist' => 'cookie'
                )
            );*/
            $this->widget('ext.yii-jqTree.JQTree', array(
                'dataUrl' => $this->createAbsoluteUrl('/site/ajaxFillTree'),
                'dragAndDrop' => false,
                'selectable' => false,
                'saveState' => 'leftTree',
                'autoOpen' => true,
                'onCreateLi' => "js:function(node, \$li) {
                    \$li.find('.jqtree-title').html('<a href=\"".$this->createUrl("/category")."/'+ node.id +'\">'+ node.name +'</a>');
                }"
                /*'htmlOptions' => array(
                    'class' => 'treeview-red',
                ),*/
            ));
            ?>
        </div><!-- end sidebar -->
    </div>
    <div class="clearfix"></div>
    <div class="tags-container">
        <ul class="breadcrumb">
            <li>Tags</li>
        </ul>
        <?php
        $tags = ProductTag::model()->findAllBySql("SELECT * FROM product_tag GROUP BY tag_text");
        foreach($tags as $tag):
        ?>
            <a href="<?php echo $this->createUrl('/tag/index', array('text'=>$tag->tag_text)); ?>" class="btn btn-mini"><?php echo $tag->tag_text; ?></a>
        <?php endforeach; ?>
    </div>
    <br />
    <br />
</div>