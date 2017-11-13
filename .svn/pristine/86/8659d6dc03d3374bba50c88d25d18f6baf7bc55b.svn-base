    
<h2 class="section-header closed_tickets">Tickets Đã Xử Lý Xong</h2>
<?php  // NGUYEN DUNG
    $this->widget('zii.widgets.CListView', array(
        'dataProvider' => $model->searchNeedProcessDone(),
        'itemView' => '_item_clist_view_only',
//        'ajaxUpdate'=>false, 
//        'afterAjaxUpdate'=>'function(id, data){ BindClickView(); }',
        'itemsCssClass'=>'',
        'pagerCssClass'=>'pager',
        'pager'=> array(
            'maxButtonCount' => 10,
            'class'=>'CLinkPager',
            'header'=> false,
            'footer'=> false,
        ),
        'summaryText' => true,
        'summaryText'=>'Showing <strong>{start} - {end}</strong> of {count} results',
        'template'=>'{pager}{summary}<ul class="tickets clearfix">{items}</ul>{pager}{summary}',
    ));
?>
