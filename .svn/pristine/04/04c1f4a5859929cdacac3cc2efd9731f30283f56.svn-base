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
	'Tin Tức'=>array('index'),
	'Manage',
);

$menus = array(
	array('label'=>'Create Cms', 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('cms-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#cms-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('cms-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('cms-grid');
        }
    });
    return false;
});
");
?>

<h1>Quản Lý Tin Tức</h1>



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
    'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox();}',
        //'afterAjaxUpdate'=>'function(id, data){alert(1)}',
        //'beforeAjaxUpdate'=>'function(id, data){ $(".search-form form").serialize(); }',
    
    
	//'filter'=>$model,
	'columns'=>array(
            array(
                'header' => 'S/N',
                'type' => 'raw',
                'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
                'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
                'htmlOptions' => array('style' => 'text-align:center;')
            ),
            'title',
//            'slug',
            array(
                'type' => 'datetime',
                'name'=>'created_date',
                'value'=>'$data->created_date',
                'htmlOptions' => array('style' => 'text-align:center;')
                //'value'=> '($data->created_date!= "0000-00-00 00:00:00") ? date(ActiveRecord::getDateFormatPhp()." H:i:s" ,strtotime($data->created_date)) : ""',
            ),
//          'display_order',
            array(
                'name'=>'display_order',
                'htmlOptions' => array('style' => 'text-align:center;width:80px;')
            ),            
            array(
                'name'=>'show_in_menu',
                'type'=>'StatusField',
                'value'=>'array("status"=>$data->show_in_menu,"id"=>$data->id,"field_name"=>"show_in_menu")',
                'htmlOptions' => array('style' => 'text-align:center;width:80px;'),
                'cssClassExpression'=>'GasCheck::isAllowAccess("cms", $data->status==0?"AjaxActivateField":"AjaxDeactivateField")?"":"remove_html_only"'
            ), 

            array(
                'name'=>'status',
                'type'=>'status',
                'value'=>'array("status"=>$data->status,"id"=>$data->id)',
                'htmlOptions' => array('style' => 'text-align:center;'),
                'cssClassExpression'=>'GasCheck::isAllowAccess("cms", $data->status==0?"ajaxActivate":"ajaxDeactivate")?"":"remove_html_only"'
            ),
        
        /*
		'place_holder_id',
		'creator_id',
		'status',
		'short_content',
		'link',
		'meta_keywords',
		'meta_desc','template'=>'{delete}{update}',{'template'=>'{delete}{update}',}
		*/
            array(
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
}
</script>