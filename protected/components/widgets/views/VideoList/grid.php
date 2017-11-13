<?php
    $model = new MuradVideo();
    $dataProvider = $model->SearchFE($mCategory->id, $data['type_video_audio']);
    
    $widget = $this->widget('zii.widgets.CListView', array(
        'dataProvider'=> $dataProvider,
        'id'=>"video-grid-".$data['grid_id'],
        'itemView'=>'VideoList/grid_item',
        'viewData'=>array('dataProvider'=>$dataProvider),
        //list-video clearfix
        'itemsCssClass'=>'list-video items clearfix',
//        'ajaxUpdate'=>false,
        'enablePagination'=>true,
        'pager' => array(
            'maxButtonCount' => 5,
            'header' => false,
            'footer'=> false,
            'prevPageLabel' =>  'Previous',
            'nextPageLabel' =>  'Next',
            'lastPageLabel' => 'Last',
            'firstPageLabel' => 'First',
            'selectedPageCssClass'=>'active',
            'htmlOptions'=>array('class'=>'')
        ),
//        'itemsTagName'=>'ul',
//        'template'=>'{pager}{items}{pager}',
        'template'=>'{items}{pager}',
));?>    