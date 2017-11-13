<?php
/** Gas
 * The extend of CFormatter, using in type of CGridView columns and attributes of CDetailView
 */
class CmsFormatter extends CFormatter
{
    protected $statusFormat = array('1'=>'Active', '0'=>'Inactive');
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;    
    protected $publishFormat = array('1' => 'Published', '0' => 'Unpublished');
    protected $approveFormat = array('1' => 'Approved', '0' => 'Unapproved');
    public static $statusVar = array('1' => 'Active', '0' => 'Inactive');
    public static $yesNoFormat = array(1 => 'Có', 0 => 'Không');
    public static $yesNoCharFormat = array('yes' => 'Có', 'no' => 'Không');
    public static $allModule = array(null => 'Front End',
            'admin' => 'Admin',
            'member' => 'Member',
            'product' => 'Product',
            'auditTrail' => 'Audit Trail');

    public static $PAGE_MAX_BUTTON = 20;

    public static  $days = array(
        2=>'Monday',
        3=>'Tuesday',
        4=>'Wednesday',
        5=>'Thursday',
        6=>'Friday',
        7=>'Saturday',
        8=>'Sunday',
    );    

    public static  $SALUTATION = array(
        1=>'Anh',
        2=>'Chị',
        3=>'Cô',
        4=>'Chú',
        8=>'Em',
        5=>'Bác',
        6=>'Gì',
        7=>'Ông',
    );
    
    public static $aRoleRestrictCode = array(ROLE_MANAGER, ROLE_ADMIN);
	
    public function getStatusFormat($hasEmpty = true) {
        if($hasEmpty)
            return array(''=>'', '1'=>'Active', '0'=>'Inactive');
        return $this->statusFormat;
    }    
    
    public function getApproveFormat($hasEmpty = true) {
        if($hasEmpty)
            return array(''=>'', '1'=>'Approved', '0'=>'Unapproved');
        return $this->approveFormat;
    }

    public function getPositionFormat($hasEmpty = true) {
        if($hasEmpty)
            return array(''=>'', 'Bottom'=>'Bottom');
        return $this->positionFormat;
    }
	
	/* formatYNStatus use for Yes/No*/
    
    public static function formatYNStatus($value)
    {
    	$return = array('1' =>	'Yes','0' =>	'No');
    	return isset($return[$value])?$return[$value]:""; 
    }
    

    public function formatStatus($value)
    {
        if(is_array($value))
        {
            return (($value['status'] == self::STATUS_INACTIVE) ?
                CHtml::link(
                    "Nghỉ Việc",
                    array("ajaxActivate", "id"=>$value['id']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to ".$this->publishFormat[1],
                    )
                )
                :
                CHtml::link(
                    "Active",
                    array("ajaxDeactivate", "id"=>$value['id']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to ".$this->publishFormat[0],
                    )
                )
            );
        }
        else
            return $value == 0 ? $this->statusFormat['0'] : $this->statusFormat['1'];
    }
    
    public function formatShowMenu($value)
    {
        if(is_array($value))
        {
            return ($value['show_menu'] == self::STATUS_INACTIVE) ?
                CHtml::link(
                    "No",
                    array("ajaxShow", "id"=>$value['id']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to turn on in menu",
                    )
                )
                :
                CHtml::link(
                    "Yes",
                    array("ajaxNotShow", "id"=>$value['id']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to turn off in menu",
                    )
                );

        }
        else
            return $value == 0 ? $this->statusFormat['0'] : $this->statusFormat['1'];
    }

    public function formatPage($value)
    {
        $value = EmbedController::parse($value);
        return $this->formatHtml($value);
    }

    public function formatDate($value)
    {	
        if($value=='0000-00-00' || $value=='0000-00-00 00:00:00' || is_null($value))
            return '';	
        if(is_string($value))
        {
            $date = new DateTime($value);
//            return $date->format(Yii::app()->params['dateFormat']);
            return $date->format( 'd/m/Y' );
        }
        return parent::formatDate($value);
    }

    public function formatTime($value)
    {
        if($value=='0000-00-00' || $value=='0000-00-00 00:00:00' || is_null($value))
            return '';	
        if(is_string($value))
        {
            $date = new DateTime($value);
            return $date->format( 'H:i');
        }
        return parent::formatDate($value);
    }

    public function formatDateTime($value)
    {
        if($value=='0000-00-00' || $value=='0000-00-00 00:00:00' || is_null($value))
            return '';	
        if(is_string($value))
        {
            $date = new DateTime($value);
//            return $date->format(Yii::app()->params['dateFormat'] . ' ' . Yii::app()->params['timeFormat']);
            return $date->format('d/m/Y' . ' ' . 'H:i');
        }
        return parent::formatDate($value);
    }

