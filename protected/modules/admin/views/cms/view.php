<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: view.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<?php
$this->breadcrumbs=array(
	'Cms'=>array('index'),
	$model->title,
);

$menus = array(
                array('label'=>'Create Cms', 'url'=>array('create'), 'action' => 'create'),
                array('label'=>'Update Cms', 'url'=>array('update', 'id'=>$model->id), 'action' => 'update'),
                array('label'=>'Delete Cms', 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
                array('label'=>'Manage Cms', 'url'=>array('index'), 'action' => 'index'),
        );

$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>View Cms: <?php echo $model->title; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'title',
//		'slug',
//		array(
//			'name'=>'banner',
//			'type'=>'html',
//			'value'=> (!empty($model->banner))?CHtml::image(Yii::app()->baseUrl.'/upload/cms/banner/'.$model->banner):'',

		'display_order',
		array(
			'name'=>'show_in_menu',
			'value'=>CmsFormatter::$yesNoFormat[$model->show_in_menu],
		),
		array(
			'name'=>'status',
			'type'=>'Status',
//                        'value'=>(!empty($model->status) && $model->status==1) ? 'Active' : 'Inactive',
			//'value'=>$model->status,
		),
//		),
		array(
                        'type' => 'datetime',
			'name'=>'created_date',
                        'value'=>$model->created_date,
			//'value'=>date(ActiveRecord::getDateFormatPhp().' H:i' , strtotime($model->created_date)),
		),            
                'cms_content:html',            
		'short_content:html',
//		'link',
		//'meta_keywords',
		//'meta_desc',
	),
)); ?>
