<?php
include_once 'config.local.php';

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.

Yii::setPathOfAlias('bootstrap', dirname(__FILE__).'/../extensions/bootstrap');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=> $THEME_NAME,
//        'defaultController' => 'admin/site/index',
        'defaultController' => 'site/index',
        'theme'=> $THEME,
        'language' => 'vi',
		
	// preloading 'log' component
	'preload'=>array('log', 'ELangHandler'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
                'application.components.widgets.*',
                'application.components.views.*',
                'application.extensions.yii-mail.*',
		'application.extensions.EUploadedImage.*',
                'application.extensions.EPhpThumb.*',
                'application.extensions.MyDebug.*',
		'application.extensions.editMe.*',
                'application.extensions.ControllerActionsName.*',
                'application.extensions.toSlug.*',
                'application.modules.api.models.*',// Oct 09, 2015
                'application.modules.api.components.*',
                'application.extensions.yii-apns-gcm-master.*',// Oct 31, 2015
            ),
	'modules'=>array(
        // Sep 27, 2015 Open gii nếu tạo thêm model
		'gii'=>array( // CLOSE WHEN LIVE SITE
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
		 	// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
                        'generatorPaths'=>array(
                            'application.gii',   // a path alias
                            'bootstrap.gii',
                        ),
		),
        
        'admin',
        'member',
        'api'// Oct 09, 2015
//        'auditTrail'=>array(
//			'userClass' => 'Users', // the class name for the user object
//			'userIdColumn' => 'id', // the column name of the primary key for the user
//			'userNameColumn' => 'username', // the column name of the primary key for the user
//		),
	),

	// application components
	'components'=>array(
            'geoip' => array(
                    // http://www.yiiframework.com/extension/geoip/
                    // !important => please read readme
                          'class' => 'application.extensions.geoip.CGeoIP',
                          // specify filename location for the corresponding database
                          'filename' => ROOT.'/upload/GeoLiteCity.dat',
                          // Choose MEMORY_CACHE or STANDARD mode
                          'mode' => 'STANDARD',
                      ),
            'session' => array(
                'class' => 'CDbHttpSession',
                'timeout' => 43200, // 12 hours, 46800 - 13 hours, 50400 - 14 hours, 54000 - 15 hours, 57600 - 16 hours, 
                'cookieParams' => array(
                    // http://www.yiiframework.com/forum/index.php/topic/12849-chttpcookie-httponly/
    //                'httpOnly' => true,// not run http://www.yiiframework.com/forum/index.php/topic/12849-chttpcookie-httponly/
                    'httponly' => true,// The Yii code which sets the cookie uses extract($value) to convert the array into variables, and it's looking for $httponly
                ),
            ),

            'user'=>array(
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'class' => 'WebUser',
                            'loginUrl'=>array('/admin/site/login'),
            ),

        'urlManager'=>array(
            'urlFormat'=>'path',
//            'rules'=>array(
//                '<action:(error|unsubscribe)>'=>'admin/site/<action>',
//                '<action:(login|logout|error|changePassword)>'=>'admin/site/<action>',
//                // for hide admin in url
//                '<controller:\w+>/<id:\d+>'=>'admin/<controller>/view',
//                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'admin/<controller>/<action>',
//                '<controller:\w+>/<action:\w+>'=>'admin/<controller>/<action>',
//                '<controller:\w+>'=>'admin/<controller>/index',
//                // for hide admin in url
//                '<url:(admin|member)>'=>'<url>/site/',
//            ),            
            
            'rules'=>array(
                // seo product
//                'category-product/<category_slug:[a-zA-Z0-9-]+>'=> array('product/index'),

                //seo product
//                'category-product-type/<category_type:[a-zA-Z0-9-]+>'=> array('product/index'),
//                'product-detail/<slug:[a-zA-Z0-9-]+>'=> array('product/detail'),
                'sitemap'=> array('site/sitemap'),
                'news-detail/<lang:[a-zA-Z0-9-]+>/<slug:[a-zA-Z0-9-]+>'=> array('news/detail'),
                
                // video + audio
//                'video/<slug:[a-zA-Z0-9-]+>'=> array('videos/index'),
//                'radio/<slug:[a-zA-Z0-9-]+>'=> array('videos/radio'),
                
//                'video-detail/<slug:[a-zA-Z0-9-]+>'=> array('videos/detail'),
//                'radio-detail/<slug:[a-zA-Z0-9-]+>'=> array('videos/detailRadio'),
//                'news-blog/<slug:[a-zA-Z0-9-]+>'=> array('news/index'),
//                'product-type/<slug:[a-zA-Z0-9-]+>'=> array('product/type'),
                'page/<slug:[a-zA-Z0-9-]+>'=> array('site/pages'),

                //seo product
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

        'db'=>array(
            'connectionString' => "mysql:host=$MYSQL_HOSTNAME;dbname=$MYSQL_DATABASE",
            'emulatePrepare' => true,
            'username' => $MYSQL_USERNAME,
            'password' => $MYSQL_PASSWORD,
            'tablePrefix'=> $TABLE_PREFIX,
            'charset' => 'utf8',
            'enableProfiling'=>true,
            'enableParamLogging'=>true,
        ),

        'authManager'=>array(
            'class'=>'CDbAuthManager',
            'connectionID'=>'db',
        ),

        'errorHandler'=>array(
        // use 'site/error' action to display errors
        'errorAction'=>'site/error',
        ),
        'log'=>array(
            'class'=>'CLogRouter',
            'routes'=>array(
                array(
                    'class'=>'CFileLogRoute',
                    //'levels'=>'error, warning',
                ),
                array(
                    'class' => 'DbLogRoute',
                    'connectionID' => 'db',
                    'autoCreateLogTable' => false,
                    'logTableName' => $TABLE_PREFIX."_logger",
                    'levels' => 'info, error'
                    // nota:categories removed from me
                    //'categories' => 'cclinica',
                ),
				// uncomment the following to show log messages on web pages
//				array(
//					'class'=>'CWebLogRoute',
//				),
                array(
                    'class'=>'ext.yii-debug-toolbar.YiiDebugToolbarRoute',
                    'ipFilters'=>array(isset($_COOKIE['debug']) ? '127.0.0.1':'0.0.0.0'),
                ),
            ),
        ),

        'mail' => array(
            'class' => 'application.extensions.yii-mail.YiiMail',
            'transportType'=>'smtp', /// case sensitive!
            'transportOptions'=>array(
                'host'=>'smtp.gmail.com',
                'username'=>'dungverz@gmail.com',
                'password'=>'dung!@#123',
                'port'=>'465',
                'encryption'=>'ssl',
                'timeout'=>'120',
            ),
            'viewPath' => 'application.mail',
            'logging' => true,
//            'logging' => false,
            'dryRun' => false
        ),

        'setting'=>array(
            'class' =>  'application.extensions.MyConfig.MyConfig',
            'cacheId'=>null,
            'useCache'=>false,
            'cacheTime'=>0,
            'tableName'=> $TABLE_PREFIX . '_settings',
            'createTable'=>false,
            'loadDbItems'=>true,
            'serializeValues'=>true,
            'configFile'=>'',
        ),

        'format'=>array(
            'class'=>'CmsFormatter',
        ),
            
        // Sep 21, 2015 - begin notify app ios+android https://github.com/bryglen/yii-apns-gcm -- 
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

//        'ELangHandler' => array (
//            'class' => 'application.extensions.langhandler.ELangHandler',
//            'languages' => array('en','cn'),
//            'strict' => true,
//        ),
            
        'bootstrap'=>array(
            'class'=>'bootstrap.components.Bootstrap',
        ),            
            
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
            'niceditor'=>array(),
    //		'niceditor'=>array('bold','italic','underline','ol','ul'),
    //        'niceditor_v_1'=>array('bold','italic','underline','ol','ul','fontSize','left','center','right','justify','forecolor','bgcolor','image','upload','link','unlink'),
            'niceditor_v_1'=>array('xhtml','bold','italic','underline','indent','outdent','ol','ul','fontSize','left','center','right','justify','forecolor','bgcolor','image','upload'),
            'niceditor_v_2'=>array(),

            'adminEmail'=>'webmaster@example.com',
            'autoEmail'=>'auto_mailer@starlets22.com',
            'dateFormat'=>'d/m/Y',
            'timeFormat'=>'H:i',
            'paypalURL'=>'https://www.paypal.com/cgi-bin/webscr',
            'paypalURL_sandbox'=>'https://www.sandbox.paypal.com/cgi-bin/webscr',
            'paypal_email_address'=>'kvan_1325843303_biz@verzdesign.com',
            'is_paypal_sandbox'=>1,
            'image_watermark'=>'bg_13394962316443.gif',
            'defaultPageSize'=>20,

            'twitter'=>'',
            'facebook'=>'',
            'linkedin'=>'',
            'rss'=>'',

            'meta_description'=>'',
            'meta_keywords'=>'',
//            'reCaptcha'=>array(
//               'publicKey'=>'6Lfmj9ASAAAAAM2b4ePzdByLBIrX6bSU32ZnLgIR',
//               'privateKey'=>'6Lfmj9ASAAAAAAiZVwboS55FW1sKY1QWm-lGEEAV',
//            ),
	),
);