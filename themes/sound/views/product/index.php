<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=108658119183570";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
        
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

        <div class="span6">
            <ul class="breadcrumb">
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
                <address>
                    <?php if (isset($product->manufacturer)): ?><strong>Brand:</strong> <span><?php echo $product->manufacturer->name; ?></span><br><?php endif; ?>
                    <!--<strong>Reward Points:</strong> <span>0</span><br>-->
                    <?php if(count($product->specs) > 1): ?><strong><?php echo $product->specs[0]->description->name; ?>:</strong> <span><?php echo $product->specs[0]->value_init; ?><?php echo ($product->specs[0]->value_end != '') ? ' ~ ' . $product->specs[0]->value_end : ''; ?><?php echo (!is_null($product->specs[0]->unit)) ? ' ' . $product->specs[0]->unit->name : ''; ?></span><br><?php endif; ?>
                </address>
            </div>	

            <div class="span6">
                <h2>
                    <strong>Price: <?php echo $product->getFormattedPrice(true); ?> NTD</strong> <!--<small>Ex Tax: $500.00</small>--><br><br>
                </h2>
            </div>	

            <div class="span6">
                <form class="form-inline">
                    <div class="span3 no_margin_left">
                        <label>Qty:</label>
                        <input type="text" placeholder="1" class="span1">
                        <button type="submit" class="btn btn-primary">Add to cart</button>
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
            <div class="span6">
                <!--
                <p>
                    <input name="star1" type="radio" class="star"/>
                    <input name="star1" type="radio" class="star"/>
                    <input name="star1" type="radio" class="star"/>
                    <input name="star1" type="radio" class="star"/>
                    <input name="star1" type="radio" class="star"/>&nbsp;&nbsp;

                    <a href="#">0 reviews</a>  |  <a href="#">Write a review</a>
                </p>
                -->                
            </div>	


        </div>	


    </div>
    <hr>
    <div class="row">
        <div class="span9">
            <div class="tabbable">
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#spec">Spec</a></li>
                    <li><a data-toggle="tab" href="#description">Description</a></li>
                    <li><a data-toggle="tab" href="#advancedSearch">Related Product Search</a></li>
                    <li><a data-toggle="tab" href="#tags">Tags</a></li>
                </ul>
                <div class="tab-content">
                    <div id="spec" class="tab-pane active">
                        <table class="table table-bordered table-striped">
                            <tbody>
                            <?php foreach($product->specs as $spec): ?>
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
                    <div id="advancedSearch" class="tab-pane">
                        <p>Select the spec you want to adjust</p>
                        <form>
                            <button type="button" class="btn btn-inverse">Ok</button>
                            <br /><br />
                            <?php 
                            $product_attributes = array();
                            foreach($product->specs as $spec) {
                                $product_attributes[$spec->product_spec_id] = $spec->description->name;
                            } 
                            ?>
                            <?php echo CHtml::dropDownList('test1', null, $product_attributes); ?>  
                            <span class="help-block">+ Add filter</span>
                            
                            
                        </form>
                    </div>
                    <div id="tags" class="tab-pane">
                        <div id="tags" class="tab-pane active">
                            <div class="tags">
                                <?php foreach($product->tags as $tag): ?>
                                <div class="tag label btn-info">
                                    <span><?php echo $tag->tag_text; ?></span>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <br />
                        <br />
                        <br />
                        <br />
                    </div>
            </div>

        </div>
    </div>
    </div>
    <div class="row-fluid">
        <div class="fb-comments" data-href="<?php echo Yii::app()->createAbsoluteUrl('product/view', array('id'=>$product->product_id)); ?>" data-numposts="5" data-colorscheme="light"></div>
    </div>