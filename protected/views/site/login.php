<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/admin/css/form.css" />
<section>
        <h1 class="title"><strong>LOGIN</strong></h1>
    <div class="content">
        <div class="form">
            <div id="wrap-login"> 
                
                <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                    'enableClientValidation'=>true,
                    'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                    ),
            )); ?>
                    <div class="row">
                        <?php echo $form->labelEx($model,'email'); ?>
                            <?php echo $form->textField($model,'email', array('class'=>'text','size'=>40)); ?>
                        <?php echo $form->error($model,'email'); ?>
                    </div>
                    <div class="row">
                        <?php echo $form->labelEx($model,'password'); ?>
                            <?php echo $form->passwordField($model,'password', array('class'=>'text','size'=>40)); ?>
                        <?php echo $form->error($model,'password'); ?>
                    </div>
                    <div class="row_align rememberMe">
                        <?php echo $form->checkBox($model,'rememberMe'); ?>
                        <?php echo $form->label($model,'rememberMe'); ?>
                        <?php echo $form->error($model,'rememberMe'); ?>
                    </div>
                    <?php if($model->scenario == 'captchaRequired'): ?>
                    <div class="row">
                            <?php echo CHtml::activeLabelEx($model,'verifyCode'); ?>
                            <div>
                            <?php $this->widget('CCaptcha'); ?>
                            <?php echo CHtml::activeTextField($model,'verifyCode'); ?>
                            </div>
                            <div class="hint">Please enter the letters as they are shown in the image above.
                            <br/>Letters are not case-sensitive.</div>
                    </div>
                    <?php endif; ?>
                
                    <div class="button">
                        <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/forgot_password') ?>">Forgot Password ?</a>&nbsp;&nbsp;
                        <input type="submit" value="Login" />
                    </div>
                    <div class="row" style="margin-top: 15px;">
                        <label style="width: auto;">Not a member? <a href="<?php echo Yii::app()->createAbsoluteUrl('/site/register'); ?>">Join Now</a></label>
                    </div>    
                    <div class="clear"></div>
                <?php $this->endWidget(); ?>
            </div>

            <style>
                #wrap-login{
                    width: 400px;
                }    
            </style>
        </div>
    </div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $('#login-form .row span').remove();
    });
</script>


