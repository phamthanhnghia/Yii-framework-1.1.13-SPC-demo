<?php 
class ProductItem extends CWidget
{
    public $data;
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: render list view product
     */
    public function run()
    {
        $this->render("ProductList/grid_item",array('data'=> $this->data) );
    }
}
?>