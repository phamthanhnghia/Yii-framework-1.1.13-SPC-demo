<?php
/**
 * The following variables are available in this template:
 * - $this: the CrudCode object
 */
?>
<?php
echo "<?php\n";
$label=$this->pluralize($this->class2name($this->modelClass));
echo "\$this->breadcrumbs=array(
	\$this->pluralTitle=>array('index'),
	'Tạo Mới',
);\n";
?>

$menus = array(		
        array('label'=>"$this->singleTitle Management", 'url'=>array('index')),
);
$this->menu= ControllerActionsName::createMenusRoles($menus, $actions);
?>

<h1>Tạo Mới <?php echo '<?php echo $this->singleTitle; ?>'; ?></h1>

<?php echo "<?php echo \$this->renderPartial('_form', array('model'=>\$model)); ?>"; ?>
