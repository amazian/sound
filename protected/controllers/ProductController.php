<?php

class ProductController extends Controller {

    public function actionView($id) {
        $product = Product::model()->findByPk($id);
        if(is_null($product)) 
            die('Invalid product');

        // filters
        $productSpecs = array();
        if(isset($_POST['spec_filter'])) {
            $specFilterIds = $_POST['spec_filter'];
            foreach($specFilterIds as $specFilterId) {
                $productSpec = ProductSpec::model()->findByPk($specFilterId);
                if(!is_null($productSpec)) {
                    if($productSpec->description->type_id == Spec::TYPE_NUMERICAL) {
                        // check if range
                        if(isset($_POST["filter-{$specFilterId}-start"]) && $_POST["filter-{$specFilterId}-start"] > 0 && isset($_POST["filter-{$specFilterId}-end"]) && $_POST["filter-{$specFilterId}-end"] > 0) {
                            $valueStart = $_POST["filter-{$specFilterId}-start"];
                            $valueEnd = $_POST["filter-{$specFilterId}-end"];

                            // product specs on range
                            $productSpecs = ProductSpec::model()->findAll("spec_id=:spec_id AND (value_init BETWEEN :start AND :end OR value_end BETWEEN :start AND :end)", array(':spec_id'=>$productSpec->spec_id, ':start'=>$valueStart, ':end'=>$valueEnd));
                        }
                        // or single
                        elseif(isset($_POST["filter-{$specFilterId}-start"]) && $_POST["filter-{$specFilterId}-start"] > 0) {
                            $valueStart = $_POST["filter-{$specFilterId}-start"];

                            // product specs on filter
                            $productSpecs = ProductSpec::model()->findAll("spec_id=:spec_id AND (value_init=:start)", array(':spec_id'=>$productSpec->spec_id, ':start'=>$valueStart));
                        }
                    }
                    elseif($productSpec->description->type_id == Spec::TYPE_ALPHABETICAL) {
                        $value = isset($_POST["filter-{$specFilterId}"]) ? $_POST["filter-{$specFilterId}"] : null;
                        if(!is_null($value)) {
                            // product specs on filter
                            $productSpecs = ProductSpec::model()->findAll("spec_id=:spec_id AND value_init=:value", array(':spec_id'=>$productSpec->spec_id, ':value'=>$value));
                        }
                    }
                }
            }

        }

        $relatedProducts = array();
        if(count($productSpecs) > 0) {
            foreach($productSpecs as $productSpec) {
                if($productSpec->product->product_id == $id) continue;

                $relatedProducts[] = $productSpec->product;
            }
        }
        
        $this->render('index', array(
            'product'=>$product,
            'relatedProducts'=>$relatedProducts,
            'relatedProductSearch'=>isset($_POST['spec_filter'])
        ));
    }
    
    public function actionHoverCard($id) {
        $product = Product::model()->findByPk($id);
        if(is_null($product)) 
            die('Invalid product');
        
        $this->renderPartial('_hoverCard', array (
            'product'=>$product
        ));
    }

    public function actionHoverCardNoBuyButton($id) {
        $product = Product::model()->findByPk($id);
        if(is_null($product))
            die('Invalid product');

        $this->renderPartial('_hoverCardNoBuyButton', array (
            'product'=>$product
        ));
    }
    
    public function actionCompare(){
        $this->render('compare', array(
            
        ));
    }

    public function actionGetFilterHtmlForSpec($id) {
        $productSpec = ProductSpec::model()->findByPk($id);
        if(!is_null($productSpec)) {
            if($productSpec->description->type_id == Spec::TYPE_NUMERICAL) {
                echo CHtml::textField("filter-{$productSpec->product_spec_id}-start");
                echo CHtml::textField("filter-{$productSpec->product_spec_id}-end");
            }
            else {
                echo CHtml::radioButtonList("filter-{$productSpec->product_spec_id}", null, $productSpec->description->getSpecOptions(), array(
                    'separator'=>'&nbsp;&nbsp;&nbsp;'
                ));
            }
        }
    }

    public function actionGetTagProducts($tagText) {
        $productsByTag = ProductTag::model()->findAllByAttributes(array('tag_text'=>$tagText));
        $products = array();
        foreach($productsByTag as $productByTag) {
            $products[] = $productByTag->product;
        }

        $this->renderPartial('_tagProducts', array(
            'products' => $products,
        ));
    }

}