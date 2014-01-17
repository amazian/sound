<?php

/**
 * RegisterForm class.
 * RegisterForm is the data structure for keeping
 * user register form data. It is used by the 'register' action of 'SiteController'.
 */
class RegisterForm extends CFormModel {

    public $name;
    public $phone;
    public $password;
    public $passwordAgain;
    public $email;
    public $verifyCode;

    /**
     * Declares the validation rules.
     * The rules state that phone and password are required,
     * and password needs to be checked.
     */
    public function rules() {
        return array(
            // username and password are required
            array('name, password, passwordAgain, phone, email', 'required'),
            array('email', 'email'),
            array('password', 'checkPassword'),
            array('phone', 'checkIfPhoneExists'),
            array('name, password', 'length', 'max'=>255),
            array('phone', 'numerical', 'integerOnly' => true),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'name'=>Yii::t('register', 'Name'),
            'password'=>Yii::t('register', 'Password'),
            'passwordAgain'=>Yii::t('register', 'Repeat Password'),
            'phone'=>Yii::t('register', 'Phone'),
            'email'=>Yii::t('register', 'Email'),
            'verifyCode'=>Yii::t('register', 'Verification Code'),
        );
    }

    /**
     * Checks if the phone number exists are the same.
     * This is the 'checkPassword' validator as declared in rules().
     */
    public function checkPassword($attribute, $params) {
        if (!$this->hasErrors()) {
            if ($this->password != $this->passwordAgain)
                $this->addError('password', 'Passwords entered are not the same.');
        }
    }

    /**
     * Checks that phone number doesnt exists on the database.
     * This is the 'checkIfPhoneExists' validator as declared in rules().
     */
    public function checkIfPhoneExists($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = Customer::model()->findByAttributes(array('telephone'=>$this->phone));
            if (!is_null($user))
                $this->addError('phone', Yii::t('register', 'Phone number exists!.'));
        }
    }

    /**
     * Register the user with the data specified in the model.
     * @return boolean whether register is successful
     */
    public function register() {
        $customer = new Customer;
        $customer->name = $this->name;
        $customer->telephone = $this->phone;
        $customer->password = md5($this->password);
        $customer->email = $this->email;
        $customer->date_added = date('Y-m-d');
        $customer->status = 1;

        return $customer->save();
    }

}
