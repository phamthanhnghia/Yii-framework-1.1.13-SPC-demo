<?php
$this->breadcrumbs=array(
	'Users',
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>'', 'active'=>true),
	array('label'=>'Create Users', 'url'=>array('create')),
); 

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('users-model-grid', {
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#users-model-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('users-model-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('users-model-grid');
        }
    });
    return false;
});
");
?>

<h1>List users</h1>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->
   
<?php 
  //  $status = ActiveRecord::getUserStatus();
//	$model->status = $status[$model->status];
    $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'users-model-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        'name',
        'nick_name',
        array(
            'name'=>'city_id',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=> '!empty($data->city_id) ? $data->city->city_name : ""',
            'filter' => ActiveRecord::getCity()
        ),
		'email',
		'height',		
        array(
                'name'=>'dob',
                'type'=>'date',
                ),
        
		array(
            'name'=>'work_out_side',
            'type'=>'work',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'array("work_out_side"=>$data->work_out_side,"id"=>$data->id)',
			'filter' => array('1'=>'Yes','0' => 'No')
        ),
         array(
            'name'=>'status',
            'type'=>'status',
            'htmlOptions' => array('style' => 'text-align:center;'),
            'value'=>'array("status"=>$data->status,"id"=>$data->id)',
			'filter' => array('1'=>'Yes','0' => 'No')
        ),
             
            
		/*
        'id',
        'password_hash',
		'temp_password',		
		'bust',
		'weight',
		'waist',
		'hips',
		'dress_size',
		'shoes_size',
		'bust_cup_size',		
		'login_attemp',
		'created_date',
		'last_logged_in',
		'status',
		'ip_address',		
		'application_id',
		
		*/
		array(
			'class'=>'CButtonColumn',
            'template' => '{view} {update} {delete}',
		),
	),
)); ?>
