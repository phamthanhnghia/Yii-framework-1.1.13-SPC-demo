<?php
$this->breadcrumbs=array(
	'Admin Accounts'=>array('index'),
    $model->first_name . " " . $model->last_name,
);

$menus=array(
	array('label'=>'Admin Accounts', 'url'=>array('index')),
	array('label'=>'Create Admin Account', 'url'=>array('create')),
	array('label'=>'Update Admin Account', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Admin Account', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Admin Account [<?php echo $model->first_name . " " . $model->last_name; ?>]</h1>

<?php
$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'username',
		'email',
        array(
            'name' => 'Full Name',
            'type'=>'raw',
            'value'=>$model->first_name . " " . $model->last_name
        ),
        'phone',
        'gender',
        array(
            'name' => 'created_date',
            'value'=> ($model->created_date!= "0000-00-00 00:00:00") ? date(ActiveRecord::getDateFormatPhp()." H:i:s" ,strtotime($model->created_date)) : "",
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
        array(
            'name' => 'last_logged_in',
            'value'=> ($model->last_logged_in!= "0000-00-00 00:00:00") ? date(ActiveRecord::getDateFormatPhp()." H:i:s" ,strtotime($model->last_logged_in)) : "",
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
            
            
		//'ip_address',
		'status:status',
	),
)); ?>
