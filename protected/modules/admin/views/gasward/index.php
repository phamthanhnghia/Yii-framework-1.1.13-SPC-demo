<?php
$this->breadcrumbs=array(
	'QL Phường Xã',
);

$menus=array(
	array('label'=> Yii::t('translation','Tạo Mới Phường Xã'), 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('gas-ward-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");

Yii::app()->clientScript->registerScript('ajaxupdate', "
$('#gas-ward-grid a.ajaxupdate').live('click', function() {
    $.fn.yiiGridView.update('gas-ward-grid', {
        type: 'POST',
        url: $(this).attr('href'),
        success: function() {
            $.fn.yiiGridView.update('gas-ward-grid');
        }
    });
    return false;
});
");
?>

<h1><?php echo Yii::t('translation', 'QL Phường Xã'); ?></h1>

<?php echo CHtml::link(Yii::t('translation','Tìm Kiếm Nâng Cao'),'#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'gas-ward-grid',
	'dataProvider'=>$model->search(),
    'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox();}',
//	'enableSorting' => false,	
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
            array(
                'name'=>'district_id',
                'value'=>'$data->district?$data->district->name:""',
            ),	            
		 Yii::t('translation','name'),
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