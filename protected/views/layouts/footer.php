<footer class="footer-wapper">
    <div class="container">
        <div class="row">
            <?php echo MuradCategory::renderFeMenuFooter(); ?>
        </div>
        <div class="logo-ft"> 
            <img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/logo.png" alt="">
        </div>
        <div class="f_size_13">
            <ul class="footer-menu ">
                <li><a href="http://daukhi.huongminhgroup.com/news-detail/vi/dieu-khoan-su-dung-app">Privacy Policy</a></li>
                <li class="icon-plugs CursorPointer">Related Sites
                    <ul><li><a href="#">SK Ethical Management</a></li>
                        <li><a href="#">SK Shared Growth Commission</a></li>
                        <li><a href="#">SK innovation</a></li>
                        <li><a href="#">SK energy</a></li>
                        <li><a href="#">SK global chemical</a></li>
                        <li><a href="#">SK lubricants</a></li>
                        <li><a href="#">SK chemicals</a></li>
                        <li><a href="#">SK E&S </a></li>
                    </ul>
                </li>
                <li class="icon-plugs CursorPointer">Family Web Sites
                    <ul><li><a href="#">SK Ethical Management</a></li>
                        <li><a href="#">SK Shared Growth Commission</a></li>
                        <li><a href="#">SK innovation</a></li>
                        <li><a href="#">SK energy</a></li>
                        <li><a href="#">SK global chemical</a></li>
                        <li><a href="#">SK lubricants</a></li>
                        <li><a href="#">SK chemicals</a></li>
                        <li><a href="#">SK E&S </a></li>
                    </ul>
                </li>
                </li>
                <!--<li><a href="#">Web Sites</a></li>-->
            </ul>
            <p class=""><?php echo MyFormat::label("CompanyName"); ?>, <?php echo MyFormat::label("CompanyAddress"); ?> Tel. 08 6294 9650   Fax. 08 6294 7087</p>
            <p class="note-f" style="padding-top: 8px;">Copyright(C) <span>SPJ</span>. All Rights Reserved.</p>
            <p>&nbsp;</p>
            <p>&nbsp;</p>
        </div>
    </div>
<!--<div class="copyright"></div>-->
    
</footer>
<script>
    $(function(){
        $('#sidebar-btn').click(function() {
            $('#sidebar').toggleClass('visible');
        });
    });
</script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/plugins.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/spj.js"></script>