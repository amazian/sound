<?php

class TopSalesController extends BackendController {

    public function actionIndex() {
        $model = new TopSalesForm;

        
        $this->render('index', array(
            'model'=>$model
        ));
    }
    
    public function actionAdd($id){
        if(!ProductTopSales::model()->exists("product_id={$id}")) {
            $model = new ProductTopSales;
            $model->product_id = $id;
            $model->save();
        }
    }
    
    public function actionDelete($id){
        if(ProductTopSales::model()->exists("product_id={$id}")) {
            ProductTopSales::model()->deleteAllByAttributes(array('product_id'=>$id));
        }
    }

    public function actionProducts(){
        $topSalesProducts = ProductTopSales::model()->findAll();
        foreach($topSalesProducts as $topSaleProduct) {
            $product = $topSaleProduct->product;
            if(!is_null($product)) {
                echo CHtml::tag('tr', array(),
                    CHtml::tag('td', array(), $product->description->name) .
                    CHtml::tag('td', array(), $product->type) .
                    CHtml::tag('td', array(), $product->model) .
                    CHtml::tag('td', array(), !is_null($product->primarySpec) ? $product->primarySpec->description->name : "") .
                    CHtml::tag('td', array(), $product->getFormattedPrice(true)) .
                    CHtml::tag('td', array(), CHtml::link('Remove', '#', array('class'=>'remove', 'data-product-id'=>$product->product_id)))
                );
            }
        }
    }
    
    public function actionAutocomplete($query){
        $json = array();

        $productDescriptions = ProductDescription::model()->findAll("name LIKE '%{$query}%' OR product_id LIKE '%{$query}%'");
        foreach($productDescriptions as $description){
            $json[] = array('id'=>$description->product_id, 'value'=>"ID:{$description->product_id} {$description->name}");
        }
        
        echo CJSON::encode($json);
    }
}