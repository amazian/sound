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

    public function removeItemFromCart($productId) {
        $itemsOnCart = array();
        if($this->hasState('itemsOnCart'))
            $itemsOnCart = $this->getState('itemsOnCart');

        foreach($itemsOnCart as $id => $item) {
            $itemProdId = $item['id'];
            if($itemProdId == $productId) {
                unset($itemsOnCart[$id]);
            }
        }

        $this->setState('itemsOnCart', $itemsOnCart);
    }

    public function getQuantityForProductId($productId) {
        $itemsOnCart = array();
        if($this->hasState('itemsOnCart'))
            $itemsOnCart = $this->getState('itemsOnCart');

        foreach($itemsOnCart as $item) {
            if($item['id'] == $productId)
                return $item['qty'];
        }

        return 0;
    }

    public function setQuantityForProductId($productId, $qty) {
        if($qty == 0) {
            $this->removeItemFromCart($productId);
        }
        else {
            $itemsOnCart = array();
            if($this->hasState('itemsOnCart'))
                $itemsOnCart = $this->getState('itemsOnCart');

            foreach($itemsOnCart as $id => $item) {
                $itemProdId = $item['id'];
                if($itemProdId == $productId) {
                    $itemsOnCart[$id]['qty'] = $qty;
                }
            }

            $this->setState('itemsOnCart', $itemsOnCart);
        }
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

    public function clearItemsOnCart() {
        $this->setState('itemsOnCart', array());
    }
}