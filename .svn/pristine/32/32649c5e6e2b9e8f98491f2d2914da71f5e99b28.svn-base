<?php
$this->breadcrumbs=array(
	'Quản Lý Member Login',
);

$menus=array(
	array('label'=> Yii::t('translation','Create Member'), 'url'=>array('create')),
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

<h1>Quản Lý Member Login</h1>
<?php if(Yii::app()->user->hasFlash('successUpdate')): ?>
    <div class="flash notice"><?php echo Yii::app()->user->getFlash('successUpdate');?></div>         
<?php endif; ?>
<?php echo CHtml::link(Yii::t('translation','Tìm Kiếm Nâng Cao'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php 
//$this->renderPartial('_search',array(
//	'model'=>$model,
//)); 
?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$model->searchGasMember(),
        'template'=>'{pager}{summary}{items}{pager}{summary}', 
    'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox();}',
        'pager' => array(
            'maxButtonCount'=>  CmsFormatter::$PAGE_MAX_BUTTON,
        ),    
    
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
        array(
            'headerHtmlOptions' => array('style' => 'width:20px;'),
            'header' => 'Reset',
            'class'=>'CButtonColumn',
            'template'=> ControllerActionsName::createIndexButtonRoles($actions, array('mail_reset_password')),
            'buttons'=>array(
                'mail_reset_password'=>array(
                    'label'=>'Reset password của user này',
                    'imageUrl'=>Yii::app()->theme->baseUrl . '/admin/images/mail.png',
                    'options'=>array('class'=>'mail_reset_password'),
                    'url'=>'Yii::app()->createAbsoluteUrl("admin/gasmember/mail_reset_password",
                        array("id"=>$data->id, ) )',                     
                    'click'=>'function(){ if(confirm("Bạn chắc chắn muốn reset mật khẩu của user này?")) { $.blockUI({ message: null }); return true; } return false;}',
                ),
            ),                          
        ),                      
//            array(
//                'header' => 'Mã Hệ Thống',
//                'name' => 'code_account',       
//                'htmlOptions' => array('style' => 'width:50px;')
//            ), 
            array(
                'header' => 'email+username',
                'type' => 'html',
                'value' => '$data->getInfoLoginMember()',
            ), 
//            'email',
            
//            array(
//                'header' => 'Phân Quyền',
//                'class'=>'CButtonColumn',
//                'template'=> '{user}',
//                'htmlOptions' => array('style' => 'width:50px;text-align:center;'),
//                'buttons' => array( 
//                    'user' => array(
//                        'label' => 'Phân Quyền Setting Privilege',
//                        'imageUrl' => Yii::app()->theme->baseUrl . '/admin/images/folder.png',
//                        'options' => array('class' => 'show-book-chapters','target'=>'_blank'),
//                        'url' => 'Yii::app()->createAbsoluteUrl("admin/rolesAuth/user",array("id"=>$data->id))',
//                        'visible'=>'GasCheck::isAllowAccess("rolesAuth", "user")',
//                    )
//                ),
//            ), 
            
//            array(
//                'header' => 'Username',
//                'name' => 'username',               
//            ), 			
//
//            array(
//                'header' => 'Mật Khẩu',
//                'value'=>'$data->temp_password',
//            ),
            array(
                'header' => 'Chức Vụ',
                'name' => 'role_id',
                'type'=>'RoleNameUser',                
                'value'=>'$data->role_id',   
//                'htmlOptions' => array('style' => 'width:100px;')
            ), 				
            array(
                'header' => 'Tên Member',
                'name'=>'first_name',
            ),


            array(
                'header' => 'Mã Member',
                'name' => 'code_bussiness',               
                'htmlOptions' => array('style' => 'width:50px;')
            ), 	
		
            'address',
            array(
                'header' => 'Tạo Bởi',
                'value'=>'$data->rCreatedBy?$data->rCreatedBy->first_name:""',   
            ),	
            array(
                'header' => 'Login Mới Nhất',
                'name'=>'last_logged_in',
                'type'=>'datetime',
            ),	
            array(
                'name'=>'status',
                'type'=>'status',
                'value'=>'array("status"=>$data->status,"id"=>$data->id)',
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            array(
                'header' => 'Ngày Tạo',
                'name' => 'created_date',
                'type' => 'Datetime',
                'htmlOptions' => array('style' => 'width:50px;')
            ),             
//            array(
//                'name'=>'district_id',
//                'value'=>'$data->district?$data->district->name:""',
//            ),   
            
		/*
		 Yii::t('translation','name_agent'),
		 Yii::t('translation','code_account'),
		 Yii::t('translation','code_bussiness'),
		 Yii::t('translation','address'),
		 Yii::t('translation','province_id'),
		 Yii::t('translation','channel_id'),
		 Yii::t('translation','district_id'),
		 Yii::t('translation','storehouse_id'),
		 Yii::t('translation','sale_id'),
		 Yii::t('translation','payment_day'),
		 Yii::t('translation','beginning'),
		 Yii::t('translation','first_char'),
		 Yii::t('translation','login_attemp'),
		 Yii::t('translation','created_date'),
		 Yii::t('translation','last_logged_in'),
		 Yii::t('translation','ip_address'),
		 Yii::t('translation','role_id'),
		 Yii::t('translation','application_id'),
		 Yii::t('translation','status'),
		 Yii::t('translation','gender'),
		 Yii::t('translation','phone'),
		 Yii::t('translation','verify_code'),
		 Yii::t('translation','area_code_id'),
		*/
		array(
                    'header' => 'Action',
                    'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions),
		),
	),
)); ?>
<script>
$(document).ready(function() {
    fnUpdateColorbox();
});

function fnUpdateColorbox(){   
    fixTargetBlank();
    
    $('.mail_reset_password').attr('target','');
}
</script>