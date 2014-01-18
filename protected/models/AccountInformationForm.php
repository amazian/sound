<?php

/**
 * AccountInformationForm class.
 * AccountInformationForm is the data structure for keeping
 * customer information form data. It is used by the 'information' action of 'MyAccountController'.
 */
class AccountInformationForm extends CFormModel {

    public $id;
    public $name;
    public $phone;
    public $address;

    /**
     * Declares the validation rules.
     * The rules state that phone and password are required,
     * and password needs to be checked.
     */
    public function rules() {
        return array(
            // username and password are required
            array('name, phone, address', 'required'),
            array('phone', 'checkIfPhoneExists'),
            array('name', 'length', 'max'=>255),
            array('phone', 'numerical', 'integerOnly' => true),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'name'=>Yii::t('register', 'Name'),
            'phone'=>Yii::t('register', 'Phone'),
        );
    }

    /**
     * Checks that phone number doesnt exists on the database.
     * This is the 'checkIfPhoneExists' validator as declared in rules().
     */
    public function checkIfPhoneExists($attribute, $params) {
        if (!$this->hasErrors()) {
            $user = Customer::model()->findByAttributes(array('telephone'=>$this->phone));
            if (!is_null($user) && $user->email != Yii::app()->user->name)
                $this->addError('phone', Yii::t('register', 'Phone number exists!.'));
        }
    }

    /**
     * Register the user with the data specified in the model.
     * @return boolean whether register is successful
     */
    public function save() {
        $customer = Customer::model()->findByPk($this->id);
        $customer->name = $this->name;
        $customer->telephone = $this->phone;
        $customer->address = $this->address;

        return $customer->save();
    }

}
