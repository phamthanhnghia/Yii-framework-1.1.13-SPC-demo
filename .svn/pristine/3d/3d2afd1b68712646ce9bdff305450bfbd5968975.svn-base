<?php

/**
 * This is the model class for table "{{_gas_leave}}".
 *
 * The followings are the available columns in table '{{_gas_leave}}':
 * @property string $id
 * @property string $agent_id
 * @property string $uid_login
 * @property string $to_uid_approved
 * @property string $uid_leave
 * @property string $leave_date_from
 * @property string $leave_date_to
 * @property string $leave_content
 * @property integer $leave_days_real
 * @property integer $leave_days_holidays
 * @property integer $status
 * @property string $manage_approved_uid
 * @property string $manage_approved_date
 * @property string $manage_note
 * @property string $rejected_date
 * @property string $rejected_uid
 * @property string $approved_director_id
 * @property string $approved_director_date
 * @property string $director_note
 * @property string $created_date
 */
class GasLeave extends CActiveRecord
{
    // @note Apr 27, 2015, 1 nhân viên có thể tạo phép cho những nhân viên dưới quyền của mình
    public static $UID_SEARCH_USER = array(
        58463, // Nguyễn Thị Thùy Linh
        516154, // Nguyễn Thị Duyên
    );
    public static $ROLE_SEARCH_USER = array(
        ROLE_ADMIN, ROLE_MONITORING_MARKET_DEVELOPMENT, 
        ROLE_SUB_USER_AGENT, ROLE_HEAD_OF_MAINTAIN,
        ROLE_ACCOUNTING, // Oct 05, 2015 
    );
    
    public static $ROLE_APPROVE_LEVEL_1 = array(// Role duyet phep lan 1
        ROLE_CHIEF_ACCOUNTANT,  //  Kế Toán Trưởng
        ROLE_CHIEF_MONITOR, // Tổng giám sát
        ROLE_DIRECTOR_BUSSINESS,  // Giám Đốc Kinh Doanh
        ROLE_HEAD_GAS_BO,// Trưởng Phòng KD Gas Bò
        ROLE_HEAD_GAS_MOI,// Trưởng Phòng KD Gas Mối
        ROLE_HEAD_TECHNICAL,// Trưởng Phòng Kỹ Thuật
        ROLE_MONITORING,// NV Giám Sát
        ROLE_HEAD_OF_LEGAL,// Trưởng Phòng Pháp Lý - May 19, 2015
        ROLE_ACCOUNTING_ZONE,// Kế Toán Khu Vực - Sep 03, 2015
        ROLE_SUB_DIRECTOR,// Phó Giám Đốc Chi Nhánh - Oct 05, 2015
        ROLE_HEAD_OF_BUSINESS,// Trưởng Phòng Kinh Doanh - Oct 06, 2015
        ROLE_HEAD_OF_MAINTAIN,// Tổ Trưởng Tổ Bảo Trì - Oct 09, 2015
    );
    
    /** Dec 06, 2014
     * Tổ Trưởng Tổ Bảo Trì (ROLE_HEAD_OF_MAINTAIN) do Trưởng Phòng Kỹ Thuật (ROLE_HEAD_TECHNICAL) quản lý
        NV Bảo Trì (ROLE_E_MAINTAIN) do Tổ Trưởng Tổ Bảo Trì quản lý
     */
    
    // Now 21, 2014 những role phải qua kế toán trưởng approve, không tính role kế toán bán hàng do đại lý tạo hộ
    public static $ROLE_CHIEF_ACCOUNTANT_APPROVE = array(
        ROLE_ACCOUNTING, ROLE_DEBT_COLLECTION
    );
    // Now 21, 2014
    
    // Dec 06, 2014 những role phải qua Trưởng Phòng Kỹ Thuật duyệt rồi lên giám đốc
//    public static $ROLE_HEAD_TECHNICAL_APPROVE = array(
//        ROLE_HEAD_OF_MAINTAIN // Tổ Trưởng Tổ Bảo Trì
//    ); // Important: chỗ này không xử lý như thế này, vì khi Tổ Trưởng Tổ Bảo Trì tạo thì tên của người này
//    cũng nằm trong list search, nên sẽ không căn cứ như thế này nữa
    
    /** Dec 06 chỗ này xử lý cho user Tổ Trưởng Tổ Bảo Trì tạo nghỉ phép cho nv bảo trì 
    * và cả chính nhân viên Tổ Trưởng Tổ Bảo Trì đang login nữa
     cái này có thể sẽ map cho nhiều loại user về sau nữa, sẽ gắn luôn user đang login ở 
     * đầu tiên của select
     */
    public static $ROLE_HEAD_OF_MAINTAIN = array(
        ROLE_HEAD_OF_MAINTAIN, // Tổ Trưởng Tổ Bảo Trì, tạo phép cho nv bảo trì
        ROLE_BUSINESS_PROJECT // Dec 17, 2014 NV Kinh Doanh Dự Án do Trưởng Phòng Kỹ Thuật duyệt
    );
    
    // Dec 06, 2014 những role phải qua Trưởng Phòng Kỹ Thuật duyệt rồi lên giám đốc
    
    // Giám Đốc Kinh Doanh, Trưởng Phòng KD Gas Bò
    public static $ROLE_APPROVE_LEVEL_2 = array(
        ROLE_DIRECTOR // giám đốc duyệt cuối cùng
    );
    
