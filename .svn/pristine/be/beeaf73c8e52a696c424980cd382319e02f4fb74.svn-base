<?php
$this->breadcrumbs = array(
    'System Configurations',
);
?>

<h1>System configurations</h1>

<?php if (Yii::app()->user->hasFlash('setting')): ?>

<div class="flash-success">
    <?php echo Yii::app()->user->getFlash('setting'); ?>
</div>

<?php endif; ?>

<div class="form fieldset_label">

<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'setting-form-admin-form',
    'enableAjaxValidation' => false,
    'method'=>'post',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <?php echo $form->errorSummary($model); ?>

<?php Yii::app()->clientScript->registerCoreScript('jquery.ui'); ?>
<?php
$gridCss = Yii::app()->getAssetManager()->publish(Yii::getPathOfAlias('zii.widgets.assets')).'/gridview/styles.css';
Yii::app()->getClientScript()->registerCssFile($gridCss);
?>
    
<script>
$(function() {
    $( "#tabs" ).tabs({ active: 2 });
});
</script>
<div id="tabs">
    <ul>
        <li><a href="#tabs-1">Cài đặt chung</a></li>
        <li><a href="#tabs-2">Cài đặt hệ thống</a></li>
        <li><a href="#tabs-3">System Care</a></li>
        <li><a href="#tabs-4">Mail</a></li>
    </ul>
    
    <?php  include 'system_care.php';?>
    <?php  include 'system_mail.php';?>
    
    <div id="tabs-1">
        <div class="column" style="width: 45%">
            <fieldset>
                <legend>Thiết Đặt Hệ Thống</legend>
                    <div class="row">
                        <?php echo $form->labelEx($model, 'time_disable_login', array('label'=>'Giờ cấm truy cập')); ?>
                        <?php echo $form->textField($model, 'time_disable_login', array('size'=>35, 'placeholder'=>'vd: 18:35')); ?>
                        <?php echo $form->error($model, 'time_disable_login'); ?>
                    </div>            
            </fieldset>

            <fieldset>
                <legend>General Settings</legend>

                <div class="row">
                    <?php echo $form->labelEx($model, 'title'); ?>
                    <?php echo $form->textField($model, 'title', array('style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'title'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'adminEmail'); ?>
                    <?php echo $form->textField($model, 'adminEmail', array('style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'adminEmail'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'autoEmail'); ?>
                    <?php echo $form->textField($model, 'autoEmail', array('style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'autoEmail'); ?>
                </div>

                <div class="row ">
                    <?php echo $form->labelEx($model, 'meta_description'); ?>
                    <?php echo $form->textArea($model, 'meta_description', array('rows'=>5,'cols'=>35,'style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'meta_description'); ?>
                </div>

                <div class="row ">
                    <?php echo $form->labelEx($model, 'meta_keywords'); ?>
                    <?php echo $form->textArea($model, 'meta_keywords', array('rows'=>5,'cols'=>35,'style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'meta_keywords'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'login_limit_times'); ?>
                    <?php echo $form->textField($model, 'login_limit_times', array('style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'login_limit_times'); ?>
                </div>

                <div class="row">
                    <label for="SettingForm_time_refresh_login">Time Refresh Login(minutes)</label>
                    <?php echo $form->textField($model, 'time_refresh_login', array('style'=>'width:350px;')); ?>
                    <?php echo $form->error($model, 'time_refresh_login'); ?>
                </div>

                <div class="row">
                    <?php echo $form->labelEx($model, 'server_name',array('label'=>'Server Name For Cron Job')); ?>
                    <?php echo $form->textField($model, 'server_name', array('size'=>45)); ?>
                    <?php echo $form->error($model, 'server_name'); ?>
                </div> 
            </fieldset>
        </div>    
        
        <div class='clr'></div>
    </div><!-- end <div id="tabs-1">-->
    <div id="tabs-2">
        
        <div class="buttons clear">
            <button type="submit">Submit</button>
        </div>

        <div class="column" style="width: 45%; ">
            <fieldset>
                <legend>Hệ thống bảo trì</legend>
                <div class="row">
                    <?php echo $form->labelEx($model, 'server_maintenance', array('label'=>'Bảo Trì Server')); ?>
                    <?php echo $form->dropDownList($model, 'server_maintenance', array('yes'=>'Yes','no'=>'No')); ?>
                </div>
                
                <div class="row">
                    <?php echo $form->labelEx($model, 'server_maintenance_message',array('label'=>'Thông Báo Bảo Trì Server')); ?>
                    <?php echo $form->textArea($model, 'server_maintenance_message', array('rows'=>5,'cols'=>35,'style'=>'width:350px;')); ?>
                </div>
                
                <div class="row">
                    <?php echo $form->labelEx($model, 'allow_session_menu', array('label'=>'Allow Session Menu Cache menu vào session')); ?>
                    <?php echo $form->dropDownList($model, 'allow_session_menu', CmsFormatter::$yesNoCharFormat); ?>
                </div>                 
            </fieldset>
        </div>        
        
        <div class='clr'></div>
    </div><!-- end <div id="tabs-2">-->
</div> <!-- end <div id="tabs">-->
    
    <div class='clr'></div>
    <div class="buttons clear">
        <button type="submit">Submit</button>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->