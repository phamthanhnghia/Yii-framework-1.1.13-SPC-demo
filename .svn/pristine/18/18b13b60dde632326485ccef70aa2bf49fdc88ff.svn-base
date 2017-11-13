<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/main.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/screen.css" rel="stylesheet" type="text/css" media="screen" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/print.css" rel="stylesheet" type="text/css" media="print" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/form.css" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/jquery-ui-1.8.18.custom.css" type=text/css rel=stylesheet>
    <link rel="shortcut icon" type="image/ico" href="<?php echo Yii::app()->theme->baseUrl; ?>/favicon.ico" />
    <link rel="apple-touch-icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/images/favicon.png" />

    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.colorbox-min.js"></script>    
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/colorbox.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>  
    

    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/cssmenuvertical3/cssmenuvertical.css" rel="stylesheet" type="text/css" media="screen" />
    <style type="text/css">
        /* Theme 
        @import "<?php // echo Yii::app()->theme->baseUrl; ?>/admin/css/menu.css";
        */
    </style>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/style.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/huongminh.css" />
    <script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/spj.js"></script>  
    

    <?php // Yii::app()->clientScript->registerCoreScript('jquery');  //jquery-1.8.3.min.js available in yii 1.1.13 ?>
    <?php Yii::app()->clientScript->registerCoreScript('jquery');  //jquery-1.11.min.js available in yii 1.1.17 ?>
    <?php //Yii::app()->bootstrap->registerAllCss(); ?>
    <?php  //Yii::app()->bootstrap->register(); ?>    
</head>
    <meta name="robots" content="noindex" />
    <meta name="googlebot" content="noindex" />    
    
    <body>
    <div id="main">
        <div id="wrap">
            <div id="top-nav">
                <div id="top-nav-right">
                    <?php if(isset(Yii::app()->user->id)): ?>
                        <?php  $this->widget('zii.widgets.CMenu',array(
                                                        'items'=>array(
                                                                //array('label'=>'Change Password', 'url'=>array('/admin/site/changePassword'), 'visible'=>Yii::app()->user->isAdmin),
                                                                array(
                                                'label'=>Yii::t('admin', 'Logout') . ' ('.Yii::app()->user->name.')',
                                                'url'=>array('site/logout'),
                                                //'visible'=>Yii::app()->user->isAdmin,
                                                'linkOptions'=>array('confirm'=>'Are you sure want to logout?')
                                            ),
                                                                array(
                                                'label'=>Yii::t('admin_change_my_pass', 'Đổi Mật Khẩu'),
                                                'url'=>array('site/change_my_password'),
                                            ),
                                            array('label'=>"Hôm Nay: ".MyFormat::$TheDaysOfTheWeek[date('l')].' '.date('d-m-Y')),
                                                            
                                                               /*  array(
                                                'label'=>Yii::t('admin_update_my_profile', 'Profile'),
                                                'url'=>array('manageadmin/update_my_profile'),
                                            ), */

                                                        ),
                                                )); ?>
                        <?php include 'ticket_notify.php';?>                                                
                     <?php endif;?>
                </div>
                <div id="top-nav-left">
                    <ul>
                        <li>&nbsp;</li>
                    </ul>
                </div>
            </div>
            <div id="header">
                <div class="logo"><?php echo CHtml::link('', array('/'), array("title"=>"Home")) ?></div>
                <div class="header_left">
                    Administrator
                </div>
                <div class="clr"></div>
            </div>
            <div class="clr"></div>
            <!-- end header -->
            <div id="content">
                <div id="menu">
                    <?php
                        $menu = new ShowAdminMenu();
                        echo $menu->showMenu();
                    ?>

                     <?php
                     /*
                     /*if(Yii::app()->session['LOGGED_USER'] != null)
                     {
                        $this->widget('application.extensions.mbmenu.MbMenu',array(
                        'items' => Urls::model()->renderMenuItem()
                            );
                        }*/

                    ?>
                <div class="clr"></div>
                </div>

                <div id="tab-frame">
                    <?php if(isset($this->breadcrumbs)):?>
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                            'links'=>$this->breadcrumbs,
                            'homeLink'=>CHtml::link('Trang Chủ', array('/admin')),
                        )); ?><!-- breadcrumbs -->
                    <?php endif?>
                    <div class="clr"></div>                    
                    <?php echo $content; ?>
                    <div class="clr"></div>
                </div>
        </div>
        <!-- end content -->

    </div>
        
        <div id="footer">
              <div>Copyright &copy; <?php /*echo "2013 - ";*/ echo date('Y'); ?> by <a href="<?php echo Yii::app()->request->hostInfo;?>">Hướng Minh</a><br/>
					All Rights Reserved.<br/>
					<?php //echo Yii::powered(); ?>
              </div>
        </div>
        
        <div class="backtotop">
            <a href="#">TOP</a>
        </div>    
        
        <div style='display:none'>
              <div id='inline_content_warning' style='background:#fff;'>
                  <p><strong class="inline_content_warning"></strong></p>
              </div>
        </div>        
        
    </div>
    </body>
</html>

<?php if($mLatestNews = Cms::getNewsPopup()): ?>
<?php $session=Yii::app()->session;
    $show_popup_news = Yii::app()->setting->getItem('show_popup_news');
    if(!isset($session['HAS_READ_NEWS']) )
        $session['HAS_READ_NEWS'] = 0;
    
    if( $show_popup_news==1 && !isset($session['ARR_ID_NEWS'][$mLatestNews->id]) )
        $session['HAS_READ_NEWS'] = 0;
    $LINK_READ = Yii::app()->createAbsoluteUrl('admin/site/news',array('id'=>$mLatestNews->id, 'HAS_READ_NEWS'=>1));
?>

<div class="display_none">
    <div id="colorbox_alert" class="">
        <h1>Hệ Thống Có Thông Báo Mới</h1>
        <p>Bạn cần bấm vào link xem bên dưới thì popup này sẽ không hiện lên nữa.</p>
        <a style="font-size:15px;" class="gas_link" target="_blank" href="<?php echo $LINK_READ;?>">
            <?php echo $mLatestNews->title;?>
        </a>
    </div>
</div>
<?php endif;?>

<script type="text/javascript">
jQuery(document).ready(function(){            
    validateNumber();
    BindClickClose('<?php echo BLOCK_UI_COLOR;?>');// Dec 15, 2014
    
});
        
/* Nguyen Dung add for multiselect */
    $(window).load(function(){
//        $('.group_subscriber').find('.ui-multiselect').click(function(){
////            $('.group_subscriber .fix-label').find('.ui-multiselect-checkboxes').css({height:'350px'});   
//            var div = $(this).parent('div');    
//            if(div.find(".ui-multiselect-menu").css('display')=='block')
//                div.find('.ui-multiselect-menu').hide();
//            else{
//                div.find('.ui-multiselect-menu').show();
//            }    
//        });
        
        <?php // if(isset(Yii::app()->user->id) && $mLatestNews && !$session['HAS_READ_NEWS'] && Yii::app()->user->role_id==ROLE_SUB_USER_AGENT): ?>
        <?php if(isset(Yii::app()->user->id) && $mLatestNews && !$session['HAS_READ_NEWS'] ): ?>
        $.colorbox({inline:true, href:"#colorbox_alert",
            closeButton:false,
                overlayClose :false, escKey:false,
                innerHeight:'250', 
                innerWidth:'500', 
                                
         });
         <?php endif;?>
             
        $('.gas_link').click(function(){
            $.fn.colorbox.close();
        });
         
    }); // end  $(window).load(function()

    
/* Nguyen Dung add for multiselect */    
</script>



