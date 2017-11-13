<div id="tabs-3">
        <div class="column" style="width: 45%; ">
            <fieldset>
                <legend>Toàn Hệ Thống</legend>
                <div class="row">
                    <?php echo $form->labelEx($model, 'allow_admin_login', array('label'=>'Allow Admin Login')); ?>
                    <?php echo $form->dropDownList($model, 'allow_admin_login', CmsFormatter::$yesNoCharFormat, array('class'=>'w-200') ) ; ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'allow_use_admin_cookie', array('label'=>'Allow Use Admin Cookie')); ?>
                    <?php echo $form->dropDownList($model, 'allow_use_admin_cookie', CmsFormatter::$yesNoCharFormat, array('class'=>'w-200') ) ; ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'delete_global_days', array('label'=>'Số Ngày Được Xóa')); ?>
                    <?php echo $form->textField($model, 'delete_global_days'); ?> Ngày
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'cookie_days', array('label'=>'Số Ngày Cookie Login')); ?>
                    <?php echo $form->textField($model, 'cookie_days'); ?> Ngày
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'days_keep_track_login', array('label'=>'Số Ngày Giữ Tracking Login')); ?>
                    <?php echo $form->textField($model, 'days_keep_track_login'); ?> Ngày
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'enable_delete', array('label'=>'Cho Phép Xóa Global')); ?>
                    <?php echo $form->dropDownList($model, 'enable_delete', CmsFormatter::$yesNoCharFormat, array('class'=>'w-200') ) ; ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'check_login_same_account', array('label'=>'Check Login Same Account')); ?>
                    <?php echo $form->dropDownList($model, 'check_login_same_account', CmsFormatter::$yesNoCharFormat, array('class'=>'w-200') ) ; ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'DeleteImage', array('label'=>'Delete image news')); ?>
                    <?php echo $form->dropDownList($model, 'DeleteImage', CmsFormatter::$yesNoCharFormat, array('class'=>'w-200') ) ; ?>
                </div>
                
            </fieldset>
            
            <fieldset>
                <legend>Tickets</legend>
                <div class="row">
                    <?php echo $form->labelEx($model, 'limit_post_ticket', array('label'=>'Số ticket được post trong 1 ngày')); ?>
                    <?php echo $form->textField($model, 'limit_post_ticket'); ?>
                </div>
                <div class="row">
                    <?php echo $form->labelEx($model, 'ticket_page_size', array('label'=>'Page Size Ticket')); ?>
                    <?php echo $form->textField($model, 'ticket_page_size'); ?>
                </div>
            </fieldset>
        </div> <!-- end col left <div class="column" -->
        <div class="buttons clear">
            <button type="submit">Submit</button>
        </div>

        <div class="column" style="width: 45%;">
            
        </div> <!-- end col right <div class="column" -->
        
        <div class='clr'></div>
</div><!-- end <div id="tabs-3">-->