<?php

/**
 * ChangePasswordForm class.
 * ChangePasswordForm is the data structure for keeping
 * user password form data. It is used by the 'changePassword' action of 'MyAccountController'.
 */
class ChangePasswordForm extends CFormModel {

    public $id;
    public $password;
    public $passwordAgain;

    /**
     * Declares the validation rules.
     * The rules state that phone and password are required,
     * and password needs to be checked.
     */
    public function rules() {
        return array(
            array('password, passwordAgain', 'required'),
            array('password', 'checkPassword'),
            array('password, passwordAgain', 'length', 'max'=>255),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'password'=>Yii::t('register', 'Password'),
            'passwordAgain'=>Yii::t('register', 'Repeat Password'),
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
     * Register the user with the data specified in the model.
     * @return boolean whether register is successful
     */
    public function save() {
        $customer = Customer::model()->findByPk($this->id);
        $customer->password = md5($this->password);

        return $customer->save();
    }

}
