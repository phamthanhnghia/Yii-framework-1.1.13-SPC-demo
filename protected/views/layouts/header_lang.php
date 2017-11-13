<div class="dropdown " style="">
    <form method="post">
        <button id="dLabel" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="icon-flags"><img src="<?php echo Languages::getCurrentImage(); ?>" alt=""/></span><?php echo Languages::getCurrentLangText();?>
            <span class="icon-top"><i class="fa fa-sort"></i></span>
        </button>
        <ul class="dropdown-menu " aria-labelledby="dLabel">
            <?php foreach (Languages::$aCode as $langCode=>$langName): ?>
                <li><a class="ChangeLang" href="javascript:void(0);" data='<?php echo $langCode;?>'><span class="icon-flags-dropdown"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/lang_<?php echo $langCode;?>.jpg" alt=""/></span><?php echo $langName;?></a></li>
            <?php endforeach; ?>
                <input type="hidden" name="lang" value="en">
          <!--<li><a href="#"><span class="icon-flags-dropdown"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/img/lang_vn.jpg" alt=""/></span>VietNam</a></li>-->
        </ul>
    </form>
</div>