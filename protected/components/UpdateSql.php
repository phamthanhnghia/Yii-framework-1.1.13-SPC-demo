<?php
class UpdateSql
{
		  
    /**
     * @Author: ANH DUNG 11-19-2013
     * @Todo: cập nhật tỉnh, quận huyện, phường xã cho bảo trì vs bán hàng bảo trì
     * UpdateSql::updateAddressMaintain();
     * UpdateSql::updateAddressMaintain('GasMaintainSell');
     */         
    public static function updateAddressMaintain($name_model='GasMaintain'){        
        $from = time();
        $model_ = call_user_func(array($name_model, 'model'));
        $mRes = $model_->findAll();            
        foreach($mRes as $item){
            $item->update(array('province_id','district_id','ward_id'));
        }
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
    }
	  
    /**
     * @Author: ANH DUNG 11-21-2013
     * @Todo: cập nhật thêm cột maintain_employee_id bên bán hàng bảo trì
     * UpdateSql::updateAddressMaintain();
     * UpdateSql::updateAddressMaintain('GasMaintainSell');
     */         
    public static function updateMaintainEmployee($name_model='GasMaintainSell'){
//        set_time_limit(7200);
        $from = time();
        $model_ = call_user_func(array($name_model, 'model'));
        $criteria = new CDbCriteria();
//        $criteria->addCondition('maintain_id<>"" AND maintain_id<>0'); 
        $tableName = $model_->tableName();        
        $mRes = $model_->findAll($criteria);
        foreach($mRes as $item){
            $item->update(array('maintain_employee_id','monitoring_id',
                'accounting_employee_id','is_same_seri_maintain','type',
                'maintain_id',
                ));
        }
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	

    }

    /**
     * @Author: ANH DUNG 11-25-2013
     * @Todo: cập nhật một số cột như: address, address_vi, name_agent, 
     * @từ khi mà thay đổi quản lý địa chỉ khách hàng theo tỉnh, quận huyện, phường, đường
     * UpdateSql::updateColumnAddressUser();
     */       
    public static function updateColumnAddressUser($role_id, $aUpdate = array()){        
        $from = time();
        $criteria = new CDbCriteria();
        if(is_array($role_id)){
            $criteria->addInCondition('t.role_id',$role_id);
        }else{
            echo 123;die;
            $criteria->compare('t.role_id',$role_id);
        }
//        $criteria->compare('t.created_date',date('Y-m-d'),true);
        $mRes = Users::model()->findAll($criteria);
//        echo count($mRes);die;
        if(count($aUpdate)<1)
            $aUpdate = array('address','address_vi','name_agent');
//        $aUpdate = array('address_vi','name_agent');
        foreach($mRes as $item)
        {
            $item->update($aUpdate);
        }		
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
    }

    public static function updateAllNameVi($className){
        $from = time();
        $model_ = call_user_func(array($className, 'model'));        
        $mRes = $model_->findAll();
        foreach($mRes as $item)
        {
            $item->update();
        }		
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
    }    
    
    /**
     * @Author: ANH DUNG 12-21-2013
     * @Todo: sửa lại dữ liệu, thêm cột agent_id (  đã thay = area_code_id ) 
     * vào table user, không dùng session để lưu KH của đại lý nữa, viết sql cập nhật
     * step khi đổi, 
    1/ change lúc save cho các model, khi tạo bảo trì or pttt
    2/ change autocomplete search khi tạo bảo trì or pttt, bán hàng bảo trì
    3/ change criteria search bảo trì or pttt
    4/ run sql cập nhật hết các customer Bảo trì vs pttt
     * UpdateSql::updateColumnAddressUser();
     */        
    public static function changeSaveCustomerOfAgent(){
        $from = time();
        $criteria = new CDbCriteria();
        $criteria->addCondition("t.agent_id IS NOT NULL AND t.customer_id IS NOT NULL  ");
//        $criteria->addCondition("t.employee_maintain_id IS NOT NULL AND t.maintain_agent_id IS NOT NULL  ");
        $models = GasAgentCustomer::model()->findAll($criteria);
        $sql='';
        $tableName = Users::model()->tableName();
        foreach($models as $item){
            $sql .= "UPDATE $tableName SET `area_code_id`=$item->agent_id WHERE `id`=$item->customer_id ;";
            //UPDATE mytable SET (id, column_a, column_b) FROM VALUES ( (1, 12, 6), (2, 1, 45), (3, 56, 3), … );
        }
        Yii::app()->db->createCommand($sql)->execute();
        
        $to = time();
        $second = $to-$from;
        echo count($models).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;          
    }
    
