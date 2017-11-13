<?php
$this->breadcrumbs=array(
	'Đại Lý',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Đại Lý'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#users-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('users-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('users-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Đại Lý'); ?></h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->search(),
        'template'=>'{pager}{summary}{items}{pager}{summary}',     
	'afterAjaxUpdate'=>'function(id, data){fnUpdateColorbox();}',
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            array(
                'header' => 'Mã Đại Lý',
                'name' => 'code_account',
                'htmlOptions' => array('style' => 'width:50px;')
            ), 	
            array(
                'header' => 'Username',
                'name' => 'username',      
                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
            ), 	            
//            array(
//                'header' => 'Mật Khẩu',
//                'value'=>'$data->temp_password',
//                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
//            ),  
            array(
                'name'=>'id',
                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,                
            ),
            array(
                'header'=>'HS Pháp Lý',
                'value'=>'$data',
                'type'=>'AgentProfileCheck',
                'htmlOptions' => array('class' => 'item_c'),
                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
            ),
            array(
                'header' => 'Tên Đại Lý',
                'name'=>'first_name',
            ),
            array(
                'header' => 'Loại',
                'name' => 'gender',
                'value'=>'isset(Users::$aTypeAgent[$data->gender])?Users::$aTypeAgent[$data->gender]:""',
            ),
            array(
                'header' => 'Ngày Cập Nhật Sổ Quỹ',
                'name'=>'payment_day',
                'htmlOptions' => array('style' => 'text-align:center;width:80px;'),
                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,                
            ),
            
            'address',		 
		 
        array(
                'name'=>'province_id',
                'value'=>'$data->province?$data->province->name:""',
            ),		

            array(
                'name'=>'district_id',
                'value'=>'$data->district?$data->district->name:""',
            ), 
             
//            array(
//                'name'=>'beginning',
//                'type'=>'Currency',
//                'htmlOptions' => array('style' => 'text-align:right;'),
//                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
//            ), 
//            array(
//                'header' => 'Login Mới Nhất',
//                'name'=>'last_logged_in',
//                'type'=>'datetime',
//            ),			
            
            array(
            'header' => 'Action',
            'class'=>'CButtonColumn',
//            'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view')),
                'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('view', 'update')),
            ),
	),
)); ?>

<script>
$(document).ready(function() {
    fnUpdateColorbox();
});

function fnUpdateColorbox(){
    fixTargetBlank();
//    $('.button-column').find('.view').attr('target','_blank');
}
</script>