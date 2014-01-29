<?php

/**
 * CheckoutForm class.
 * CheckoutForm is the data structure for keeping
 * user checkout form data. It is used by the 'checkout' action of 'ShoppingCartController'.
 */
class CheckoutForm extends CFormModel {

    const PAYMENT_METHOD_OPENPAY = 0;
    const PAYMENT_METHOD_PAYPAL = 1;

    public $address;
    public $deliveryType;
    public $paymentGateway;

    /**
     * Declares the validation rules.
     * The rules state that phone and password are required,
     * and password needs to be checked.
     */
    public function rules() {
        return array(
            // username and password are required
            array('address, deliveryType, paymentGateway', 'required'),
            array('address', 'length', 'max'=>255),
            array('deliveryType, paymentGateway', 'numerical', 'integerOnly' => true),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
        );
    }

    /**
     * Register the user with the data specified in the model.
     * @return boolean whether register is successful
     */
    public function createOrder() {
        if(!Yii::app()->user->isGuest) {
            $customer = Customer::model()->findByAttributes(array('email'=>Yii::app()->user->name));

            $order = new Order;
            $order->invoice_no = 0;
            $order->invoice_prefix = 'SND';
            $order->store_id = 0;
            $order->store_name = 'Sound';
            $order->store_url = Yii::app()->baseUrl;
            $order->customer_id = $customer->customer_id;
            $order->customer_group_id = 0;
            $order->firstname = $customer->name;
            $order->lastname = 'N/A';
            $order->telephone = $customer->telephone;
            $order->email = $customer->email;
            $order->fax = 'N/A';
            $order->payment_firstname = $customer->name;
            $order->payment_lastname = 'N/A';
            $order->payment_company = 'N/A';
            $order->payment_company_id = 0;
            $order->payment_tax_id = 0;
            $order->payment_address_1 = $this->address;
            $order->payment_address_2 = 'N/A';
            $order->payment_city = 'N/A';
            $order->payment_postcode = 'n/a';
            $order->payment_country = 'n/a';
            $order->payment_country_id = 0;
            $order->payment_zone = 'n/a';
            $order->payment_zone_id = 0;
            $order->payment_address_format = 'n/a';

            if($this->paymentGateway == self::PAYMENT_METHOD_OPENPAY)
                $order->payment_method = 'openpay';
            else
                $order->payment_method = 'paypal';

            $order->payment_code = 'n/a';
            $order->shipping_firstname = $customer->name;
            $order->shipping_lastname = 'N/A';
            $order->shipping_company = 'n/a';
            $order->shipping_address_1 = $this->address;
            $order->shipping_address_2 = 'n/a';
            $order->shipping_city = 'n/a';
            $order->shipping_postcode = 'n/a';
            $order->shipping_country = 'n/a';
            $order->shipping_country_id = 0;
            $order->shipping_zone = 'n/a';
            $order->shipping_zone_id = 0;
            $order->shipping_address_format = 'n/a';

            $order->shipping_method = 'Taiwan Post System';
            $order->shipping_code = 'n/a';

            $order->comment = 'empty';

            // Calculate total
            $products  = Yii::app()->user->getItemsOnCart();
            $order->total = 0;
            foreach($products as $product) {
                $order->total += ($product->price * Yii::app()->user->getQuantityForProductId($product->product_id));
            }

            $order->order_status_id = 0;
            $order->affiliate_id = 0;
            $order->commission = 0;
            $order->language_id = 0;
            $order->currency_id = 0;
            $order->currency_code = 0;
            $order->currency_value = 0;
            $order->ip = '127.0.0.1';
            $order->forwarded_ip = '127.0.0.1';
            $order->user_agent = 'n/a';
            $order->accept_language = 'n/a';
            $order->date_added = date("Y-m-d H:i:s");
            $order->date_modified = date("Y-m-d H:i:s");

            if($order->save()) {

                // save products
                foreach($products as $product) {
                    $orderProduct = new OrderProduct;
                    $orderProduct->order_id = $order->order_id;
                    $orderProduct->product_id = $product->product_id;
                    $orderProduct->name = $product->description->name;
                    $orderProduct->model = $product->model;
                    $orderProduct->quantity = Yii::app()->user->getQuantityForProductId($product->product_id);
                    $orderProduct->price = $product->price;
                    $orderProduct->total = $product->price * $orderProduct->quantity;
                    $orderProduct->tax = 0;
                    $orderProduct->reward = 0;
                    $orderProduct->save();
                }

                return $order->order_id;
            }
            else
                return false;
        }
        else
            return false;
    }

}
