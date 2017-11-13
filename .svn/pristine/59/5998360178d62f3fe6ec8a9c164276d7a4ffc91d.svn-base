<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class AdminUserIdentity extends UserIdentity
{
    private $status = 1;
    public $role_id;
    public $application_id=BE;
    public $md5_pwd='';

    /**
     * Authenticates a user.
     * The example implementation makes sure if the username and password
     * are both 'demo'.
     * In practical applications, this should be changed to authenticate
     * against some persistent user identity storage (e.g. database).
     * @return boolean whether authentication succeeds.
     */
    public function authenticate()
    {
        try {
        //user ip login more than X times can't login
        $iplogin = new IpLogins();
        $iplogin->deleteOldRecords();
        if(!$iplogin->limitLoginTimes($this->username, Yii::app()->request->getUserHostAddress()))
        {
            $this->errorCode = self::ERROR_FAILURE_MAX_TIMES;                
            return !$this->errorCode;
        }
        $criteria = new CDBcriteria();
        $criteria->compare('t.username', $this->username);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.application_id', $this->application_id);
        $record=Users::model()->find($criteria);
        $attUpdate = array();
        if(empty($this->md5_pwd)){
            $this->md5_pwd = md5(trim($this->password));
        }

        if($record===null)
        {
            $this->errorCode=self::ERROR_USERNAME_INVALID;
        }
        else if(trim($record->password_hash) != $this->md5_pwd)
        {
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
            $record->login_attemp = $record->login_attemp + 1;
            $attUpdate[] = 'login_attemp';
            $record->update($attUpdate);
        }
        else if($record->status==0 )
        {
            $this->errorCode=  self::ERROR_USERNAME_BLOCKED;
        }
        else
        {
            $this->_id=$record->id;
            $this->role_id = $record->role_id;
            $this->_isAdmin = true;
            $this->errorCode=self::ERROR_NONE;
            // Update last IP and time
            $record->last_logged_in = date('Y-m-d H:i:s');
            $record->login_attemp = 0;
            $record->verify_code = md5(time());
            $session=Yii::app()->session;
            $session['CURRENT_SESSION_USER'] = $record->verify_code;                    
            Yii::app()->session['LOGGED_USER'] = $record;
            $attUpdate[] = 'last_logged_in';
            $attUpdate[] = 'login_attemp';
            $attUpdate[] = 'verify_code'; // Apr 19, 2014 close tạm để fix multi login agent, sau này mở lại ra                    
            if(!$record->update($attUpdate))
                Yii::log(print_r($record->getErrors(), true), 'error', 'AdminUserIdentity.authenticate');
            /**
            * DTOAN ghostkissboy12@gmail.com
            * set cookie
            */
            if(isset($_POST['AdminLoginForm']['rememberMe'])){
               if($_POST['AdminLoginForm']['rememberMe']==1){
                   ActiveRecord::setCookie(VERZ_COOKIE_ADMIN, $record, 'username');
               }
           }
        }

        if($this->errorCode && $this->errorCode != self::ERROR_USERNAME_INVALID)
        {
            //write ip and username            
            $iplogin->username = $this->username;
            $iplogin->ip_address = Yii::app()->request->getUserHostAddress();
            $iplogin->time_login = time();
            $iplogin->save();       
        }

        return !$this->errorCode;
        } catch (Exception $exc) {
            throw new Exception("Username or ip not valid. ".$exc->getMessage());
        }

    }

}