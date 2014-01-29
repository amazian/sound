<?php

class SimpleOpenPayModule extends CWebModule {

    const OPENPAY_PRODUCTION = 'https://www.twv.com.tw/openpay/pay.php';

    /**
     * @var string|array
     * The url to return the customer after a successful payment
     */
    public $returnUrl;

    /**
     * @var string|array The url to return the customer if payment was cancelled
     */
    public $cancelUrl;

    /**
     * @var string|array The url to notify url for the paypal
     */
    public $notifyUrl;

    /**
     * @var string Default currency to use
     */
    public $currency = 'NTD';


    public $openPayUrl;

    public $language;

    /**
     * @var string merchant id
     */
    public $mid;

    public function init() {
        // this method is called when the module is being created
        // you may place code here to customize the module or the application
        // import the module-level models and components
        $this->setImport(array(
            'SimplePaypal.models.*',
            'SimplePaypal.components.*',
        ));

        $model = OpenpaySetting::model()->find();

        $this->openPayUrl = self::OPENPAY_PRODUCTION;

        $this->returnUrl = $model->return_url;
        $this->cancelUrl = $model->cancel_url;
        $this->notifyUrl = $model->notify_url;
        $this->currency = $this->currency;
        $this->mid = $model->mid;
        $this->language = $model->language;
    }

    public function beforeControllerAction($controller, $action) {
        if (parent::beforeControllerAction($controller, $action)) {
            // this method is called before any module controller action is performed
            // you may place customized code here
            return true;
        }
        else
            return false;
    }

}
