<?php
/**
 * VerzDesignCMS
 * 
 * LICENSE
 *
 * @copyright	Copyright (c) 2012 Verz Design (http://www.verzdesign.com)
 * @version 	$Id: _view.php 2012-06-01 09:09:18 nguyendung $
 * @since		1.0.0
 */
?>
<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->title), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('slug')); ?>:</b>
	<?php echo CHtml::encode($data->slug); ?>
	<br />
        
	<b><?php echo CHtml::encode($data->getAttributeLabel('banner')); ?>:</b>
	<?php if(!empty($data->banner)) echo CHtml::image(Yii::app()->baseUrl.'/upload/cms/banner/'.$data->banner);// encode($data->banner); ?>
        
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cms_content')); ?>:</b>
	<?php echo $data->cms_content;//echo CHtml::encode($data->content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode(date( ActiveRecord::getDateFormatPhp().' H:i' , strtotime($data->created_date))); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('display_order')); ?>:</b>
	<?php echo CHtml::encode($data->display_order); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('show_in_menu')); ?>:</b>
	<?php echo CHtml::encode((!empty($data->show_in_menu) && $data->show_in_menu==1) ? "Yes" : "No"); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('place_holder_id')); ?>:</b>
	<?php echo CHtml::encode($data->place_holder->position); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('creator_id')); ?>:</b>
	<?php echo CHtml::encode($data->creator_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('short_content')); ?>:</b>
	<?php echo CHtml::encode($data->short_content); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('link')); ?>:</b>
	<?php echo CHtml::encode($data->link); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_keywords')); ?>:</b>
	<?php echo CHtml::encode($data->meta_keywords); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('meta_desc')); ?>:</b>
	<?php echo CHtml::encode($data->meta_desc); ?>
	<br />

	*/ ?>

</div>