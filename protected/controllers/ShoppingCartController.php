<?php

class ShoppingCartController extends Controller {

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $products = Yii::app()->user->getItemsOnCart();
        $items = array();
        foreach($products as $product) {
            $items[] = array(
                'product' => $product,
                'qty' => Yii::app()->user->getQuantityForProductId($product->product_id)
            );
        }

        $this->render('index', array(
            'items'=>$items
        ));
    }

    public function actionAdd($id, $qty) {
        if(Product::model()->exists("product_id=:product_id", array(':product_id'=>$id))){
            Yii::app()->user->addItemToCart($id, $qty);
        }

        $this->redirect(array('index'));
    }

    public function actionUpdate() {
        $ids = isset($_POST['ids']) ? $_POST['ids'] : array();
        $amounts = isset($_POST['amount']) ? $_POST['amount'] : array();

        // Update
        foreach($amounts as $productId => $amount) {
            Yii::app()->user->setQuantityForProductId($productId, $amount);
        }

        // Remove
        foreach($ids as $productId) {
            Yii::app()->user->removeItemFromCart($productId);
        }

        $this->redirect(array('index'));
    }

    public function actionCheckout() {
        if(Yii::app()->user->isGuest) {
            $this->redirect(array('/site/login'));
            return;
        }
        $model = new CheckoutForm;

        // collect user input data
        if (isset($_POST['CheckoutForm'])) {
            $model->attributes = $_POST['CheckoutForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                if($orderId = $model->createOrder()) {
                    // clear shopping cart
                    //Yii::app()->user->clearItemsOnCart();

                    $order = Order::model()->findByPk($orderId);

                    // redirect to payment gateway
                    if($model->paymentGateway == CheckoutForm::PAYMENT_METHOD_PAYPAL) {
                        $paypalManager = Yii::app()->getModule('SimplePaypal')->paypalManager;

                        $paypalManager->addField('item_name', 'Items on Shopping Cart');
                        $paypalManager->addField('amount', (float) $order->total);

                        // list items
                        foreach($order->products as $id => $orderProduct) {
                            $paypalManager->addField('item_name_' . ($id+1), $orderProduct->name);
                            $paypalManager->addField('quantity_' . ($id+1), (int)$orderProduct->quantity);
                            $paypalManager->addField('amount_' . ($id+1), (float)$orderProduct->price);
                        }

                        //$paypalManager->dumpFields();   // for printing paypal form fields
                        $paypalManager->submitPaypalPost();
                    }
                    else {
                        $openPayManager = Yii::app()->getModule('SimpleOpenPay')->openPayManager;

                        $openPayManager->addField('txid', '222222'); // Merchants Order Number
                        $openPayManager->addField('amount', $order->total);
                        //$openPayManager->addField('Parameter check 1', '8cfe9eceb4457332e6dee59fa436c078');
                        //$openPayManager->addField('Parameter check 2', '8f2d1f6fa969e7e12efca50099691f9a');

                        //$openPayManager->dumpFields();   // for printing openpay form fields
                        $openPayManager->submitOpenPayPost();
                    }
                }
            }

        }

        $model->paymentGateway = CheckoutForm::PAYMENT_METHOD_OPENPAY;
        $model->deliveryType = 0;

        if(!Yii::app()->user->isGuest) {
            $customer = Customer::model()->findByAttributes(array('email'=>Yii::app()->user->name));
            $model->address = $customer->address;
        }

        $shippingOptions = CHtml::listData(DeliveryMethod::model()->findAll(), 'delivery_method_id', 'text');

        $paymentGateways = array(
            CheckoutForm::PAYMENT_METHOD_OPENPAY => 'OpenPay',
            CheckoutForm::PAYMENT_METHOD_PAYPAL => 'PayPal',
        );

        $this->render('checkout', array(
            'model'=>$model,
            'paymentGateways'=>$paymentGateways,
            'shippingOptions'=>$shippingOptions
        ));
    }

}