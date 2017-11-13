<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: admin.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<?php
$this->breadcrumbs=array(
	'Cms'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Cms', 'url'=>array('index')),
	array('label'=>'Create Cms', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cms-grid', {
		data: $(this).serialize()
	});
        
        //console.log($(this).serialize());
	return false;
        
        
});
");
?>

<h1>Manage Cms</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cms-grid',
	'dataProvider'=>$model->search(),
    'template'=>'{pager}{summary}{items}{pager}{summary}', 
        //'afterAjaxUpdate'=>'function(id, data){alert(1)}',
        //'beforeAjaxUpdate'=>'function(id, data){ $(".search-form form").serialize(); }',
    
    
	//'filter'=>$model,
	'columns'=>array(
		'title',
		'slug',
		array(
            'name'=>'created_date',
            'value'=> '($data->created_date!= "0000-00-00 00:00:00") ? date(ActiveRecord::getDateFormatPhp() ,strtotime($data->created_date)) : ""',
        ),
		'display_order',
		array(
            'name'=>'show_in_menu',
            'value'=> '(!empty($data->show_in_menu) && $data->show_in_menu==1) ? "Yes" : "No"',
			'filter'=>array('1'=>'Yes','0'=>'No'),
        ),
		array(
            'name'=>'status',
            'value'=> '(!empty($data->status) && $data->status==1) ? "Active" : "Inactive"',
			'filter'=>  ActiveRecord::getUserStatus(),
        ),
        
        /*
		'place_holder_id',
		'creator_id',
		'status',
		'short_content',
		'link',
		'meta_keywords',
		'meta_desc',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