    public function formatFileSize($value)
    {
        static $KB = 1024;
        static $MB = 1048576;

        $size = intval($value);
        if($size < $KB)
        {
            return $value . ' B';
        }
        elseif($size < $MB)
        {
            return round($value / $KB, 3) . ' KB';
        }
        else
        {
            return round($value / $MB, 3) . ' MB';
        }
    }

    public function formatImage($value)
    {
        if(is_array($value))
        {
            $url = Yii::app()->createUrl($value['url']);
            $h = $value['h'];
            $w = $value['w'];
            return CHtml::image(Yii::app()->createAbsoluteUrl(
                "vendors/timthumb.php?src=$url&h=$h&w=$w&zc=1"
            ), '', isset($value['htmlOptions']) ? $value['htmlOptions'] : array());
        }
//        return CHtml::image(Yii::app()->createAbsoluteUrl($value));
        return $value;
    }

    public function formatPrice($value, $country = 'sg')
    {
        if($country == 'sg')
        {
            return 'S$'.number_format($value,2);
        }
        return $value;
    }

   public static function formatCurrency($price)
   {
        return ActiveRecord::formatCurrency($price);
   }
   
    public function formatNumberCurrency($value, $country = 'sg')
    {
        if(is_array($value))
        {
            if(empty($value['currencyType']))
                $currencyType = 'SGD';
            else
                $currencyType = $value['currencyType'];
            return number_format((float)$value['number'],2)." (".$currencyType.")";
        }
        else
            return $value = "";		
    }
    
    // Nguyen Dung 09-16-2013
    public function formatDeleteAgentCustomer($model) {
        return "<a  title='Xóa Khách Hàng Khỏi Đại Lý' href='".Yii::app()->createAbsoluteUrl('admin/gasagent/delete_customer_agent',
                array('id'=>$model->id))."' onclick='return fnUpdateDeleteCustomer(this);'>Xóa</a>";
    }        
    
    // Nguyen Dung 09-16-2013
    public function formatHadSelling($model) {
        if(count($model->GasMaintainSell)>0){
            $html = "<div class='HadSelling'>";
            foreach($model->GasMaintainSell as $item){
                if($item->maintain_id==$model->id)
                $html.="<a class='view_selling' title='Xem Bán Hàng' href='".Yii::app()->createAbsoluteUrl('admin/gasmaintainsell/view',array('id'=>$item->id))."'>
                            <img alt='Xem Bán Hàng' src='".Yii::app()->theme->baseUrl."/admin/images/icon/selling.png'>    
                        </a>";
            }
            $html .= "</div>";
            return $html;
        }
        return "";
    }        
    
   public static function formatStatusMaintain($status)
   {
       $str='';
       if($status==STATUS_HAS_CALL_OK)
           $str="<font style='color:#0101DF'>".CmsFormatter::$STATUS_MAINTAIN[$status]."</font>";
       elseif($status==STATUS_HAS_CALL_FAILED)
           $str="<font style='color:#DF0101'>".CmsFormatter::$STATUS_MAINTAIN[$status]."</font>";
       elseif($status==STATUS_HAS_CALL_OK_LEVEL_1)
           $str="<font style='color:#0040FF'>".CmsFormatter::$STATUS_MAINTAIN[$status]."</font>";
       elseif($status==STATUS_HAS_CALL_OK_LEVEL_2)
           $str="<font style='color:#0080FF'>".CmsFormatter::$STATUS_MAINTAIN[$status]."</font>";
       elseif($status==STATUS_HAS_CALL_OK_LEVEL_3)
           $str="<font style='color:#F78181'>".CmsFormatter::$STATUS_MAINTAIN[$status]."</font>";
       else
           return CmsFormatter::$STATUS_MAINTAIN[$status];
        return $str;
   }
   
   public static function formatStatusSupervision($status)
   {
       $str='';
       if($status==2)
           return $str="<font style='color:#DF0101'>".CmsFormatter::$STATUS_MAINTAIN_BACK[$status]."</font>";
        return CmsFormatter::$STATUS_MAINTAIN_BACK[$status];
   }
       
