<?php 
    $mUser = $model->rUidLeave;
    $session=Yii::app()->session;
    $cmsFormater = new CmsFormatter();
    $ObjCreatedDate = new DateTime($model->created_date);
    $aCName = explode("-", $model->c_name);
?>

<?php include 'view_update_status.php';?>

<div class="sprint" style=" padding-right: 235px;">
    <a class="button_print" href="javascript:void(0);" title="In Đơn Nghỉ Phép">
        <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/print.png">
    </a>
</div>
<div class="clr"></div>
<script  src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.printElement.min.js"></script>
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/print-store-card.css" />
<script type="text/javascript">
	$(document).ready(function(){
            $(".button_print").click(function(){
                    $('#printElement').printElement({ overrideElementCSS: ['<?php echo Yii::app()->theme->baseUrl;?>/css/print-store-card.css'] });
            });
	});
</script>

<div class="container" id="printElement">
    <table cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <div class="logo">
                    <img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo80x80.png">
                </div>            
                <p style="margin: 31px 0 20px 0; font-size: 15px;">CÔNG TY TNHH HƯỚNG MINH</p>
            </td>
            <td valign="top" class="item_c">
                <h2 style="margin: 35px 0 0">
                    <span class="f_size_18">CỘNG HOÀ XÃ HỘI CHỦ NGHĨA VIỆT NAM</span><br>
                    <span class="item_normal f_size_16">Độc lập - Tự do - Hạnh phúc</span>
                </h2>
            </td>
        </tr>
    </table>
    <br>
    <h2 class="item_c">ĐƠN XIN NGHỈ PHÉP</h2>
    <br>
    
    <div style="width: 80%; margin: 0 auto;" class="f_size_14 fix_noborder">
        <p class="item_b"><span class="item_u item_i r_padding_100">Kính gởi:</span>BAN GIÁM ĐỐC CÔNG TY TNHH HƯỚNG MINH</p>
        <table cellpadding="0" cellspacing="0" class="tb hm_table">
            <tbody>
                <tr>
                    <td><p>Tôi tên: <?php echo $aCName[0];?></p></td>
                    <td>Bộ phận công tác: <?php echo $session['ROLE_NAME_USER'][$mUser->role_id];?></td>
                </tr>
                <tr>
                    <td colspan="2">
                    <p>Nay tôi làm đơn này gởi đến Ban Giám đốc cho phép tôi được nghỉ phép</p>
                        <p>từ ngày <?php echo $cmsFormater->formatDate($model->leave_date_from);?> đến hết 
                    ngày <?php echo $cmsFormater->formatDate($model->leave_date_to);?>.</p>
                    <p>Lý do nghỉ phép: <?php echo nl2br($model->leave_content);?>.</p>
                    <p>Tôi xin cam đoan sẽ hoàn thành tốt công việc khi hết hạn nghỉ phép.</p>
                    <p>Rất mong sự chấp thuận của Ban Giám đốc.</p>
                    </td>
                </tr>
            </tbody>
        </table>
        <br>
        <table cellpadding="0" cellspacing="0" class="tb hm_table">
            <tbody>
                <tr>
                    <td class="item_c" style="width: 50%;">
                        <p class="item_b">*Ý KIẾN CỦA PHỤ TRÁCH BỘ PHẬN</p>
                        <?php if(!empty($model->manage_approved_uid)): ?>
                            <p><?php echo isset(GasLeave::$LIST_STATUS_TEXT[$model->manage_approved_status])?GasLeave::$LIST_STATUS_TEXT[$model->manage_approved_status]:'';?></p>
                        <?php endif;?>
                        <p><?php echo nl2br($model->manage_note);?></p>
                    </td>
                    <td class="item_c">
                        TP.HCM, ngày <?php echo $ObjCreatedDate->format('d');?> tháng <?php echo $ObjCreatedDate->format('m');?> năm <?php echo $ObjCreatedDate->format('Y');?><br>
                        Người làm đơn<br>
                        (ký tên, ghi rõ họ tên)
                    </td>
                </tr>
                
            </tbody>
        </table>
        <br><br><br><br><br><br><br><br>
        <table cellpadding="0" cellspacing="0" class="tb hm_table">
            <tbody>
                <tr>
                    <td class="item_c " style="">
                        <p class="item_b">* Ý KIẾN CỦA BAN GIÁM ĐỐC</p>
                        <?php if(!empty($model->approved_director_id)): ?>
                            <p><?php echo GasLeave::$LIST_STATUS_TEXT[$model->status];?></p>
                        <?php endif;?>
                        <p><?php echo nl2br($model->director_note);?></p>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    
</div>

<script>
    $(window).load(function(){ // không dùng dc cho popup
        fnResizeColorbox();
        parent.$('.SubmitButton').trigger('click');
    });
    
    function fnResizeColorbox(){
//        var y = $('body').height()+100;
        var y = $('#main_box').height()+100;
        parent.$.colorbox.resize({innerHeight:y});        
    }
</script>

