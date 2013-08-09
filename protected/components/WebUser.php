<?php
class WebUser extends CWebUser {
    private $_model = null;
 
    function getRole() {
             if (!$this->isGuest ){
            $loginuser = ExtSupervisor::model()->find('LOWER(extsupervisor)=?', array(strtolower($this->id)));
            if($loginuser !== null)
                return 3;
            $loginuser = IntSupervisor::model()->find('LOWER(intsupervisor)=?', array(strtolower($this->id)));
            if($loginuser !== null)
                return 2;
            $loginuser =  Professor::model()->find('LOWER(professor)=?', array(strtolower($this->id)));
            if($loginuser !== null)
                return 1;
            $loginuser = StudentLogin::model()->find('LOWER(userid)=?', array(strtolower($this->id)));
            if($loginuser !== null)
                return 0;
        }
        
    }
 
}