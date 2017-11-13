<div class="item-news">
    <a href="<?php echo $data->getUrlDetail();?>"><img src="<?php echo $data->getUrlImage('size2');?>" alt=""/></a>
    <h3><a href="<?php echo $data->getUrlDetail();?>"><?php echo $data->getName(); ?></a></h3>
    <div class="t-date"><?php echo $data->getFeCreatedDate(); ?></div>
    <div class="document">
        <p><?php echo $data->getShortContent(); ?></p>
    </div>
    <a href="<?php echo $data->getUrlDetail();?>" class="r-more">Xem chi tiết</a>
</div>