    public $autocomplete_name;
    public $autocomplete_name_v1;
    // 0: new, 1: approved by cấp quản lý, 2: appove by giám đốc, 3: reject
    const STA_NEW = 0;
    const STA_APPROVED_BY_MANAGE = 1;
    const STA_APPROVED_BY_DIRECTOR = 2;
    const STA_REJECT = 3;
    
    const UID_HEAD_GAS_MOI = 136808; // Trưởng Phòng KD Gas Mối - Đoàn Ngọc Hải Triều - Sep 02, 2015
    // some uid for duyệt trước khi lên giám đốc
    const UID_DIRECTOR = 26676; // Giám Đốc - Vũ Thái Long
    const UID_CHIEF_ACCOUNTANT = 182302; // Kế Toán Trưởng Nguyễn Thị Ngân
    const UID_CHIEF_MONITOR = 303; // Tổng giám sát Trần Trung Hiếu
//    const UID_CHIEF_MONITOR = 375036; // backup Dec 18, 2015 (Tp gas dan dung) Tổng giám sát Trần Trung Hiếu
    const UID_DIRECTOR_BUSSINESS = 111250; // Giám Đốc Kinh Doanh - Bùi Đức Hoàn
    const UID_HEAD_GAS_BO = 114943; // Trưởng Phòng KD Gas Bò - Phạm Văn Đức
    const UID_HEAD_TECHNICAL = 289276; // Trưởng Phòng Kỹ Thuật - Bùi Văn Dũng - Dec 06, 2014
    const UID_HEAD_OF_LEGAL = 258737; // Trưởng Phòng Pháp Lý - Nguyễn Ngọc Kiên - May 19, 2015
    const UID_MANAGER_BUSSINESS = 345431; // Trưởng Phòng Kinh Doanh - Nguyễn Thanh Hải - Oct 05, 2015
    // Dec 10, 2015 định nghĩa thêm 1 số uid vào chung 1 chỗ của LEAVE
    const KH_CONGTY_MOI = 122230; // Khách Hàng Công Ty - Mối
    const KH_CONGTY_BO = 49184; // Khách Hàng Công Ty - Bò
    const AUDIT_ISSUE = 826507; // Audit - Nguyễn Thị Nga
    
    // Dec 10, 2015 định nghĩa thêm 1 số uid vào chung 1 chỗ của LEAVE

    // Sep 25, 2015 Close những cái const bên dưới lại, vì không dùng đến nữa, vì đã chuyên lên cho nhập trên giao diện rồi
//    const UID_THUY_VI = 301; // NV Kế Toán Khu Vực - Trương Thị Thúy Vi - Aug 19, 2015
//    const UID_HOAI_HAN = 705615; // NV Kế Toán Khu Vực-Bình Dương - Trần Hoài Hận - Aug 26, 2015
//    const UID_LY_HOA = 557845; // NV Kế Toán Khu Vực-Mien Tay - Trần Thị Lý Hoa - Aug 26, 2015
//    const UID_HONG_THAM = 117095; // NV Kế Toán Khu Vực - SG - Nguyễn Thị Hồng Thắm - Aug 26, 2015
//    const UID_HOANG_VINH = 710310; // Kế Toán Trưởng - VLong - Nguyễn Hoàng Vinh - Aug 29, 2015
//    const UID_MAI_TRAM = 710304; // NV Kế Toán Khu Vực - Nguyễn Thị Mai Trâm - Aug 29, 2015
//    const UID_KIEU_DIEM = 457603; // NV Kế Toán Khu Vực - Lê Thị Kiều Diễm - Aug 29, 2015
//    const UID_BAO_NGOC = 117083; // NV Kế Toán Khu Vực - Triệu Hoàng Bảo Ngọc - Sep 01, 2015
//    const UID_THACH_DOI = 265421; // NV Kế Toán Khu Vực - Châu Thạch Đời - Sep 02, 2015
//    const UID_TUYET_NT = 457656; // NV Kế Toán Khu Vực - Nguyễn Thị Tuyết - Sep 02, 2015
//    const UID_HUONG_TTT = 716835; // NV Kế Toán Khu Vực - Thạch Thị Thanh Hương - Sep 02, 2015
//    const UID_THIEN_DT = 726576; // NV Kế Toán Khu Vực - Đặng Thị Thiện - Sep 07, 2015
//    const UID_CHANH_VM = 457605; // NV Kế Toán Khu Vực - Vòng Mỹ Chánh - Sep 08, 2015
//    const UID_DAT_NV = 740841; // NV Kế Toán Khu Vực - Nguyễn Văn Đạt - Sep 11, 2015
//    const UID_NGOC_PT = 160; // NV Kế Toán Khu Vực - Phạm Thị Ngọc - Sep 18, 2015
//    const UID_THU_PTH = 457604; // NV Kế Toán Khu Vực - Phạm Thị Hồng Thu - Sep 21, 2015
//    const UID_THAO_HT = 117094; // NV Kế Toán Khu Vực - Hồ Thị Thảo - Sep 21, 2015
    // some uid for duyệt trước khi lên giám đốc
    
    // Now 17, 2014 thiết lập cho user xem tất cả đơn xin nghỉ phép    
    const UID_VIEW_ALL_LEAVE_1 = 163598; // Lễ Tân - Nguyễn Thị Hạnh
    const UID_VIEW_ALL_LEAVE_2 = 260420; // Nv kế toán - Huỳnh Thanh Thùy
    const UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI = 49241; // NV Giám Sát - Nguyễn Thị Kim Tuyết
    const UID_VIEW_ALL_HEAD_DAN_DUNG = 375036; // Trưởng Phòng Gas Dân Dụng - Trần Trung Hiếu - Aug 28, 2015
    const UID_VIEW_ALL_BUI_TAM = 211; // NV Kế Toán - Bùi Thị Tâm - NOW 10, 2015
    
