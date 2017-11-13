<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php echo "<?php\n"; ?>
$this->breadcrumbs = array(
	$this->pluralTitle => array('index'),
        $model->id=>array('view','id'=>$model->id),
	'Cập Nhật ' . $this->singleTitle,
);

$menus = array(	
    array('label' => $this->pluralTitle, 'url' => array('index')),
    array('label' => 'Xem ' . $this->singleTitle, 'url' => array('view', 'id' => $model->id)),	
    array('label' => 'Tạo Mới ' . $this->singleTitle, 'url' => array('create')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);

?>

<h1>Cập Nhật: <?php echo '<?php echo $this->singleTitle; ?>'; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>