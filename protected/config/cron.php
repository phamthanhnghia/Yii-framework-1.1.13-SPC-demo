<?php
include_once 'config.local.php';

return array(
    // This path may be different. You can probably get it from `config/main.php`.
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Cron',

    'preload'=>array('log'),

    'import'=>array(
        'application.components.*',
        'application.models.*',
        'ext.yii-mail.YiiMailMessage',
        'application.cms.components.*',
        
        'application.extensions.toSlug.*',
        'application.modules.api.models.*',// Add Dec 02, 2015  để chạy ở cron
        'application.modules.api.components.*',// Add Dec 02, 2015
        'application.extensions.yii-apns-gcm-master.*',// Add Dec 02, 2015
    ),
    // We'll log cron messages to the separate files
    'components'=>array(
        
        // Now 21, 2014 Fix for createAbsoluteUrl in console
        // http://www.yiiframework.com/forum/index.php?/topic/21474-set-hostinfo-and-baseurl/page__p__105239__fromsearch__1#entry105239
        'urlManager'=>array(
            'urlFormat'=>'path',
            'rules'=>array(
                // seo page
                'page/<slug:[a-zA-Z0-9-]+>'=> array('member/page/view_page_info'),
                //seo tag
                'tag/<name:[a-zA-Z0-9-]+>'=> array('member/tag/view_tag_info'),
                //seo tag
                'category/<slug:[a-zA-Z0-9-]+>'=> array('member/category/view_category_info'),
                //seo post : post/view_post_info/slug/this-post-demo2/cat/clothes
                'category/<cat:[a-zA-Z0-9-]+>/<slug:[a-zA-Z0-9-]+>'=> array('member/post/detail_post'),
                '<action:(error|unsubscribe)>'=>'site/<action>',
                'admin/<action:(login|logout|error|changePassword)>'=>'admin/site/<action>',
                'member/<action:(error|login|logout|forgot_password|register|change_password)>'=>'member/site/<action>',
                'member/<action:(profile|edit_profile|change_password)>'=>'member/users/<action>',
                'member/verify_register/<id>'=>'member/site/verify_register',
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
                '<url:(admin|member)>'=>'<url>/site/',
    //
            ),            
            'showScriptName'=>false,
        ),
        'request' => array(
            'hostInfo' => 'http://daukhimiennam.com',
            'baseUrl' => '',
            'scriptUrl' => '',
        ),
        // Now 21, 2014 Fix for createAbsoluteUrl in console
                
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron.log',
                    'levels'=>'error, warning',
                ),
                array(
                    'class'=>'CFileLogRoute',
                    'logFile'=>'cron_trace.log',
                    'levels'=>'trace',
                ),
                // Fix Now 21, 2014 for write  Yii::log
                // tắt log đi vì khi CRON send mail nó ghi 1 đống vào log TABLE => NOT NEED
//                array(
//                    'class' => 'DbLogRoute',
//                    'connectionID' => 'db',
//                    'autoCreateLogTable' => false,
//                    'logTableName' => $TABLE_PREFIX."_logger",
//                    'levels' => 'info, error'
//                    // nota:categories removed from me
//                    //'categories' => 'cclinica',
//                ),
                // Fix Now 21, 2014 for write  Yii::log
            ),
        ),

        // Your DB connection
        'db'=>array(
            'connectionString' => "mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE",
            'emulatePrepare' => true,
            'username' => $MYSQL_USERNAME,
            'password' => $MYSQL_PASSWORD,
            'tablePrefix'=>$TABLE_PREFIX,
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        ),

        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType'=>'php', /// case sensitive!
            'transportOptions'=>array(
                'host'=>'localhost',
                'username'=>'',
                'password'=>'',
                'port'=>'25',
                'encryption'=>'none',
                'timeout'=>'120',
            ),
            'viewPath' => 'application.mail',
            'logging' => true,
            'dryRun' => false
        ),       

        'setting'=>array(
            'class' =>  'application.extensions.MyConfig.MyConfig',
            'cacheId'=>null,
            'useCache'=>false,
            'cacheTime'=>0,
            'tableName'=>$TABLE_PREFIX . '_settings',
            'createTable'=>false,
            'loadDbItems'=>true,
            'serializeValues'=>true,
            'configFile'=>'',
        ),
        
        // Sep 21, 2015 - add to cron from Dec 02, 2015 begin notify app ios+android https://github.com/bryglen/yii-apns-gcm -- 
        'apns' => array(
            'class' => 'ext.yii-apns-gcm-master.YiiApns',
//            'environment' => 'production',
             'environment' => 'sandbox',
//            'pemFile' => Yii::getPathOfAlias('application.vendors').'/apnssert/apns-dev.pem', // wrong
//            'pemFile' => Yii::getPathOfAlias('application.vendors').'/apnssert/ck.pem', // wrong
//            'pemFile' => dirname(__FILE__).'/apnssert/ck.pem',// ok for test ios bb
            'pemFile' => dirname(__FILE__).'/apnssert/apns-dev.pem',
            'dryRun' => false, // setting true will just do nothing when sending push notification
            // 'retryTimes' => 3,
            'options' => array(
                'sendRetryTimes' => 5
            ),
        ),
        'gcm' => array(
            'class' => 'ext.yii-apns-gcm-master.YiiGcm',
            'apiKey' => $GcmApiKey // daukhimiennam.com
//            'apiKey' => $GcmApiKey // android.huongminhgroup.com
        ),
        // using both gcm and apns, make sure you have 'gcm' and 'apns' in your component
        'apnsGcm' => array(
            'class' => 'ext.yii-apns-gcm-master.YiiApnsGcm',
            // custom name for the component, by default we will use 'gcm' and 'apns'
            //'gcm' => 'gcm',
            //'apns' => 'apns',
        ),
        // Sep 21, 2015 - begin notify app ios+android
        
    ),
);