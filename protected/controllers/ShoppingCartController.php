<?php

class ShoppingCartController extends Controller {

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $products = Yii::app()->user->getItemsOnCart();

        $this->render('index', array(
            'products'=>$products
        ));
    }

    public function actionAdd($id, $qty) {
        if(Product::model()->exists("product_id=:product_id", array(':product_id'=>$id))){
            Yii::app()->user->addItemToCart($id, $qty);
        }

        $this->redirect(array('index'));
    }

}