    // 12-21-2013  dùng sau khi chạy hàm trên changeSaveCustomerOfAgent
    public static function deleteCustomerOfAgent(){
        $from = time();
        $criteria = new CDbCriteria();
        $criteria->addCondition("agent_id IS NOT NULL AND customer_id IS NOT NULL  ");
        $models = GasAgentCustomer::model()->deleteAll($criteria);
        $to = time();
        $second = $to-$from;
        echo count($models).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;          
    }
    
    /**
     * @Author: ANH DUNG 02-11-2014
     * @Todo: cập nhật cột type_customer // loại KH 1: Bình Bò, 2: Mối, dùng cho thống kê doanh thu
     * @dùng cho xuất báo cáo doanh thu, ta sẽ không cộng doanh thu của KH bình bò
     * UpdateSql::updateColumnAddressUser();
     */       
    public static function updateCashBookTypeCustomer(){        
        $from = time();
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.customer_id<>0');
        $mRes = GasCashBookDetail::model()->findAll($criteria);
//        echo count($mRes);die;
        $aUpdate = array('type_customer');
        foreach($mRes as $item)
        {
            $item->update($aUpdate);
        }		
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
    }    
    
    /**
     * @Author: ANH DUNG Apr 01, 2014
     * @Todo: update sale_id cho table thẻ kho
     * cập nhật sale id cho khách hàng thẻ kho trong bảng GasStoreCardDetail + GasRemain
     */
    public static function updateSaleIdForStorecardDetail(){
        set_time_limit(72000);
        $from = time();
        $criteria = new CDbCriteria();
       
        $criteria->addCondition(" t.role_id IN ('".ROLE_CUSTOMER."')");
        $aTypeNot = array(CUSTOMER_TYPE_MAINTAIN, CUSTOMER_TYPE_MARKET_DEVELOPMENT);
        $criteria->addNotInCondition( 't.type', $aTypeNot);
        $criteria->addInCondition( 't.is_maintain', CmsFormatter::$ARR_TYPE_CUSTOMER_STORECARD); // Aug 19, 2014 chỉ update KH bò mối thôi, vì cái 
        // type KH của store card hiện tại nó gồm nhiều loại, ko thể update bừa dc
//        $criteria->addCondition( 't.sale_id<>"" AND t.sale_id IS NOT NULL');// có KH không có sale
        $mRes = Users::model()->findAll($criteria);
        echo count($mRes);die;
                
        foreach($mRes as $item)
        {
            // 1. update GasStoreCardDetail CPU run about 30% too low, it so good
            GasStoreCardDetail::model()->updateAll(array('sale_id'=>$item->sale_id,'type_customer'=>$item->is_maintain),
//                    "`customer_id`=$item->id");
                    "`customer_id`=$item->id AND date_delivery>='2016-01-01' ");
            
            // mới thêm phần cập nhật từ ngày nào
//                     run 1: Apr 01, 2014 1173 done in: 107 Second <=> 1.7833333333333 Minutes
//                     run 1: Apr 16, 2014  1228 done in: 133 Second <=> 2.2166666666667 Minutes 
//                     run 1: Apr 25, 2014 sau khi index chạy nhanh kinh khủng 1264 done in: 4 Second <=> 0.066666666666667 Minutes
//                     run 1: Apr 25, 2014 after index  1820 done in: 6 Second <=> 0.1 Minutes
//                     run 2: May 07, 2014 after index  1893 done in: 12 Second <=> 0.2 Minutes
//                     run 3: May 10, 2014 after index  1893 done in: 8 Second <=> 0.13333333333333 Minutes
//                     May 20, 2014  1981 done in: 11 Second
//                     1983 done in: 4 Second <=> 0.066666666666667 Minutes
//                     May 28, 2014 -2027 done in:+ 14 Second <=> 0.23333333333333 Minutes
//                     
            // 2. update gas_gas_remain
//            GasRemain::model()->updateAll(
//                    array('sale_id'=>$item->sale_id, 
//                        'type_customer'=>$item->is_maintain                        
//                    ),
////                    "`customer_id`=$item->id  ");
//                    "`customer_id`=$item->id  AND date_input>='2016-01-01' ");
                        
//                    1173 done in: 9 Second <=> 0.15 Minutes
//                   run 2: Apr 16, 2014  1228 done in: 13 Second <=> 0.21666666666667 Minutes
//                   run 2: Apr 25, 2014  1264 done in: 3 Second <=> 0.05 Minutes
//                   run 2: Apr 25, 2014  1820 done in: 2 Second <=> 0.033333333333333 Minutes
//                   run 3: May 07, 2014  1893 done in: 8 Second <=> 0.13333333333333 Minutes
//                   run 4: May 10, 2014  1893 done in: 4 Second <=> 0.066666666666667 Minutes
//                   May 20, 2014  1981 done in: 3 Second <=> 0.05 Minutes
//                   1983 done in:+ 6 Second <=> 0.1 Minutes
//                   2027 done in:+ 4 Second <=> 0.066666666666667 Minutes
//            sleep(3);
            
            // 3/ dùng để cập nhật loại KH trong bảng GasStoreCard. Sẽ ít dùng
//            GasStoreCard::model()->updateAll(array('type_user'=>$item->is_maintain),
//                    "`customer_id`=$item->id");
            // May 21, 2014 - 1985 done in:+ 5 Second <=> 0.083333333333333 Minutes
        }
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in:+ '.($second).'  Second  <=> '.($second/60).' Minutes';die;
    }   
    
    
    // dung để copy danh sách kh từ 1 đại lý có sẵn sang 1 đại lý mới tạo
    public static function copyCustomerFromAgentToNewAgent(){
        $from = time();
        $agent_from = 106; // Đại lý Bình Thạnh
        $agent_to = 118239; // Kho Bình Thạnh
        $aRowInsert=array();
        $allCustomer = GasAgentCustomer::getCustomerOfAgentAllModel($agent_from);

        if(count($allCustomer)){
            foreach($allCustomer as $model){
                $aRowInsert[]="('$agent_to',
                        '$model->customer_id'
                        )";
            }
            $tableName = GasAgentCustomer::model()->tableName();
            $sql = "insert into $tableName (agent_id,
                        customer_id
                        ) values ".implode(',', $aRowInsert);
            if(count($aRowInsert)>0)
                Yii::app()->db->createCommand($sql)->execute();	
        }
        
        $to = time();
        $second = $to-$from;
        echo count($allCustomer).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
        
        
    }
    
    // cập nhật cột agent id với record do ROLE_DIEU_PHOI tạo, để search cho đúng
    public static function UpdateAgentForOrder(){
        $from = time();
        $criteria = new CDbCriteria();
        $criteria->compare("t.type", GasOrders::TYPE_DIEU_PHOI);
        $models = GasOrders::model()->findAll($criteria);
        if(count($models)){
            foreach($models as $model){
               $model->agent_id = $model->user_id_create;
               $model->update(array('agent_id'));
            }
        }
        
        $criteria = new CDbCriteria();
        $criteria->compare("t.type", GasOrders::TYPE_DIEU_PHOI);
        $models = GasOrdersDetail::model()->findAll($criteria);
        
        if(count($models)){
            foreach($models as $model){
               $model->agent_id = $model->user_id_create;
               $model->update(array('agent_id'));
            }
        }
        $to = time();
        $second = $to-$from;
        echo count($models).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
    }
    
    /**
     * @Author: ANH DUNG May 12, 2014
     * @Todo: đổi của KH sale_id A sang Sale id B
     * cập nhật change sale id cho khách hàng trong bảng 
     * User - GasStoreCardDetail + GasRemain + gasOrderDetail + gasCashbookDetail
     */
    public static function updateChangeSaleIdOfCustomer(){
        set_time_limit(72000);
        $from = time();
        $criteria = new CDbCriteria();
        $sale_old = 49170; // Phạm Văn Đức
        $sale_new = 49184; // Khách Hàng Công Ty - Bò

        $criteria->compare( 't.sale_id', $sale_old);
        $mRes = Users::model()->findAll($criteria);
        echo count($mRes);die;
        
        // 1. update table User
            Users::model()->updateAll(array('sale_id'=>$sale_new),
                    "`sale_id`=$sale_old"); 
        // 2. update GasStoreCardDetail CPU run about 30% too low, it so good
            GasStoreCardDetail::model()->updateAll(array('sale_id'=>$sale_new),
                    "`sale_id`=$sale_old"); 
        // 3. update gas_gas_remain
            GasRemain::model()->updateAll(array('sale_id'=>$sale_new),
                    "`sale_id`=$sale_old");
        // 4. update GasOrdersDetail
            GasOrdersDetail::model()->updateAll(array('sale_id'=>$sale_new),
                    "`sale_id`=$sale_old");
        // 5. update GasOrdersDetail
            GasCashBookDetail::model()->updateAll(array('sale_id'=>$sale_new),
                    "`sale_id`=$sale_old");
                        
//                    1173 done in: 9 Second <=> 0.15 Minutes
//            sleep(3);
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
    }       
    
  
    
    /**
     * @Author: ANH DUNG May 20, 2014
     * @Todo: update materials_type_id cho mỗi materials_id 
     * dùng cho báo cáo
     */
    public static function updateMaterialTypeIdStorecardDetail(){
        set_time_limit(72000);
        $from = time();
        $mRes = GasMaterials::model()->findAll();
//        echo count($mRes);die;
//        May 20, 2014 - 276 done in: 7 Second <=> 0.11666666666667 Minutes
        foreach($mRes as $item)
        {            
            GasStoreCardDetail::model()->updateAll(array('materials_type_id'=>$item->materials_type_id),
                    "`materials_id`=$item->id");
        }		
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
    }       
    
    
    /**
     * @Author: ANH DUNG Jun 02, 2014
     * @Todo: update materials_type_id cho mỗi materials_id theo model
     * dùng cho báo cáo
     */
    public static function updateMaterialTypeIdByModel($className){
        set_time_limit(72000);
        $from = time();
        $mRes = GasMaterials::model()->findAll();
        $model = call_user_func(array($className, 'model'));        
        foreach($mRes as $item)
        {            
            $model->updateAll(array('materials_type_id'=>$item->materials_type_id),
                    "`materials_id`=$item->id");
        }
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
    }
    
    /**
     * @Author: ANH DUNG Jun 08, 2014 - 46 done in: 6 Second <=> 0.1 Minutes
     * @Todo: cập nhật loại KH đại lý là 5 cho bảng store card
     */
    public static function updateTypeCustomerAgent(){
        set_time_limit(72000);
        $from = time();
        $criteria = new CDbCriteria();
        $criteria->compare( 't.role_id', ROLE_AGENT);
        $mRes = Users::model()->findAll($criteria);    
//        echo count($mRes);die;
        foreach($mRes as $item){
            GasStoreCard::model()->updateAll(array('type_user'=>CUSTOMER_IS_AGENT),
                    "`customer_id`=$item->id");
            GasStoreCardDetail::model()->updateAll(array('type_customer'=>CUSTOMER_IS_AGENT),
                    "`customer_id`=$item->id");
        }
        
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;          
    }
    
    /******************** IMPORTANT ********************
     * @Author: ANH DUNG Jun 09, 2014
     * @Todo: cập nhật nhập xuất của đại lý trong năm 2014 table GasMaterialsOpeningBalance
     * cái này có khi cứ mỗi đầu năm mới là sẽ chạy vào ngày 01-01, để nó ra đúng Nhập xuất ở trang chủ
     * vì dữ liệu insert vào bảng này có thể sẽ bị ngắt quãng không kiểm soát được
     * tháng 5 chạy lại hàm này 1 lần để check lại phần cut data, vì khi cut data phần dữ liệu 
     * của năm cũ sẽ phục vụ phần báo cáo tồn kho của đại lý
     ******************* IMPORTANT  ****************/
    public static function Agent2014UpdateImportExport(){
        /** @Note: chay theo thu tu 1: delete all record in 2014
         * 2: find all agent 
         * 3. foreach agent và tính nhập xuất từng vật tư  ... 
         */
        set_time_limit(72000);
        $from = time();
//        $year = 2014; 
        $year = 2015; // 76 done in: 40 Second <=> 0.67 Minutes
        echo 'need close';die; // Mar 11, 2015 
//         1. delete all record in 2014 -- đoạn này xóa của năm 2014 đã chạy xong ngày Jun 09, 2014
//        $criteria = new CDbCriteria();
//        $criteria->compare('year', $year);
//        GasMaterialsOpeningBalance::model()->deleteAll($criteria);
//        die;
//        1. delete all record in 2014 -- đoạn này xóa của năm 2014 đã chạy xong ngày Jun 09, 2014
//        2. Run lan 2 vao Mar 11, 2015 delete all record in 2014
//        3. Run lan 3 vao May 16, 2015 delete all record in 2014
//        4. Run Delete lan 4 vao Dec 06, 2015 => delete all record in 2014
       
        // 2. find all agent 
        $list_agent_id = Users::getArrIdAgentNotWarehouse();
        // 3. foreach agent và tính nhập xuất từng vật tư - material của từng đại lý rồi insert từng đại lý 1
        foreach($list_agent_id as $agent_id){
            self::Agent2014BuildOneAgent($agent_id, $year);
        }
        $to = time();
        $second = $to-$from;
        echo count($list_agent_id).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;     
        /** Mar 11, 2015 RUN 63 done in: 15 Second <=> 0.25 Minutes
         * Dec 06, 2015 76 done in: 50 Second <=> 0.833 Minutes
         */
    }
    
    // belong to Agent2014UpdateImportExport
    public static function Agent2014BuildOneAgent($agent_id, $year){
        $aRes = array();
        self::Agent2014CalcImportExport($aRes, 'IMPORT', $agent_id, $year, TYPE_STORE_CARD_IMPORT);
        self::Agent2014CalcImportExport($aRes, 'EXPORT', $agent_id, $year, TYPE_STORE_CARD_EXPORT);
        if(!isset($aRes['UNIQUE_MATERIAL_ID'])) return;
        self::Agent2014SqlAdd($aRes, $agent_id, $year);
    }
    // belong to Agent2014UpdateImportExport
    public static function Agent2014CalcImportExport(&$aRes, $NAME_VAR, $agent_id, $year, $type_store_card){
        $criteria = new CDbCriteria();
        $criteria->compare('t.type_store_card', $type_store_card); // 1: Nhập, 2: xuất
        $criteria->compare('year(t.date_delivery)', $year);
        $criteria->compare('t.user_id_create', $agent_id);
        $criteria->select = "t.materials_type_id, t.materials_id,"
                    . " sum(qty) as qty";
        $criteria->group = "t.materials_id";
        $mRes = GasStoreCardDetail::model()->findAll($criteria);
        foreach ($mRes as $item){
            $aRes[$NAME_VAR][$item->materials_id] = $item->qty;
            $aRes['UNIQUE_MATERIAL_ID'][$item->materials_id] = $item->materials_type_id;
        }        
    }
    // belong to Agent2014UpdateImportExport
    public static function Agent2014SqlAdd($aRes, $agent_id, $year){
        $aRowInsert=array();
        foreach($aRes['UNIQUE_MATERIAL_ID'] as $materials_id=>$materials_type_id){
            $import = isset($aRes['IMPORT'][$materials_id])?$aRes['IMPORT'][$materials_id]:0;
            $export = isset($aRes['EXPORT'][$materials_id])?$aRes['EXPORT'][$materials_id]:0;

            $model = new GasMaterialsOpeningBalance();
            $model->year = $year;
            $model->agent_id = $agent_id;
            $model->materials_id = $materials_id;
            $model->materials_type_id = $materials_type_id;
            $model->import = $import;
            $model->export = $export;
            $model->qty = $model->import-$model->export;
            $aRowInsert[]="('$model->year',
                        '$model->agent_id',
                        '$model->materials_id',
                        '$model->materials_type_id',
                        '$model->import', 
                        '$model->export', 
                        '$model->qty'
                        )";
        }
        $tableName = GasMaterialsOpeningBalance::model()->tableName();
        $sql = "insert into $tableName (year,
                    agent_id,
                    materials_id,
                    materials_type_id,
                    import,
                    export,
                    qty
                    ) values ".implode(',', $aRowInsert);
        if(count($aRowInsert)>0)
            Yii::app()->db->createCommand($sql)->execute();
    }
    
    /**
     * @Todo: cập nhật nhập parent_id (hệ thống cho KH) của tất cả các table liên quan
     */
    public static function CustomerUpdateParentId(){
        set_time_limit(72000);
        $from = time();
        $aModelCustomer = self::getAllCustomerStoreCard();
        self::CustomerUpdateParentIdOneTable('GasCashBookDetail', $aModelCustomer);
        self::CustomerUpdateParentIdOneTable('GasStoreCard', $aModelCustomer);
        self::CustomerUpdateParentIdOneTable('GasStoreCardDetail', $aModelCustomer);
        self::CustomerUpdateParentIdOneTable('GasRemain', $aModelCustomer);
        $to = time();
        $second = $to-$from;
        echo count($aModelCustomer).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;          
    }
    
    public static function CustomerUpdateParentIdOneTable($className, $aModelCustomer){
        $model = call_user_func(array($className, 'model'));                
        foreach ($aModelCustomer as $item){
            $customer_parent_id = MyFormat::getParentIdForCustomer($item);
            $model->updateAll(array('customer_parent_id'=>$customer_parent_id),
                    "`customer_id`=$item->id");
        }
    }    
    
    // lấy toàn bộ KH thẻ kho, kh chính là bò mối cần theo dõi
    public static function getAllCustomerStoreCard(){
        $criteria = new CDbCriteria();
        $criteria->addCondition(" t.role_id IN ('".ROLE_CUSTOMER."')");
        $aTypeNot = array(CUSTOMER_TYPE_MAINTAIN, CUSTOMER_TYPE_MARKET_DEVELOPMENT);
        $criteria->addNotInCondition( 't.type', $aTypeNot);
        return Users::model()->findAll($criteria);
    }
        
    // Aug 19, 2014 to update week_setup_id for table gas
    public static function UpdateWeekSetupId(){
        $models = GasBussinessContract::model()->findAll();
        foreach($models as $item){
            $item->update(array('week_setup_id'));
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 24, 2014
     * @Todo: resize file scan
     * @Param: $model
     */
    public static function ResizeFileScan() {
        
    }
    
    /**
     * @Author: ANH DUNG Dec 28, 2015
     * @Todo: get $criteria của KH bò mỐi
     * @Param: $criteria
     */
    public static function getCriteriaKhBoMoi(&$criteria) {
        $criteria->addCondition(" t.role_id IN ('".ROLE_CUSTOMER."')");
        $aTypeNot = array(CUSTOMER_TYPE_MAINTAIN, CUSTOMER_TYPE_MARKET_DEVELOPMENT);
        $criteria->addNotInCondition( 't.type', $aTypeNot);
        $aTypeBoMoi = array(STORE_CARD_KH_BINH_BO, STORE_CARD_KH_MOI);
        $criteria->addInCondition( 't.is_maintain', $aTypeBoMoi); // Aug 19, 2014 chỉ update KH bò mối thôi, vì cái 
        // type KH của store card hiện tại nó gồm nhiều loại, ko thể update bừa dc
        // $criteria->addCondition( 't.sale_id<>"" AND t.sale_id IS NOT NULL');// có KH không có sale
    }
    
    /**
     * @Author: ANH DUNG Apr 04, 2015
     * @Todo: update LastPurchase cua kh bo moi
     * chỉ update cho KH bò mối, còn KH không là bò, mối thì không làm
     * Apr 04, 2015: 662 done in:+ 7 Second <=> 0.116 Minutes
     */
    public static function UpdateLastPurchase() {
        set_time_limit(72000);
        $from = time();
        $criteria = new CDbCriteria();
        self::getCriteriaKhBoMoi($criteria);
        
        // type KH của store card hiện tại nó gồm nhiều loại, ko thể update bừa dc
//        $criteria->addCondition( 't.sale_id<>"" AND t.sale_id IS NOT NULL');// có KH không có sale
        $mRes = Users::model()->findAll($criteria);
        echo count($mRes);die;
        $run = 0;
        foreach($mRes as $item)
        {
            if(empty($item->last_purchase)){
                $item->last_purchase = GasStoreCard::GetLastPurchase($item->id);
                $item->update(array('last_purchase'));
                $run++;
            }
        }
        
        $to = time();
        $second = $to-$from;
        echo $run.' done in:+ '.($second).'  Second  <=> '.($second/60).' Minutes';die;
    }
    
    
    /**
     * @Author: ANH DUNG Apr 10, 2015
     * @Todo: ngày nhập gas dư và thẻ kho mới nhất của đại lý
     * @important hàm này run hàng ngày qua cron job không được sửa
     */
    public static function UpdateLastInputRemainStorecard() {
//        set_time_limit(72000);
//        $from = time();
        $criteria = new CDbCriteria();
        $criteria->compare('t.role_id', ROLE_AGENT);
        $mRes = Users::model()->findAll($criteria);
//        echo count($mRes);die;
        foreach($mRes as $mUser){
            $date_last_gas_remain = self::GetLastInputRemain($mUser->id);
            $date_last_storecard = self::GetLastInputStorecard($mUser->id);
            if(!empty($date_last_gas_remain)){
                Users::UpdateKeyInfo($mUser, 'date_last_gas_remain', $date_last_gas_remain);
            }
            if(!empty($date_last_storecard)){
                Users::UpdateKeyInfo($mUser, 'date_last_storecard', $date_last_storecard);
            }
        }
//        $to = time();
//        $second = $to-$from;
//        echo count($mRes).' done in:+ '.($second).'  Second  <=> '.($second/60).' Minutes';die;
    }
    
    /**
     * @Author: ANH DUNG Apr 10, 2015
     * @Todo: belong to UpdateLastInputRemainStorecard
     * get ngay nhap gas du moi nhat 
     * @Param: $agent_id
     */
    public static function GetLastInputRemain($agent_id) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.agent_id', $agent_id);
        $criteria->order = 't.date_input DESC';
        $criteria->limit = 1;
        $model = GasRemain::model()->find($criteria);
        if($model){
            return $model->date_input;
        }
        return '';
    }
    
    /**
     * @Author: ANH DUNG Apr 10, 2015
     * @Todo: belong to UpdateLastInputRemainStorecard
     * get ngay nhap the kho moi nhat 
     * @Param: $agent_id
     */
    public static function GetLastInputStorecard($agent_id) {
        $criteria = new CDbCriteria();
        $criteria->compare('t.user_id_create', $agent_id);
        $criteria->order = 't.date_delivery DESC';
        $criteria->limit = 1;
        $model = GasStoreCard::model()->find($criteria);
        if($model){
            return $model->date_delivery;
        }
        return '';
    }
    
    
     /**
     * @Author: ANH DUNG Apr 22, 2015
     * @Todo: cập nhật province_id của đại lý cho thẻ kho và chi tiết thẻ kho
      * Run Apr 22, 2015 done in 2.85 minutes khá lâu
     */
    public static function UpdateProvinceIdAgentOfStorecard(){
        set_time_limit(72000);
        $from = time();
        $criteria = new CDbCriteria();
        $criteria->compare( 't.role_id', ROLE_AGENT);
        $mRes = Users::model()->findAll($criteria);    
        echo count($mRes);die;
        foreach($mRes as $item){
            GasStoreCard::model()->updateAll(array('province_id_agent'=> $item->province_id ),
                    "`user_id_create`=$item->id");
            GasStoreCardDetail::model()->updateAll(array('province_id_agent'=> $item->province_id ),
                    "`user_id_create`=$item->id");
        }
        
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;          
    }
    
    
     /**
     * @Author: ANH DUNG Dec 18, 2015
     * @Todo: cập nhật chuyển sale của KH 
      * Run Dec 18, 2015 1 done in: 1 Second
     */
    public static function ChangeSaleCustomer(){
//        $sale_from = 137363; // Lư Hoàng sale Bo
//        $sale_from = 236070; // Lư Hoàng sale Moi Chuyen Vien
//        $sale_to = 497413; // Lư Hoàng PTTT - CCS
        
//        $sale_from = 758756; // Mạch Phương Em  Sale Mối 
//        $sale_to = 49184; // Khách Hàng Công Ty - Bò
        
        
//        $sale_from = 654523; // Jan 15, 2016 Trương Quang Hiệp Sale Bo 
//        $sale_to = 49184; // Khách Hàng Công Ty - Bò
        
//        $sale_from = 502161; // Jan 19, 2016 Tống Thành Vũ Linh Sale Bo 
        $sale_from = 489649; // Jan 19, 2016 Tống Thành Vũ Linh Sale Mối 
        $sale_to = 360792; // Tống Thành Vũ Linh PTTT - CCS
        
        set_time_limit(72000);
        $from = time();
        $criteria = new CDbCriteria();
        $criteria->compare( 'sale_id', $sale_from);
        $criteria->compare( 'role_id', ROLE_CUSTOMER);
        $mRes = Users::model()->count($criteria);    
        echo $mRes;die;
        $aUpdate = array('sale_id' => $sale_to);
        Users::model()->updateAll($aUpdate, $criteria);

        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;          
    }
    
    /**
     * @Author: ANH DUNG Dec 24, 2015
     * @Todo: cập nhật type_customer cua issue ticket
      *
     */
    public static function IssueTicketUpdateTypeCustomer(){
        set_time_limit(72000);
        $from = time();
        $criteria = new CDbCriteria();
        $mRes = GasIssueTickets::model()->findAll($criteria);
        echo count($mRes). " -- need close to run function";die;
        foreach($mRes as $item){
            $item->update(array('type_customer'));
        }
        
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;          
    }
    
    /**
     * @Author: ANH DUNG Dec 28, 2015
     * @Todo: update sale id cho Issueticket
     */         
    public static function UpdateSaleIdSomeTable(){
        $from = time();
        $criteria = new CDbCriteria();
        self::getCriteriaKhBoMoi($criteria);
        $mRes = Users::model()->findAll($criteria);
        echo count($mRes);die;
        foreach($mRes as $item)
        {
            $item->changeSale();
        }
        $to = time();
        $second = $to-$from;
        echo count($mRes).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;  	
        // Dec 28, 2015: 5055 done in: 6 Second <=> 0.1 Minutes
    }    
    
}
?>
