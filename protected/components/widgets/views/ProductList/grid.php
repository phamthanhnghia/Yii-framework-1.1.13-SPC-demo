<?php
    $widget = $this->widget('zii.widgets.CListView', array(
        'dataProvider'=> $dataProvider,
        'id'=>"product-grid-".$data['grid_id'],
        'itemView'=>'ProductList/grid_item',
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
        'template'=>'{items}{pager}',
));?>    