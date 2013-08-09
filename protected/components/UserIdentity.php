<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity {
 
    protected $_id;

    public function authenticate(){
   
        //login int,ext and professors
        $user = User::model()->findByPk($this->username);
         //login student
        $student = StudentLogin::model()->findByPk($this->username);
        if(($user!==null && $this->password===$user->password)||($student!==null && $this->password===$student->password)) {
            if($user!==null){
            $this->_id = $user->userid;
            $this->username = $user->userid;
            }
            else {
                $this->_id = $student->userid;
            $this->username = $student->userid;
            }
            $this->errorCode = self::ERROR_NONE;
    
        } 
        else {

            $this->errorCode = self::ERROR_USERNAME_INVALID;
        }
       
       return !$this->errorCode;
    }
 
    public function getId(){
        return $this->_id;
    }
}