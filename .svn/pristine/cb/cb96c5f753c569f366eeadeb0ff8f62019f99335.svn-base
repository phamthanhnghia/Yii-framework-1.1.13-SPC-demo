<?php
    $widget = $this->widget('zii.widgets.CListView', array(
        'dataProvider'=> $dataProvider,
        'id'=>"news-grid-",
        'itemView'=>'index/index_item',
        'viewData'=>array('dataProvider'=>$dataProvider),
        'itemsCssClass'=>'items clearfix',
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
        'template'=>'{pager}<ul class="list-3 clearfix">{items}</ul>{pager}',
));?>    