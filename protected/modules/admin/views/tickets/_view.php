<?php
/* @var $this TicketsController */
/* @var $data GasTickets */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('code_no')); ?>:</b>
	<?php echo CHtml::encode($data->code_no); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('agent_id')); ?>:</b>
	<?php echo CHtml::encode($data->agent_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid_login')); ?>:</b>
	<?php echo CHtml::encode($data->uid_login); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('send_to_id')); ?>:</b>
	<?php echo CHtml::encode($data->send_to_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('admin_new_message')); ?>:</b>
	<?php echo CHtml::encode($data->admin_new_message); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
	<?php echo CHtml::encode($data->status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('process_status')); ?>:</b>
	<?php echo CHtml::encode($data->process_status); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('process_time')); ?>:</b>
	<?php echo CHtml::encode($data->process_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('process_user_id')); ?>:</b>
	<?php echo CHtml::encode($data->process_user_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('created_date')); ?>:</b>
	<?php echo CHtml::encode($data->created_date); ?>
	<br />

	*/ ?>

</div>