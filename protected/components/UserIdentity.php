<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {

    /**
     * @var User The user model.
     */
    protected $model = NULL;


    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate() {
        $condition = '`email` = :email AND `password` = :password';
        $params = array(':email' => $this->username, ':password' => Helper::hash($this->password));
        $this->model = User::model()->find($condition, $params); /* @var $model User*/

        if ($this->model !== NULL) {
            // Set state
            Yii::app()->user->setState('name', $this->model->name);
            
            $this->errorCode = self::ERROR_NONE;
        }

        return !$this->errorCode;
    }
    
    public function getId() {
        if ($this->model) {
            return $this->model->id;
        } else {
            return NULL;
        }
    }
    
    public function getName() {
        if ($this->model) {
            return $this->model->email;
        } else {
            return NULL;
        }
    }

}