    public static $LIST_STATUS_TEXT = array(
        GasLeave::STA_NEW => "Chờ Duyệt",
        GasLeave::STA_APPROVED_BY_MANAGE => "Quản lý đã duyệt",
        GasLeave::STA_APPROVED_BY_DIRECTOR => "Giám Đốc Duyệt",
        GasLeave::STA_REJECT => "Không cho phép nghỉ",
    );
    
    public static $STATUS_UPDATE_BY_MANAGE = array(
        GasLeave::STA_APPROVED_BY_MANAGE => "Cho phép nghỉ",
        GasLeave::STA_REJECT => "Không cho phép nghỉ",
    );
    
    public static $STATUS_UPDATE_BY_DIRECTOR = array(
        GasLeave::STA_APPROVED_BY_DIRECTOR => "Cho phép nghỉ",
        GasLeave::STA_REJECT => "Không cho phép nghỉ",
    );
    
    public static $LIST_STATUS_WAIT = array(
        GasLeave::STA_NEW,
    );
    public static $LIST_STATUS_APPROVED = array(
        GasLeave::STA_APPROVED_BY_MANAGE,
        GasLeave::STA_APPROVED_BY_DIRECTOR
    );
    
    public static $LIST_STATUS_REJECTED = array(
        GasLeave::STA_REJECT,
    );
    
    public static $LIST_UID_APPROVE_SALE_BO = array(
        GasLeave::UID_DIRECTOR_BUSSINESS,
        GasLeave::UID_HEAD_GAS_BO,
    );
    // Now 17, 2014 thiết lập cho user xem tất cả đơn xin nghỉ phép    
    public static $LIST_UID_VIEW_ALL= array(
        GasLeave::UID_VIEW_ALL_LEAVE_1,
        GasLeave::UID_VIEW_ALL_LEAVE_2,
        GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI,
        GasLeave::UID_CHIEF_MONITOR,
        GasLeave::UID_VIEW_ALL_BUI_TAM,
    );
    
    public $date_from;
    public $date_to;
    
    // DEC 29, 2014 array role sẽ show trong phần check chọn user thuộc quyền quản lý của 1 user khác
    public static $ROLE_BELONG_MANAGE = array(
        ROLE_ACCOUNTING, // NV Kế Toán
        ROLE_CRAFT_WAREHOUSE, // Thủ Kho
        ROLE_DRIVER, // Lái Xe
        ROLE_MANAGING_DIRECTOR, // Quản Đốc
        ROLE_WORKER, // Công Nhân
        ROLE_E_MAINTAIN, // NV Bảo Trì
        ROLE_SECURITY, // Bảo Vệ
        ROLE_PHU_XE, // Phụ Xe
        ROLE_CHIET_NAP, // NV chiết nạp
        );
    
    // lấy số ngày cho phép đại lý cập nhật
    public static function getDayAllowUpdate(){
        return Yii::app()->params['days_update_leave'];
    }
    
