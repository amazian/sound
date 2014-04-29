<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=108658119183570";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

<style>
    .tag {
        cursor: pointer; cursor: hand;
    }
</style>
        
<?php echo $this->renderPartial('/common/leftMenu'); ?>
<div class="span9">
    <ul class="breadcrumb">
        <li>
            <a href="<?php echo $this->createUrl('/site/index'); ?>">Home</a> <span class="divider">/</span>
        </li>
        <li class="active">
            <a href="#"><?php echo $product->description->name; ?></a>
        </li>
    </ul>


    <div class="row">
        <div class="span9">
            <h1><?php echo $product->description->name; ?></h1>
        </div>
    </div>
    <hr>

    <div class="row">
        <div class="span3">
            <img src="<?php echo $product->getImageWithSize(220, 220); ?>" alt="">
        </div>	 

        <div class="span6">
            <ul class="breadcrumb" style="margin-bottom: 5px;">
                <li>
                    <a href="#"><?php echo $product->description->name; ?></a> <span class="divider">/</span>
                </li>
                <li>
                    <a href="#"><?php echo $product->type; ?></a> <span class="divider">/</span>
                </li>
                <li>
                    <a href="#"><?php echo $product->model; ?></a>
                </li>
            </ul>

            <div class="span6">
                <?php if (isset($product->manufacturer)): ?><img src="<?php echo $product->manufacturer->getImageWithSize(60, 60); ?>" /> <span><?php echo $product->manufacturer->name; ?></span><br><?php endif; ?>
                <!--
                <?php if(!is_null($product->getPrimarySpec())): ?><strong><?php echo $product->getPrimarySpec()->description->name; ?>:</strong> <span><?php echo $product->getPrimarySpec()->value_init; ?><?php echo ($product->getPrimarySpec()->value_end != '') ? ' ~ ' . $product->getPrimarySpec()->value_end : ''; ?><?php echo (!is_null($product->getPrimarySpec()->unit)) ? ' ' . $product->getPrimarySpec()->unit->name : ''; ?></span><br><?php endif; ?>
                -->
            </div>


            <div class="span6" style="margin: 0px 0px 10px 0px;">
                <h2>
                    <strong>Price: <?php echo $product->getFormattedPrice(true); ?> NTD</strong><br>
                </h2>
            </div>	

            <div class="span6" style="margin: 10px 0px;">
                <form class="form-inline">
                    <div class="span3 no_margin_left" style="margin: 0px;">
                        <label>Qty:</label>
                        <input id="quantity" type="text" placeholder="1" class="span1" value="1">
                        <button id="add-to-cart" type="submit" class="btn btn-primary">Add to cart</button>
                    </div>	
                    <!--
                    <div class="span1">
                        - OR -
                    </div>	
                    <div class="span2">
                        <p><a href="#">Add to Wish List</a></p>
                        <p><a href="compare.html">Add to Compare</a></p>
                    </div>	
                    -->
                </form>
            </div>	
            <div class="span6" style="margin: 10px 0px;">
                <div class="share">
                    <!-- AddThis Button BEGIN -->
                    <div class="addthis_default_style">
                        <a class="addthis_button_compact">Share</a>
                        <a class="addthis_button_email"></a>
                        <a class="addthis_button_print"></a>
                        <a class="addthis_button_facebook"></a>
                        <a class="addthis_button_twitter"></a>
                    </div>
                    <script src="//s7.addthis.com/js/250/addthis_widget.js" type="text/javascript"></script>
                    <!-- AddThis Button END -->
                </div>
            </div>	


        </div>	


    </div>
    <hr>
    <div class="row">
        <div class="span9">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="<?php if(!$relatedProductSearch): ?>active<?php endif; ?>"><a data-toggle="tab" href="#spec">Spec</a></li>
                    <li><a data-toggle="tab" href="#description">Description</a></li>
                    <li class="<?php if($relatedProductSearch): ?>active<?php endif; ?>""><a data-toggle="tab" href="#advancedSearch">Related Product Search</a></li>
                    <li><a data-toggle="tab" href="#tags">Tags</a></li>
                </ul>
                <div class="tab-content">
                    <div id="spec" class="tab-pane <?php if(!$relatedProductSearch): ?>active<?php endif; ?>">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <?php
                                $primerySpec = $product->getPrimarySpec();
                                if(!is_null($primerySpec)):
                            ?>
                                <tr>
                                    <th style="width: 200px; text-align: right;"><?php echo $primerySpec->description->name; ?></th>
                                    <td><?php echo $primerySpec->value_init; ?><?php echo ($primerySpec->value_end != '') ? ' ~ ' . $primerySpec->value_end : ''; ?><?php echo (!is_null($primerySpec->unit)) ? ' ' . $primerySpec->unit->name : ''; ?></td>
                                </tr>
                            <?php endif; ?>
                            <?php foreach($product->specs as $spec): ?>
                                <?php if($primerySpec->product_spec_id == $spec->product_spec_id) continue; ?>
                                <tr>
                                    <th style="width: 200px; text-align: right;"><?php echo $spec->description->name; ?></th>
                                    <td><?php echo $spec->value_init; ?><?php echo ($spec->value_end != '') ? ' ~ ' . $spec->value_end : ''; ?><?php echo (!is_null($spec->unit)) ? ' ' . $spec->unit->name : ''; ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <div id="description" class="tab-pane">
                        <?php echo $product->description->getDescription(); ?>
                    </div>    
                    <div id="advancedSearch" class="tab-pane <?php if($relatedProductSearch): ?>active<?php endif; ?>">
                        <p>Select the spec you want to adjust</p>
                        <form class="form-inline" action="<?php echo $this->createUrl('view', array('id'=>$product->product_id)); ?>" method="post">
                            <button type="submit" class="btn btn-inverse">Go</button>
                            <br /><br />
                            <?php 
                            $product_attributes = array(0=>'Select Spec');
                            foreach($product->specs as $spec) {
                                $product_attributes[$spec->product_spec_id] = $spec->description->name;
                            } 
                            ?>
                            <div id="filters">
                                <div id="filters-template" class="row-fluid filter-container">
                                    <div class="filter-selector span2"><?php echo CHtml::dropDownList('spec_filter[]', 0, $product_attributes, array('id'=>'', 'class'=>'filter-select span12')); ?></div>
                                    <div class="filter-options span10">&nbsp;</div>
                                </div>
                            </div>
                            <a id="add-filter" href="#" class="">+ Add filter</a>
                        </form>

                        <?php if($relatedProductSearch): ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Type</th>
                                    <th>Serial</th>
                                    <th>Spec</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($relatedProducts as $relatedProduct): ?>
                                <tr>
                                    <td><?php echo $relatedProduct->description->name; ?></td>
                                    <td><?php echo $relatedProduct->type; ?></td>
                                    <td><?php echo $relatedProduct->model; ?></td>
                                    <td><?php echo isset($relatedProduct->primarySpec) ? $relatedProduct->primarySpec->description->name : "&nbsp;"; ?></td>
                                    <td><?php echo $relatedProduct->price; ?></td>
                                </tr>
                                <?php endforeach; ?>
                                <?php if(count($relatedProducts) == 0): ?>
                                <tr>
                                    <td colspan="5" style="text-align: center;">We couldn't find any products with the filters specified, please try again.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                        <?php endif; ?>
                        <br />
                        <br />
                        <br />
                        <br />
                    </div>
                    <div id="tags" class="tab-pane">
                        <div id="tags" class="tab-pane active">
                            <div class="tags">
                                <?php foreach($product->tags as $tag): ?>
                                <div class="tag label btn-info">
                                    <span class="tag"><?php echo $tag->tag_text; ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                        <br />
                        <div id="tag-container">&nbsp;</div>
                    </div>
            </div>

        </div>
    </div>
    </div>
    <div class="row-fluid">
        <div class="fb-comments" data-href="<?php echo Yii::app()->createAbsoluteUrl('product/view', array('id'=>$product->product_id)); ?>" data-numposts="5" data-colorscheme="light"></div>
    </div>

    <script>
        $('#add-to-cart').on('click', function(){
            if($('#quantity').val() <= 0)
                alert('Qty must be at least 1. Please enter a qty and try again.');
            else
                document.location = '<?php echo $this->createUrl('/shoppingCart/add'); ?>/?id=<?php echo $product->product_id; ?>&qty=' + $('#quantity').val();

            return false;
        });

        $('.filter-select').on('change', function(){
            var specId = $(this).val();
            var containerDiv = $(this).parent('div').parent('div').find('div.filter-options');
            $.get('<?php echo $this->createUrl('getFilterHtmlForSpec'); ?>', {id: specId}, function(data){
                containerDiv.html(data);
            });
        });

        $('#add-filter').on('click', function() {
            $( "#filters-template" ).clone(true).appendTo( "#filters" );

            return false;
        });

        $('.tag').on('click', function(){
            var tagText = $(this).html();
            var containerDiv = $('#tag-container');
            $.get('<?php echo $this->createUrl('getTagProducts'); ?>', {tagText: tagText}, function(data){
                containerDiv.html(data);
                bindButton();
            });
        });

        function bindButton() {
            $('.add-to-cart').on('click', function(){
                var productId = $(this).attr('data-id');
                if($('#qty-'+productId).val() <= 0)
                    alert('Qty must be at least 1. Please enter a qty and try again.');
                else
                    document.location = '<?php echo $this->createUrl('/shoppingCart/add'); ?>/?id=' + productId + '&qty=' + $('#quantity').val();

                return false;
            });
        }

    </script>