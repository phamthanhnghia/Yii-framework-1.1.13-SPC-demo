<?php
$this->breadcrumbs=array(
	'Member'=>array('index'),
	$model->code_account." - ".$model->first_name,
);

$menus = array(
	array('label'=>'Member', 'url'=>array('index')),
	array('label'=>'Create Member', 'url'=>array('create')),
	array('label'=>'Update Member', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Member', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
$mUsersRef = $model->mUsersRef;
?>

<h1>View Member: <?php echo $model->code_account . ' - '. $model->first_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
	
        array(
            'label' => 'Mã Hệ Thống',
            'name' => 'code_account',                       
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),		
        array(
            'label' => 'Mã Member',
            'name' => 'code_bussiness',                       
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),
        'email',
        array(
            'label' => 'Chức Vụ',
            'type'=>'RoleNameUser',
            'value' => $model->role_id,
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),
        'username',
        array(
            'label' => 'Mật Khẩu',
            'name' => 'temp_password',
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),            
        array(
            'label' => 'Tên Member',
            'name' => 'first_name',
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),

        array(
            'name' => 'phone',
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),
	
        'address',
        array(
            'name'=>'province_id',
            'value'=>$model->rProvince?$model->rProvince->name:'',
        ),		
        array(
            'name'=>'district_id',
            'value'=>$model->rDistrict?$model->rDistrict->name:'',
        ),
        array(
            'label'=>'Ghi chú',
            'type'=>'html',
            'value'=>$mUsersRef?$mUsersRef->getNote():'',
        ),

        'created_date:datetime',
        'last_logged_in:datetime',
            //'phone',
    ),
)); ?>

File ảnh hiện tại 
<a class="gallery" href="<?php echo ImageProcessing::bindImageByModel($model->mUsersRef,'','',array('size'=>'size2'));?>">
    <img src="<?php echo ImageProcessing::bindImageByModel($model->mUsersRef,'','',array('size'=>'size1'));?>">
</a>

<script>
$(document).ready(function() {
    jQuery('a.gallery').colorbox({ opacity:0.5 , rel:'group1' });
});
</script>