    /**
     * @Author: ANH DUNG May 19, 2015
     * @Todo: get listoption người duyệt
     * @note: khi thêm 1 người duyệt mới thì sẽ chỉnh ở 3 chỗ
     * 1: $ROLE_APPROVE_LEVEL_1
     * 2: some uid for duyệt trước khi lên giám đốc
     * 3: here
     */
    public static function ListoptionApprove() {
        $aModelUser = GasOneManyBig::getArrayModelUser(GasOneManyBig::TYPE_LEAVE, GasOneManyBig::TYPE_LEAVE);
        $aRes = array();
        foreach($aModelUser as $item){
            $aRes[$item->id] = $item->getNameWithRole();
        }
        return $aRes;
//        return array(
//            GasLeave::UID_DIRECTOR => "Vũ Thái Long - Giám Đốc",
//            GasLeave::UID_CHIEF_ACCOUNTANT => "Nguyễn Thị Ngân - Kế Toán Trưởng",
//            GasLeave::UID_CHIEF_MONITOR => "Trần Trung Hiếu - Tổng Giám Sát",
//            GasLeave::UID_DIRECTOR_BUSSINESS => "Bùi Đức Hoàn - Giám Đốc Kinh Doanh",
//            GasLeave::UID_HEAD_GAS_BO => "Phạm Văn Đức - Trưởng Phòng KD Gas Bò",
//            GasLeave::UID_HEAD_TECHNICAL => "Bùi Văn Dũng - Trưởng Phòng Kỹ Thuật",
//            GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI => "Nguyễn Thị Kim Tuyết - NV Giám Sát (Tây Nguyên)",
//            GasLeave::UID_HEAD_OF_LEGAL => "Nguyễn Ngọc Kiên - Trưởng Phòng Pháp Lý",
//            GasLeave::UID_THUY_VI => "Trương Thị Thúy Vi - Kế Toán Khu Vực",
//            GasLeave::UID_HOAI_HAN => "Trần Hoài Hận - Kế Toán Khu Vực",
//            GasLeave::UID_LY_HOA => "Trần Thị Lý Hoa - Kế Toán Khu Vực",
//            GasLeave::UID_HONG_THAM => "Nguyễn Thị Hồng Thắm - Kế Toán Khu Vực",
//            GasLeave::UID_HOANG_VINH => "Nguyễn Hoàng Vinh - Kế Toán Trưởng (Vĩnh Long)",
//            GasLeave::UID_MAI_TRAM => "Nguyễn Thị Mai Trâm - Kế Toán Khu Vực",
//            GasLeave::UID_KIEU_DIEM => "Lê Thị Kiều Diễm - Kế Toán Khu Vực",
//            GasLeave::UID_BAO_NGOC => "Triệu Hoàng Bảo Ngọc - Kế Toán Khu Vực",
//            GasLeave::UID_THACH_DOI => "Châu Thạch Đời - Kế Toán Khu Vực",
//            GasLeave::UID_TUYET_NT => "Nguyễn Thị Tuyết - Kế Toán Khu Vực",
//            GasLeave::UID_HUONG_TTT => "Thạch Thị Thanh Hương - Kế Toán Khu Vực",
//            GasLeave::UID_THIEN_DT => "Đặng Thị Thiện - Kế Toán Khu Vực",
//            GasLeave::UID_CHANH_VM => "Vòng Mỹ Chánh - Kế Toán Khu Vực",
//            GasLeave::UID_DAT_NV => "Nguyễn Văn Đạt - Phó Giám Đốc Chi Nhánh",
//            GasLeave::UID_NGOC_PT => "Phạm Thị Ngọc - Kế Toán Khu Vực",
//            GasLeave::UID_THU_PTH => "Phạm Thị Hồng Thu - Kế Toán Khu Vực",
//            GasLeave::UID_THAO_HT => "Hồ Thị Thảo - Kế Toán Khu Vực",
//        );
    }
    
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return GasLeave the static model class
     */
    public static function model($className=__CLASS__)
    {        
        return parent::model($className);
    }

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{_gas_leave}}';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return array(
            array('to_uid_approved, uid_leave, leave_date_from, leave_date_to, leave_content', 'required', 'on'=>'create, update'),
            array('status', 'required', 'on'=>'update_status'),
            array('status', 'CheckUserUpdateStatusLeave', 'on'=>'update_status'),
            array('leave_date_to', 'CheckDateLeave', 'on'=>'create, update'),
            array('leave_content', 'length', 'max'=>500),
            array('manage_note, director_note', 'length', 'max'=>300),
            array('id, agent_id, uid_login, to_uid_approved, uid_leave, leave_date_from, leave_date_to, leave_content, leave_days_real, leave_days_holidays, status, manage_approved_uid, manage_approved_date, manage_note, rejected_date, rejected_uid, approved_director_id, approved_director_date, director_note, created_date', 'safe'),
            array('date_from,date_to', 'safe'),
        );
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: kiểm tra ngày kết thúc phải lớn hơn hoặc = ngày bắt đầu
     */
    public function CheckDateLeave($attribute,$params)
    {
        if(!empty($this->leave_date_from) && !empty($this->leave_date_to))
        {
            $leave_date_from = '';
            $leave_date_to = '';
            if(strpos($this->leave_date_from, '/')){
                $leave_date_from = MyFormat::dateConverDmyToYmd($this->leave_date_from);
                MyFormat::isValidDate($leave_date_from);
            }
            if(strpos($this->leave_date_to, '/')){
                $leave_date_to = MyFormat::dateConverDmyToYmd($this->leave_date_to);
                MyFormat::isValidDate($leave_date_to);
            }
            if(!empty($leave_date_from) || !empty($leave_date_to)){
                $leave_date_to = MyFormat::modifyDays($leave_date_to, 1, '+');
                $isValidDate = MyFormat::compareTwoDate($leave_date_to, $leave_date_from);
                if(!$isValidDate){
                    $this->addError('leave_date_to','Ngày không hợp lệ.');
                }
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Sep 28, 2014
     * @Todo: kiểm tra user update status co hop le khong
     */
    public function CheckUserUpdateStatusLeave($attribute,$params)
    {
        if(!empty($this->status))
        {
            $cRole = Yii::app()->user->role_id;
            $cUid = Yii::app()->user->id;
            $NotAllowS1 = false;
//            if(in_array($cRole, GasLeave::$ROLE_APPROVE_LEVEL_1)){
//                // change at Now 10, 2014 - Giám Đốc Kinh Doanh, 4: Trưởng Phòng KD Gas Bò duyet sale bo
//                if( $this->to_uid_approved == GasLeave::UID_HEAD_GAS_BO ){
////                if(in_array($cUid, GasLeave::$LIST_UID_APPROVE_SALE_BO)){
//                    
//                }else{ // nếu là user approve bình thường như tổng giám sát + kế toán trưởng
//                    if($cUid != $this->to_uid_approved)
//                        $NotAllowS1 = true;
//                }
//            }
            // Apr 07, 2015 cho phép NV Giám Sát - Nguyễn Thị Kim Tuyết duyệt Khu vực Gia Lai
            if($cUid==GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI){
                return ;
            }
            // Apr 07, 2015     
            
            
            if( in_array($cRole, GasLeave::$ROLE_APPROVE_LEVEL_1) && 
                ( $cUid != $this->to_uid_approved || 
                    ( !empty($this->approved_director_id) && $userRole!=ROLE_ADMIN ) || 
                    $this->status == GasLeave::STA_APPROVED_BY_DIRECTOR || 
                    $this->status == GasLeave::STA_NEW || 
                    $cUid == $this->uid_login
                    )
            ){
                
//     BACKUP 1  Now 10, 2014 if( in_array($cRole, GasLeave::$ROLE_APPROVE_LEVEL_1) && 
//                ( $cUid != $this->to_uid_approved || 
//                    ( !empty($this->approved_director_id) && $userRole!=ROLE_ADMIN ) || 
//                    $this->status == GasLeave::STA_APPROVED_BY_DIRECTOR || 
//                    $this->status == GasLeave::STA_NEW )
//            ){
                // 1. kiem tra neu la user quan ly thi kiem tra xem co phai don do dc gui cho dung user do khong
                // 2. kiem tra khong cho cap nhat status invalid
                if( $this->to_uid_approved == GasLeave::UID_HEAD_GAS_BO ){
                    if(!in_array($cUid, GasLeave::$LIST_UID_APPROVE_SALE_BO)){
                        $this->addError('status','S2, Yêu cầu của User không hợp lệ .');
                        return ;
                    }                    
                }else{ // nếu là user approve bình thường như tổng giám sát + kế toán trưởng
                    $this->addError('status','S1, Yêu cầu của User không hợp lệ .');
                    return ;
                }                
            }
            
            if(in_array($cRole, GasLeave::$ROLE_APPROVE_LEVEL_2) && 
                    ($this->status == GasLeave::STA_APPROVED_BY_MANAGE || $this->status == GasLeave::STA_NEW) 
                ){
                $this->addError('status','Yêu cầu của User không hợp lệ.');
            }
        }
    }  

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return array(
            'rUidLogin' => array(self::BELONGS_TO, 'Users', 'uid_login'),// người tạo
            'rUidLeave' => array(self::BELONGS_TO, 'Users', 'uid_leave'),// người nghỉ
            'rAgent' => array(self::BELONGS_TO, 'Users', 'agent_id'),
            'rToUidApproved' => array(self::BELONGS_TO, 'Users', 'to_uid_approved'),
            'rManageApprovedUid' => array(self::BELONGS_TO, 'Users', 'manage_approved_uid'),
            'rRejectedUid' => array(self::BELONGS_TO, 'Users', 'rejected_uid'),
            'rApprovedDirectorId' => array(self::BELONGS_TO, 'Users', 'approved_director_id'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'agent_id' => 'Đại Lý',
            'uid_login' => 'Người Tạo',
            'to_uid_approved' => 'Người Duyệt',
            'uid_leave' => 'Nhân Viên Nghỉ',
            'leave_date_from' => 'Từ Ngày',
            'leave_date_to' => 'Đến Ngày',
            'leave_content' => 'Lý Do',
            'leave_days_real' => 'Ngày Phép',
            'leave_days_holidays' => 'Ngày Lễ',
            'status' => 'Trạng Thái',
            'manage_approved_uid' => 'Quản Lý',
            'manage_approved_date' => 'Quản Lý Duyệt Ngày',
            'manage_note' => 'Quản Lý Ghi Chú',
            'rejected_date' => 'Ngày Từ Chối',
            'rejected_uid' => 'Người Từ Chối',
            'approved_director_id' => 'Giám Đốc',
            'approved_director_date' => 'Giám Đốc Duyệt Ngày',
            'director_note' => 'Giám Đốc Ghi Chú',
            'created_date' => 'Ngày Tạo',
            'date_from' => 'NV Nghỉ Từ Ngày',
            'date_to' => 'NV Nghỉ Đến Ngày',
            'c_name' => 'Nhân Viên Nghỉ',
        );
    }

    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: search don nghi phep cho duyet nghi
     */
    public function searchWaitApproved(){
        $criteria=new CDbCriteria;
//        if( Yii::app()->user->role_id==ROLE_DIRECTOR){
//            $criteria->compare("t.status", GasLeave::STA_APPROVED_BY_MANAGE);
//        }else{
//            $criteria->addInCondition("t.status", GasLeave::$LIST_STATUS_WAIT);
//        }
        
        $criteria->addInCondition("t.status", GasLeave::$LIST_STATUS_WAIT);
        
        self::AddCriteriaSame($this, $criteria);

        $sort = new CSort();
        $sort->attributes = array(
            'leave_date_from'=>'leave_date_from',
            'leave_date_to'=>'leave_date_to',
            'status'=>'status',
            'created_date'=>'created_date',
        );    
//        $sort->defaultOrder = 't.status ASC, t.id desc'; // change jan 13, 2015
        $sort->defaultOrder = 't.id desc';

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'sort' => $sort,
                'pagination'=>array(
                    'pageSize'=> 30,
//                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: add 1 số điều kiện chung cho 3 hàm search table
     */
    public static function AddCriteriaSame($model, &$criteria){
        $userRole = Yii::app()->user->role_id;
        $userId = Yii::app()->user->id;
//        $criteria=new CDbCriteria;
        if($userRole!=ROLE_ADMIN){
            // 1. neu role la tong giam sat vs // 2. neu role la ke toan truong
            // to_uid_approved hoặc là 3: Giám Đốc Kinh Doanh, 4: Trưởng Phòng KD Gas Bò
            if(in_array($userRole, GasLeave::$ROLE_APPROVE_LEVEL_1) && !in_array($userId, GasLeave::$LIST_UID_VIEW_ALL) ){
                // change at Now 10, 2014 - Giám Đốc Kinh Doanh, 4: Trưởng Phòng KD Gas Bò duyet sale bo
                if(in_array($userId, GasLeave::$LIST_UID_APPROVE_SALE_BO)){
                    $criteria->addCondition(" "
                            . "t.to_uid_approved IN  (". implode(',', GasLeave::$LIST_UID_APPROVE_SALE_BO) .")"
                            . "OR t.manage_approved_uid IN  (". implode(',', GasLeave::$LIST_UID_APPROVE_SALE_BO) .")"
                            . " OR t.uid_login=$userId "
                        . " ");
//                    . "( t.agent_id IN (".  implode(',', $session['LIST_AGENT_OF_USER'] ).") OR t.uid_login=$cUid )"
                }else{
                    $criteria->addCondition(" t.to_uid_approved=$userId OR t.manage_approved_uid=$userId "
                            . " OR t.uid_login=$userId "
                        . " ");
                }
                
                
            }elseif($userRole==ROLE_DIRECTOR){// 3. neu role la giam doc
                $criteria->addCondition(" t.to_uid_approved=$userId OR t.approved_director_id=$userId "
                        . ""
                    . " ");            
            }elseif(in_array($userId, GasLeave::$LIST_UID_VIEW_ALL) ){
                // 4. Change Now 17, 2014 thiết lập cho user xem tất cả đơn xin nghỉ phép
                // 5. Change Mar 19, 2015 cho phép nv giám sát Kim Tuyết xem hết các đại lý mà user đó dc giới hạn (tây nguyên)
                // 6. Change Apr 22, 2015 đã xử lý send to to_uid_approved nv giám sát Kim Tuyết
//                if($userId==GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI){
//                    GasAgentCustomer::addInConditionAgent($criteria, 't.agent_id');
//                }
                // Close on Apr 22, 2015, đã xử lý send to to_uid_approved
            }
            else{
                $criteria->compare("t.uid_login", $userId);
            }
        }
        
        if(!empty($model->to_uid_approved)){ // Oct 05, 2015 fix add
            $criteria->addCondition("t.to_uid_approved=$model->to_uid_approved OR t.manage_approved_uid=$model->to_uid_approved");
        }
        
        $criteria->compare('t.uid_login', $model->uid_login);
        $criteria->compare('t.uid_leave', $model->uid_leave);
        $date_from = '';
        $date_to = '';
        if(!empty($model->date_from)){
            $date_from = MyFormat::dateDmyToYmdForAllIndexSearch($model->date_from);
        }
        if(!empty($model->date_to)){
            $date_to = MyFormat::dateDmyToYmdForAllIndexSearch($model->date_to);
        }
        if(!empty($date_from) && empty($date_to))
            $criteria->addCondition("t.leave_date_from>='$date_from'");
        if(empty($date_from) && !empty($date_to))
            $criteria->addCondition("t.leave_date_from<='$date_to'");
        if(!empty($date_from) && !empty($date_to))
            $criteria->addBetweenCondition("t.leave_date_from",$date_from,$date_to);
    }    
    
    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: search don nghi phep duoc duyet nghi
     */
    public function searchApproved()
    {
        $criteria=new CDbCriteria;
        $criteria->addInCondition("t.status", GasLeave::$LIST_STATUS_APPROVED);
        
        self::AddCriteriaSame($this, $criteria);

        $sort = new CSort();
        $sort->attributes = array(
            'leave_date_from'=>'leave_date_from',
            'leave_date_to'=>'leave_date_to',
            'status'=>'status',
            'created_date'=>'created_date',
        );    
        $sort->defaultOrder = 't.id desc';

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'sort' => $sort,
                'pagination'=>array(
                    'pageSize'=> 20,
//                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
        ));
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: search don nghi phep bi tu choi
     */
    public function searchRejected(){
        $criteria=new CDbCriteria;
        $criteria->addInCondition("t.status", GasLeave::$LIST_STATUS_REJECTED);
        
        self::AddCriteriaSame($this, $criteria);

        $sort = new CSort();
        $sort->attributes = array(
            'leave_date_from'=>'leave_date_from',
            'leave_date_to'=>'leave_date_to',
            'status'=>'status',
            'created_date'=>'created_date',
        );    
        $sort->defaultOrder = 't.id desc';

        return new CActiveDataProvider($this, array(
                'criteria'=>$criteria,
                'sort' => $sort,
                'pagination'=>array(
                    'pageSize'=> 20,
//                    'pageSize'=> Yii::app()->user->getState('pageSize',Yii::app()->params['defaultPageSize']),
                ),
        ));
    }
    
    public function defaultScope()
    {
            return array(
                    //'condition'=>'',
            );
    }
    
    protected function beforeValidate() {
        if(!GasLeave::CanAutocomplete()){
            if($this->scenario == 'create' || $this->scenario == 'update'){
                $this->uid_leave = Yii::app()->user->id;
            }
        }
        return parent::beforeValidate();
    }
    
    /**
     * @Author: ANH DUNG Mar 08, 2015
     * @Todo: cập nhật cột c_name lưu name user tại thời điểm đó lại    
     */
    public static function OnlyUpdateCName() {
//        GasLeave::OnlyUpdateCName();
        $from = time();
        $models = self::model()->findAll();
        foreach($models as $mLeave){
            $mLeave->scenario = "only_update_c_name";
            $mLeave->update(array('c_name'));
        }
        $to = time();
        $second = $to-$from;
        echo count($models).' done in: '.($second).'  Second  <=> '.($second/60).' Minutes';die;
    }
    
    protected function beforeSave() {
        $cmsFormater = new CmsFormatter();
        // Mar 08, 2015
        if($this->rUidLeave){
            $this->c_name = $cmsFormater->formatNameAndRole($this->rUidLeave);
            if( $this->scenario == "only_update_c_name" ){
                return parent::beforeSave();
            }
        }
        // Mar 08, 2015
        
        if(strpos($this->leave_date_from, '/')){
            $this->leave_date_from = MyFormat::dateConverDmyToYmd($this->leave_date_from);
            MyFormat::isValidDate($this->leave_date_from);
        }
        if(strpos($this->leave_date_to, '/')){
            $this->leave_date_to = MyFormat::dateConverDmyToYmd($this->leave_date_to);
            MyFormat::isValidDate($this->leave_date_to);
        }
        
        if($this->isNewRecord){
            if(Yii::app()->user->role_id == ROLE_SUB_USER_AGENT){
                $this->agent_id = MyFormat::getAgentId();
            }
            $this->uid_login = Yii::app()->user->id;
//            GasLeave::SomeProcess($this); // không thể để ở đây, vì khi update thì nó có thể đổi người nghỉ
        }        
        
        // di chuyển ra khỏi if($this->isNewRecord) ngày Dec 06, 2014
        if( $this->scenario == "create" ||  $this->scenario == "update" ){
            GasLeave::SomeProcess($this); // không thể để ở đây, vì khi update thì nó có thể đổi người nghỉ
        }
        // di chuyển ra khỏi if($this->isNewRecord) ngày Dec 06, 2014
        
        $this->leave_days_real = MyFormat::getNumberOfDayBetweenTwoDateForLeave($this->leave_date_from, $this->leave_date_to);
//        echo $this->leave_days_real;die;
//        echo GasLeaveHolidays::getNumberOfDayHolidays('2014-09-25', '2014-09-25');die;
        $this->leave_days_holidays = GasLeaveHolidays::getNumberOfDayHolidays($this->leave_date_from, $this->leave_date_to);
        // tinh so ngay chu nhat trong khoang ngay do
        $WeekendHolidays = MyFormat::getNumberOfSunday($this->leave_date_from, $this->leave_date_to);
        $this->leave_days_real = $this->leave_days_real-$this->leave_days_holidays - $WeekendHolidays;        
        return parent::beforeSave();
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: xu ly tinh toan 1 so field
     * 1/ xác định gửi đến ai xử lý, 1 là quản lý, 2 là đến thằng giám đốc
     * 2/ xác định luôn trạng thái của đơn này
     */
    public static function SomeProcess($model) {
        /*
         *  BIG CHANGE MAY 19, 2015 
         * CHO chọn người duyệt trên màn hình luôn
         * 
         */
        $model->need_manage_approved = 1;// 1: nhom user can quan ly approve
        $model->status = GasLeave::STA_NEW;
//        $model->to_uid_approved = GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI;
        return ;
        /*
         *  BIG CHANGE MAY 19, 2015 
         * CHO chọn người duyệt trên màn hình luôn
         * 
         */                
        
//        $model->status = GasLeave::STA_APPROVED_BY_MANAGE; // Sep 27, 2014 không hiểu chỗ này định để làm gì, cứ để status = 0 thôi
        $model->status = GasLeave::STA_NEW;        
        $model->to_uid_approved = GasLeave::UID_DIRECTOR; // den thang giam doc
        // neu sau khi quan ly approved cho cai don do thi cai to_uid_approved cung phai doi thanh uid giam doc
        $cRole = Yii::app()->user->role_id;
        $cUid = Yii::app()->user->id;
        
        if(GasLeave::HandleTayNguyenApprove($model, $cRole, $cUid)){
            return; // Apr 22, 2015 move ra ngoai if ($cRole==ROLE_SUB_USER_AGENT)
        }
        if ($cRole==ROLE_SUB_USER_AGENT) {
           /* 2. neu role la sub agent - dai ly TAO phép cho kế toán vs nv giao hàng
            * nếu là NV kế toán thì => kế toán trưởng => giám đốc
            * nếu là NV giao hàng => tổng giám sát => giám đốc
            */
            $model->need_manage_approved = 1;// 1: nhom user can quan ly approve
            $mUserLeave = Users::model()->findByPk($model->uid_leave);
            if($mUserLeave->role_id == ROLE_EMPLOYEE_MAINTAIN){
                // nhân viên giao hàng thì sẽ do => tổng giám sát approve trc => giám đốc
                $model->status = GasLeave::STA_NEW;
                $model->to_uid_approved = GasLeave::UID_CHIEF_MONITOR;
            }elseif($mUserLeave->role_id == ROLE_ACCOUNTING_AGENT){
                // nhân viên Kế Toán Bán Hàng thì sẽ do => kế toán trưởng approve trc => giám đốc
                $model->status = GasLeave::STA_NEW;
                $model->to_uid_approved = GasLeave::UID_CHIEF_ACCOUNTANT;
            }
        }
        
        // Now 10, 2014 xử lý cho sale bò: Nhân viên sale bò do giám đốc kinh doanh 
        // Bùi Đức Hoàn ( 111250 ) or trưởng phòng kinh doanh bò (Phạm Văn Đức - 114943 ) duyệt
        if ($cRole == ROLE_SALE) {
            if(Yii::app()->user->gender == Users::SALE_BO){
                $model->need_manage_approved = 1;// 1: nhom user can quan ly approve
                $model->status = GasLeave::STA_NEW;
                $model->to_uid_approved = GasLeave::UID_HEAD_GAS_BO;
            }
        }
        // Now 10, 2014
        
        // Now 21, 2014 nếu role của user cần kế toán trưởng approve
        if( in_array($cRole, GasLeave::$ROLE_CHIEF_ACCOUNTANT_APPROVE) ){
            // nhân viên Thu nợ ( hiện tại) thì sẽ do => kế toán trưởng approve trc => giám đốc
            $model->need_manage_approved = 1;// 1: nhom user can quan ly approve
            $model->status = GasLeave::STA_NEW;
            $model->to_uid_approved = GasLeave::UID_CHIEF_ACCOUNTANT;
        }
        // Now 21, 2014 nếu role của user cần kế toán trưởng approve
        //            
        // Dec 06, 2014 nếu role của user cần Trưởng Phòng Kỹ Thuật approve
//        if( in_array($cRole, self::$ROLE_HEAD_TECHNICAL_APPROVE) ){
//            // Tổ Trưởng Tổ Bảo Trì ( hiện tại) thì sẽ do => Trưởng Phòng Kỹ Thuật approve trc => giám đốc
//            $model->need_manage_approved = 1;// 1: nhom user can quan ly approve
//            $model->status = GasLeave::STA_NEW;
//            $model->to_uid_approved = GasLeave::UID_HEAD_TECHNICAL;
//        }// bỏ kiểu xử lý này đi, sẽ làm như bên dưới
        
        // Tổ Trưởng Tổ Bảo Trì tạo nghỉ phép cho chính mình + nv bảo trì trong đội
        // , xem thêm note ở chỗ khai báo $ROLE_HEAD_OF_MAINTAIN
        if( in_array($cRole, GasLeave::$ROLE_HEAD_OF_MAINTAIN) ){
            // Tổ Trưởng Tổ Bảo Trì tạo phép cho chính mình và nv bảo trì trong đội
            $mUserLeave = Users::model()->findByPk($model->uid_leave);
//            if( $mUserLeave->role_id == ROLE_HEAD_OF_MAINTAIN ){
            if( in_array($mUserLeave->role_id, GasLeave::$ROLE_HEAD_OF_MAINTAIN) ){
                // Dec 06, 2014 ROLE_HEAD_OF_MAINTAIN,  Tổ Trưởng Tổ Bảo Trì role của user cần Trưởng Phòng Kỹ Thuật approve
                // Dec 17, 2014 ROLE_BUSINESS_PROJECT NV Kinh Doanh Dự Án do Trưởng Phòng Kỹ Thuật duyệt approve
                $model->need_manage_approved = 1;// 1: nhom user can quan ly approve
                $model->status = GasLeave::STA_NEW;
                $model->to_uid_approved = GasLeave::UID_HEAD_TECHNICAL;
            }
        }
        
        // Tổ Trưởng Tổ Bảo Trì tạo nghỉ phép cho nv bảo trì, xem thêm note ở chỗ khai báo $ROLE_HEAD_OF_MAINTAIN        
        // Dec 06, 2014 nếu role của user cần Trưởng Phòng Kỹ Thuật approve
    }
    
    /**
     * @Author: ANH DUNG Apr 07, 2015
     * @Todo: cho phép NV Giám Sát - Nguyễn Thị Kim Tuyết approve Khu vực Gia Lai
     * cả NV giao hàng và kế toán bán hàng đều send cho Kim Tuyết
     * @Param: $model
     * @return: true nếu đại lý ở tây nguyên, false thì cho chạy tiếp ở function sau
     */
    public static function HandleTayNguyenApprove(&$model, $cRole, $cUid) {
        $ListAgentTayNguyen = GasAgentCustomer::getEmployeeMaintainAgent(GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI);
        $current_agent_id = MyFormat::getAgentId();
        $mUserLogin = Users::model()->findByPk($cUid);
        if( (in_array($current_agent_id, $ListAgentTayNguyen) && $cRole==ROLE_SUB_USER_AGENT) || 
            ( in_array($mUserLogin->province_id, GasProvince::$PROVINCE_TAY_NGUYEN) && $mUserLogin->id!=GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI )
        ){
            $model->need_manage_approved = 1;// 1: nhom user can quan ly approve
            $model->status = GasLeave::STA_NEW;
            $model->to_uid_approved = GasLeave::UID_VIEW_ALL_TAY_NGUYEN_GIA_LAI;
            return true;
        }
        return false;
    }
    
    /**
     * @Author: ANH DUNG Nov 21, 2014
     * @Todo: check xem co send mail cho quan ly khong
     * @Param: $model model GasLeave
     */
    public static function CheckAndSendMailToManager($model) {
        return ; // Feb 26, 2015 All email send will put to Table Schedule
        $mUserApproved = Users::model()->findByPk( $model->to_uid_approved );
        if($mUserApproved){
            if(in_array($mUserApproved->role_id, GasLeave::$ROLE_APPROVE_LEVEL_1) ){
                SendEmail::LeaveAlertSend($mUserApproved, $model);
            }
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 19, 2014
     * @Todo: check user can use autocomplete to search user
     * @Param: $model
     */
    public static function CanAutocomplete() {
        $cRole = Yii::app()->user->role_id;
        $cUid = Yii::app()->user->id;
        if(in_array($cRole, GasLeave::$ROLE_SEARCH_USER) || in_array($cUid, GasLeave::$UID_SEARCH_USER) )
        {
            return true;
        }
        return false;
    }
    
    
}