   public static function formatMaintainHistory($model)
   {
       $str='';
       $cmsFormat = new CmsFormatter();
       $mMaintain = GasMaintain::getAllMaintainCustomerOfAgent($model->agent_id, $model->customer_id);
       if(count($mMaintain)>0)
        foreach($mMaintain as $key=>$item){
           $TEXT = 'Bảo trì';
           if($item->type == TYPE_MARKET_DEVELOPMENT)
               $TEXT = 'PTTT';
           if($key==0)
                $str.="<b>$TEXT lần: ".($key+1)." </b>";
           else
                $str.="<br><font style='color:red'><b>$TEXT lần: ".($key+1)." </b></font>";
           $str.="<br>Ngày : ".$cmsFormat->formatDate($item->maintain_date)." ";
           $str.="<br>Nhân Viên : ".($item->maintain_employee?$item->maintain_employee->first_name:'')." ";
           $str.="<br>Hiệu Gas : ".($item->materials?$item->materials->name:'')." ";
           $str.="<br>Seri : ".$item->seri_no."<br> ";
        }
        return $str;
   }
          
		  
    public static function formatRoleNameUser($role_id)
    {
        if(empty($role_id)) return '';
        $session=Yii::app()->session;
        if(!isset($session['ROLE_NAME_USER']) || !isset($session['ROLE_NAME_USER'][$role_id]))
                $session['ROLE_NAME_USER'] = Roles::getArrRoleName();
        return $session['ROLE_NAME_USER'][$role_id];
    }
		  
    public static function formatStatusCustomerMaintain($mUser)
   {
        return CmsFormatter::$STATUS_IS_MAINTAIN[$mUser->is_maintain];
   }
       
		  
    public static function formatCheckWithSeriMaintain($mMaintainSell)
   {
       $str='';
//       $mMaintain = GasMaintain::getLatestObjMaintainCustomerOfAgent($mMaintainSell->agent_id, $mMaintainSell->customer_id);
       if($mMaintainSell->is_same_seri_maintain)
           return 'Trùng Seri Bảo Trì';
       return "<font style='color:red;'>Không</font>";
   }
       
    public static function formatMaintainSellPromotion($mMaintainSell)
   {
       $str='';
       $models = GasOneManyBig::getArrModelOfManyId($mMaintainSell->id, ONE_SELL_MAINTAIN_PROMOTION);
//       $mMaintain = GasMaintain::getLatestObjMaintainCustomerOfAgent($mMaintainSell->agent_id, $mMaintainSell->customer_id);
       if(count($models)>0){
           foreach($models as $key=>$item){
               if($key==0)
                    $str.= $item->material?($key+1).'. '.$item->material->name:'';
               else
                   $str.= $item->material?'<br>'.($key+1).'. '.$item->material->name:'';
           }
       }
       return $str;
   }
   
    public function formatStatusField($value)
    {
        if(is_array($value))
        {
            return (($value['status'] == self::STATUS_INACTIVE) ?
                CHtml::link(
                    "Inactive",
                    array("ajaxActivateField", "id"=>$value['id'],'field_name'=>$value['field_name']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to ".$this->publishFormat[1],
                    )
                )
                :
                CHtml::link(
                    "Active",
                    array("ajaxDeactivateField", "id"=>$value['id'],'field_name'=>$value['field_name']),
                    array(
                        "class"=>"ajaxupdate",
                        "title"=>"Click here to ".$this->publishFormat[0],
                    )
                )
            );
        }
        else
            return $value == 0 ? $this->statusFormat['0'] : $this->statusFormat['1'];
    }
       
    /**
     * @Author: ANH DUNG 11-11-2013
     * @Todo: display full name of user
     * @Param: $mUser model user
     * @Return: full name with salution of user
     */    
   public function formatNameUser($mUser)
   {
       if(!$mUser) return '';
//        if(!empty($mUser->last_name)){ // Close on Apr 15, 2015 vi thay khong can thiet, he thong khong co dung last_name
//            if(isset(CmsFormatter::$SALUTATION[$mUser->last_name]))
//                return CmsFormatter::$SALUTATION[$mUser->last_name].' '.trim($mUser->first_name);
//        }
        return $mUser->code_bussiness."-".trim($mUser->first_name);
   }

   public function formatOnlyNameUser($mUser)
   {
        if(!$mUser) return '';
        return $mUser->first_name;
   }
   
    /**
     * @Author: ANH DUNG 11-11-2013
     * @Todo: display full name of customer and type Bo Moi
     * @Param: $mUser model user
     */        
   public function formatNameUserWithTypeBoMoi($mUser)
   {
        if(is_null($mUser)) return '';
        return $mUser->code_bussiness." - ".trim($mUser->first_name)." - ". (isset(CmsFormatter::$CUSTOMER_BO_MOI[$mUser->is_maintain])?CmsFormatter::$CUSTOMER_BO_MOI[$mUser->is_maintain]:"");
   }

   // 11-11-2013 ANH DUNG
   public function formatAddressTempUser($mUser){
       $str='';
       if($mUser)
           return $mUser->address;
       return '';
//       if(!empty($mUser->address_temp))
//           return $mUser->address_temp;
       
   }

