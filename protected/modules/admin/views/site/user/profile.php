<?php
$this->breadcrumbs=array(
	'Cập nhật thông tin cá nhân',
);
?>

<h1>Cập nhật thông tin cá nhân</h1>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'users-model-form',
	'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo MyFormat::BindNotifyMsg(); ?>
    <?php echo $form->errorSummary($model); ?>
    <?php echo $form->errorSummary($model->mUsersRef); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'first_name',array('label'=>'Họ Tên')); ?>
		<?php echo $model->first_name; ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model,'first_name',array('label'=>'Chức Vụ')); ?>
		<?php $session=Yii::app()->session; echo $session['ROLE_NAME_USER'][$model->role_id]; ?>
	</div>
    <div class="row">
        <?php echo $form->labelEx($model->mUsersRef,'image_sign',array()); ?>
		<?php echo $form->fileField($model->mUsersRef,'image_sign', array('accept'=>'image/*')); ?>
        <?php if(!empty($model->mUsersRef->image_sign)): ?>
        File hiện tại 
        <a class="gallery" href="<?php echo ImageProcessing::bindImageByModel($model->mUsersRef,'','',array('size'=>'size2'));?>">
            <img src="<?php echo ImageProcessing::bindImageByModel($model->mUsersRef,'','',array('size'=>'size1'));?>">
        </a>
        <?php endif;?>
	</div>

    <div class="row buttons" style="padding-left: 141px;padding-top: 15px;">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=> 'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
        });
        jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });
    });
</script>