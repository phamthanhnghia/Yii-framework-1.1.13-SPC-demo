<?php
class AjaxController extends AdminController
{
    public function actionRunSomeSql(){
        set_time_limit(7200);
        // admin/ajax/RunSomeSql
        // need run again RunSomeSql
        //UpdateSql::updateColumnAddressUser(); // 2104 done in: 175 Second <=> 2.9166666666667 Minutes
        // 2159 done in: 33 Second <=> 0.55 Minutes - in host - lan 1
        // 2177 done in: 27 Second <=> 0.45 Minutes - in host - lan 2
        //UpdateSql::updateAddressMaintain(); // 1862 done in: 685 Second <=> 11.416666666667 Minutes
        // 1917 done in: 30 Second <=> 0.5 Minutes  - in host lan 1
        // 1931 done in: 29 Second <=> 0.483333333333 Minutes  - in host lan 2
//        UpdateSql::updateAddressMaintain('GasMaintainSell'); // 53 done in: 6 Second <=> 0.1 Minutes
        //54 done in: 0 Second <=> 0 Minutes - in host lan 1
        //54 done in: 0 Second <=> 0 Minutes - - in host lan 2
        
        // ##################################################
//        UpdateSql::updateMaintainEmployee('GasMaintainSell'); // it is done 
        // run at Feb-14-2014 2004 done in: 336 Second <=> 5.6 Minutes
        // run at Feb-14-2014 1982 done in: 138 Second <=> 2.3 Minutes 
        // need close line: $this->date_sell =  MyFormat::dateConverD.. GasMaintainSell::setA ... $this->note = In
        // run at Feb-08-2014 result 1456 done in: 210 Second <=> 3.5 Minutes

        // ##################################################
        
//        UpdateSql::updateAllNameVi('GasMaterials'); // it is done        
//        UpdateSql::changeSaveCustomerOfAgent(); // 12-21-2013 done in: 23 Second <=> 0.383333333333 Minutes
//         UpdateSql::deleteCustomerOfAgent(); // 12-21-2013   done in: 0 Second <=> 0 Minutes
//        UpdateSql::updateColumnAddressUser(ROLE_AGENT); // 01-01-2014 done in: 23 Second <=> 0.383333333333 Minutes
//        UpdateSql::updateCashBookTypeCustomer(); // 02-11-2014 103 done in: 1 Second <=> 0.016666666666667 Minutes
//        
// ##################### CPU run about 30% too low #############################
        // cập nhật lại sale và loại customer bò, mối cho KH trong bảng thẻ kho
//        UpdateSql::updateSaleIdForStorecardDetail(); // CPU run about 30% too low, it so good Apr 01, 2014 1173 done in: 107 Second <=> 1.7833333333333 Minutes, nexxt 1173 done in: 9 Second <=> 0.15 Minutes
        //// ngày Apr 16, 2014 chạy cập nhật sale cho KH thẻ kho từ ngày 01-04-2014 do có 1 sale lên làm trưởng phòng, nên chia lại KH cho sale khác
        //// ngày Apr 16, 2014  1228 done in: 133 Second <=> 2.2166666666667 Minutes 
        //1173 done in: 105 Second <=> 1.75 Minutes
        // May 07, 2014 1893 done in: 12 Second <=> 0.2 Minutes
// ##################### CPU run about 30% too low #############################
        
        
        // Apr 19, 2014 AddSubUserAgent 
//        GasCheck::AddSubUserAgent();
//        GasCheck::ChangeUsernameAgent();
//        GasCheck::UpdateUsernameSubAgent();
        // Apr 19, 2014 AddSubUserAgent 
        
        // May 03, 2014  
//        UpdateSql::copyCustomerFromAgentToNewAgent();
//        
        // May 06, 2014  
//        UpdateSql::UpdateAgentForOrder(); // 212 done in: 1 Second <=> 0.016666666666667 Minutes
        // May 13, 2014  15:20
//        UpdateSql::updateChangeSaleIdOfCustomer(); // 212 done in: 1 Second <=> 0.016666666666667 Minutes
//        
        // May 20, 2014  18:16
//        UpdateSql::updateMaterialTypeIdStorecardDetail(); // 276 done in: 7 Second <=> 0.11666666666667 Minutes
//        UpdateSql::updateMaterialTypeIdByModel('GasMaterialsOpeningBalance'); 
//        UpdateSql::updateTypeCustomerAgent(); //46 done in: 6 Second <=> 0.1 Minutes
//        
//        // hàm này chạy cập nhật nhập xuất tồn đại lý năm 2014 hoặc 1 năm nào đó 2028 chẳng hạn
//        UpdateSql::Agent2014UpdateImportExport(); // need run Jun 09, 2014 - 46 done in: 6 Second <=> 0.1 Minutes
//        // hàm này chạy cập nhật nhập xuất tồn đại lý năm 2014 hoặc 1 năm nào đó 2028 chẳng hạn
        
//        UpdateSql::CustomerUpdateParentId();// chưa chạy lần nào
        
//        UpdateSql::updateColumnAddressUser(array(ROLE_EMPLOYEE_MAINTAIN, ROLE_ACCOUNTING_AGENT, ROLE_DRIVER,),
//                array('address_vi')
//                );// 172 done in: 1 Second <=> 0.016666666666667 Minutes
        
        /** Oct 14, 2014
         * @Todo: sửa 1 số PTTT ngày trước chỉ nhập bên file scan, không tự động tạo bên PTTT và new Customer
         * Chú ý khi chạy hàm này thì phải login vào useser đại lý để chạy đúng parent_id
         */
//        GasFileScan::FixFileScanOld(1561); // đã run success 09:37 Oct 14, 2014
//        GasFileScan::FixFileScanOld(1614); // đã run success 09:37 Oct 15, 2014

        // Apr 04, 2015 AddSubUserAgent 
//        UpdateSql::UpdateLastPurchase();
        // Apr 04, 2015 AddSubUserAgent 
        
        // #### BIG JOB 2015 - Dec 06, 2015 cut data ############
//        UpdateCutData::run();
        // #### BIG JOB 2015 - Dec 06, 2015 cut data ############
        // Dec 18, 2015 ChangeSaleCustomer
//        UpdateSql::ChangeSaleCustomer();
        // Dec 18, 2015 ChangeSaleCustomer
        
        echo 'You go to end function ajax';die;
    }
    
