<?php 
class News extends CWidget
{
    public $mNews;
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: render list view product
     */
    public function run()
    {
        $this->render("News/ColLeft", array('mNews'=>$this->mNews) );
    }
}
?>