<?php
Yii::import('zii.widgets.CPortlet');
class GasAutocompleteMaterial extends CPortlet
{
    public $data; // is array('model'=>$model, 'url'=> custom url, 'field_name'=>field_name)

    public function init()
    {
        parent::init();        
    }

    public function renderContent()
    {
        $this->render('view',array('data'=>$this->data));
    }
    
}