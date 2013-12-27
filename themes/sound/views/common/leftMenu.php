<?php
Yii::app()->clientScript->registerCoreScript('cookie');
?>

<?php $categories = Category::model()->firstLevel()->active()->orderBySortOrder()->findAll(); ?>
<div class="span3">
    <!-- start sidebar -->
    <ul class="breadcrumb">
        <li>Categories</span></li>
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