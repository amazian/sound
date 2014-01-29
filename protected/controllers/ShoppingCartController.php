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

    public function actionCheckout() {
        $model = new CheckoutForm;

        // collect user input data
        if (isset($_POST['CheckoutForm'])) {
            $model->attributes = $_POST['CheckoutForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate()) {
                if($orderId = $model->createOrder()) {
                    // clear shopping cart
                    Yii::app()->user->clearItemsOnCart();

                    $order = Order::model()->findByPk($orderId);

                    // redirect to payment gateway TODO: make dynamic, for the moment only paypal
                    $paypalManager = Yii::app()->getModule('SimplePaypal')->paypalManager;

                    $paypalManager->addField('item_name', 'Purchase at Sound');
                    $paypalManager->addField('amount', '50');
                    $paypalManager->addField('item_name_1', 'Test Title');
                    $paypalManager->addField('quantity_1', '2');
                    $paypalManager->addField('amount_1', 1);
                    $paypalManager->addField('custom', '111');

                    //$paypalManager->dumpFields();   // for printing paypal form fields
                    $paypalManager->submitPaypalPost();
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