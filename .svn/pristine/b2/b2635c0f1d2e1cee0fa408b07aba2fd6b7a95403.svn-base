<?php
defined('YII_DEBUG') or define('YII_DEBUG',true);
date_default_timezone_set('Asia/Ho_Chi_Minh');
// including Yii
define('ROOT', dirname(__FILE__));

//require_once('yii-framework-1.1.13/yii.php'); // live config
//$yii=dirname(__FILE__).'/../yii-framework-1.1.17/yii.php'; // local config
$yii=dirname(__FILE__).'/yii-framework-1.1.17/yii.php'; // demo site config
require_once($yii);

// we'll use a separate config file
$config=dirname(__FILE__).'/protected/config/cron.php';

// creating and running console application
Yii::createConsoleApplication($config);
SettingForm::applySettings();//override settings by values from database
Yii::app()->run();