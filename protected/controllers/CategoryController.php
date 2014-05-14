<?php

class CategoryController extends Controller {

    public function actionView($id) {
        $category = Category::model()->findByPk($id);
        if(is_null($category))
            die('Invalid category');

        $productsByBrand = array();
        foreach($category->activeProducts as $product) {
            $manufacturer = $product->manufacturer_id;
            if(is_object($manufacturer)) {
                $productsByBrand[$manufacturer->manufacturer_id] = array(
                    'brand' => $manufacturer,
                    'product' => $product,
                );
            }
        }
        
        $this->render('index', array(
            'category' => $category,
            'productsByBrand'=>$productsByBrand,
        ));
    }

}