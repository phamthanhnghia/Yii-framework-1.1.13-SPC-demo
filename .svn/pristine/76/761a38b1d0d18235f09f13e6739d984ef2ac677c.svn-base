<div id="wrapper">
        <h1 class="title" style="">
            <strong>
                <?php 
                $login = " <a href='".Yii::app()->createAbsoluteUrl('admin/login')."'>Đăng Nhập</a>";
                    $text = "Trang Bạn Yêu Cầu Không Tồn Tại.";
                    if(Yii::app()->params['server_maintenance']=='yes'){
                        $text = Yii::app()->params['server_maintenance_message'];
                    }
                    
                    $session=Yii::app()->session;
                    if(isset($session['TEXT_ACCESS_NOT_ALLOW'])){
                        $text = $session['TEXT_ACCESS_NOT_ALLOW'];
                    }
                    echo $text.$login;
                    Yii::app()->user->logout();
                ?>
            </strong>
        </h1>
    <p><img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/logo.png"></p>
</div><!--end of wrapper-->
<link rel="stylesheet" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/underconstruction.css" type="text/css" />
<script>
    $(function(){
        $('#page').attr('id','');
        $('#main').attr('id','');
    });
</script>
