<?php
$this->breadcrumbs=array(
	'Đại Lý'=>array('index'),
	$model->first_name,
);

$menus = array(
	array('label'=>'Đại Lý', 'url'=>array('index')),
	array('label'=>'Create Đại Lý', 'url'=>array('create')),
	array('label'=>'Update Đại Lý', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Đại Lý', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Đại Lý: <?php echo $model->first_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'label' => 'Mã Đại Lý',
            'name' => 'code_account',                       
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),	
        array(
            'label' => 'Tên Đại Lý',
            'name' => 'first_name',                       
            'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),			
        array(
            'label' => 'Loại',
            'value'=>isset(Users::$aTypeAgent[$model->gender])?Users::$aTypeAgent[$model->gender]:"",
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),			
        array(            
            'name' => 'username',                       
            'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
            //'htmlOptions' => array('style' => 'text-align:center;')
        ),			
//        array(
//            'label' => 'Mật Khẩu',
//            'name' => 'temp_password',                       
//            //'htmlOptions' => array('style' => 'text-align:center;')
//        ),    
            array(
                'label' => 'Ngày Cập Nhật Sổ Quỹ',
                'name'=>'payment_day',
                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
            ),            
            'address',
            array(
                'name'=>'province_id',
                'value'=>$model->province?$model->province->name:'',
            ),		
            array(
                'name'=>'district_id',
                'value'=>$model->district?$model->district->name:'',
            ),            
            array(
                'name'=>'ward_id',
                'value'=>$model->ward?$model->ward->name:'',
            ),  
            'house_numbers',
            array(
                'name'=>'street_id',
                'value'=> $model->street?$model->street->name:'',
            ),              
            array(
                'name'=>'beginning',
                'type'=>'Currency',
                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
            ),            
           		
            array(
                'name'=>'created_date',
                'type'=>'datetime',
                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
            ),            
           		
            array(
                'label'=>'Ngày Đánh PTTT',
                'name'=>'last_logged_in',
                'type'=>'datetime',
                'visible'=>Yii::app()->user->role_id==ROLE_ADMIN,
            ),            
           		
//            'created_date:datetime',
//            'last_logged_in:datetime',
            //'phone',
	),
)); ?>

<?php
$link = Yii::app()->getRequest()->getUrl() ;
Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){

	$.fn.yiiGridView.update('users-grid', {
                url : '$link',
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

<?php
    $mAgentCustomer = new GasAgentCustomer();
    $mAgentCustomer->agent_id = $model->id;
    if(isset($_GET['GasAgentCustomer']))
            $mAgentCustomer->customer_id=$_GET['GasAgentCustomer']['customer_id'];
?>

<h1>DS Khách Hàng Của <?php echo $model->first_name; ?></h1>
<h2>
    <a class="add_customer_of_agent" href="<?php echo Yii::app()->createAbsoluteUrl('admin/gasagent/add_customer_of_agent',array('agent_id'=>$model->id));?>">
        Thêm Khách Hàng
    </a>
</h2>
<div class="search-form" style="">
<?php $this->renderPartial('_search',array(
	'model'=>$mAgentCustomer,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-grid',
	'dataProvider'=>$mAgentCustomer->searchAgentCustomer(),
        'template'=>'{pager}{summary}{items}{pager}{summary}',     
	'enableSorting' => false,
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
                'header' => 'Mã Hệ Thống',
                'name' => 'code_account',
                'value'=>'$data->customer?$data->customer->code_account:""',
                'htmlOptions' => array('style' => 'width:100px;')
            ), 		
            array(
                'header' => 'Mã Khách Hàng',
                'name' => 'code_bussiness',
                'value'=>'$data->customer?$data->customer->code_bussiness:""',
                'htmlOptions' => array('style' => 'width:100px;')
            ),            
            array(
                'name' => 'first_name',
                'value'=>'$data->customer?$data->customer->first_name:""',               
            ), 		
//            array(
//                'name' => 'name_agent',
//                'value'=>'$data->customer?$data->customer->name_agent:""',
//                'htmlOptions' => array('style' => 'width:150px;')
//            ), 		
             
        array(
            'name' => 'address',
            'value'=>'$data->customer?$data->customer->address:""',
            'type' => 'html',
        ),            
	                    
        array(
            'header' => 'Sale',
            'value'=>'$data->customer?($data->customer->sale?$data->customer->sale->first_name:""):""',
        ),            

//        Yii::t('translation','payment_day'),
            
        array(
            'header' => 'Action',
            'type'=>'DeleteAgentCustomer',
            'value'=>'$data',
            'htmlOptions' => array('style' => 'text-align:center;','class'=>'')
        ),      		
//		array(
//			'header' => 'Action',
//			'class'=>'CButtonColumn',
//                        'template'=> ControllerActionsName::createIndexButtonRoles($actions),
//		),
	),
)); ?>



<script>
$(document).ready(function() {
    fnUpdateColorbox();    
});

function fnUpdateColorbox(){
    $(".add_customer_of_agent").colorbox({iframe:true,innerHeight:'75%', innerWidth: '75%',close: "<span title='close'>close</span>"});
}
function fnUpdateDeleteCustomer(this_){    
        if(confirm('Bạn chắc chắn muốn xóa khách hàng này khỏi đại lý?')){
            var url_ = $(this_).attr('href');
            $.blockUI({ overlayCSS: { backgroundColor: '<?php echo BLOCK_UI_COLOR;?>' } }); 
            $.ajax({
                url:url_,
                type:'get',
//                dataType:'json',
//                data:{ajax_costs:1,materials_id:materials_id,sell_month:sell_month,sell_year:sell_year},
                success:function(data){
                    $.fn.yiiGridView.update("users-grid");
                    $.unblockUI();
                }
            });        
        }
        return false

}
</script>