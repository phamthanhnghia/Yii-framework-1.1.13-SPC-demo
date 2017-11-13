<?php
$this->breadcrumbs=array(
	$this->pluralTitle=>array('index'),
	'Import Excel',
);

$menus = array(		
        array('label'=>"$this->singleTitle Management", 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Import Excel <?php echo $this->singleTitle; ?></h1>

<?php if(isset($data['errors'])): ?>
    <div class="flash notice_error">
    <ul>
        <?php foreach ($data['errors'] as $error): ?>
            <li><?php echo $error; ?></li>
        <?php endforeach; ?>
    </ul>
    </div>
<?php endif; ?>

<?php echo MyFormat::BindNotifyMsg(); ?>
<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'spa-services-block-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="note">Dòng có dấu <span class="required">*</span> là bắt buộc.</p>
    <?php echo MyFormat::BindNotifyMsg(); ?>
    
    <div class="row">
        <?php echo $form->labelEx($model,'file_name'); ?>
        <?php echo $form->fileField($model,'file_name', array('class'=>'w-600')); ?>
        <?php echo $form->error($model,'file_name'); ?>
    </div>

    <div class="row buttons" style="padding-left: 141px;">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? 'Create' :'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->
<script>
    $(document).ready(function(){
        $('.form').find('button:submit').click(function(){
            $.blockUI({ overlayCSS: { backgroundColor: '#fff' } }); 
        });

    });
   
</script>