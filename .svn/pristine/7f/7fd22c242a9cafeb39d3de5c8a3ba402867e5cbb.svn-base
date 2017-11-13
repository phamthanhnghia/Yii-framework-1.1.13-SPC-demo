<?php $cmsFormater = new CmsFormatter(); 
    $uidLogin = Yii::app()->user->id;
    $CanClose = true;
    if($uidLogin != $data->uid_login){
        $CanClose = false;
    }
?>
<li class="ticket">
        <div class="content">
            <h4 class="title">
                <a class="view collapsed" href="#ticket-<?php echo $data->id;?>"><?php echo $data->title;?></a>
            </h4>
            <div class="actions">
                <a class="reply collapsed" href="#ticket-<?php echo $data->id;?>" title="Trả lời ticket">Reply</a>
                <!--- for reply button --> 
                <?php if($CanClose):?>
                <form method="post" class="button_to" action="<?php echo Yii::app()->createAbsoluteUrl('admin/tickets/close_ticket', array('id'=>$data->id)) ?>">
                    <div>
                        <input type="submit" value="Close" class="btn close btn_closed_tickets" title="Chỉ close khi mà vấn đề hỗ trợ của ticket này đã được giải quyết xong" alert_text="Chỉ close ticket khi mà vấn đề hỗ trợ của ticket này đã được giải quyết xong. Bạn chắc chắn muốn close?">                
                    </div>
                </form>
                <?php endif;?>
                
                <!--- for delete button --> 
                <?php if(GasCheck::canDeleteData($data)):?>
                <?php // if(1):?>
                    <?php if(GasCheck::isAllowAccess('tickets', 'delete')):?>
                    <form method="post" class="button_to" action="<?php echo Yii::app()->createAbsoluteUrl('admin/tickets/delete', array('id'=>$data->id)) ?>">
                        <div>
                            <input type="submit" value="Delete" class="btn digital_delete btn_closed_tickets" title="Xóa vĩnh viễn ticket này" alert_text="Xóa vĩnh viễn ticket này?"> 
                        </div>
                    </form>
                    <?php endif;?> 
                <?php endif;?>
                <!--- for delete button --> 
                
            </div>
            <p class="created_at">
            Ticket <strong title="Mã số ticket"><?php echo $data->code_no;?></strong> 
            - Ngày Tạo <?php echo $cmsFormater->formatDateTime($data->created_date); ?>            
            <?php if($data->uid_login != $uidLogin): ?>
                bởi <span class="label"><?php echo GasTickets::ShowNameReply($data->rUidLogin); ?></span>
            <?php endif;?>
            <?php // if($data->admin_new_message == 1 && Yii::app()->user->role_id==ROLE_ADMIN): ?>
            <?php if(Yii::app()->user->role_id==ROLE_ADMIN): ?>
                Đến <span class="label"><?php echo $data->rSendToId?GasTickets::ShowNameReply($data->rSendToId):'Admin'; ?></span>
            <?php endif;?>
            <?php if($data->process_status==GasTickets::PROCESS_STATUS_FINISH ): ?>
                <!--- Last reply 1 Day ago by LÀM SAU NẾU CÓ TIME--> 
                - Trả lời vào <?php echo $cmsFormater->formatDateTime($data->process_time); ?> bởi 
                <span class="label"><?php echo GasTickets::ShowNameReply($data->rProcessUserId); ?></span>
            <?php endif;?>

            </p>
        </div><!-- end <div class="content"> -->
        
        <div id="ticket-<?php echo $data->id;?>" class="in collapse display_none" style="">
            <div class="post_reply post_reply<?php echo $data->id;?>" data_class="post_reply<?php echo $data->id;?>">                
                <!--xử lý hiện thông báo cho đại lý biết ai đang xử lý ticket này-->
                <?php if($data->process_status == GasTickets::PROCESS_STATUS_PICK):?>
                <div class="flash alert">
                    <a data-dismiss="alert" class="close" href="javascript:void(0)">&nbsp;</a>
                    Ticket này đang được xử lý bởi: <?php echo GasTickets::ShowNameReply($data->rProcessUserId); ?> vào lúc <?php echo $cmsFormater->formatDateTime($data->process_time); ?>
                </div>
                <?php endif;?>
                <!--xử lý hiện thông báo cho đại lý biết ai đang xử lý ticket này-->
                
                <?php
                    // nếu ticket status là finish hoặc là của uid tạo (đại lý) hoặc là người pick xử lý thì cho hiện form reply
                    if( $data->process_status == GasTickets::PROCESS_STATUS_FINISH ||
                        $data->uid_login == $uidLogin || 
                        $data->admin_new_message == GasTickets::ADMIN_SEND || 
                        ($data->process_status == GasTickets::PROCESS_STATUS_PICK && $data->process_user_id==$uidLogin) ): ?>
                    <h4>Post Reply</h4>
                    <div class="styled-form">
                        <form method="post" id="new_reply" class="simple_form new_reply" action="<?php echo Yii::app()->createAbsoluteUrl('admin/tickets/reply', array('id'=>$data->id)) ?>" accept-charset="UTF-8">
                            <div class="control-group text required reply_content">
                                <div class="controls">
                                    <textarea rows="20" placeholder="Nhập nội dung trả lời" name="GasTickets[message]" id="reply_content" cols="40" class=""></textarea>
                                    <div class="errorMessage l_padding_20 display_none" style="">Nhập nội dung trả lời.</div>
                                </div>
                            </div>
                            <input type="submit" value="Submit Reply" name="commit<?php echo $data->id;?>">
                        </form>
                    </div>
                <?php  // nếu ticket status là new và không phải của đại lý tạo thì dc phép pick ticket này
                    elseif($data->process_status == GasTickets::PROCESS_STATUS_NEW &&
                        $data->uid_login != $uidLogin 
                        ):?>
                    <div class="styled-form">
                        <form method="post" class="" action="<?php echo Yii::app()->createAbsoluteUrl('admin/tickets/pick_ticket', array('id'=>$data->id)) ?>" accept-charset="UTF-8">
                            <input class="pick_ticket" type="submit" value="Chọn Xử Lý" name="commit<?php echo $data->id;?>">
                        </form>
                    </div>
                <?php endif; ?>
                <?php /*else: // những user khác không làm dc gì khi có người pick ticket này rồi ?>
                    <div class="flash alert">
                        <a data-dismiss="alert" class="close" href="javascript:void(0)">&nbsp;</a>
                        Ticket này đang được xử lý bởi: <?php echo GasTickets::ShowNameReply($data->rProcessUserId); ?> vào lúc <?php echo $cmsFormater->formatDateTime($data->process_time); ?>
                    </div>
                <?php endif; */?>
            </div>
        
            <ul class="replies">
                <?php foreach($data->rTicketDetail as $mDetail): ?>
                <li class="received reply margin_0">
                    <div class="message">
                        <?php echo nl2br($mDetail->message);?>
                        <span class="posted_on">Ngày gửi <?php echo $cmsFormater->formatDateTime($mDetail->created_date); ?></span>
                    </div>
                    <div class="author">
                        <!--<img width="90" height="90" src="https://secure.gravatar.com/avatar/c2da17c95e66c07894e30584b34a9921?default=identicon&amp;secure=true&amp;size=90" alt="Gravatar">-->
                        <span class="name item_b"><?php echo GasTickets::ShowNameReplyAtDetailTicket($mDetail->rUidPost, array('mDetailTicket'=>$mDetail)); ?></span>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
        </div><!-- end <div id="ticket-->
    </li>