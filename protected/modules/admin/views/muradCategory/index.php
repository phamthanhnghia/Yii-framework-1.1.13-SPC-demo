<?php
$this->breadcrumbs=array(
	$this->singleTitle,
);

$menus=array(
            array('label'=>"Create $this->singleTitle", 'url'=>array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('murad-category-grid', {
                url : $(this).attr('action'),
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Danh Sách <?php echo $this->pluralTitle; ?></h1>


<?php echo CHtml::link('Tìm Kiếm Nâng Cao','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'murad-category-grid',
	'dataProvider'=>$model->search(),
        'afterAjaxUpdate'=>'function(id, data){ fnUpdateColorbox();}',
        'template'=>'{pager}{summary}{items}{pager}{summary}',
//    'itemsCssClass' => 'items custom_here',
//    'htmlOptions'=> array('class'=>'grid-view custom_here'),
        'pager' => array(
            'maxButtonCount'=>  CmsFormatter::$PAGE_MAX_BUTTON,
        ),
//	'enableSorting' => false,
	//'filter'=>$model,
	'columns'=>array(
        array(
            'header' => 'S/N',
            'type' => 'raw',
            'value' => '$this->grid->dataProvider->pagination->currentPage * $this->grid->dataProvider->pagination->pageSize + ($row+1)',
            'headerHtmlOptions' => array('width' => '10px','style' => 'text-align:center;'),
            'htmlOptions' => array('style' => 'text-align:center;')
        ),
                array(
                    'name'=>'name_for_slug',
                    'value'=>'$data->getNameForSlug()',
                ),
                array(
                    'name' => 'order_display',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
                array(
                    'name' => 'type',
                    'value' => '$data->getType()',
                ),

                array(
                    'name' => 'category_type',
                    'value' => '$data->getCategoryTypeText()',
                ),
                //                array(
//                    'name'=>'file_name',
//                    'type'=>'html',
//                    'value'=>'$data->getImageThumbTemp()',
//                ),
                
                array(
                    'name' => 'status',
                    'value' => '$data->getStatusText()',
                    'htmlOptions' => array('style' => 'text-align:center;')
                ),
		/*
		'meta_keywords',
		'meta_description',
		*/
		array(
                    'header' => 'Actions',
                    'class'=>'CButtonColumn',
                    'template'=> ControllerActionsName::createIndexButtonRoles($actions),
                    'buttons'=>array(
//                        'update'=>array(
//                            'visible'=> 'GasCheck::AgentCanUpdateMeetingMinutesxx($data)',
//                        ),
                        'delete'=>array(
                            'visible'=> '$data->canDeleteData()',
                        ),
                    ),
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