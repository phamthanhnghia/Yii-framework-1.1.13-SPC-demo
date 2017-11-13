<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title><?php echo CHtml::encode($this->pageTitle); ?> - <?php echo Yii::app()->params['title']; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" /> 
    <meta content="telephone=no" name="format-detection" />     
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png" />
    
    
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/font-awesome.min.css" />
    <meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/plugins.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/style.css" />
    <?php Yii::app()->clientScript->registerCoreScript('jquery'); //jQuery JavaScript Library 1.11.0 ?>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>-->
</head>

<body>
    <?php include "header.php"; ?>
    <?php echo $content; ?>
    <?php include "footer.php"; ?>
</body>

</html>

<script type="text/javascript">
        $(document).ready(function() {

        });
</script>