<?php $this->beginContent('/layouts/main'); ?>

<div id="control">
<?php
$arr = array();
foreach ($this->menu as $k=> $val){
	
	$arr[] =$val;	
	$arr[$k]['itemOptions'] = array('class'=>$val['url'][0],
                                'title'=>$val['label'],	
                                );	
        if(isset($val['htmlOptions']['class'])) // ADD BY ANH DUNG
            $arr[$k]['itemOptions']['class'] = $val['htmlOptions']['class'];
        
	if($val['url'][0]=='index') $val['url'][0]='Quản Lý';
	if($val['url'][0]=='create') $val['url'][0]='Tạo Mới';
	if($val['url'][0]=='delete') $val['url'][0]='Xóa';

	$arr[$k]['label']=ucfirst($val['url'][0]);
        if(isset($val['htmlOptions']['label'])) // ADD BY ANH DUNG
            $arr[$k]['label'] = $val['htmlOptions']['label'];
}

		$this->beginWidget('zii.widgets.CPortlet', array(
			//'title'=>'Operations',
		));

		$this->widget('zii.widgets.CMenu', array(
			'items'=>$arr,
			'linkLabelWrapper' => 'span',
			'htmlOptions'=>array('class'=>'operations'),
		));
		
		$this->endWidget();
	?>
</div>

<div class="span-19 main-content">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>

<?php $this->endContent(); ?>

