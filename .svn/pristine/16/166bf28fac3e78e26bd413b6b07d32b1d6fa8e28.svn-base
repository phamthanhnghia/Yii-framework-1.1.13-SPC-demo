<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
$this->breadcrumbs=array(
    $this->pluralTitle => array('index'),
    ' ' . $this->singleTitle . ' : ',
);

$menus = array(
	array('label'=>"$this->pluralTitle Management", 'url'=>array('index')),
	array('label'=>"Tạo Mới $this->singleTitle", 'url'=>array('create')),
	array('label'=>"Cập Nhật $this->singleTitle", 'url'=>array('update', 'id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>)),
	array('label'=>"Xóa $this->singleTitle", 'url'=>array('delete'), 'linkOptions'=>array('submit'=>array('delete','id'=>$model-><?php echo $this->tableSchema->primaryKey; ?>),'confirm'=>'Bạn chắc chắn muốn xóa ?')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<?php echo "<h1>Xem: <?php echo \$this->singleTitle; ?></h1>\n"; ?>

<?php echo "<?php"; ?> $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
<?php
foreach($this->tableSchema->columns as $column)
	echo "\t\t'".$column->name."',\n";
?>
	),
)); ?>
