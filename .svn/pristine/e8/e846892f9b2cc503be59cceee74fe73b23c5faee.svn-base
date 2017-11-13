<div class="form">
    <section>
    <h1 class="title"><strong>Forgotten Password</strong></h1>
        <div class="content" >
            <?php $form=$this->beginWidget('CActiveForm', array(
                    'id'=>'register-form',
            )); ?>
            <style>
                .group-patient ._l{
                    float: left;
                    width: 150px;
                    font-weight: bold;
                }
                .group-patient ._r{
                    float: left;
                    font-weight: bold;
                }
            </style>        
            

                <div class="group-patient" style="width:600px; float: left;padding-left: 250px;">
                    <div class="not-member" style="display: block;">
                    	<p class="note">Your new password will be sent to your registered email address.</p>
                        <!-- <p class="note">Your new password will send to email or contact the administrator if you forgot your email at <strong><?php echo CHtml::link('here',Yii::app()->createAbsoluteUrl('contactUs/'));?></strong>.</p> -->
                        
                       
                        <div class="row" style="width: 480px">
                            <?php echo $form->labelEx($model,'email',array('label'=>'Please enter your registered email address','style'=>'width:250px;')); ?>
                            <?php echo $form->textField($model,'email',array('size'=>35,'maxlength'=>30, 'onkeypress'=>'return event.keyCode!=13;')); ?>
                            <div class="ajaxValidateSuccess" style="display: none;"></div>                            
                            <div class="errorMessage" style="display:none;padding-left: 100px;">Email is required</div>
                        </div>
                        <div class="row buttons" style="width: 480px">
                            <span class="edit">
                                <input type="button" id="btn_submit" value="Submit"/>
                            </span>
                            <span class="edit"><input type="button" value="Cancel" onclick="location.href='<?php echo Yii::app()->createAbsoluteUrl('/') ?>'"></span>
                        </div>
                    </div>
                </div>
            <div class="clear"></div>         

            <?php $this->endWidget(); ?>
            </div>
    </section>
</div>
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.blockUI.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('#btn_submit').unbind("click").click(function(){
            var email = $('#Users_email').val();
            if(email.length==0){$('#Users_email').parent('div').find('.errorMessage').show(); return false; }
            // begin ajax	
            var url_ = "<?php echo Yii::app()->createAbsoluteUrl('site/forgot_password');?>";
       
                $.blockUI({ overlayCSS: { backgroundColor: '#61CB5F' } }); 
                $.ajax({
                        url: url_,
                        data: {email:email,ajax:'ajax'},
                        type: "post",
                        dataType: "json",
                        async: true,
                        success: function(data){
                                if(data['success']){
                                        $('.not-member').html('<p class="note">An email with your new password has been sent to '+email+'. <br />Please check your email. <br />If you do not receive an email, please check you Junk & Spam boxes.</p>');
                                    }else{
                                        alert(data['msg']);
                                        $('#Users_email').parent('div').find('.errorMessage').show().text(data['msg']);
                                }
                            $.unblockUI();
                        }
                });
            // end ajax            
        });
        
    });
</script>


<style>

div.form input[type=text],
div.form textarea,
div.form select
{
	margin: 0.2em 0 0.5em 0;
	border: #CDCDCD solid 1px;
	padding: 3px;
}

div.form fieldset
{
	border: 1px solid #DDD;
	padding: 10px;
	margin: 0 0 10px 0;
    -moz-border-radius:7px;
}

div.form .row label
{
	font-weight: bold;
	font-size: 0.9em;
	float:left;
	width: 110px;
}

div.form .row_align label
{
	font-weight: bold;
	font-size: 0.9em;
	display: block;
	float:none;
	display: inline-block;
}


div.form .row
{
	margin: 5px 0;
}

div.form .col
{
	with: 45%;
	float: left;
	margin-right: 4% !important
}

div.form .row_align
{
	padding: 0px 0px 0px 110px;
}


div.form .hint
{
	margin: 0;
	padding: 0;
	color: #999;
}

div.form .note
{
	font-style: italic;
}

div.form .center{text-align: center}

div.form span.required
{
	color: red;
}

div.form div.error label:first-child,
div.form label.error,
div.form span.error
{
	color: #C00;
}

div.form div.error input,
div.form div.error textarea,
div.form div.error select,
div.form input.error,
div.form textarea.error,
div.form select.error
{
	background: #FEE;
	border-color: #C00;
}

div.form div.success input,
div.form div.success textarea,
div.form div.success select,
div.form input.success,
div.form textarea.success,
div.form select.success
{
	background: #E6EFC2;
	border-color: #C6D880;
}


div.form .errorSummary
{
	border: 2px solid #C00;
	padding: 7px 7px 12px 7px;
	margin: 0 0 20px 0;
	background: #FEE;
	font-size: 0.9em;
}

div.form .errorMessage
{
	color: red;
	font-size: 0.9em;
}

div.form .errorSummary p
{
	margin: 0;
	padding: 5px;
}

div.form .errorSummary ul
{
	margin: 0;
	padding: 0 0 0 20px;
}

div.wide.form label
{
	float: left;
	margin-right: 10px;
	position: relative;
	text-align: right;
	width: 150px;
}

div.wide.form .row
{
	clear: left;
}


div.wide.form .buttons, div.wide.form .hint, div.wide.form .errorMessage
{
	clear: left;
	padding-left: 110px;
}

div.form .buttons
{

	padding-left: 110px;
}

.buttons .btn-submit input { margin-left:50px; background:url(../images/bg-btn.png) repeat-x; }
.form select {width:148px;}
.form .btn-active select {width:140px !important;}
.search-form select {width:192px;}
.form .cmb-active select {width:90px;}
.form .btn-submit input {margin-left: 48px;}

.form .image-watermark {
	width:250px;
	padding:5px;
	float:left;
}

div.form input[type= submit],
div.form input[type= button],
div.form input[type= reset],
div.form input[type= file]{
	min-width: 80px;
	min-height: 25px;
	padding: 0 5px 0 5px;
}

div.flash-success
{
    background: none repeat scroll 0 0 #E6EFC2;
    border-color: #C6D880;
    color: green;
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 20px;
    padding-left: 150px;}
   
</style>