   // 12-15-2013 ANH DUNG
   public function formatPrimaryAddress($mUser){
       if(!$mUser) return '';
       MyFunctionCustom::buildAddressUser($mUser);
       return $mUser->address;
   }

   // 12-17-2013 ANH DUNG
   public function formatStoreCardTypeInOut($mStoreCard){
       if($mStoreCard->type_store_card==TYPE_STORE_CARD_IMPORT)
           return CmsFormatter::$STORE_CARD_TYPE_IMPORT[$mStoreCard->type_in_out];
       return CmsFormatter::$STORE_CARD_TYPE_EXPORT[$mStoreCard->type_in_out];
   }

   // 12-17-2013 ANH DUNG
   public function formatStoreCardDetail($mStoreCard){
       $str = '';
       $sum_sl=0;
       $total_item = count($mStoreCard->StoreCardDetail);
       if($total_item){
           foreach($mStoreCard->StoreCardDetail as $item){
               $sum_sl+=$item->qty;
               $str .= "<br> SL:<b>".  ActiveRecord::formatCurrency($item->qty)."</b> - ".$item->materials->name;
           }
       }
       if($total_item>1){
           $str .= "<br> <b>Tổng SL: $sum_sl</b>";
       }
       
       return trim($str,"<br>");
   }

   // 12-26-2013 ANH DUNG
   public function formatCashBookDetail($model){
       $str = '';
       if(count($model->CashBookDetail)){
           foreach($model->CashBookDetail as $key=>$item){
               $str .= "<br> <b>".($key+1).". </b>Diễn giải: $item->description - <b>Loại:</b> {$item->master_lookup->name} - SL: ".$item->qty ." Số Tiền: ". ActiveRecord::formatCurrency($item->amount);
           }
       }
       return trim($str,"<br>");
   }

   // 01-01-2014 ANH DUNG: format tên KH của thẻ kho, vì có tể không nhập customer
   public function formatNameCustomerStoreCard($model){
       $res = '';
       $cmsFormater = new CmsFormatter();
       if($model->customer){
           $res = $cmsFormater->formatNameUser($model->customer);
       }else{
           $res = CmsFormatter::$CUSTOMER_NEW_OLD_STORE_CARD[CUSTOMER_PAY_NOW];
       }
       return $res;
   }
   
   // 01-01-2014 ANH DUNG: format tên KH của thẻ kho, vì có tể không nhập customer
   public function formatNameCustomerOrder($model){
       $res = '';
       $cmsFormater = new CmsFormatter();
       if($model->customer){
           $type = isset(CmsFormatter::$CUSTOMER_BO_MOI[$model->customer->is_maintain])?CmsFormatter::$CUSTOMER_BO_MOI[$model->customer->is_maintain]:"";
           $res = $cmsFormater->formatNameUser($model->customer)." KH $type";
       }
       return $res;
   }
   
   // 01-04-2014 ANH DUNG: format tên KH của thẻ kho, vì có tể không nhập customer
   public function formatCustomerStoreCardType($model){
       $res = '';
       if($model->customer){
           $res = $model->customer->is_maintain?CmsFormatter::$CUSTOMER_BO_MOI[$model->customer->is_maintain]:"";
       }
       return $res;
   }
   
   // Apr 01, 2014 ANH DUNG: format cân gas lần 1 của gas dư
   public function formatGasRemain1($model){       
       $res = '';
       if($model->amount_gas){
           $res .= "".ActiveRecord::formatCurrency($model->amount_gas);
       }
        $res .= "<input class='amount_gas' type='hidden' value='$model->amount_gas'>";
       return $res;
   }   
   // Apr 01, 2014 ANH DUNG: format cân gas lần 1 của gas dư
   
