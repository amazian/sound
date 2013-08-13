<?php

class ProductController extends Controller {

    public function actionView($id) {
        $product = Product::model()->findByPk($id);
        if(is_null($product)) 
            die('Invalid product');
        
        // Convert attributes to table
        $productAttributeIds = array();
        foreach($product->attributes as $attr)
            $productAttributeIds[$attr->attribute_id] = $attr->text;
        
        $specs = array();
        $groups = AttributeGroup::model()->findAll();
        foreach($groups as $group){
            if(count($group->attributes) > 0){
                foreach($group->attributes as $attribute){
                    if(in_array($attribute->attribute_id, array_keys($productAttributeIds)))
                        $specs[$group->description->name][$attribute->description->name] = $productAttributeIds[$attribute->attribute_id];
                }                            
            }                    
        }
        
        $this->render('index', array(
            'product'=>$product,
            'specGroups'=>$specs,
        ));
    }
    
    public function actionCompare(){
        $this->render('compare', array(
            
        ));
    }

}