<?php
/**
 * Class for check some role access to action custom
 */
class GasCheck
{
    // SỐ NGÀY CHO PHÉP CẬP NHẬT PTTT
    public static $DAY_UPDATE_PTTT = 3;
    public static $DAY_ALLOW_DELETE = 5;// cái này có thể dùng để check toàn hệ thống

    // hiện tại là những đại lý có thể tạo mới KH thẻ kho
        public static $arrAgentAllow = array(
//            100,// Kho Bến Cát
//            26678,// Kho Tân Sơn
//            25785,// Kho Phước Tân
//            106,// Đại lý Bình Thạnh
//            30754,// Kho Vĩnh Long
        ); // những đại lý có thể tạo mới KH thẻ kho
    
    /** ANH DUNG Feb 17, 2014
     * to do: check agent can create new customer store card
     */
    public static function AgentCreateCustomerStoreCard()
    {        
        if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT){
            if(!in_array(MyFormat::getAgentId(), GasCheck::$arrAgentAllow))
                    return false;
        }
        return true; // for admin và điều phối create customer store card
    }
    
    /** ANH DUNG Feb 26, 2014
     * to do: check agent can update gas dư
     */
    public static function AgentCanUpdateRemain($model)
    {
        // May 21, 2015 dùng chung ngày update gas dư với thẻ kho
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, Yii::app()->params['storecard_admin_update'], '-');
        if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT ){
            if(Yii::app()->user->id != $model->uid_login && $model->uid_login!=0){
                return false;
            }
            $dayAllow = date('Y-m-d');
            $dayAllow = MyFormat::modifyDays($dayAllow, GasCashBook::getAgentDaysAllowUpdate(), '-');
//            $dayAllow = MyFormat::modifyDays($dayAllow, Yii::app()->params['gas_remain_agent_update'], '-');
        }
        // May 21, 2015 dùng chung ngày update gas dư với thẻ kho
