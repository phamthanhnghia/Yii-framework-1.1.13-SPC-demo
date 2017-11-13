<?php $this->pageTitle=Yii::app()->name . '  Login';?>

<h1>Login</h1>
<?php if(isset($_GET['RE_LOGIN_USER'])):?>
    <div class="info" style="widows:600px;height:50px; color:#FF0000;font-weight:bold;text-align:center; font-size:24px;margin-top:30px;">
        <?php echo $_GET['RE_LOGIN_USER']; ?>
    </div>
<?php endif; ?>
<p>Please fill out the following form with your login credentials:</p>

<div class="form">
    <?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'admin-login-form',
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
        'validationDelay'=>100000, // trên ie8 (firefox+chrom ko sao) nó tự động trigger validate ajax, nên khi mới load 
    ),
)); ?>

    <p class="note">Fields with <span class="required">*</span> are required.</p>

    <div class="row">
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username', array('maxlength'=>35,'class'=>'gas_login')); ?>
        <?php echo $form->error($model,'username'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password', array('maxlength'=>35,'class'=>'gas_login')); ?>
        <?php echo $form->error($model,'password'); ?>
    </div>
    
    <?php /*
    <div class="row">
        <?php echo $form->labelEx($model,'verify_code'); ?>
        <div style="float: left;">
            <div style="">
                <div style="float: left;padding-bottom: 10px;" class="box_verify_code">
                    <?php $this->widget('CCaptcha'); ?>
                </div>
                <div class="clear"></div>
                <?php echo CHtml::activeTextField($model,'verify_code', array('class'=>'gas_login','placeholder'=>'Nhập dãy số xác thực hình trên')); ?>
            </div>            
            <?php echo $form->error($model,'verify_code'); ?>
        </div>
        <div class="clr"></div>
        <?php // echo $form->error($model,'verify_code'); ?>
    </div>
    <div class="clr"></div>
    */ ?>
    
    
    <div class="row_align rememberMe padding-fix">
        <?php echo $form->checkBox($model,'rememberMe'); ?>
        <?php echo $form->label($model,'rememberMe'); ?>
        <?php echo $form->error($model,'rememberMe'); ?>
    </div>

   <?php   /* 
   <div class="row_align padding-fix">
        <label>
            <a href="<?php echo Yii::app()->createAbsoluteUrl('admin/site/ForgotPassword');?>" target="_blank">Forgot Password ?</a>
        </label>
    </div>
          */ ?>

    <div class="row buttons padding-fix" style="padding-top: 10px;">
        <button type="submit">Login</button>
    </div>
    
    <?php $this->endWidget(); ?>
</div><!-- form -->
<style>
    .padding-fix {padding-left: 138px !important; }
    .form .gas_login {width: 200px;}
</style>

<script>
    $(function(){
        $('#AdminLoginForm_username').focus();
    });
</script>