   // Mar 01, 2014 ANH DUNG: format cân gas lần 2 của gas dư
   public function formatGasRemain2($model){       
       $res = '';
       if($model->amount_gas_2){
           $res .= "<span class='high_light_tr'></span>".ActiveRecord::formatCurrency($model->amount_gas_2)." Kg - ".($model->re_user_update_2?$model->re_user_update_2->first_name:" User đã bị xóa");
           if(GasRemain::CanUpdateGasRemain2Or3($model)){
               $res .= "<br><a class='update_gas_remain' href='".Yii::app()->createAbsoluteUrl('admin/ajax/update_gas_remain',array('id'=>$model->id,'type'=>'2'))."'>Cập NhậtLần 2</a>";
           }
           
           if(Yii::app()->user->role_id == ROLE_ADMIN){
               $res .= "<br><a class='remove_update_gas_remain' href='javascript:void(0);' rel='".Yii::app()->createAbsoluteUrl('admin/ajax/remove_update_gas_remain',array('id'=>$model->id,'type'=>'2'))."'>Hủy Lần 2</a>";
           }
           
       }else{
           if(GasRemain::CanUpdateGasRemain2Or3($model)){
                $res = "<a class='update_gas_remain' href='".Yii::app()->createAbsoluteUrl('admin/ajax/update_gas_remain',array('id'=>$model->id,'type'=>'2'))."'>Cập NhậtLần 2</a>";
           }
       }
        $res .= "<input class='amount_gas_2' type='hidden' value='$model->amount_gas_2'>";
       return $res;
   }   
   // Mar 01, 2014 ANH DUNG: format cân gas lần 3 của gas dư
   public function formatGasRemain3($model){
       $res = '';
       if(empty($model->amount_gas_2))
           return $res;
       if($model->amount_gas_3){
           $res .= "<span class='high_light_tr'></span>".ActiveRecord::formatCurrency($model->amount_gas_3)." Kg - ".($model->re_user_update_3?$model->re_user_update_3->first_name:" User đã bị xóa");
           if(GasRemain::CanUpdateGasRemain2Or3($model)){
               $res .= "<br><a class='update_gas_remain' href='".Yii::app()->createAbsoluteUrl('admin/ajax/update_gas_remain',array('id'=>$model->id,'type'=>'3'))."'>Cập Nhật Lần 3</a>";
           }
       }else{
           if(GasRemain::CanUpdateGasRemain2Or3($model)){
                $res = "<a class='update_gas_remain' href='".Yii::app()->createAbsoluteUrl('admin/ajax/update_gas_remain',array('id'=>$model->id,'type'=>'3'))."'>Cập Nhật Lần 3</a>";
           }
       }       
       $res .= "<input class='amount_gas_3' type='hidden' value='$model->amount_gas_3'>";
       return $res;
   }   
   
   // May 20, 2014 ANH DUNG: 
   public function formatGasRemainAmount($model){       
       $res = '';
       if($model->amount>0){
           $res .= "<span class='amount display_none'>$model->amount</span>".ActiveRecord::formatCurrency($model->amount);
       }
       return $res;
   }     
   
      // Apr 01, 2014 ANH DUNG: format row đã cập nhật số xe rồi
   public function formatGasOrderCar($model){
       $res = $model->orders_no;
       if($model->user_id_update_car_number){
           $res = "<span class='high_light_tr'>$model->orders_no</span>";
       }
       return $res;
   }   

   //// 1: sale bò, 2: sale Mối
   public function formatTypeSaleText($model){
       $res = '';
       if(in_array($model->role_id, Users::$ARR_ROLE_LIKE_SALE) && isset(Users::$aTypeSale[$model->gender])){
           $res = Users::$aTypeSale[$model->gender];
       }
       return $res;
   }
   
   
   // May 20, 2014 ANH DUNG: 
   public function formatCollectionCustomer($model){       
       $res = '';
       if($model->collection_customer>0){
           $res .= "<span class='collection_customer display_none'>$model->collection_customer</span>".ActiveRecord::formatCurrency($model->collection_customer);
       }
       return $res;
   }    
   // May 20, 2014 ANH DUNG: 
   public function formatReceivablesCustomer($model){       
       $res = '';
       if($model->receivables_customer>0){
           $res .= "<span class='receivables_customer display_none'>$model->receivables_customer</span>".ActiveRecord::formatCurrency($model->receivables_customer);
       }
       return $res;
   }    
   
   // May 20, 2014 ANH DUNG: 
   public function formatGasRemainHasExport($model){       
       $res = GasRemain::$TYPE_HAS_EXPORT[0];
       if($model->has_export){
           $res = "<span class='item_b hight_light'>".GasRemain::$TYPE_HAS_EXPORT[1]."</span>";
       }
       return $res;
   }    
 
   // Jun 30, 2014 ANH DUNG
   public function formatDetailFileScanInfo($model){
       $str = '';
       foreach($model->rFileScanDetail as $key=>$item){
            $aDate = explode('-', $item->maintain_date);
            $pathUpload = "upload/file_scan/$aDate[0]/$aDate[1]/$aDate[2]";            
            $path = '/' . $pathUpload . '/size2' . '/' . $item->file_name;
//            if (file_exists(Yii::getPathOfAlias("webroot") . $path)) {
            if (is_file(Yii::getPathOfAlias("webroot") . $path)) {
                $str.="<a class='gallery' href='".Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id, 'model'=>'GasFileScanDetail'))."'> ";
                    $str.="<img width='80' height='60' src='".ImageProcessing::bindImageByModel($item,'','',array('size'=>'size2'))."'>";
                $str.="</a>";
            }
        }
       foreach($model->rDetailInfo as $key=>$item){
            $str .= "<br> <b>".($key+1).". $item->customer_name </b> - {$item->customer_phone} - <b>Gas:$item->materials_name - Seri: $item->seri</b> - ".$item->customer_address ." - $item->note";
       }
       return $str;
