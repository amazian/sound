<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * Authenticates a user.
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $user = Customer::model()->findByAttributes(array('email' => $this->username, 'status'=>1));

        if (is_null($user))
            $this->errorCode = self::ERROR_USERNAME_INVALID;
        else if ($user->password != md5($this->password) )
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
        else
            $this->errorCode = self::ERROR_NONE;


        return!$this->errorCode;
    }

}