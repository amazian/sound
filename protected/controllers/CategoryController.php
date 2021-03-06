<?php

class CategoryController extends Controller {

    public function actionView($id) {
        $category = Category::model()->findByPk($id);
        if(is_null($category))
            die('Invalid category');

        $manufacturers = Manufacturer::model()->findAll();
        
        $this->render('index', array(
            'category' => $category,
            'manufacturers' => $manufacturers,
        ));
    }

}