<?php

/**
 * Description of OpenPay
 *
 * @author turi
 */
class OpenPay extends CComponent {

    /**
      # The url (relative to base url) to return the customer after a successful payment
     */
    public $returnUrl;

    /**
      # The url (relative to base url) to return the customer if he/she cancels the payment
     */
    public $cancelUrl;

    /**
     * @var string|array The url to notify url for the paypal
     */
    public $notifyUrl;

    /**
      # Default currency to use;
     */
    public $currency = 'NTD';

    public $openPayUrl;

    /**
     * @var string paypal business/merchant email
     */
    public $mid; // merchant id
    public $lastError;                 // holds the last error encountered
    public $fields = array();           // array holds the fields to submit to openpay

    public function init() {
        $this->openPayUrl = Yii::app()->getModule('SimpleOpenPay')->paypalUrl;

        $this->returnUrl = Yii::app()->createAbsoluteUrl(Yii::app()->getModule('SimpleOpenPay')->returnUrl);
        $this->cancelUrl = Yii::app()->createAbsoluteUrl(Yii::app()->getModule('SimpleOpenPay')->cancelUrl);
        $this->notifyUrl = Yii::app()->createAbsoluteUrl(Yii::app()->getModule('SimpleOpenPay')->notifyUrl);

        $this->currency = Yii::app()->getModule('SimpleOpenPay')->currency;
        $this->mid = Yii::app()->getModule('SimpleOpenPay')->mid;

        // populate $fields array with a few default values.  See the openpay
        // documentation for a list of fields and their data types. These openpay
        // values can be overwritten by the calling script.

        $this->addField('version', '1.0');           // Return method = POST
        $this->addField('mid', $this->merc);
        $this->addField('business', $this->businessEmail);
        $this->addField('return', $this->returnUrl . '&q=success');
        $this->addField('cancel_return', $this->cancelUrl . '&q=cancel');
        $this->addField('notify_url', $this->notifyUrl . '&q=ipn');
        $this->addField('currency_code', $this->currency);
    }

    public function __construct() {
        
    }

    public function test() {
        echo 'paypalUrl: ' . $this->paypalUrl . '<br/>';
        echo 'returnUrl: ' . $this->returnUrl . '<br/>';
        echo 'cancelUrl: ' . $this->cancelUrl . '<br/>';
        echo 'notifyUrl: ' . $this->notifyUrl . '<br/>';
        echo 'currency: ' . $this->currency . '<br/>';
        echo 'businessEmail: ' . $this->businessEmail . '<br/>';

        print '<pre>' . print_r($this->fields, 1) . '</pre>';
    }

    public function addField($field, $value) {

        // adds a key=>value pair to the fields array, which is what will be 
        // sent to paypal as POST variables.  If the value is already in the 
        // array, it will be overwritten.

        $this->fields["$field"] = $value;
    }

    public function submitPaypalPost() {

        // this function actually generates an entire HTML page consisting of
        // a form with hidden elements which is submitted to paypal via the 
        // BODY element's onLoad attribute.  We do this so that you can validate
        // any POST vars from you custom form before submitting to paypal.  So 
        // basically, you'll have your own form which is submitted to your script
        // to validate the data, which in turn calls this function to create
        // another hidden form and submit to paypal.
        // The user will briefly see a message on the screen that reads:
        // "Please wait, your order is being processed..." and then immediately
        // is redirected to paypal.

        echo "<html>\n";
        echo "<head><title>Processing Payment...</title></head>\n";
        echo "<body onLoad=\"document.form.submit();\">\n";
        echo "<center><h3>Please wait, your order is being processed...</h3></center>\n";
        echo "<form method=\"post\" name=\"form\" action=\"" . $this->paypalUrl . "\">\n";

        foreach ($this->fields as $name => $value) {
            echo "<input type=\"hidden\" name=\"$name\" value=\"$value\">";
        }

        echo "</form>\n";
        echo "</body></html>\n";
    }

    public function notify() {
        $listener = new IpnListener();
        $listener->use_curl = false;
        $listener->use_sandbox = $this->paypalSandbox;

        return $listener->processIpn();
    }

    public function dumpFields() {

        // Used for debugging, this function will output all the field/value pairs
        // that are currently defined in the instance of the class using the
        // addField() function.

        echo "<h3>paypal_class->dumpFields() Output:</h3>";
        echo "<table width=\"95%\" border=\"1\" cellpadding=\"2\" cellspacing=\"0\">
            <tr>
               <td bgcolor=\"black\"><b><font color=\"white\">Field Name</font></b></td>
               <td bgcolor=\"black\"><b><font color=\"white\">Value</font></b></td>
            </tr>";

        ksort($this->fields);
        foreach ($this->fields as $key => $value) {
            echo "<tr><td>$key</td><td>" . urldecode($value) . "&nbsp;</td></tr>";
        }

        echo "</table><br>";
    }

}

?>