//       return trim($str,"<br>");
   }
   
   // Jul 25, 2014 ANH DUNG: 
   public function formatSpancopB12($model){       
       $res = '';
       if($model->b12>0){
           $res .= "<span class='amount_b12 display_none'>$model->b12</span>".$model->b12;
       }
       return $res;
   }       
   // Jul 25, 2014 ANH DUNG: 
   public function formatSpancopB45($model){       
       $res = '';
       if($model->b45>0){
           $res .= "<span class='amount_b45 display_none'>$model->b45</span>".$model->b45;
       }
       return $res;
   }       
   
   // Jul 30, 2014 ANH DUNG: 
   public function formatSpancopCustomerName($model){
       $cmsFormater = new CmsFormatter();
       $newShow = $cmsFormater->formatSpancopCustomerSpecial($model);
       $res = $newShow;
       if($model->status == GasBussinessContract::STATUS_THUONG_LUONG){
           $OverDate = MyFormat::compareTwoDate(date('Y-m-d'), $model->date_plan);           
           if($model->still_thuong_luong || ($OverDate && $model->still_thuong_luong==0) ){
                $res = "<span class='high_light_tr'></span>".$newShow;
           }
       }
       return $res;
   }
   
   // Jul 30, 2014 ANH DUNG: 
    public function formatSpancopAddress($model){       
       $res = "<b>CF: ";
       $address = nl2br($model->address);
       if($model->belong_to_id == $model->id){
           $res .= "$model->code_no</b>";
       }elseif( $model->belong_to_id ){
           $mFirst = $model->rBelongToId;
           if($mFirst){
                $res .= "$mFirst->code_no</b>";
           }
       }
       return $res."<br>$address";
   }
   
    public function formatSpancopCustomerSpecial($model){
       $res = "$model->customer_name";
       if(!empty($model->phone)){
           $res .= "<br><b>ĐT:</b>$model->phone";
       }
       if(!empty($model->customer_contact)){
           $res .= "<br><b>Liên Hệ:</b>$model->customer_contact";
       }
       if(!empty($model->customer_zone)){
           $res .= "<br><b>Chuyên Đề: </b>".GasBussinessContract::GetCustomerZoneView($model->customer_zone);
       }
       
       return $res;
   }
   
    public function formatSpancopReport($model){
        $cmsFormater = new CmsFormatter();
       $res = "";
       foreach($model->rComment as $mComment){
//           $res .= "<b>{$mComment->getUidLogin()}</b> <i>{$cmsFormater->formatDateTime($mComment->created_date)}</i>: ".nl2br($mComment->getContent())."<br>";
           $res .= $mComment->ShowItem();
       }
       $note = "<b>Ghi chú: </b>".nl2br($model->note);
       $res = "$res".$note;
       return $res;
   }
   
    public function formatStorecardNote($model){
       $note = nl2br($model->note);
       $update_note = nl2br($model->update_note);
       $res = $note." $update_note";
       if(!empty($note)){
           $res = $note."<br> $update_note";
       }
       return $res;
   }   
   
   // Aug 22, 2014 ANH DUNG: 
    public function formatFullNameTrackLogin($model){       
       $res = '';
       if($model->rUidLogin){
           $res = $model->rUidLogin->first_name;
           if(in_array($model->type, GasTrackLogin::$TYPE_RISK) )
                $res = "<span class='high_light_tr'></span>".$res;
       }        
       return $res;
   }
   
    // Sep 05, 2014 ANH DUNG
    public function formatGasManageToolDetail($model){
       $str = '';
       
        foreach($model->rManageToolDetail as $key=>$item){
            $str .= "<br> <b>".($key+1).". </b>Diễn giải: {$item->rMaterial->name} - <b>SL:</b> ".ActiveRecord::formatCurrency($item->qty);
        }
       return trim($str,"<br>");
   }
   
   // Sep 06, 2014 ANH DUNG
    public function formatDetailGasProfile($model){
       $str = '';
        foreach($model->rProfileDetail as $key=>$item){
//            $str.="<a class='gallery' href='".ImageProcessing::bindImageByModel($item,'','',array('size'=>'size2'))."'> ";
//                $str.="<img width='100' height='70' src='".ImageProcessing::bindImageByModel($item,'','',array('size'=>'size1'))."'>";
//            $str.="</a>";            
            $str.="<a class='gallery' href='".Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id))."'> ";
                $str.="<img width='80' height='60' src='".ImageProcessing::bindImageByModel($item,'','',array('size'=>'size1'))."'>";
            $str.="</a>";
        }
       return $str;
   }
   
   // Sep 06, 2014 ANH DUNG
   public function formatGasProfileMaterial($model){
       $str = '';
       $aId = explode(',', $model->list_materials_id);
       $aRes = GasMaterials::getListOptionByArrId($aId);
       $i=1;
       foreach($aRes as $item){
           $str .= "<br> <b>".($i++).". </b>: {$item}";
       }
       return trim($str,"<br>");
   }
   
   // Sep 06, 2014 ANH DUNG
    public function formatNameAndRole($mUser){
       $session=Yii::app()->session;
       if($mUser){
           return $mUser->first_name." - ". $session['ROLE_NAME_USER'][$mUser->role_id];
       }
       return '';
   }
   
   // Sep 27, 2014 ANH DUNG $model is model Leave
    public function formatLeaveDate($model){
       $cmsFormater = new CmsFormatter();
       if($model->leave_date_from == $model->leave_date_to){
           return $cmsFormater->formatDate($model->leave_date_to);
       }
       return "Từ ".$cmsFormater->formatDate($model->leave_date_from)." Đến ".$cmsFormater->formatDate($model->leave_date_to);
   }
   
   // Sep 27, 2014 ANH DUNG
   public function formatLeaveStatus($model){
//       if($model->status == GasLeave::STA_APPROVED_BY_MANAGE && Yii::app()->user->role_id==ROLE_DIRECTOR){
//           return GasLeave::$LIST_STATUS_TEXT[GasLeave::STA_NEW];
//       }
       return GasLeave::$LIST_STATUS_TEXT[$model->status];
   }
   
   // Sep 28, 2014 ANH DUNG
   public function formatLeaveStatusDateApproved($model){
       $cmsFormater = new CmsFormatter();
       if(!empty($model->approved_director_date)){
           return $cmsFormater->formatDateTime($model->approved_director_date);
       }
       return $cmsFormater->formatDateTime($model->manage_approved_date);
   }
   
   public function formatLeaveUserApproved($model){
       $cmsFormater = new CmsFormatter();
       $mUser = null;
       if($model->rApprovedDirectorId){
           return $cmsFormater->formatOnlyNameUser($model->rApprovedDirectorId);
       }elseif($model->rManageApprovedUid){
           return $cmsFormater->formatOnlyNameUser($model->rManageApprovedUid);
       }elseif($model->rToUidApproved){
           return $cmsFormater->formatOnlyNameUser($model->rToUidApproved);
       }
       return '';
   }
   
   
    // Nov 04, 2014 ANH DUNG
    public function formatSalesFileScanNote($model){
       $str = '';
       foreach($model->rFileScanDetail as $key=>$item){
            $aDate = explode('-', $item->date_sales);            
            $pathUpload = GasSalesFileScanDetai::$pathUpload."/$aDate[0]/$aDate[1]/$aDate[2]";
            $path = '/' . $pathUpload . '/size2' . '/' . $item->file_name;
//            if (file_exists(Yii::getPathOfAlias("webroot") . $path)) {
            if (is_file(Yii::getPathOfAlias("webroot") . $path)) {
                $str.="<a class='gallery' href='".Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id, 'model'=>'GasSalesFileScanDetai'))."'> ";
                    $str.="<img width='80' height='60' src='".ImageProcessing::bindImageByModel($item,'','',array('size'=>'size2'))."'>";
                $str.="</a>";
            }
        }
       $str.= "<br>$model->note";
       return $str;
