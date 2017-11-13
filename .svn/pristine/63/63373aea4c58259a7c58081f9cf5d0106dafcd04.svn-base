<div class="row w-350" >    
    <?php // echo $form->textField($ModelCreate,'send_to_id',array('class'=>'ticket_topic', 'size'=>30,'maxlength'=>200,'placeholder'=>'Gửi Cho User Hệ Thống')); ?>    
    <?php echo $form->hiddenField($model,'send_to_id', array('class'=>'', 'class_update_val'=>'')); ?>
    <?php echo $form->hiddenField($model,'admin_new_message', array('value'=>1)); ?>
    <?php 
        // widget auto complete search user customer and supplier
        $aData = array(
            'model'=>$ModelCreate,
            'field_customer_id'=>'send_to_id',
            'url'=> Yii::app()->createAbsoluteUrl('admin/ajax/search_for_ticket'),
            'name_relation_user'=>'rSendToId',
            'ClassAdd'=>'w-350',
            'ClassAddDivWrap'=>'w-650',
//            'fnSelectCustomer'=>'fnAfterSelectSaleOrAgent',
        );
        $this->widget('ext.SpaAutocompleteCustomer.SpaAutocompleteCustomer',
            array('data'=>$aData));                                        
    ?>        
</div>

