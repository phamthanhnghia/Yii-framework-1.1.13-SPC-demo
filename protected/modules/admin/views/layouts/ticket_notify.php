<?php if(GasCheck::isAllowAccess('tickets', 'index')): ?>
<div class="ticket_notify float_r">
    <a class="ticket_notify_icon" href="<?php echo Yii::app()->createAbsoluteUrl('admin/tickets/index'); ?>" title="Thông báo ticket mới">
        <?php
            $notificationsCountValue = 0;
            if(isset($_GET['ticket_notify']))
                $notificationsCountValue = GasTickets::CountNotify(); 
        ?>
        <?php if($notificationsCountValue):?>
        <span class="jewelCount">
            <span class="notificationsCountValue"><?php echo $notificationsCountValue;?></span>
            <!--<i class="accessible_elem"> Notifications</i>-->
        </span>
        <?php endif;?>
    </a>
</div>
<?php endif;?>
    
    