    public function actionGet_slt_district()
    {
        if(isset($_GET['ajax']) && $_GET['ajax']==1){                
            $province_id = (int)$_GET['province_id'];
            $session=Yii::app()->session;
            $session['PROVINCE_ID'] = $province_id;
            $aDis = GasDistrict::getArrAll($province_id);
            $html_district='';
            if(count($aDis)>0){
                $html_district.='<option value="">Select</option>';
                foreach($aDis as $key=>$item){
                    $selected = '';
//                    if($_GET['catId']==$key)
//                        $selected = 'selected="selected"';
                    $html_district.='<option value="'.$key.'" '.$selected.'>'.$item.'</option>';
                }
            }
            else
                $html_district.='<option value="">Select</option>';            
            $json = CJavaScript::jsonEncode(array('html_district'=>$html_district));            
            echo $json;die;            
        } 	
    } 	
        
   public function actionGet_slt_ward()
    {
        if(isset($_GET['ajax']) && $_GET['ajax']==1){                
            $province_id = (int)$_GET['province_id'];
            $district_id = (int)$_GET['district_id'];
            $aDis = GasWard::getArrAll($province_id, $district_id);
            $html_district='';
            if(count($aDis)>0){
                $html_district.='<option value="">Select</option>';
                foreach($aDis as $key=>$item){
                    $selected = '';
//                    if($_GET['catId']==$key)
//                        $selected = 'selected="selected"';
                    $html_district.='<option value="'.$key.'" '.$selected.'>'.$item.'</option>';
                }
            }
            else
                $html_district.='<option value="">Select</option>';            
            $json = CJavaScript::jsonEncode(array('html_district'=>$html_district));
            echo $json;die;            
        } 	
    }     
		     
