<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SettingForm extends CFormModel
{
    //email
    public $transportType; //php or smtp
    public $smtpHost;
    public $smtpUsername;
    public $smtpPassword;
    public $smtpPort;
    public $encryption;

    //general
    public $dateFormat;
    public $timeFormat;
    public $adminEmail;
    public $autoEmail;
    public $login_limit_times;
    public $time_refresh_login;

    //paypal
    public $paypalURL;
    public $paypal_email_address;
    public $paypalType;

    public $twitter;
    public $facebook;
    public $linkedin;
    public $rss;

    public $title;
    public $meta_description;
    public $meta_keywords;

    public static $_paypalURL;

    public $title_all_mail;
    public $image_watermark;
    public $image_watermark2;
    
    //mailchimp
    public $mailchimp_on;
    public $mailchimp_api_key;
    public $mailchimp_list_id;  
    public $mailchimp_title_groups;
    
    // for cron job newsletter
    public $server_name;
    
    public $server_maintenance;
    public $server_maintenance_message;
    public $time_disable_login;
    public $allow_session_menu;
    public $show_popup_news;
    
    /* For system */
    public $delete_global_days;
    public $limit_post_ticket;    
    public $ticket_page_size;
    public $cookie_days;
    public $days_keep_track_login;
    public $enable_delete; // cờ cho phép xóa trên toàn hệ thống
    public $allow_admin_login;
    public $allow_use_admin_cookie; // Dec 13, 2014 cho phép dùng cookie admin để login?
    public $check_login_same_account; // Jan 09, 2015  check 1 account 2 user login cùng 1 lúc
    public $DeleteImage; // Aug 07 cho phép xóa image của news
    /* For system */
    /* For other function */
    
    /* For other function */


    public function rules()
    {
        $return = array();
        foreach( SettingForm::$arrGeneral as $key=>$value):
            $return[] = array($value, 'safe');
        endforeach;
        foreach( SettingForm::$arrSmtp as $key=>$value):
            $return[] = array($value, 'safe');
        endforeach;
        
//        $return []= array('adminEmail, autoEmail', 'required');
        $return []=array('smtpPort, login_limit_times, time_refresh_login', 'numerical', 'integerOnly' => true);
//        $return []=array('adminEmail, autoEmail', 'email');
        $return []=array('twitter,facebook,linkedin,rss', 'length', 'max'=>200);
        $return []=array('image_watermark2', 'file','on'=>'updateSettings',
            'allowEmpty'=>true,
            'types'=> 'jpg,gif,png,tiff',
            'wrongType'=>'Only jpg,gif,png,tiff allowed',
            'maxSize' => 1024 * 1024 * 3, // 8MB
            'tooLarge' => 'The file was larger than 3MB. Please upload a smaller file.',
        );
        $return []=array('image_watermark2', 'match', 'pattern'=>'/^[^\\/?*:&;{}\\\\]+\\.[^\\/?*:&;{}\\\\]{3}$/', 'message'=>'Image files name cannot include special characters: &%$#', 'on'=>'updateSettings');
        $return []=array('transportType, smtpHost, dateFormat, timeFormat, smtpUsername, smtpPassword, encryption', 'length', 'max'=>100);
        $return []=array('title, meta_description, meta_keywords, address, phone, email, googleMap', 'safe');
        return $return;
    }
    
    public static $arrSmtp = array('host' => 'smtpHost', 'username' => 'smtpUsername', 'password' => 'smtpPassword',
    'port' => 'smtpPort', 'encryption' => 'encryption');
    
    public static $arrGeneral = array(
    'adminEmail' => 'adminEmail',
    'autoEmail' => 'autoEmail',
    'meta_description' => 'meta_description',
    'meta_keywords' => 'meta_keywords', 'image_watermark' => 'image_watermark', 'login_limit_times' => 'login_limit_times',
    'time_refresh_login' => 'time_refresh_login',
    'title_all_mail' => 'title_all_mail',
    'title' => 'title',
    'server_name' => 'server_name',
    'server_maintenance' => 'server_maintenance',
    'server_maintenance_message' => 'server_maintenance_message',
    'time_disable_login' => 'time_disable_login',
    'allow_session_menu' => 'allow_session_menu',
    'show_popup_news' => 'show_popup_news',        
    'delete_global_days' => 'delete_global_days',
    'limit_post_ticket' => 'limit_post_ticket',
    'ticket_page_size' => 'ticket_page_size',
    'cookie_days' => 'cookie_days',
    'days_keep_track_login' => 'days_keep_track_login',
    'enable_delete' => 'enable_delete',
    'allow_admin_login' => 'allow_admin_login',
    'allow_use_admin_cookie' => 'allow_use_admin_cookie',
    'check_login_same_account' => 'check_login_same_account',
    'DeleteImage' => 'DeleteImage',
        

);

    /**
     * Override configurations.
     */
    static public function applySettings()
    {
        //apply setting for paypal
        if (Yii::app()->setting->getItem('transportType')) {
            Yii::app()->mail->transportType = Yii::app()->setting->getItem('transportType');
        }
        if (Yii::app()->mail->transportType == 'smtp') {
            foreach(self::$arrSmtp as $key => $value)
            {
                if (Yii::app()->setting->getItem($value))
                {
                    Yii::app()->mail->transportOptions[$key] = Yii::app()->setting->getItem($value);
                }
            }
            
        } else {
            Yii::app()->mail->transportOptions = '';
        }

        //apply setting for general
        foreach(self::$arrGeneral as $key => $value)
        {
            if (Yii::app()->setting->getItem($value))
            {
                Yii::app()->params[$key] = Yii::app()->setting->getItem($value);
            }
        }
        self::$_paypalURL = Yii::app()->params['paypalURL'];
        //apply setting for paypal
        if (Yii::app()->setting->getItem('title')) {
            Yii::app()->name = Yii::app()->setting->getItem('title');
        }
    }
}
