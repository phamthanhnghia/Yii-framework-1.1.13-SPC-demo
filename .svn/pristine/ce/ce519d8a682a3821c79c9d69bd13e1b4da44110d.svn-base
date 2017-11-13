<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

            <div class="row">
                <?php echo $form->label($model,'customer_id'); ?>
                <?php echo $form->hiddenField($model,'customer_id'); ?>
                <?php 
                    // widget auto complete search user customer and supplier
                    $aData = array(
                        'model'=>$model,
                        'name_relation_user'=>'customer',
                    );
                    $this->widget('ext.SpaAutocompleteCustomer.SpaAutocompleteCustomer',
                        array('data'=>$aData));                                        
                ?>
            </div> 

	<div class="row">
		<?php // echo $form->label($model,'sale_id',array()); ?>
		<?php // echo $form->dropDownList($model,'sale_id', Users::getArrUserByRole(ROLE_SALE),array('empty'=>'select','style'=>'float:left;')); ?>
	</div>


	<div class="row buttons" style="padding-left: 159px;">
		        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>Yii::t('translation','Search'),
            'type'=>'null', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>'small', // null, 'large', 'small' or 'mini'
            //'htmlOptions' => array('style' => 'margin-bottom: 10px; float: right;'),
        )); ?>	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->