   public function actionGet_slt_monitoring_employee()
    {
        if(isset($_GET['ajax']) && $_GET['ajax']==1){                
            $monitoring_id = $_GET['monitoring_id'];
            $aRes =Users::getSelectByRoleForAgent($monitoring_id, ONE_MONITORING_MARKET_DEVELOPMENT,'', array('status'=>STATUS_ACTIVE));
            $html='';
            if(count($aRes)>0){    
                $html.='<option value="">Select</option>';                
                foreach($aRes as $key=>$item){
                    $selected = '';
                    $html.='<option value="'.$key.'" '.$selected.'>'.$item.'</option>';
                }
            }
            else
                $html.='<option value="">Select</option>';            
            $json = CJavaScript::jsonEncode(array('html'=>$html));            
            echo $json;die;            
        } 	
    }     
		
//*****************************  11-08-2013 Nguyen Dung auto complete of search agent **************************************//
    public function actionAutocomplete_data_streets(){ 
        $criteria = new CDbCriteria();            
        $session=Yii::app()->session;
        $criteria->addSearchCondition('t.name_vi', $_GET['term'], true); // true ==> LIKE '%...%'            
//            $criteria->limit = 50;
        $models = GasStreet::model()->findAll($criteria);
        $returnVal=array();
        foreach($models as $model)
        {
            $returnVal[] = array(    
                'label'=>$model->name,
                'value'=>$model->name,
                'id'=>$model->id,
                'name_vi'=>$model->name_vi,
                'province_id'=>$model->province_id,
            );
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }       

    public function actionIframe_create_district(){
        try
        {
            $this->layout='ajax';
            $model=new GasDistrict('create');
            if(isset($_POST['GasDistrict']))
            {
                    $model->attributes=$_POST['GasDistrict'];
                    if($model->save()){
                        Yii::app()->user->setFlash('successUpdate', "Thêm mới thành công.");
                        $this->redirect(array('iframe_create_district'));
                    }
            }
            $this->render('iframe/Iframe_create_district',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
            }                        
    }

    public function actionIframe_create_ward(){
        try
        {
            $this->layout='ajax';
            $model=new GasWard('create');
            if(isset($_POST['GasWard']))
            {
                    $model->attributes=$_POST['GasWard'];
                    if($model->save()){
                        Yii::app()->user->setFlash('successUpdate', "Thêm mới thành công.");
                        $this->redirect(array('Iframe_create_ward'));
                    }
            }
            $this->render('iframe/Iframe_create_ward',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
            }                        
    }

    public function actionIframe_create_street(){
        try
        {
            $this->layout='ajax';
            $model=new GasStreet('create');
            if(isset($_POST['GasStreet']))
            {
                    $model->attributes=$_POST['GasStreet'];
                    if($model->save()){
                        Yii::app()->user->setFlash('successUpdate', "Thêm mới thành công.");
                        $this->redirect(array('Iframe_create_street'));
                    }
            }
            $this->render('iframe/Iframe_create_street',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
            }                        
    }

   public function actionUpdate_market_development_employee(){
        $this->layout='ajax';
        $model=new GasOneMany();		
        $msg='';
        $model->one_id = $_GET['employee_id'];
        if(isset($_POST['GasOneMany'])){			
            GasOneMany::saveArrOfManyId($model->one_id, ONE_MONITORING_MARKET_DEVELOPMENT);
            $msg='Cập Nhật Thành Công';
        }
        $model->many_id = GasOneMany::getArrOfManyId($model->one_id, ONE_MONITORING_MARKET_DEVELOPMENT);
        $this->render('one_many/Update_market_development_employee',array('model'=>$model,'msg'=>$msg));
    }
    
    /**
     * @Author: ANH DUNG Dec 06, 2014
     * @Todo: làm phần 1 user quản lý nhiều sub user thuộc nhiều role khác nhau
     * Hiện tại: 1 tổ trưởng bảo trì quản lý nhiều nhân viên bảo trì
     */
   public function actionUpdate_manage_multiuser(){
        $this->layout='ajax';
        $model=new GasOneMany();
        $msg='';
        $model->one_id = $_GET['employee_id'];
        if(isset($_POST['GasOneMany'])){
            GasOneMany::saveArrOfManyId($model->one_id, ONE_USER_MANAGE_MULTIUSER);
            $msg='Cập Nhật Thành Công';
        }
        $model->many_id = GasOneMany::getArrOfManyId($model->one_id, ONE_USER_MANAGE_MULTIUSER);
        $this->render('one_many/update_manage_multiuser',array('model'=>$model,'msg'=>$msg));
    }
    

//*****************************  auto complete of search agent **************************************//
    // -- Nguyen Dung
    public function actionSearch_customer_by_seri(){ 
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        
        $criteria = new CDbCriteria();
        /********* get seri CustomerMaintain *****/
        $criteria->compare('t.seri_no', $_GET['term'], true); 
        if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT){
            $criteria->compare('t.agent_id', MyFormat::getAgentId()); 
        }
        $criteria->addCondition("t.created_date>='".MyFormat::GetDateLimitSearchCustomerPttt()."'");
        $criteria->order = 't.id DESC';
        $criteria->limit = 30;
        $models = GasMaintain::model()->findAll($criteria);
        /********* get seri CustomerMaintain *****/            
        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
                'label'=>"Seri: $model->seri_no - ".$model->customer->code_bussiness.' -- '.$cmsFormat->formatNameUser($model->customer).' -- '.$model->customer->phone,
                'value'=> $model->seri_no,
                'name_customer'=> $cmsFormat->formatNameUser($model->customer),
                'id'=>$model->customer->id,
                'name_agent'=>$model->customer->name_agent,
                'code_account'=>$model->customer->code_account,
                'code_bussiness'=>$model->customer->code_bussiness,
                'address'=>$model->customer->address,
                'phone'=>$model->customer->phone,
                'seri_no'=>$model->seri_no,
            );
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }    		

//******** Dùng cho KH thẻ kho, bình bò vs mối. sẽ giới hạn KH trong danh sách KH của đại lý
// **************************************//
    // -- Nguyen Dung - use at gasstorecard/_form       
    public function actionSearch_user_by_code(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        
        $criteria = new CDbCriteria();
        $cRole = Yii::app()->user->role_id;
        // giới hạn chỉ search kh của agent, còn admin thì dc search all
        if($cRole==ROLE_SUB_USER_AGENT){
            $session=Yii::app()->session;
            // check session và cờ CẬP NHẬT của đại lý, nếu=1 thì khởi tạo lại session 
            if(!isset($session['CUSTOMER_OF_AGENT']) || Yii::app()->user->first_char ){
                $session['CUSTOMER_OF_AGENT'] = GasAgentCustomer::getCustomerOfAgent(MyFormat::getAgentId());
                // cập nhật cờ báo đại lý có KH mới về 0
                Users::updateFirstChar(Yii::app()->user->parent_id, 0);
            } 
            $criteria->addInCondition('t.id', $session['CUSTOMER_OF_AGENT']);
            $criteria->addCondition(" t.role_id = ".ROLE_AGENT."", "OR"); 
        }
        // end giới hạn chỉ search kh của agent, còn admin thì dc search all
                
//            $criteria->addCondition(" ( t.role_id=".ROLE_CUSTOMER." AND t.type=".CUSTOMER_TYPE_STORE_CARD." OR t.role_id=".ROLE_AGENT. ") "); 
        $criteria->addCondition(" t.role_id IN ('".ROLE_CUSTOMER."', '".ROLE_AGENT."')"); 
        
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $aTypeNot = array(CUSTOMER_TYPE_MAINTAIN, CUSTOMER_TYPE_MARKET_DEVELOPMENT);
        $criteria->addNotInCondition( 't.type', $aTypeNot);
        if($cRole == ROLE_SALE || $cRole == ROLE_EMPLOYEE_MARKET_DEVELOPMENT){
            $criteria->compare('t.sale_id', Yii::app()->user->id);
        }
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {
            $TypeCustomer = '';
            if($model->is_maintain){
                $TypeCustomer = (isset(CmsFormatter::$CUSTOMER_BO_MOI[$model->is_maintain])?CmsFormatter::$CUSTOMER_BO_MOI[$model->is_maintain]:"");
            }
            
            $label = $cmsFormat->formatNameUser($model)." - $TypeCustomer".' - '.($model->district?$model->district->name:'');
            $name_agent = $model->name_agent;
            $name_customer = "".$cmsFormat->formatNameUser($model)." - KH $TypeCustomer";
            
            if($model->role_id==ROLE_AGENT){
                $addText = "Cty HƯỚNG MINH - ";
                $label = $addText.$cmsFormat->formatNameUser($model).' -- '.($model->district?$model->district->name:'')."";
                $name_agent = $addText.$model->name_agent;
                $name_customer = $addText.$cmsFormat->formatNameUser($model);
            }
            $returnVal[] = array(
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=> $label,
                'value'=>$cmsFormat->formatNameUser($model),
                'name_customer'=> $name_customer,
                'id'=>$model->id,
                'name_agent'=> $name_agent,
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone,
                'is_maintain'=>$model->is_maintain, // Loại Kh bình bò, bình mối
            );
            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }    		

//******** Dùng cho lúc tạo sổ quỹ, là KH dc tạo bên KH thẻ kho, bình bò vs mối. auto complete of search all user in system  **************************************//
    // -- Nguyen Dung - use at gasstorecard/_form       
    public function actionSearch_user_cash_book(){ 
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
//            $criteria->addCondition(" ( t.role_id=".ROLE_CUSTOMER." AND t.type=".CUSTOMER_TYPE_STORE_CARD." OR t.role_id=".ROLE_AGENT. ") "); 
        $criteria->addCondition(" t.role_id IN ('".ROLE_CUSTOMER."', '".ROLE_AGENT."')"); 
//            $criteria->addSearchCondition('t.code_bussiness', $_GET['term'], true); // true ==> LIKE '%...%'
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $aTypeNot = array(CUSTOMER_TYPE_MAINTAIN, CUSTOMER_TYPE_MARKET_DEVELOPMENT);
        $criteria->addNotInCondition( 't.type', $aTypeNot);
        $criteria->compare('t.area_code_id', MyFormat::getAgentId());
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {
            $TypeCustomer = '';
            if($model->is_maintain){
                $TypeCustomer = isset(CmsFormatter::$CUSTOMER_BO_MOI[$model->is_maintain])?CmsFormatter::$CUSTOMER_BO_MOI[$model->is_maintain]:"";
            }
            
            $label = $cmsFormat->formatNameUser($model)." - $TypeCustomer".' - '.($model->district?$model->district->name:'');
            $name_agent = $model->name_agent;
            $name_customer = "".$cmsFormat->formatNameUser($model)." - KH $TypeCustomer";
            
            if($model->role_id==ROLE_AGENT){
                $addText = "Cty HƯỚNG MINH - ";
                $label = $addText.$cmsFormat->formatNameUser($model).' -- '.($model->district?$model->district->name:'')."";
                $name_agent = $addText.$model->name_agent;
                $name_customer = $addText.$cmsFormat->formatNameUser($model);
            }            
            
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=>$label,
                'value'=>$cmsFormat->formatNameUser($model),
                'name_customer'=> $name_customer,
                'id'=>$model->id,
                'name_agent'=>$model->name_agent,
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone
            );
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
//******** search tất cả KH thẻ kho, bình bò vs mối. dùng cho lúc view đại lý, add customer cho đại lý
// để giới hạn lại customer của KH đó khi search customer ở thẻ kho ( có thể ở cash book nữa )
// http://localhost/gas-dev/gas/admin/gasagent/view/id/100
//  **************************************//
    // -- Nguyen Dung - use at gasstorecard/_form       
    public function actionSearch_all_customer_storecard(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $cRole = Yii::app()->user->role_id;
        $cUid = Yii::app()->user->id;
        $models = Users::getDataAutocomplete($_GET['term'], $cRole, $cUid);
        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {
            
            $TypeCustomer = '';
            if($model->is_maintain){
                $TypeCustomer = isset(CmsFormatter::$CUSTOMER_BO_MOI[$model->is_maintain])?CmsFormatter::$CUSTOMER_BO_MOI[$model->is_maintain]:"";
            }
            
            $label = $cmsFormat->formatNameUser($model)." - $TypeCustomer".' - '.($model->district?$model->district->name:'');
            $name_agent = $model->name_agent;
            $name_customer = "".$cmsFormat->formatNameUser($model)." - KH $TypeCustomer";
            
            if($model->role_id==ROLE_AGENT){
                $addText = "Cty HƯỚNG MINH - ";
                $label = $addText.$cmsFormat->formatNameUser($model).' -- '.($model->district?$model->district->name:'')."";
                $name_agent = $addText.$model->name_agent;
                $name_customer = $addText.$cmsFormat->formatNameUser($model);
            }
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=> $label,
                'value'=>$cmsFormat->formatNameUser($model),
                'name_customer'=> $name_customer,
                'id'=>$model->id,
                'name_agent'=> $name_agent,
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone
            );
            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }    		
    
    public function actionSearch_for_bussiness_contract(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        
        $criteria = new CDbCriteria();
//        $criteria->addCondition(" t.role_id IN ('".ROLE_SALE."', '".ROLE_SUB_USER_AGENT."')"); 
//        $criteria->addCondition(" ( t.role_id=".ROLE_SALE." AND t.gender<>".Users::SALE_MOI." ) "
//                . " OR ( t.role_id=".ROLE_SUB_USER_AGENT." ) OR ( t.role_id=".ROLE_EMPLOYEE_MAINTAIN." )"); 
        $criteria->addCondition(" ( t.role_id=".ROLE_SALE." AND t.gender<>".Users::SALE_MOI." ) "
                . " OR ( t.role_id=".ROLE_SUB_USER_AGENT." ) "
                . " OR ( t.role_id=".ROLE_MONITOR_AGENT." ) "
                . ""); 
        
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $criteria->addNotInCondition( 't.parent_id', CmsFormatter::$LIST_WAREHOUSE_ACCOUNT);

        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {            
            $label = $model->first_name;
            $name_agent = $label;
            $name_customer = $label;
            
            if($model->role_id==ROLE_EMPLOYEE_MAINTAIN){
                $label = "NVGH- ".$model->first_name;
                $name_agent = $label;
                $name_customer = $label;
            }elseif($model->role_id==ROLE_SALE){
//                $addText = "Cty HƯỚNG MINH - ";
                $label = ActiveRecord::FormatNameSale($model);
                $name_agent = $label;
                $name_customer = $label;
            }
            
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $name_customer,
                'id'=>$model->id,
                'name_agent'=> $name_agent,
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    /**
     * @Author: ANH DUNG Mar 06, 2015
     * @Todo: search nguoi tao for admin/gasSupportCustomer/index
     */
    public function actionSearch_for_user_login(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        
        $criteria = new CDbCriteria();
//        $criteria->addInCondition("t.role_id", CmsFormatter::$aRoleMemLogin);
        $criteria->addNotInCondition('t.role_id',  CmsFormatter::$aRoleMemNotLogin);
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {            
            $label = $cmsFormat->formatNameAndRole($model);
            $name_agent = $label;
            $name_customer = $label;
            
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $name_customer,
                'id'=>$model->id,
                'name_agent'=> $name_agent,
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    public function actionSearch_for_ccdc_tool(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $aRoleSearch = array(ROLE_AGENT, ROLE_EMPLOYEE_MAINTAIN, ROLE_EMPLOYEE_MARKET_DEVELOPMENT);
        
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $criteria->addInCondition( 't.role_id', $aRoleSearch);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);
        $session=Yii::app()->session;

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {            
            $label = $model->first_name." - ". $session['ROLE_NAME_USER'][$model->role_id];
            $name_agent = $label;
            $name_customer = $label;
            
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $name_customer,
                'id'=>$model->id,
                'name_agent'=> $name_agent,
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    public function actionSearch_for_ticket(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $RoleAllow = array(ROLE_SUB_USER_AGENT, ROLE_DIEU_PHOI);
        $criteria->addInCondition( 't.role_id', $RoleAllow);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {            
//            $addPrefix = "Sale - ";
//            $label = $addPrefix.$cmsFormat->formatNameUser($model)."";
//            $name_agent = $label;
//            $name_customer = $label;            
            if($model->role_id==ROLE_DIEU_PHOI){
                $label = "Điều Phối - ".$model->first_name;
                $name_agent = $label;
                $name_customer = $label;
            }elseif($model->role_id==ROLE_SUB_USER_AGENT){
                $addText = "Cty HƯỚNG MINH - ";
                $label = $addText.$model->first_name;
                $name_agent = $label;
                $name_customer = $label;
            }
            
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $name_customer,
                'id'=>$model->id,
                'name_agent'=> $name_agent,
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();
    }
    
    // Note at Now 21, 2014 use at: 1/ gasreports/output_customer báo cáo sản lượng khách hàng
    // 2/ dùng ở phần tạo member gắn sale tương tứng
    public function actionSearch_sale(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
//        $criteria->addSearchCondition('t.first_name', $_GET['term'], true); // true ==> LIKE '%...%'
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $RoleAllow = array(ROLE_SALE, ROLE_EMPLOYEE_MARKET_DEVELOPMENT);
        $criteria->addInCondition( 't.role_id', $RoleAllow);
//        $criteria->addInCondition( 't.gender', Users::$aTypeSaleSearch);// Dec 18, 2015 fix limit khi search sale, chỉ ai dc gắn chức vụ thì mới search 
        $criteria->addCondition (""
                    . "( t.gender IN (".  implode(',', Users::$aTypeSaleSearch ).") OR t.role_id=".ROLE_SALE." )"
                    . "");
        
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {            
            $label = MyFormat::BuildNameSaleSystem($model);
            
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $label,
                'id'=>$model->id,
                'name_agent'=> '',
                'code_account'=>$model->code_account,
                'code_bussiness'=> $model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    public function actionSearch_user_login(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
//        $RoleAllow = CmsFormatter::$aRoleMemLogin;
//        $criteria->addInCondition( 't.role_id', $RoleAllow);
        $criteria->addNotInCondition('t.role_id',  CmsFormatter::$aRoleMemNotLogin);
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);
        $session=Yii::app()->session;
        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {            
            $label = $model->first_name." - ".$session['ROLE_NAME_USER'][$model->role_id];
            if($model->role_id == ROLE_SALE){
                $typeSale = isset(Users::$aTypeSale[$model->gender])?Users::$aTypeSale[$model->gender]:'';
                $label = $model->first_name." - ".$typeSale;
            }
            
            $returnVal[] = array(
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $label,
                'id'=>$model->id,
                'name_agent'=> '',
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone,
                'name_role' => $model->getNameWithRole(),
            );
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    /**
     * @Author: ANH DUNG Nov 17, 2015
     */
    public function actionSearch_user_login_not_agent(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $roleNotAllow = CmsFormatter::$aRoleMemNotLogin;
        $roleNotAllow[] = ROLE_AGENT;
        $criteria->addNotInCondition('t.role_id',  $roleNotAllow);
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);
        $session=Yii::app()->session;
        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {            
            $label = $model->first_name." - ".$session['ROLE_NAME_USER'][$model->role_id];
            if($model->role_id == ROLE_SALE){
                $typeSale = isset(Users::$aTypeSale[$model->gender])?Users::$aTypeSale[$model->gender]:'';
                $label = $model->first_name." - ".$typeSale;
            }
            
            $returnVal[] = array(
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $label,
                'id'=>$model->id,
                'name_agent'=> '',
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone,
                'name_role' => $model->getNameWithRole(),
            );
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    /**
     * @Author: ANH DUNG Sep 06, 2014
     * @Todo: thay thế cho dropdown search agent
     */
    public function actionSearch_dropdown_agent(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $RoleAllow = array(ROLE_AGENT);
        $criteria->addInCondition( 't.role_id', $RoleAllow);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);
        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        
        foreach($models as $model)
        {            
            $label = $model->first_name;
            $returnVal[] = array(    
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $label,
                'id'=>$model->id,
                'name_agent'=> '',
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone,
                'name_role' => $model->getNameWithRole(),
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    
    /**
     * @Author: ANH DUNG Sep 25, 2015
     * @Todo: search ở bảng oneMany, giới hạn user cho từng phần xử lý
     * như duyệt phép, Đơn Vị Thực Hiện ...
     */
    public function actionSearchLimitByFunction(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        if(isset($_GET['type']) && in_array($_GET['type'], GasOneManyBig::$TYPE_ALLOW_AUTO)){
            $uidLimit = GasOneManyBig::getArrOfManyId($_GET['type'], $_GET['type']);
            $criteria->addInCondition('t.id', $uidLimit);
        }

        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);
        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        
        foreach($models as $model)
        {            
            $label = $model->first_name;
            $returnVal[] = array(    
                'label'=> $label,
                'value'=> $label,
                'name_customer'=> $label,
                'id'=>$model->id,
                'name_agent'=> '',
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone,
                'name_role' => $model->getNameWithRole(),
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    /**
     * @Author: ANH DUNG Sep 06, 2014
     * @Todo: thay thế cho dropdown search agent
     */
    public function actionSupportCustomerDeloyBy(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $RoleAllow = array(ROLE_AGENT,
            ROLE_E_MAINTAIN, // NV Bảo Trì
            ROLE_TECHNICAL, // NV  Kỹ Thuật
            ROLE_HEAD_TECHNICAL, // Trưởng Phòng Kỹ Thuật
            ROLE_HEAD_OF_MAINTAIN, //Tổ Trưởng Tổ Bảo Trì
        );
        $criteria->addInCondition( 't.role_id', $RoleAllow);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);
        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        
        foreach($models as $model)
        {            
            $label = $model->first_name;
            $returnVal[] = array(    
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $label,
                'id'=>$model->id,
                'name_agent'=> '',
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone,
                'name_role' => $model->getNameWithRole(),
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: search user nghi pheps: admin/gasLeave/create
     * @Param: $model
     */
    public function actionSearch_user_leave(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
        $session=Yii::app()->session;
        $cRoleId = Yii::app()->user->role_id;
        $cUid = Yii::app()->user->id;
        // 1. neu role la giam sat PTTT
        if( $cRoleId == ROLE_MONITORING_MARKET_DEVELOPMENT ){
            if(!isset($session['TEAM_MONITOR_MARKET_DEV'])){
                $session['TEAM_MONITOR_MARKET_DEV'] = GasOneMany::getArrOfManyId(Yii::app()->user->id, ONE_MONITORING_MARKET_DEVELOPMENT);
            }
            $criteria->addInCondition( 't.id', $session['TEAM_MONITOR_MARKET_DEV']);
        }elseif ( $cRoleId == ROLE_SUB_USER_AGENT) {
            // 2. neu role la sub agent - dai ly
            if(!isset($session['TEAM_OF_SUB_AGENT'])){
                // nhân viên giao hàng
                $ONE_AGENT_MAINTAIN = GasOneMany::getArrOfManyId( MyFormat::getAgentId(), ONE_AGENT_MAINTAIN);
                // kế toán đại lý
                $ONE_AGENT_ACCOUNTING = GasOneMany::getArrOfManyId( MyFormat::getAgentId(), ONE_AGENT_ACCOUNTING);
                $session['TEAM_OF_SUB_AGENT'] = array_merge($ONE_AGENT_MAINTAIN, $ONE_AGENT_ACCOUNTING);
            }
            $criteria->addInCondition( 't.id', $session['TEAM_OF_SUB_AGENT']);
        
        }elseif($cRoleId != ROLE_ADMIN ){ // Sep 11, 2015
            if(!isset($session['TEAM_OF_MAINTAIN'])){
                $aManyId = GasOneMany::getArrOfManyId( $cUid, ONE_USER_MANAGE_MULTIUSER );
                $aManyId[$cUid] = $cUid;
                $session['TEAM_OF_MAINTAIN'] = $aManyId;
            }
            $criteria->addInCondition( 't.id', $session['TEAM_OF_MAINTAIN']);
        }
        
        // Close On Sep 11, sửa lại điều kiện để tất cả user có thể search nhân viên dưới quyền
//        elseif (in_array ($cRoleId, GasLeave::$ROLE_HEAD_OF_MAINTAIN) || 
//                in_array($cUid, GasLeave::$UID_SEARCH_USER)
//                ) { // Tổ Trưởng Tổ Bảo Trì + (Dec 16, 2014) NV Kinh Doanh Dự Án
//            // 1 nhân viên có thể search tạo phép cho những nhân viên dưới quyền
//            if(!isset($session['TEAM_OF_MAINTAIN'])){
//                $aManyId = GasOneMany::getArrOfManyId( $cUid, ONE_USER_MANAGE_MULTIUSER );
//                $aManyId[$cUid] = $cUid;
//                $session['TEAM_OF_MAINTAIN'] = $aManyId;
//            }
//            $criteria->addInCondition( 't.id', $session['TEAM_OF_MAINTAIN']);
//        }else{
//            // 3, neu role khac thi them dk la role_id != role_admin
//            $criteria->addCondition( 't.role_id<>'.ROLE_ADMIN);
//        }
        
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $criteria->addNotInCondition( 't.role_id', array(ROLE_CUSTOMER, ROLE_ADMIN, ROLE_AGENT, ROLE_SECURITY_SYSTEM));
        $criteria->compare('t.status', STATUS_ACTIVE);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {            
            $label = $model->first_name." - ". $session['ROLE_NAME_USER'][$model->role_id];
            $name_agent = $label;
            $name_customer = $label;
            
            $returnVal[] = array(    
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $name_customer,
                'id'=>$model->id,
                'name_agent'=> $name_agent,
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }
    
    /**
     * @Author: ANH DUNG Dec 21, 2015
     * @Todo: search by role sys
     */
    public function actionSearch_by_role(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        $criteria = new CDbCriteria();
        $criteria->addSearchCondition('t.address_vi', $_GET['term'], true); // true ==> LIKE '%...%'
        $RoleAllow = isset($_GET['role']) ? (explode(",", $_GET['role'])) : array();
        $criteria->addInCondition( 't.role_id', $RoleAllow);
        $criteria->addNotInCondition( 't.role_id', Roles::$aRoleRestrict);
        $criteria->limit = 30;
        $models = Users::model()->findAll($criteria);
        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        $session=Yii::app()->session;
        
        foreach($models as $model)
        {            
            $label = $model->first_name." - ".$session['ROLE_NAME_USER'][$model->role_id];
            if($model->role_id == ROLE_SALE){
                $typeSale = isset(Users::$aTypeSale[$model->gender])?Users::$aTypeSale[$model->gender]:'';
                $label = $model->first_name." - ".$typeSale;
            }elseif ($model->role_id == ROLE_E_MAINTAIN) {
                $label = $model->first_name." - ".$model->getTypeCustomerText();
            }
            
            $returnVal[] = array(    
               'label'=> $label,
                'value'=> $label,
                'name_customer'=> $label,
                'id'=>$model->id,
                'name_agent'=> '',
                'code_account'=>$model->code_account,
                'code_bussiness'=>$model->code_bussiness,
                'address'=>$model->address,
                'phone'=>$model->phone,
                'name_role' => $model->getNameWithRole(),
            );            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }

    /**
     * @Author: ANH DUNG 01-16-2013
     * @Todo: ghi log khi xoa 1 record ben duoi, co the chua xoa trong db, nhung cu ghi lai
     * đang sử dụng cho sổ quỹ để theo dõi. 
     * Chắc chỉ sử dụng hàm này cho xóa GasCashBookDetail, vì nó custom thông tin ghi vào nhiều quá
     */
    public function actionDelete_model(){
        if(isset($_POST['id']) && isset($_POST['className'])){
            $_POST['className'] = ActiveRecord::safeField($_POST['className']);
            $modelTmp = call_user_func(array($_POST['className'], 'model'));        
            $model = $modelTmp->findByPk( $_POST['id'] );
            if($model){
                ActiveRecord::Log(Yii::app()->user->id, ActiveRecord::buildLogMessage($model), 'Gascashbook');
            }
        }
        die;
    }
   
    public function actionGetHistoryCustomerBuy(){
        $html='';
        $cmsFormat = new CmsFormatter();
        if(isset($_GET['customer_id'])){
            $mMaintainSell = GasMaintainSell::getByCustomerId($_GET['customer_id']);
            if(count($mMaintainSell)){
                foreach($mMaintainSell as $key=>$item){       
                    $html.='<div class="box_276">';
                   if($key==0)
                        $html.="<b>Bán Hàng lần: ".($key+1)." </b>";
                   else
                        $html.="<font style='color:red'><b>Bán Hàng lần: ".($key+1)." </b></font>";
                   $html.="<br>Ngày : ".$cmsFormat->formatDate($item->date_sell)." ";
                   $html.="<br>Nhân Viên PTTT: ".($item->maintain_employee?$item->maintain_employee->first_name:'')." ";
                   $html.="<br>Gas Bán: ".($item->materials_sell?$item->materials_sell->name:'')." ";
                   $html.="<br>Thương Hiệu Gas Thu Về : ".($item->materials_back?$item->materials_back->name:'')." ";
                   $html.="<br>Seri Thu Về: ".$item->seri_back;
                   $html.='</div>';
                }
            }
        }        
        $json = CJavaScript::jsonEncode(array('html'=>$html));            
        echo $json;die; 
    }

    /**
     * @Author: ANH DUNG Mar 01, 2014
     * @Todo: cập nhật cân gas lần 2 và l lần 3
     * @Param: $_GET id model GasRemain
     */    
    public function actionUpdate_gas_remain(){
        try
        {
            $this->layout='ajax';
            if(!isset($_GET['id']) || !isset($_GET['type']) || !in_array( $_GET['type'], array(2,3) )){
                throw new Exception('Đã chỉnh sửa firebug, yêu cầu không hợp lệ.');
            }
            $model = GasRemain::model()->findByPk($_GET['id']);
            if(is_null($model)) {
                throw new Exception('Gasremain Id không tồn tại, yêu cầu không hợp lệ.');
            }
            $model->scenario = 'update_amount_gas_'.$_GET['type'] ;
            
            if(isset($_POST['GasRemain']))
            {
                $model->attributes=$_POST['GasRemain'];
                $model->validate();
                if(!$model->hasErrors()){
                    $attUpdate = array();
                    if($_GET['type']==2){
                        $model->user_update_2 = Yii::app()->user->id;
                        $model->date_update_2 = date('Y-m-d H:i:s');
                        $attUpdate[]='user_update_2';
                        $attUpdate[]='date_update_2';
                        $attUpdate[]='amount_gas_2';
                    }else{
                        $model->user_update_3 = Yii::app()->user->id;
                        $model->date_update_3 = date('Y-m-d H:i:s');
                        $attUpdate[]='user_update_3';
                        $attUpdate[]='date_update_3';
                        $attUpdate[]='amount_gas_3';
                    }
                    $model->update($attUpdate);
                    die('<script type="text/javascript">parent.$.fn.colorbox.close(); parent.$.fn.yiiGridView.update("gas-remain-grid"); </script>'); 
                    Yii::app()->user->setFlash('successUpdate', "Cập nhật thành công.");
                    $this->redirect(array('Update_gas_remain', 'id'=>$model->id,'type'=>$_GET['type']));
                }
            }
            $model->amount_gas_vo_binh = '';
            if($_GET['type']==2 && $model->user_update_2){
                $model->amount_gas_vo_binh = $model->amount_empty+$model->amount_gas_2;
            }elseif($_GET['type']==3 && $model->user_update_3){
                $model->amount_gas_vo_binh = $model->amount_empty+$model->amount_gas_3;
            }
            
            
            $this->render('Update_gas_remain',array(
                    'model'=>$model, 'actions' => $this->listActionsCanAccess,
            ));
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
            }        
    }
    
    // hủy cập nhật
    public function actionRemove_update_gas_remain(){
        try
        {
            if(!isset($_GET['id']) || !isset($_GET['type']) || !in_array( $_GET['type'], array(2,3) )){
                throw new Exception('Đã chỉnh sửa firebug, yêu cầu không hợp lệ.');
            }
            $model = GasRemain::model()->findByPk($_GET['id']);
            if(is_null($model)) {
                throw new Exception('Gasremain Id không tồn tại, yêu cầu không hợp lệ.');
            }
            $attUpdate = array();
            if($_GET['type']==2){
                $model->user_update_2 = null;
                $model->date_update_2 = null;
                $model->amount_gas_2 = null;
                $attUpdate[]='user_update_2';
                $attUpdate[]='date_update_2';
                $attUpdate[]='amount_gas_2';
            }else{
                $model->user_update_3 = null;
                $model->date_update_3 = null;
                $model->amount_gas_3 = null;
                $attUpdate[]='user_update_3';
                $attUpdate[]='date_update_3';
                $attUpdate[]='amount_gas_3';
            }
            $model->update($attUpdate);
            $json = CJavaScript::jsonEncode(array('success'=>true));            
            echo $json;die;   
            
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
            }          
    }
    
    // 10-31-2013 ANH DUNG
    public function actionDetermineGasGoBack_export_excel(){
        if(isset($_SESSION['data-excel-gas-go-back'])){
            set_time_limit(7200);
            ExportList::DetermineGasGoBack_export_excel();
        }
        $this->redirect(Yii::app()->createAbsoluteUrl('admin/gasreports/determineGasGoBack'));                        
    }        
    
    
    public function actionGetPriceBinhBoByMonth(){
        try
        {
            if(!isset($_GET['customer_id'])){
                throw new Exception('Đã chỉnh sửa firebug, yêu cầu không hợp lệ.');
            }
            $PriceBinhBoByMonth = GasStoreCard::getPriceBinhBoCurrentMonth($_GET['customer_id']);
            $json = CJavaScript::jsonEncode(array('PriceBinhBoByMonth'=>$PriceBinhBoByMonth));            
                echo $json;die;
            }
            catch (Exception $e)
            {
                Yii::log("Exception ".  $e->getMessage(), 'error');
                $code = 404;
                if(isset($e->statusCode))
                    $code=$e->statusCode;
                if($e->getCode())
                    $code=$e->getCode();
                throw new CHttpException($code, $e->getMessage());
            }          
    }    
    
    /**
     * @Author: ANH DUNG Jun 22, 2014
     * @Todo: search mã lần cân số 1 của giao nhận gas dư
     */
    public function actionSearch_remain_export_code(){
        if(!isset($_GET['term']))
            throw new CHttpException(404, "Uid: " .Yii::app()->user->id. " cố gắng truy cập link không phải ajax");
        
        $criteria = new CDbCriteria();
        $criteria->compare("t.serial", 1);// lần cân đầu tiên
        $criteria->addSearchCondition('t.code_no', $_GET['term'], true); // true ==> LIKE '%...%'
        $criteria->limit = 30;
        $models = GasRemainExport::model()->findAll($criteria);

        $returnVal=array();
        $cmsFormat = new CmsFormatter();
        foreach($models as $model)
        {
            $agentName = $model->rAgent?$model->rAgent->first_name:'';
            $label = "$model->code_no - ".$agentName;
            
            $returnVal[] = array(
                //'label'=>$model->code_account.' - '.$model->code_bussiness.' -- '.$model->first_name,
                'label'=> $label,
                'value'=>$label,
                'agent_id'=> $agentName,
                'id'=>$model->id,
                'code_no'=> $model->code_no,
            );
            
        }
        echo CJSON::encode($returnVal);
        Yii::app()->end();        
    }    	    
    
    public function actionEmptyContent(){
        $this->render('EmptyContent');
    }
    
    public function actionRunCronUpdateFirstPurchase(){
        GasBussinessContract::CronUpdateFirstPurchase();
        Yii::app()->user->setFlash('successUpdate', 'Cập Nhật Thành Công Ngày Lấy Hàng Đầu Tiên Của Khách Hàng ');
        $this->redirect(Yii::app()->createAbsoluteUrl('admin/gasBussinessContract/quick_report'));					
    }
    
    public function actionInfo35(){
        phpinfo();die;
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2014
     */
    public function actionViewImageProfileHs($id){
        $this->layout='ajax';
        $ClassName = 'GasProfileDetail';
        if(isset($_GET['model'])){
            $ClassName = $_GET['model'];
        }
        $model = MyFormat::loadModelByClass($id, $ClassName);
        
        $this->render('ViewImage/ViewImageProfileHs',array(
                'model'=>$model,
                'ClassName'=> $ClassName,
        ));
    }
    
    
    /**
     * @Author: ANH DUNG Sep 04, 2015
     * tập trung vào 1 chỗ để download file giấu link đi
     */
    public function actionForceDownload($id){
        $this->layout='ajax';
        $ClassName = '';
        if(isset($_GET['model'])){
            $ClassName = $_GET['model'];
        }
        if(empty($ClassName)){
            die;
        }
        $model = MyFormat::loadModelByClass($id, $ClassName);
        $src = $model->getSrcForceDownload();
        $fileHelper = new FileHelper();
        $fileHelper->forceDownload($src);
    }
    
    
    /**
     * @Author: ANH DUNG Now 19, 2015
     * @Todo: lấy số lần bảo trì dựa trên số tấn sản lượng Bình quân của KH theo tháng
        admin/gasUpholdSchedule/create
     */
    public function actionGetAverageOutput() {
        $schedule_in_month = 1;
        $session=Yii::app()->session;
        if(isset($session['AVERAGE_OUTPUT_CUSTOMER'])){
            $AVERAGE_OUTPUT_CUSTOMER = $session['AVERAGE_OUTPUT_CUSTOMER'];
            $schedule_in_month = round($AVERAGE_OUTPUT_CUSTOMER/1000);// 1000Kg = 1 Tấn
        }
        $json = array("schedule_in_month"=>$schedule_in_month);
        echo CJavaScript::jsonEncode($json);
        Yii::app()->end();
    }
    
    public function accessRules()
    {
        return array(
            array('allow',   //allow authenticated user to perform actions
                'users'=>array('@'),
            ),
            array('deny',  // deny all users
                    'users'=>array('*'),
            ),
        );
    }

    public function actionIndex(){}	   
    
	   
}