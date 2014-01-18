<?php
class CustomerWebUser extends CWebUser
{
    public function addItemToCart($id, $qty) {
        $itemsOnCart = array();
        if($this->hasState('itemsOnCart'))
            $itemsOnCart = $this->getState('itemsOnCart');

        $itemsOnCart[] = array(
            'id'=>$id,
            'qty'=>$qty
        );
        $this->setState('itemsOnCart', $itemsOnCart);
    }

    public function getItemsOnCart() {
        $itemsOnCart = array();
        if($this->hasState('itemsOnCart'))
            $itemsOnCart = $this->getState('itemsOnCart');

        $products = array();
        foreach($itemsOnCart as $productData) {
            $product = Product::model()->findByPk($productData['id']);
            if(!is_null($product))
                $products[] = $product;
        }

        return $products;
    }

    public function countItemsOnCart() {
        return count($this->getItemsOnCart());
    }
}