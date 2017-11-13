<?php 
class ProductList extends CWidget
{
    public $dataProvider;
    public $data;
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: render list view product
     */
    public function run()
    {
        $this->render("ProductList/grid",array( 'dataProvider'=>$this->dataProvider, 'data'=>  $this->data) );
    }
}
?>