//       return trim($str,"<br>");
   }
   
   // Nov 23, 2014 ANH DUNG
    public function formatCustomerCheckMonth($model){
        return $model->month."-$model->year";
    }
    
    // Nov 24, 2014 ANH DUNG
    public function formatCustomerCheckFileReport($model){
        $str = '';
        if(!empty($model->file_report)){
            $year = MyFormat::GetYearByDate($model->created_date);
            $month = MyFormat::GetYearByDate($model->created_date, array( 'format'=>'m') );
            $pathUpload = GasCustomerCheck::$pathUpload."/$year/$month";
            $path = '/' . $pathUpload . '/size2' . '/' . $model->file_report;
            if (is_file(Yii::getPathOfAlias("webroot") . $path)) {
                $str.="<a class='gallery' href='".Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$model->id, 'model'=>'GasCustomerCheck'))."'> ";
                    $str.="View";
                $str.="</a>";
            }
        }
        return $str;
    }
   
    // Dec 02, 2014 ANH DUNG
    public function formatAgentProfileCheck($model){
        $str = "<span class='hight_light item_b'>Chưa Có</span>";
        if(count($model->rProfileAgent)){
            $str = "<span class=''>Có Rồi</span>";
        }
        return $str;
    }
 
    // Feb 25, 2015 ANH DUNG
    public function formatIssueFile($model){
        $aFile = $model->rFileDetail;
        $str = '';
        if(count($aFile))
            $str = 'File đính kèm: ';
        foreach($aFile as $key=>$item){
            $str.="<a class='gallery' href='".Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id, 'model'=>'GasIssueTicketsDetailFile'))."'> ";
                $str.="<img width='80' height='60' src='".ImageProcessing::bindImageByModel($item,'','',array('size'=>'size1'))."'>";
            $str.="</a>";
        }
       return $str;
   }
   
    // Mar 06, 2015 ANH DUNG
    public function formatBreakTaskDailyFile($model){
        $aFile = $model->rFile;
        $str = '';
        if(count($aFile)){
            $str = '<br>File đính kèm: ';
        }
        foreach($aFile as $key=>$item){
            $str.="<a target='_blank' class='gallery' href='".Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$item->id, 'model'=>'GasFile'))."'> ";
                $str.="<img width='80' height='60' src='".ImageProcessing::bindImageByModel($item,'','',array('size'=>'size1'))."'>";
            $str.="</a>";
        }
       return $str;
   }
   
   // Mar 15, 2015 ANH DUNG
   public function formatDetailDailyGobackInfo($model){
       // init session cua pttt
       $str = '';
       $session=Yii::app()->session;
       foreach($model->rDetail as $key=>$item){
            $name = isset($session['SESSION_LIST_NAME_BY_ROLE'][$item->maintain_employee_id])?$session['SESSION_LIST_NAME_BY_ROLE'][$item->maintain_employee_id]:'';
            $str .= "<br> <b>".($key+1).". $name </b> - SL: $item->qty";
       }
//       return $str;
       return trim($str,"<br>");
   }
   
   public function formatSaleAndLevel($model){
       $mSale = $model->sale;
       if($mSale){
           $typeSale = isset(Users::$aTypeSale[$mSale->gender])?Users::$aTypeSale[$mSale->gender]:'';
           if($model->md5pass == 'for_export'){// cờ xác định là get data cho export ExportList::CustomerStoreCard
               return "$mSale->first_name";
           }
           return "<b>$mSale->first_name</b><br>[$typeSale]";
       }
       return '';
   }
   
    // Feb 25, 2015 ANH DUNG
    public function formatCustomerCheckFile($model){
        $str = '';
        if(!empty($model->file_report)){
//            $str = 'File đính kèm hiện tại: ';
            $str.="<a class='gallery' href='".Yii::app()->createAbsoluteUrl('admin/ajax/viewImageProfileHs', array('id'=>$model->id, 'model'=>'GasCustomerCheck'))."'> ";
//                $str.="<img width='80' height='60' src='".ImageProcessing::bindImageByModel($model,'','',array('size'=>'size2'))."'>";
                $str.="Xem";
            $str.="</a>";
        }
       return $str;
   }
   
   // Apr 20, 2015 ANH DUNG: 
   public function formatCustomerCheckMoneyGet($model){       
       $res = '';
       if($model->money_get>0){
           $res .= "<span class='money_get display_none'>$model->money_get</span>".ActiveRecord::formatCurrency($model->money_get);
       }
       return $res;
   }
   
   // May 14, 2015 ANH DUNG
   public function formatStatusLayHang($model){
       if($model->channel_id == Users::KHONG_LAY_HANG){
           return Users::$STATUS_LAY_HANG[$model->channel_id];
       }
       return '';
   }
   
   // May 14, 2015 ANH DUNG
   public function formatCustomerCheckNameUser($model){
       $cmsFormater = new CmsFormatter();
       $mUser = $model->rUidLogin;
       if($model->role_id == ROLE_SUB_USER_AGENT){
           $mUser = $model->rAgent;
       }
       return $cmsFormater->formatOnlyNameUser($mUser);
   }
   
   
   // Jun 13, 2015 ANH DUNG
   public function formatBussinessContractStatus($model){
       $res = GasBussinessContract::$ARR_STATUS[$model->status];
       if(!empty($model->old_status)){
           $res = "<span class='item_b'>".$model->old_status." => </span>$res";
       }
       return $res;
   }
   
   // Jun 19, 2015 ANH DUNG
   public function formatOrderViewCreateBy($model){
       $str = '';
        $str.="<a href='".Yii::app()->createAbsoluteUrl('admin/gasOrders/view', array('id'=>$model->id, 'view_create_by'=>1))."'> ";
            $str.="Xem";
        $str.="</a>";
       return $str;
   }
   
 
      
   
}