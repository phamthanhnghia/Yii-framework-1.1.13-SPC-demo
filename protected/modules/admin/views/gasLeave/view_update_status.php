<?php 
    $canUpdate = true;
    $aStatus = GasLeave::$STATUS_UPDATE_BY_DIRECTOR;
    $userRole = Yii::app()->user->role_id;
    $cUid = Yii::app()->user->id;
//    $userId = Yii::app()->user->id;
    if(in_array($userRole, GasLeave::$ROLE_APPROVE_LEVEL_1) || $cUid==GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI){
        $aStatus = GasLeave::$STATUS_UPDATE_BY_MANAGE;
        if( $cUid == $model->uid_login ){// không cho user tự approve đơn của mình
            $canUpdate = false;
        }
    }
    
    if(!empty($model->approved_director_id) && $userRole!=ROLE_ADMIN){
        $canUpdate = false;
    }
    $model->scenario = 'update_status';
?>

<?php if(GasCheck::isAllowAccess("gasLeave", "update_status") && $canUpdate):?>
    
<div class="form container">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'gas-orders-form',	
	'action'=> Yii::app()->createAbsoluteUrl('admin/gasLeave/update_status', array('id'=>$model->id)),
	'enableClientValidation'=>true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
    )); 
?>
    <?php  if(Yii::app()->user->hasFlash('successUpdate')): ?>
        <div class='success_div'><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
    <?php endif; ?>  
    <div class="row">
        <?php echo $form->labelEx($model,'status'); ?>
        <?php echo $form->dropDownList($model,'status', $aStatus,array('style'=>'width:376px;','empty'=>'Select')); ?>
        <?php echo $form->error($model,'status'); ?>
    </div>
    
    <?php if(in_array($userRole, GasLeave::$ROLE_APPROVE_LEVEL_1) || $cUid==GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI):?>
    <div class="row">
        <?php echo $form->labelEx($model,'manage_note'); ?>
        <?php echo $form->textArea($model,'manage_note',array('rows'=>2,'cols'=>50,"placeholder"=>"")); ?>
        <?php echo $form->error($model,'manage_note'); ?>
    </div>
    <?php endif;?>
    
    <?php if(in_array($userRole, GasLeave::$ROLE_APPROVE_LEVEL_2) || $userRole==ROLE_ADMIN):?>
    <div class="row">
        <?php echo $form->labelEx($model,'director_note'); ?>
        <?php echo $form->textArea($model,'director_note',array('rows'=>2,'cols'=>50,"placeholder"=>"")); ?>
        <?php echo $form->error($model,'director_note'); ?>
    </div>
    <?php endif;?>
    
    <div class="row buttons" style="padding-left: 141px;">
            <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? 'Create' :'Save',
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	
        <input class='cancel_iframe' type='button' value='Cancel'>
    </div>

<?php $this->endWidget(); ?>
</div>
<?php endif;?>