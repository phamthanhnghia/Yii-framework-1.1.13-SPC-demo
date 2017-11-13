<?php
$this->breadcrumbs=array(
	'QL Quận/Huyện',
);

$menus=array(
	array('label'=> Yii::t('translation','Create GasDistrict'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gas-district-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#gas-district-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('gas-district-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('gas-district-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'Quản Lý Quận/Huyện'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Advanced Search'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gas-district-grid',
	'dataProvider'=>$model->search(),
//	'enableSorting' => false,
	'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox();}',
    'template'=>'{pager}{summary}{items}{pager}{summary}',     
        'pager' => array(
            'maxButtonCount'=>  CmsFormatter::$PAGE_MAX_BUTTON,
        ),    
    
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '30px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),	
            array(
                'name'=>'province_id',
                'value'=>'$data->province?$data->province->name:""',
            ),		 
		 Yii::t('translation','name'),		 
		 'status:status',
            array(
                'name'=>'user_id_create',
                'value'=>'$data->user?$data->user->first_name:""',
            ),	            
            
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
}
</script>