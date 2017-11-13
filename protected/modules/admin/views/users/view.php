<?php
$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Users', 'url'=>array('Users/')),
	array('label'=>'View Users', 'url'=>'', 'active'=>true),
	array('label'=>'Create Users', 'url'=>array('create')),
	array('label'=>'Update Users', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Users', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
?> 

<h1>View User [<?php echo $model->name; ?>]</h1>

<?php 
    $status = ActiveRecord::getUserStatus();
	$model->status = $status[$model->status];
	$model->work_out_side = $status[$model->work_out_side];	    
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'email',
		'nick_name',
		'name',
        array(
            'name'=>'dob',
			'type'=>'date',           
			'htmlOptions' => array('style' => 'text-align:center;'),
        ),		
		'height',
		'bust',
		'weight',
		'waist',
		'hips',
		'dress_size',
		'shoes_size',
		'bust_cup_size',
		'work_out_side',
		array(
            'name'=>'created_date',
			'type'=>'date',           
			'htmlOptions' => array('style' => 'text-align:center;'),
        ),	
		array(
            'name'=>'last_logged_in',
			'type'=>'dateTime',           
			'htmlOptions' => array('style' => 'text-align:center;'),
        ),	
		'status',
		//'ip_address',
		//'application_id',
         array(
            'name'=>'city_id',
            'value'=>!empty($model->city_id) ? $model->city->city_name : "",
        ), 
	),
)); ?>