//        if(MyFormat::getAgentId() != $model->agent_id)
//        if(Yii::app()->user->id != $model->uid_login && $model->uid_login!=0)
//            return false;
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG May 08, 2014
     * to do: check agent  can update đặt hàng - order
     */
    public static function AgentCanUpdateOrder($model)
    {
        $today = date('Y-m-d');
        $prev_date = MyFormat::modifyDays($today, (GasOrders::$days_allow_update+1), '-');
//        $isValidDateBetween = MyFormat::compareDateBetween($prev_date, $today, $model->date_delivery);
        // $model->date_delivery ngày giao hàng cho phép update, không check ngày tạo
        // cho phép cập nhật đơn hàng có ngày giao là 1 ngày trước
        $valid = MyFormat::compareTwoDate($model->date_delivery, $prev_date);
        $cUid = Yii::app()->user->id ;
        if(in_array($cUid, GasOrders::$ZONE_HCM) 
            && in_array($model->user_id_create, GasOrders::$ZONE_HCM)
            && $valid
        ){
            return true;
        }
        if($model->user_id_create != $cUid
                || !$valid
        ){
            return false;
        }

        return true;
    }
    
    /** ANH DUNG May 18, 2014
     * to do: check agent can update gas file scan
     */
    public static function AgentCanUpdateFileScan($model)
    {
//        return true;        
//        if(MyFormat::getAgentId() != $model->agent_id)
        if(Yii::app()->user->id != $model->uid_login)
            return false;
        // Dec 15, 2014 bỏ đoạn check này đi, nếu có bán hàng cũng cho upfile excel lên
//        if(count($model->rMaintainSell)) return false;
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasFileScan::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG May 18, 2014
     * to do: check agent can update gas file scan
     */
    public static function AgentCanUpdateTextFile($model)
    {
        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasText::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    public static function AgentCanUpdateMaintainSell($model)
    {
        if(Yii::app()->user->id != $model->user_id_create){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        if(Yii::app()->user->role_id == ROLE_SUB_USER_AGENT && $model->agent_id != MyFormat::getAgentId())
            return false;
        
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasMaintainSell::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG May 18, 2014
     * to do: check agent can update gas file scan
     */
    public static function AgentCanUpdateMeetingMinutes($model)
    {
        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasMeetingMinutes::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Mar 15, 2015
     * to do: check agent can update gas PTTT daily goback
     */
    public static function AgentCanUpdatePTTTDailyGoback($model)
    {
//        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
        if(Yii::app()->user->id != $model->uid_login){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasPtttDailyGoback::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Dec 13, 2014
     * to do: check can update họp pháp lý
     */
    public static function CanUpdateMeetingLaw($model)
    {
        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasMeetingMinutes::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Dec 13, 2014
     * to do: check can update họp pháp lý
     */
    public static function CanUpdateUphold($model)
    {
//        $cRole = Yii::app()->user->role_id;
//        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
//            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
//        }// Jan 22, 2016 cho phép điều phối sửa của nhau
        
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, $model->getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Now 02, 2015
     * to do: check can update đại lý đề xuất sửa chữa
     */
    public static function CanUpdateSupportAgent($model)
    {
        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }elseif($model->status != GasSupportAgent::STATUS_NEW){
            return false;
        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, $model->getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Dec 13, 2014
     * to do: check can update họp pháp lý
     */
    public static function CanUpdateBreakTask($model)
    {
        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasBreakTask::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Now 23, 2014
     * to do: check head gas bò can update customer check
     */
    public static function CanUpdateCustomerCheck($model)
    {
        $cRole = Yii::app()->user->role_id;
//        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
//        if(Yii::app()->user->id != $model->uid_login){// Close Jun 09, 2015
//            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
//        }
        if($cRole==ROLE_SUB_USER_AGENT && $model->status_check == GasCustomerCheck::STATUS_CHECKED ){
            return false; // Nếu kế toán văn phòng đã duyệt thì ko cho đại lý edit nữa
        }
        
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasCustomerCheck::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Dec 27, 2014
     * to do: check head gas bò can update gasSupportCustomer
     */
    public static function CanUpdateSupportCustomer($model)
    {
        if($model->CanUpdateTimeDoingReal()){
            return true;// Cho tổ trưởng bảo trì vào update cột ngày giờ thi công
        }
        
        if( !$model->canUpdateGrid() ){
            return false; // ai tạo thì dc sửa của người đó, những sale của KH đó cũng dc update
        }
        if(!empty($model->approved_uid_level_1) || !empty($model->approved_uid_level_2) || !empty($model->approved_uid_level_3) ){
            return false;// nếu đã có 1 cấp trên duyệt thì không cho update nữa
//            return $model->canUpdateToPrint();
        } // close on Sep 04, 2015, không cần tách ra 2 bước update nữa, chỉ cho nhập 1 lần
        
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasSupportCustomer::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Now 23, 2014
     * to do: check giám sát đại lý can update report
     */
    public static function CanUpdateCustomerCheckReport($model)
    {
        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
//        if(Yii::app()->user->id != $model->monitor_agent_id){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasCustomerCheck::getDayAllowUpdateReport(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    public static function AgentCanUpdateManageTool($model)
    {        
        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasManageTool::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG May 18, 2014
     * to do: check agent can update gas profile, cập nhật hồ sơ pháp lý
     */
    public static function AgentCanUpdateProfileScan($model)
    {
        // Dec 04, 2014 tam close doan check nay lai
//        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
//            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
//        }
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasProfile::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    public static function AgentCanDeleteFileScan($model)
    {
//        if(count($model->rMaintainSell)) return false;
        // Close Mar 23, 2015 có bán hàng cũng xóa hết luôn
        return true;
    }
    
    public static function AgentCanUpdateBussinessContract($model)
    {
//        return true;        
        $dayAllow = date('Y-m-d');
        if(Yii::app()->user->id != $model->uid_login)
            return false;
        // Now 18, 2014 với status thương lượng sẽ cho edit dòng mới nhất, còn lại không cho
        if( $model->status == GasBussinessContract::STATUS_THUONG_LUONG )
        {
            $session=Yii::app()->session;
            if(isset($session['ARR_LAST_ID_THUONG_LUONG'][$model->belong_to_id])){
                if( $session['ARR_LAST_ID_THUONG_LUONG'][$model->belong_to_id] == $model->id )
                {
//                    return true;// Close Jun 13, 2015 nên đóng lại, vì chỉ phục vụ sửa tạm thời tại 1 thời điểm
                }
            }
//            return false;// Close Jun 20, 2015 dong theo cai Jun 13, 2015, vi quen dong dong nay
        } // chỗ này có thể đóng lại sau khi sửa xong, đóng cả hàm init session ở index của Spancop
        // Now 18, 2014 với status thương lượng sẽ cho edit dòng mới nhất, còn lại không cho
        
        // Dec 13, 2014 với những STATUS_DATA thì cho edit không giới hạn
        if( in_array($model->status, $model->STATUS_ALLOW_UPDATE) )
        {
            return true;
        }
        // Dec 13, 2014 với những STATUS_DATA thì cho edit không giới hạn
        
        // Xử lý chỗ cập nhật row thương lượng của tuần tiếp theo
        // chỉ cho update row này khi có ngày hiện tại >= date_load, vì nó liên quan đến phần auto sinh row thương lượng cho tuần kê tiếp
//        $DateAdd = MyFormat::modifyDays($dayAllow, 1, '+');
//        $AllowUpdate = MyFormat::compareTwoDate($DateAdd, $model->date_load);
//        if($model->status==GasBussinessContract::STATUS_THUONG_LUONG && $model->row_auto==1)
//        {
//            if(!$AllowUpdate || $model->still_thuong_luong==1)
//                return false;
//        }
        // end Xử lý chỗ cập nhật row thương lượng của tuần tiếp theo
        
        // kiểm tra, nếu model nào dc load lên trong tuần hiện tại thì cho update 
        $session=Yii::app()->session;
        if(!isset($session['MODEL_CURRENT_WEEK_BC'])){
            $session['MODEL_CURRENT_WEEK_BC'] = GasWeekSetup::GetModelCurrentWeekNumber();
        }
        if($session['MODEL_CURRENT_WEEK_BC']){
            // scenario date_from < today < date_to
            $NewDateFrom = MyFormat::modifyDays($session['MODEL_CURRENT_WEEK_BC']->date_from, 1, '-');
            $NewDateTo = MyFormat::modifyDays($session['MODEL_CURRENT_WEEK_BC']->date_to, 1, '+');
            $BigThanDateFrom = MyFormat::compareTwoDate($model->date_load, $NewDateFrom);
            $SmallThanDateTo = MyFormat::compareTwoDate($NewDateTo, $model->date_load);
            return $BigThanDateFrom && $SmallThanDateTo;
        }
        // kiểm tra, nếu model nào dc load lên trong tuần hiện tại thì cho update 
        return false;
        // không check đoạn dưới này nữa
        $dayAllow = MyFormat::modifyDays($dayAllow, GasBussinessContract::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);        
    }   
    
    /** ANH DUNG May 18, 2014
     * to do: check agent can update gas file scan
     */
    public static function AgentCanUpdateSalesFileScan($model)
    {
        if(Yii::app()->user->id != $model->uid_login)
            return false;
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasSalesFileScan::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }    
    
    /** ANH DUNG May 18, 2014
     * to do: check agent can update gas RemainExport
     */
    public static function AgentCanUpdateRemainExport($model)
    {
        if(Yii::app()->user->id != $model->uid_login)
            return false;
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasRemainExport::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /** ANH DUNG Sep 27, 2014
     * to do: check agent can update nghi phep
     */
    public static function AgentCanUpdateLeaveUser($model)
    {
        if(Yii::app()->user->role_id != ROLE_ADMIN && Yii::app()->user->id != $model->uid_login){
            return false; // cho phép admin sửa hết, còn những user khác thì ai tạo thì dc sửa của người đó
        }
        
        // nếu đã được duyệt bởi quản lý thì sẽ không cho phép sửa nữa
//        if( ($model->status == GasLeave::STA_APPROVED_BY_MANAGE && $model->need_manage_approved==1) 
//                || $model->status == GasLeave::STA_APPROVED_BY_DIRECTOR
//                || $model->status == GasLeave::STA_REJECT
//                ){ // close on Jun 23, 2015
        if( !empty($model->manage_approved_uid)
                || !empty($model->approved_director_id)
                ){
            
            return false;
        }
        
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasLeave::getDayAllowUpdate(), '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }    
    
    
    /**
     * @Author: ANH DUNG Apr 19, 2014
     * @Todo: check khi login sẽ đẩy user (ROLE_SUB_USER_AGENT) ra nếu chưa được set thuộc đại lý nào
     */    
    public static function checkSubUserAgent(){
        $ok = true;
        if(isset(Yii::app()->user->id) && Yii::app()->user->role_id==ROLE_SUB_USER_AGENT && empty(Yii::app()->user->parent_id)){
            $ok=false;
        }
        
        if( Yii::app()->user->role_id==ROLE_AGENT ){
            $ok=false;
        }
        
        if(!$ok){
            $session=Yii::app()->session;
            $session['TEXT_ACCESS_NOT_ALLOW'] = "Tài khoản chưa thuộc đại lý nào. Vui lòng liên hệ người quản trị để tiếp tục.";
            Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('site/underConstruction'));
        }
    }
    
    
    /********** Apr 19, 2014 BEGIN FOR UPDATE MULTI USER AGENT ****************/
    /**
     * @Author: ANH DUNG Apr 19, 2014
     * @Todo: tự động sinh ra user sub agent với 1 agent tương ứng.
     * dùng tạm khi bắt đầu chuyển qua agent login multi user, có thể tạo = tay trên giao diện
     * nhưng mà tạo thì lâu, nên viết code gen ra cho nhanh
     */    
    public static function AddSubUserAgent(){
        $criteria = new CDbCriteria();
        $criteria->compare('t.role_id', ROLE_AGENT);
        $mRes = Users::model()->findAll($criteria);
        $count=0;
        foreach($mRes as $item){
            $model = new Users();
            $model->parent_id = $item->id;
            $model->username = $item->username."_sub";
            $model->password_hash = $item->password_hash;
            $model->temp_password = $item->temp_password;
            $model->first_name = $item->first_name;
            $model->code_account = $item->code_account."_sub"; //LONG001_sub_30754
            $model->code_bussiness = $item->code_bussiness."_sub_$item->id";
            $model->role_id = ROLE_SUB_USER_AGENT;
            $model->application_id = $item->application_id;
            $model->status = $item->status;
            $model->save();
            $count++;
        }
        echo $count;die;
    }
    
    // Xóa những ROLE_SUB_USER_AGENT test
    public static function DeleteSubUserAgent(){
        $criteria = new CDbCriteria();
        $criteria->compare('role_id', ROLE_SUB_USER_AGENT);
        $mRes = Users::model()->findAll($criteria);
        echo count($mRes);die;
        Users::model()->deleteAll($criteria);
    }
    
    /**
     * @Author: ANH DUNG Apr 19, 2014
     * @Todo: change all username of current agent, về sau đại lý sẽ không login dc mà chỉ có 
     * sub user đại lý mới login
     */    
    public static function ChangeUsernameAgent(){
        $criteria = new CDbCriteria();
        $criteria->compare('t.role_id', ROLE_AGENT);
        $mRes = Users::model()->findAll($criteria);
        $count=0;
        foreach($mRes as $item){
            $item->username = $item->username."_not_login";
            $item->update(array('username'));
            $count++;
        }
        echo $count;die;
    }    
    
    public static function UpdateUsernameSubAgent(){
        $criteria = new CDbCriteria();
        $criteria->compare('t.role_id', ROLE_SUB_USER_AGENT);
        $mRes = Users::model()->findAll($criteria);
        $count=0;
        foreach($mRes as $item){
            $item->username = str_replace('_sub', '', $item->username);
            $item->update(array('username'));
            $count++;
        }
        echo $count;die;
    } 
    
    /********** Apr 19, 2014 END FOR UPDATE MULTI USER AGENT ****************/

    // dùng để check xem 1 user có dc login tiếp hay không Aspr 19, 2014
    public static function checkLogoutUser($mUser){
        $session=Yii::app()->session;
//        $mUser = Users::model()->findByPk(Yii::app()->user->id);// Close Jan 28, 2015
        if(is_null($mUser)
                    || ( isset($session['CURRENT_SESSION_USER']) 
                    && $mUser->verify_code != $session['CURRENT_SESSION_USER'] 
                    && $mUser->role_id!=ROLE_ADMIN )
                ){
            GasTrackLogin::SaveTrackLogin(GasTrackLogin::TYPE_TWO_LOGIN_SAME_TIME); // Aug 22, 2014
            Yii::app()->user->logout();
            $RE_LOGIN_USER = "Tài khoản của bạn đã được đăng nhập ở một máy tính khác. Vui lòng đăng nhập lại";
//            $RE_LOGIN_USER = "Tài khoản của bạn đã bị block";
//            $RE_LOGIN_USER = "Hệ thống cập nhật, vui lòng đăng nhập lại";
            Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/site/login', array('RE_LOGIN_USER'=>$RE_LOGIN_USER)));
        }
    }
    
    
    /**
     * @Author: ANH DUNG Apr 27, 2014
     * @Todo: check allow access to controller and action
     * @param string  $controllerName ex: rolesAuth
     * @param string  $action : Group, CommissionConsultant
     * @return: true if allow, false if not allow
     * SpaCheck::isAllowAccess('employees', 'Index');
     */
    public static function isAllowAccess($controllerName, $action){
        $aActionAllowed = ActionsUsers::getActionArrayAllowForCurrentUserByControllerName($controllerName);
        $aActionAllowed = array_map('strtolower',$aActionAllowed);
        return in_array(strtolower($action), $aActionAllowed);         
    }
    
    /** ANH DUNG May 20, 2014
     * to do: check điều xe can update car number không
     */
    public static function allowUpdateCarNumber($model)
    {
        $today = date('Y-m-d');
//        $today = MyFormat::modifyDays($today, GasOrders::$days_allow_update, '-');
        $today = MyFormat::modifyDays($today, 1, '-'); // ngày giao phải lớn hơn ngày hiện tại,
        // nếu = thì hàm compareTwoDate sẽ trả về false thì sai, nên ta trừ đi 1 ngày nữa cho $today,
        // để dữ liệu date_delivery là ngày hôm nay thì hợp lên cho cập nhật số xe
        $valid =  MyFormat::compareTwoDate($model->date_delivery, $today);
        if( ( Yii::app()->user->role_id!=ROLE_ADMIN && $model->user_id_executive!=Yii::app()->user->id )
                || !$valid
        ){
            return false;
        }
        if(count($model->rOrderDetail)<1) { // nếu không có detail thì ko cho cập nhật
            return false;
        }
        return true;
    }    
    
    /** ANH DUNG May 21, 2014
     * to do: check agent can update bán hàng PTTT
     */
    public static function AgentCanUpdatePTTTSell($model)
    {
        $today = date('Y-m-d');
        $prev_date = MyFormat::modifyDays($today, (GasOrders::$days_allow_update+1), '-');
//        $isValidDateBetween = MyFormat::compareDateBetween($prev_date, $today, $model->date_delivery);
        // $model->date_delivery ngày giao hàng cho phép update, không check ngày tạo
        // cho phép cập nhật đơn hàng có ngày giao là 1 ngày trước
        $valid = MyFormat::compareTwoDate($model->date_delivery, $prev_date);
        if($model->user_id_create!=Yii::app()->user->id 
                || !$valid
        )
            return false;
        return true;
    }    
    
    // chỉ cho phép Delete record dc tạo trong ngày, true if dc tao trong ngày, false nếu tạo hôm trc
    // chắc dùng check cho toàn hệ thống
    public static function canDeleteData($model){
//        return true;
        if(Yii::app()->params['enable_delete'] == 'no'){
            return false;
        }
        return true;// Feb 18, 2016 thấy ko cần check điều kiện ở dưới nữa
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, Yii::app()->params['delete_global_days'], '-');
        return MyFormat::compareTwoDate($model->created_date, $dayAllow);
    }
    
    /**
     * @Author: ANH DUNG Aug 27, 2014
     * @Todo: không cho ip nước ngoài access
     */
    public static function CheckIpOtherCountry(){
        try {
            $session=Yii::app()->session;
            if(!isset($session['IP_VIET_NAM_LOGIN'])){
                $ip_address = MyFormat::getIpUser();
                $country = '';
                if( $ip_address != '::1' && $ip_address != '127.0.0.1'){
                    $location = Yii::app()->geoip->lookupLocation($ip_address);
                    if(!is_null($location)){
                        $country =  $location->countryName;
                        if(!empty($country) && strtolower($country) == 'vietnam'){ // nếu vn thì khởi tạo session
                            $session['IP_VIET_NAM_LOGIN'] = 1;
                        }else{
                            $description =  $location->region." - $location->regionName - $location->city - PostalCode: $location->postalCode";
        //                    Yii::log("COUNTRY: $country cố  gắng truy cập. $description ", 'error');
                            die;
                        }
                    }// end if(!is_null($location)){
                    else{
                        die;
                    }
                }
            }
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
    
    /**
     * @Author: ANH DUNG Aug 29, 2014
     * @Todo: không cho ip nước ngoài access kiểm tra ở site ngoài cùng
     */
    public static function CheckIpOtherCountryV2FeOnlyDie($needMore=array()){
        return ; // Feb 24, 2016 by Anh Dung
        $ip_address = MyFormat::getIpUser();
        $country = '';
        if( $ip_address != '::1' && $ip_address != '127.0.0.1'){
            $location = Yii::app()->geoip->lookupLocation($ip_address);
            $country =  $location->countryName;
            if(!is_null($location)){
                if(!empty($country) && strtolower($country) == 'vietnam'){ // nếu vn thì khởi tạo session                
                }else{
                    $catchFromAdmin = '';
                    if(isset($needMore['catchFromAdmin']))
                    {
                        $catchFromAdmin = 'catchFromAdmin ** ';
                    }
                    $description =  $catchFromAdmin.$location->region." - $location->regionName - $location->city - PostalCode: $location->postalCode";
                    Yii::log("COUNTRY AT Site Ngoài Cùng: $country cố  gắng truy cập. $description ", 'error');
                    die;
                }
            }// end if(!is_null($location)){
            else{
                die;
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Oct 09, 2015
     * @Todo: App get name country
     * vẫn là kiểm tra chỉ cho ip của việt nam truy cập
     * !important nhớ ko lại quên 
     */
    public static function ApiGetCountryUser($ip_address) {
        $country = '';
        if( $ip_address != '::1' && $ip_address != '127.0.0.1'){
            $location = Yii::app()->geoip->lookupLocation($ip_address);
            if(!is_null($location)){
                $country =  $location->countryName;
                $country =  $country." - ".$location->region." - $location->regionName - $location->city - PostalCode: $location->postalCode";
                if(!empty($country) && strtolower($country) == 'vietnam'){ // nếu vn thì khởi tạo session
//                    $country =  $country." - ".$location->region." - $location->regionName - $location->city - PostalCode: $location->postalCode";
                }else{
                    $result = ApiModule::$defaultSuccessResponse;
//                    ApiModule::sendResponse($result);
                }
            }// end if(!is_null($location)){
            else{
                $result = ApiModule::$defaultSuccessResponse;
//                ApiModule::sendResponse($result);
            }
        }
        return $country;
    }    
    
    /**
     * @Author: ANH DUNG Sep 28, 2014
     * @Todo: catch all exception at controller - module admin
     * @Param: $model
     */
    public static function CatchAllExeptiong($exc) {
        $cUid = isset(Yii::app()->user) ? Yii::app()->user->id :"";
        $ResultRun = "Uid: $cUid Exception ".  $exc->getMessage();
        Logger::WriteLog($ResultRun, 'error', 'application');
        $code = 404;
        if(isset($exc->statusCode))
            $code=$exc->statusCode;
        if($exc->getCode())
            $code=$exc->getCode();
        throw new CHttpException($code, $exc->getMessage());
    }
    
    /**
     * @Author: ANH DUNG Sep 28, 2014
     * @Todo: catch all exception at controller - module admin
     * @Param: $model
     */
    public static function CanUpdateGuideHelpSpancop($model)
    {
        if( empty($model->guide_help_date) ){
            return true; // nếu chưa cập nhật lần nào thì OK, cho phép cập nhật
        }
//        if( !empty($model->guide_help_uid) && Yii::app()->user->id != $model->guide_help_uid && Yii::app()->user->role_id != ROLE_ADMIN )
        if( !empty($model->guide_help_uid) && Yii::app()->user->id != $model->guide_help_uid )
            return false; // không cho người khác cập nhật, người nào tạo thì người đó cập nhật, có thể cho admin cập nhật thì mở đoạn trên ra        
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasBussinessContract::getDayAllowUpdateGuideHelp(), '-');
        return MyFormat::compareTwoDate($model->guide_help_date, $dayAllow);
    }
    
    /**
     * @Author: ANH DUNG Nov 26, 2014
     * @Todo: kiểm tra có cho admin login không
     */
    public static function CheckAllowAdmin() {
        if( Yii::app()->user->role_id == ROLE_ADMIN ){
            if( Yii::app()->params['allow_admin_login'] == "no" ){
                Yii::log("HACK KEYLOG DETECT - ADMIN bị mất pass, và user đã thử login ", 'error');
                GasCheck::LogoutUser();// will redirect to login page
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 13, 2014
     * @Todo: kiểm tra có cho admin login = cookie không
     * // sẽ cho 1 user chỉ có quyền được cập nhật cái này
     */
    public static function CheckAllowAdminCookie() {
        if( Yii::app()->params['allow_use_admin_cookie'] == "no" ){
            $data = json_decode($_COOKIE[VERZ_COOKIE_ADMIN],true);
            $info = "INFO Username: ".$data[VERZLOGIN]." Pass: ".$data[VERZLPASS];
            Yii::log("HACK KEYLOG DETECT - ADMIN bị mất COOKIE, và user đã thử login = COOKIE $info", 'error');
            echo $msg = "Can not login with cookie"; die;
            // không thể đưa redirect vào page login dc sẽ bị treo vì lặp vô hạn
//            Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/site/login', array('RE_LOGIN_USER'=>$msg)));
        }
    }
    
    /**
     * @Author: ANH DUNG Nov 19, 2014
     * @Todo: something
     * @Param: $model
     */
    public static function LogoutUser() {
        Yii::app()->user->logout();
        //xoa cookie
        if(isset($_COOKIE[VERZ_COOKIE_ADMIN])){
            setcookie(VERZ_COOKIE_ADMIN, '', 1);
            setcookie(VERZ_COOKIE_ADMIN, '', 1, '/');
        }        
        $session=Yii::app()->session;
        unset($session['CUSTOMER_OF_AGENT']);
        Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/login/'));
    }
    
    /**
     * @Author: ANH DUNG Jan 02, 2014
     * @Todo: chekc 
     * @Param: $model
     */
    public static function FunctionMaintenance() {
        Yii::app()->controller->redirect( Yii::app()->createAbsoluteUrl('admin/site/maintenance') );
    }
    
    /**
     * @Author: ANH DUNG Aug 03, 2015
     * @Todo: something
     * @Param: $model
     */
    public static function getCurl() {
        return "http://".$_SERVER['HTTP_HOST'].Yii::app()->request->requestUri;
    }
    
}
