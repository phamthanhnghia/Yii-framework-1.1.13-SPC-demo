<?php
/**
 * @todo Class for date format
 * @author bb
 */
class MyFormat
{
    const MAX_LENGTH_8 = 8;
    const MAX_LENGTH_9 = 9;
    const MAX_LENGTH_10 = 10;
    const MAX_LENGTH_11 = 11;
    const MAX_LENGTH_12 = 12;
    const MAX_LENGTH_13 = 13;
    const MAX_LENGTH_14 = 14;
    const MAX_LENGTH_15 = 15;
    public static $sMyDateFormat = 'd-M-Y' ;
    public static $sMyTimeFormat = 'H:i' ;
    public static $sMyTimeFormatAM_PM = 'h:i A' ;
    public static $dateFormatSearch = 'dd-mm-yy';
    
    const SUCCESS_UPDATE = "successUpdate";
    const ERROR_UPDATE = "ErrorUpdate";
    const MAX_LENGTH_IMAGE = 100;
    const URL_AGENT_MAP = 'http://spj.daukhimiennam.com/api/spj/getLocationAgent';
    
    public static $NOTIFY_CLASS = array(
        MyFormat::SUCCESS_UPDATE => 'notice',
        MyFormat::ERROR_UPDATE => 'notice_error',
    );
    
    public static $TheDaysOfTheWeek = array(
      'Monday'  =>'Thứ Hai',
      'Tuesday'  =>'Thứ Ba',
      'Wednesday'  =>'Thứ Tư',
      'Thursday'  =>'Thứ Năm',
      'Friday'  =>'Thứ Sáu',
      'Saturday'  =>'Thứ Bảy',
      'Sunday'  =>'Chủ Nhật',
    );
    public static $BAD_CHAR = array('"',"'", "\\");

    public static function date($date)//date in database or timestamp
    {
        $date = self::isTimeStamp($date) ? $date : strtotime($date);
        return date(self::$sMyDateFormat,$date);
    }

    public static function  isTimeStamp($timestamp)
    {
        return ((string) (int) $timestamp === $timestamp)
            && ($timestamp <= PHP_INT_MAX)
            && ($timestamp >= ~PHP_INT_MAX);
    }
    public static function currency($decimal)
    {
         return self::$sCurrencyType.Yii::app()->numberFormatter->format(self::$sMyCurrencyFormat, $decimal);
    }
    
    public static function time($date)//time in database or timestamp
    {
        $date = self::isTimeStamp($date) ? $date : strtotime($date);
        return date(self::$sMyTimeFormat,$date);
    }
    public static function timeAM($date)//time in database or timestamp
    {
        $date = self::isTimeStamp($date) ? $date : strtotime($date);
        return date(self::$sMyTimeFormatAM_PM,$date);
    }
    
    /**
    @param: date format: 20/05/2013
    @return: date format: 2013-05-20	
    */
    public static function dateConverDmyToYmd($date){
        if(empty($date)) return '';
        $date = explode('/', $date);	
        if(count($date)>2)
            return $date[2].'-'.$date[1].'-'.$date[0];
        return '';
    }
    
	/**
	@param: date format: 20-05-2013
	@return: date format: 2013-05-20	
	*/
    public static function dateDmyToYmdForAllIndexSearch($date){
        if(empty($date)) return '';
        $date = explode('-', $date);		
        if(count($date)>2)
            return $date[2].'-'.$date[1].'-'.$date[0];
        return '';
    }	
	
    public static function dateConverYmdToDmy($date, $format = "d/m/Y"){        
        if($date=='0000-00-00' || $date=='0000-00-00 00:00:00' || is_null($date))
            return '';		
        if(is_string($date))
        {
            $date = new DateTime($date);
            return $date->format($format);
        }
    }
    
    
    /** Nguyen Dung 01-11-2013
     *  cộng thêm ngày 
     * @param: $date: 2013-05-26
     * @param: $day_add: 16
     * @param: $operator: + or -
     * @param: $amount_of_days: days, months, years, hours, minutes and seconds
     */
    public static function addDays($date, $day_add, $operator='+', $amount_of_days='day', $format='Y-m-d'){
        MyFormat::isValidDate($date);
        $date2 = new DateTime($date);
        $date2->modify($operator.$day_add.' '.$amount_of_days);
        return $date2->format($format);        
    }   
    
    /** Nguyen Dung 12-20-2013 fix tên hàm cho dễ hiểu
     *  cộng hoặc trừ thêm ngày 
     *  @param: $date: 2013-05-26
     *  @param: $day_add: 16
     *  @param: $operator: + or - default is +
     *  @param: $amount_of_days: day, month, year default is "day"
     *  @param: $format: default "Y-m-d"
     *  @return: $format: default "Y-m-d"
     */
    public static function modifyDays($date, $day_add, $operator='+', $amount_of_days='day', $format='Y-m-d'){
        MyFormat::isValidDate($date);
        if($day_add == 0 || empty($day_add)){// Fix on Jan 22, 2016
            return $date;
        }
        $date2 = new DateTime($date);
//        if($day_add==0)// Close Jan 22, 2016
//            $day_add=1;
        $date2->modify($operator.$day_add.' '.$amount_of_days);
        return $date2->format($format);        
    }   
    
    /* Nguyen Dung Jun 30, 2014
    *  check valid date
     * @param: $stringcheck: 2013-05-26
     * @return: true if valid date, else false
    */
    public static function isValidDate($someString){
        $someString = trim($someString);
        if(empty($someString)) return ;
        $date = date_parse($someString);
        if (checkdate($date["month"], $date["day"], $date["year"])){
            return true;
        }
        else{            
            Yii::log("function MyFormat::isValidDate();  Uid: " .Yii::app()->user->id. " Exception Datetime không hợp lệ", 'error');
            throw new CHttpException(404, 'Yêu cầu không hợp lệ, vui lòng thử lại');
        }
    }
    
   /**
    * @Author: ANH DUNG Sep 02, 2015
    * @Todo: convert datetime to datetime db
    * @Param: $datetime: 20/05/2013 20:01:05
    */
    public static function datetimeToDbDatetime($datetime, $char='/'){
        if(empty($datetime)) return null;
        $date_tmp = explode(' ', $datetime);
        $date = explode($char, $date_tmp[0]);
        if(count($date) < 2)
            return '';
        return "$date[2]-$date[1]-$date[0] $date_tmp[1]";
    }	
    
   /**
    * @Author: ANH DUNG Sep 02, 2015
    * @Todo: convert datetime db to datetime user
    * @Param: $datetime: 2013-05-20 20:01:05
    */
    public static function datetimeDbDatetimeUser($datetime, $char='-'){
        if(empty($datetime) || $datetime== "0000-00-00 00:00:00") return '';
        $date_tmp = explode(' ', $datetime);
        $date = explode($char, $date_tmp[0]);
        if(count($date) < 2)
            return '';
        return "$date[2]/$date[1]/$date[0] $date_tmp[1]";
    }	
    
    
    /**
     * NGUYEN DUNG - TO COMPARE TWO DATE
     * @param: string $date1: 2013-10-25
     * @param: string $date2: 2013-10-20
     * @return: bool; true if date1>date2 else return flase 
     */
    public static function compareTwoDate($date1, $date2){
        $d1 = new DateTime($date1);
        $d2 = new DateTime($date2);
        if($d1>$d2) return true;
        return false;
    }    
	
    /**
     * NGUYEN DUNG - TO COMPARE 3 DATE
     * @param: string $date_from: 2013-10-25
     * @param: string $date_to: 2013-10-20
     * @param: string $date_between: 2013-10-20
     * @return: bool; true if $date_from <= $date_between <= $date_to else return flase 
     */
    public static function compareDateBetween($date_from, $date_to, $date_between){
        $date_from = new DateTime($date_from);
        $date_to = new DateTime($date_to);
        $date_between = new DateTime($date_between);
        if($date_from<=$date_between && $date_between<=$date_to) return true;
        return false;
    }
    
    /** Sep 27, 2014
     * NGUYEN DUNG - get days between 2 date
     * @param: string $date_from: 2013-10-25
     * @param: string $date_to: 2013-10-20
     * @return: number of day
     */
    public static function getNumberOfDayBetweenTwoDate($date1, $date2){
        $date1 = new DateTime($date1);
        $date2 = new DateTime($date2);
        return $diff = $date2->diff($date1)->format("%a");
    }    
    
    /** Sep 27, 2014
     * NGUYEN DUNG - get days between 2 date
     * @param: string $date_from: 2013-10-25
     * @param: string $date_to: 2013-10-20
     * @return: number of day
     */
    public static function getNumberOfDayBetweenTwoDateForLeave($date1, $date2){
        return self::getNumberOfDayBetweenTwoDate($date1, $date2)+1;
    }    
    
    /** 01-11-2014
     * NGUYEN DUNG - format tên khách hàng: mã KH - tên KH
     * @param: string $mUser model user
     * @return: string name
     */
    public static function formatNameCustomer($mUser){
        if($mUser){
            return $mUser->code_bussiness.'-'.$mUser->first_name;
        }
        return '';
    }
    
    /**
     * @Author: ANH DUNG Mar 12, 2014
     * @Todo: remove some user input sql injection
     * @Param: $string string input
     * @Param: $needMore  $needMore['RemoveScript']
     * @Return: string
     */	
    public static function removeBadCharacters($string, $needMore=array()){        
         $string = str_replace( MyFormat::$BAD_CHAR, '', $string);
         if(isset($needMore['RemoveScript'])){
             $string = InputHelper::removeScriptTag($string);
         }
         return trim($string);
//         return str_replace(array('&','<','>','/','\\','"',"'",'?','+'), '', $string);
    }    
    
    /**
     * @Author: ANH DUNG Jul 24, 2014
     * @Todo: remove script and bad character
     * @Param: $model model . Call MyFormat::RemoveScriptBad($mDetail, $aAtt);
     * @Param: $aAtt array fieldName: $aAtt = array('customer_name','customer_contact', 'address', 'note');
     */
    public static function RemoveScriptBad($model, $aAtt){
        foreach($aAtt as $fieldName){
            $model->$fieldName = MyFormat::removeBadCharacters($model->$fieldName, array('RemoveScript'=>1));
        }
    }
    
    /**
     * @Author: ANH DUNG Apr 19, 2014
     * @Todo: get agent id cho new record là cột parent_id
     * lần này sửa cho 1 agent có thể có nhiều user login
     * @Return: id của agent
     */
    public static function getAgentId(){
        return Yii::app()->user->parent_id;
    }    
    
    public static function getAgentCodeAccount(){
        $mUser = Users::model()->findByPk(Yii::app()->user->parent_id);
        if($mUser)
            return $mUser->code_account;
        return 'ADHM';
    }    
    
    //  lấy gender: để xác định là đại lý hay kho Users::IS_AGENT = 1
    public static function getAgentGender(){
        $mUser = Users::model()->findByPk(Yii::app()->user->parent_id);
        if($mUser)
            return $mUser->gender;
        return '';
    }    
    //  lấy gender: để xác định là đại lý hay kho Users::IS_AGENT = 1
    public static function getAgentInfoFieldName($fieldName){
        $mUser = Users::model()->findByPk(Yii::app()->user->parent_id);
        if($mUser)
            return $mUser->$fieldName;
        return '';
    }    
    
    /**
     * @Author: ANH DUNG May 22, 2014
     * @Todo: lấy mảng ngày từ 2 ngày đưa ra
     * @Param: $date_from format: Y-m-d
     * @Param: $date_to format: Y-m-d
     * @Return: array date array('2014-06-07','2014-06-08'....)
     */
    public static function getArrayDay($date_from, $date_to){
        if($date_from==$date_to)
            return array($date_from);
        $aRes = array();
        $date_from_obj = new DateTime($date_from);
        $date_to_obj = new DateTime($date_to);
        
        // Nếu ngày bắt đầu lớn hơn ngày kết thúc -=> sai
        if($date_from_obj>$date_to_obj) 
            return array($date_from);
        $aRes[] = $date_from;
        $ok=true;
        while ($ok){
            $temp = MyFormat::modifyDays($date_from, 1);
            $aRes[] = $temp;
            if($temp==$date_to)
                $ok=FALSE;
            $date_from = $temp;
        }
        return $aRes;            
    }
    
    /**
     * @Author: ANH DUNG Sep 27, 2014
     * @Todo: tính số ngày chủ nhật (có thể là t7 nếu có modify) có trong khoảng ngày đưa ra
     * @Param: $date_from format: Y-m-d
     * @Param: $date_to format: Y-m-d
     * @Return: array date array('2014-06-07','2014-06-08'....)
     */
    public static function getNumberOfSunday($date_from, $date_to){
        if($date_from==$date_to)
            return 0;
        $aRes = array();
        $date_from_obj = new DateTime($date_from);
        $date_to_obj = new DateTime($date_to);
//        $WeekendHolidays = array('Saturday', 'Sunday');
        $WeekendHolidays = array('Sunday');
        // Nếu ngày bắt đầu lớn hơn ngày kết thúc -=> sai
        if($date_from_obj>$date_to_obj) 
            return 0;
        $resDays = 0;
        $ok=true;
        while ($ok){
            $temp = MyFormat::modifyDays($date_from, 1);
            $date_obj_tmp = new DateTime($temp);
            if(in_array($date_obj_tmp->format('l'), $WeekendHolidays)){
                $resDays++;
            }
            $aRes[] = $temp;
            if($temp==$date_to)
                $ok=FALSE;
            $date_from = $temp;
        }
        return $resDays;            
    }
    
    // dùng để lấy mã KH hệ thống của kh, nếu có 1 thì sẽ trả về id của chính nó
    public static function getParentIdForCustomer($mUser){
        if(is_null($mUser) || empty($mUser)) return ;
        $customer_parent_id = $mUser->id;
        if(!empty($mUser->parent_id) && $mUser->parent_id>0){
            $customer_parent_id = $mUser->parent_id;
        }
        return $customer_parent_id;
    }
    
    /**
     * @Author: ANH DUNG Jun 15, 2014
     * @Todo: kiểm tra ngày user đưa lên có hợp lệ không
     * @Param: $date required format d-m-Y. May be: 15/11/1987 OR 15-11-1987
     * @Param: $stringFormat may be / or -
     * @Return: true if OK, false if not valid
     * var_dump(MyFormat::validDateInput("055/06/2014", "/"));die;
     */
    public static function validDateInput($date, $stringFormat){
        $test_arr  = explode($stringFormat, $date);
        if (count($test_arr) == 3) {
            // bool checkdate ( int $month , int $day , int $year )
            return checkdate((int)$test_arr[1], (int)$test_arr[0], (int)$test_arr[2]) ;
        }
        return false;
    }
    
    // Jun 29, 2014 viết gọn đoạn bắt exception
    public static function catchAllException($e){
        Yii::log("Statistic:: Uid: " .Yii::app()->user->id. "Exception ".  $e->getMessage(), 'error');
        $code = 404;
        if(isset($e->statusCode))
            $code=$e->statusCode;
        if($e->getCode())
            $code=$e->getCode();
        throw new CHttpException($code, $e->getMessage());        
    }
    
    /**
     * @Author: ANH DUNG Aug 15, 2014
     * @Todo: lấy ngày giới hạn search KH pttt và seri của pttt
     */
    public static function GetDateLimitSearchCustomerPttt(){
        $res = '';
        $session=Yii::app()->session;
        if(!isset($session['DateLimitSearchCustomerPttt'])){
        // chỗ này có 2 cách tính, 1 là lấy trong last_logged_in của user, không thì lấy chung trong config của hệ thống
//            $DateLimit = MyFormat::getAgentInfoFieldName('last_logged_in');
//            if(empty($DateLimit)){
//            if(1){
                $today = date('Y-m-d');
                $TimeLimit = Yii::app()->params['month_limit_search_pttt'];
                $DateLimit = MyFormat::modifyDays($today, $TimeLimit, "-", 'month')." 00:00:00";
//            }
            $session['DateLimitSearchCustomerPttt'] = $DateLimit;
        }
        return $session['DateLimitSearchCustomerPttt'];
    }
    
    public static function RemoveNumberOnly($string){
        return trim(str_replace(range(0,9),'', $string)); // to remove number on name
    }

    /**
     * @Author: ANH DUNG Aug 06, 2014
     * @Todo: remove some field need remove script
     * @Param: $model model 
     * @Param: $aAttributes array  attributes
     */
    public static function RemoveScriptOfModelField(&$model, $aAttributes){
        foreach($aAttributes as $FieldName){
            $model->$FieldName = InputHelper::removeScriptTag($model->$FieldName);
        }
    }    
    /**
     * @Author: ANH DUNG Aug 12, 2014
     * @Todo: remove some field need remove script
     * @Param: $model model 
     * @Param: $aAttributes array  attributes
     * @Param: $needMore array  array('RemoveScript'=>1)
     */
    public static function RemoveScriptAndBadCharOfModelField(&$model, $aAttributes, $needMore=array()){
        foreach($aAttributes as $FieldName){
            $model->$FieldName = MyFormat::removeBadCharacters($model->$FieldName, $needMore);
        }
    }
    
    public static function getIpUser(){
        return Yii::app()->request->getUserHostAddress();
    }
    
    /**
     * @Author: ANH DUNG Aug 30, 2014
     * @Todo: build mảng số thứ tự
     */
    public static function BuildNumberOrder($max){
        $res = array();
        for($i=1; $i<=$max; $i++):
            $res[$i] = $i;
        endfor;
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Aug 30, 2014
     * @Todo: get year, MONTH, DAY by date
     * @Param: $date: 2014-05-05 OR 2014-05-05 05:25:00
     * @param: $needMore['format']: can be: m, d...
     * @Return: default only year.
     */
//    public static function addDays($date, $day_add, $operator='+', $amount_of_days='day', $format='Y-m-d'){
    public static function GetYearByDate($date, $needMore=array()){
        $date2 = new DateTime($date);
        if(isset($needMore['format'])){
            return $date2->format($needMore['format']);    
        }
        return $date2->format('Y');
    }     

     /**
     * @Author: ANH DUNG Aug 31, 2014
     * @Todo: load model loadModelByClass
     * @Param: ($id, $ClassName)
     * @Return: model
     */
    public static function loadModelByClass($id, $ClassName) {
        try {
            $model_ = MyFormat::CheckBeforeLoadModel($ClassName);
            $model = $model_->findByPk($id);
            if ($model === null) {
                $cUid = Yii::app()->user->id;
                Yii::log("Uid : $cUid Model Bị NULL trong hàm loadModelByClass dùng hàm call_user_func.");
                throw new CHttpException(404, 'The requested page does not exist.');
            }
            return $model;
        } catch (Exception $e) {
            Yii::log("Exception " . print_r($e, true), 'error');
            throw new CHttpException("Exception " . print_r($e, true));
        }
    }
    
    /**
     * @Author: ANH DUNG Mar 06, 2015
     * @Todo: check file tồn tại before load
     * @Param: $ClassName
     */
    public static function CheckBeforeLoadModel($ClassName) {
        $path = "/protected/models/$ClassName.php";
        if (!is_file(Yii::getPathOfAlias("webroot") . $path)) {
                $cUid = Yii::app()->user->id;
                Yii::log("Uid : $cUid Lỗi model không tồn tại. Important to review this error. User có thể đã chỉnh URL");
                throw new CHttpException(404, 'The requested page does not exist.');
        }
        return $model = call_user_func(array($ClassName, 'model'));
    }
        
    /**
     * @Author: ANH DUNG Nov 07, 2014
     * @Todo: delete list model detail belong to one model parent: ex: table GasText and GasTextComment
     * @Param: $ClassNameModelDelete name of model delete: ex: GasTextComment
     * @Param: $root_id_belong value id ref to parent table: ex 1,2,3...
     * @Param: $NameField: ex: text_id
     * will call at beforeDelete: MyFormat::deleteModelDetailByRootId('GasMeetingMinutesComment', $this->id, 'meeting_minutes_id');
     */
    public static function deleteModelDetailByRootId($ClassNameModelDelete, $root_id, $NameField){
        $criteria = new CDbCriteria();
        $criteria->compare("t.$NameField", $root_id);
        $model_ = MyFormat::CheckBeforeLoadModel($ClassNameModelDelete);
        $models = $model_->findAll($criteria);
        MyFormat::deleteArrModel($models);
    }
    
    /**
     * @Author: ANH DUNG Jan 24, 2016
     */
    public static function deleteArrModel($models) {
        foreach($models as $model){
            $model->delete();
        }
    }

     /**  ANH DUNG Sep 08, 2014
    *  @to do: save file from internet
    *  @param string $url: http://verzview.com/verzbutt/demo/upload/temp/3-1374742421.jpg
    *  @param string $path: /upload/temp
    *  @param string $fileName: 3-1374742421.jpg
    */
    public static function DownloadFileUsingCurl($url, $path, $fileName ) {
        $local_file_name = ROOT.$path.'/'.$fileName;
        set_time_limit(0);
//        $fp = fopen (dirname(__FILE__) . '/localfile.tmp', 'w+');//This is the file where we save the    information
        $fp = fopen ($local_file_name, 'w+');//This is the file where we save the    information
        $ch = curl_init(str_replace(" ","%20",$url));//Here is the file we are downloading, replace spaces with %20
        curl_setopt($ch, CURLOPT_TIMEOUT, 50);
        curl_setopt($ch, CURLOPT_FILE, $fp); // write curl response to file
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_exec($ch); // get curl response
        curl_close($ch);
        fclose($fp);
    }
    
    /**
     * @Author: ANH DUNG Sep 10, 2014
     * @Todo: check file upload có phải là image không
     * @Param: $file = $_FILES['file']['tmp_name'];
     * @Return: true if file is image, false if not
     * http://stackoverflow.com/questions/15595592/php-validating-the-file-upload
     */
    public static function IsImageFile($file){
        if (file_exists($file))
        {
            $imagesizedata = getimagesize($file);
            if ($imagesizedata === FALSE)
            {
                //not image
                throw new Exception('File không phải là ảnh, không hợp lệ, chỉ cho phép JPG, JPEG, PNG. FILE IMAGE not image Invalid request 1');
            }
            else
            {
                // http://stackoverflow.com/questions/1141227/php-checking-if-the-images-is-jpg
                // http://us2.php.net/manual/en/function.exif-imagetype.php // kiem tra file upload co hop le khong
                $imageFileType = exif_imagetype($file);
                if($imageFileType != IMAGETYPE_GIF && $imageFileType != IMAGETYPE_JPEG && $imageFileType != IMAGETYPE_PNG){
                    throw new Exception('File không phải là ảnh, không hợp lệ, chỉ cho phép JPG, JPEG, PNG. FILE IMAGE NOT IMAGE Invalid request 3');
                }
                return true;
                //image
                //use $imagesizedata to get extra info
            }
        }
        else
        {
            throw new Exception('File không phải là ảnh, không hợp lệ, chỉ cho phép JPG, JPEG, PNG. FILE IMAGE not exists file Invalid request 2');
            //not file
        }
    }
    
    /**
     * @Author: ANH DUNG Nov 07, 2014
     * @Todo: bind show notify sucess, error message
     */
    public static function BindNotifyMsg() {
        if(Yii::app()->user->hasFlash(MyFormat::SUCCESS_UPDATE)):
            return $success = "<div class='flash notice div_flash'>
                        <a data-dismiss='alert' class='close' href='javascript:void(0)'>×</a>
                        ".Yii::app()->user->getFlash(MyFormat::SUCCESS_UPDATE)."
                    </div>";
        elseif(Yii::app()->user->hasFlash(MyFormat::ERROR_UPDATE)):
            return $error = "<div class='flash notice_error div_flash'>
                        <a data-dismiss='alert' class='close' href='javascript:void(0)'>×</a>
                        ".Yii::app()->user->getFlash(MyFormat::ERROR_UPDATE)."
                    </div>";
        endif;
        
    }
    
    /**
     * @Author: ANH DUNG Sep 19, 2015
     * @Todo: hiển thị bất cứ message nào trên hệ thống
     */
    public static function SystemNotifyMsg($type, $msg) {
        $class = MyFormat::$NOTIFY_CLASS[$type];
        echo "<div class='flash $class'>
                <a data-dismiss='alert' class='close' href='javascript:void(0)'>×</a>
                $msg
            </div>";
    }
    
    /**
     * @Author: ANH DUNG Nov 21, 2014
     * @Todo: build name for sale, all system
     * @Param: $model model user
     */
    public static function BuildNameSaleSystem($model) {
        if( is_null($model) ) return "";
        $typeSale = isset(Users::$aTypeSale[$model->gender])?Users::$aTypeSale[$model->gender]:'';
        $AgentBelongTo = $model->rParent?$model->rParent->first_name:'';
        return $model->code_bussiness." - ".$model->first_name." - ".$typeSale."-".$AgentBelongTo;
    }
    
    /**
     * @Author: ANH DUNG Nov 24, 2014
     * @Todo: format some number (decimal) show at input
     * @Param: $model model
     * @Param: $aAttribute array()
     */
    public static function FormatNumberDecimal($model, $aAttribute) {
        foreach( $aAttribute as $FieldName){
            $model->$FieldName = ActiveRecord::formatNumberInput($model->$FieldName);
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 27, 2014
     * @Todo: tính toán ngày bắt đầu của tháng , dựa trên ngày hiện tại
     * vd: ngày hiện tại là 28-12-2014 và số tháng trong config là 6 tháng
     * thì ta sẽ tính như sau:
     * đầu tiên ta sẽ lấy ngày 01-12-2014 rồi trừ đi 6 tháng (config)
     * sẽ ra ngày 01-06-2014
     * và sẽ return ngày 01-06-2014, để chạy thống kê từ 01-06-2014 đến 28-12-2014
     * rồi group theo tháng
     * @Param: $model
     */
    public static function GetDateFromForSupportCustomer($month_statistic) {
        $date_begin_month = date("Y-m")."-01";
        $date_from = MyFormat::modifyDays($date_begin_month, $month_statistic, '-', 'month');
        return $date_from;
    }
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: get length code for storecard, cashbook
     * tính toán độ dài cho mã thẻ kho, mã sổ quỹ
     * @Param: $model
     */
    public static function GetLengthCode($length) {
        $code_account = MyFormat::getAgentCodeAccount();
        $code_lenth_root = 5; // length mã số của 1 đại lý hay cửa hàng chuẩn
        $need_add = strlen($code_account) - $code_lenth_root;
//        if( $need_add > 0){
            $length += $need_add ; // chỗ này đảm bảo trong 1 năm sẽ có 99 ngàn phiếu được xuất cho 1 đại lý, nếu vượt thì phải xem lại chỗ này
//        } // xử lý cho cộng cả số âm cho mã này: CH215 00 00007
        return $length;
    }
    
    /**
     * @Author: ANH DUNG Jan 28, 2015
     * @Todo: get last comment for this
     * @Param: $id_root is id model parent (root) of this detail model. 
     * Ex GasMeetingMinutes có GasMeetingMinutesComment thì $id_root ở đây là id của model GasMeetingMinutes
     * @Param: $field_name tên khóa ngoại ref của GasMeetingMinutes ở table GasMeetingMinutesComment
     * @Param: $ClassName is tên model class GasMeetingMinutesComment
     * @Param: $rUidLogin is relation user post comment của GasMeetingMinutesComment 
     * @Return: string 
     * @example:  MyFormat::GetLastComment($model->id, 'meeting_minutes_id', 'GasMeetingMinutesComment', 'rUidLogin');
     */
    public static function GetLastComment($id_root, $field_name, $ClassName, $rUidLogin, $needMore=array() ) {
        $res = '';                
        $criteria = new CDbCriteria();
        $criteria->compare("t.$field_name", $id_root);
        $criteria->order = "t.id DESC";
        $criteria->limit = 1;
        $model_ = call_user_func(array($ClassName, 'model'));
        $mComment = $model_->find($criteria);
        if($mComment){
            $cmsFormater = new CmsFormatter();
            if($mComment->$rUidLogin){
                $res = $mComment->$rUidLogin->first_name."<br>".$cmsFormater->formatDateTime($mComment->created_date);
            }
        }
        return $res;
    }
    
    /**
     * @Author: ANH DUNG Jan 28, 2015
     * @Todo: count total comment for this topic
     * @Param: $id_root is id model parent (root) of this detail model. 
     * Ex GasMeetingMinutes có GasMeetingMinutesComment thì $id_root ở đây là id của model GasMeetingMinutes
     * @Param: $field_name tên khóa ngoại ref của GasMeetingMinutes ở table GasMeetingMinutesComment
     * @Param: $ClassName is tên model class GasMeetingMinutesComment
     * @Param: $rUidLogin is relation user post comment của GasMeetingMinutesComment 
     * @Return: number 
     * @example:  MyFormat::CountComment($model->id, 'meeting_minutes_id', 'GasMeetingMinutesComment', 'rUidLogin');
     */
    public static function CountComment($id_root, $field_name, $ClassName, $needMore=array() ) {
        $res = '';                
        $criteria = new CDbCriteria();
        $criteria->compare("t.$field_name", $id_root);
        $model_ = call_user_func(array($ClassName, 'model'));
        return $model_->count($criteria);
    }
    
    /**
     * @Author: ANH DUNG Feb 24, 2015
     * @Todo: get name user with level
     * @Param: $mUser
     */
    public static function GetNameWithLevel($mUser) {
        if(is_null($mUser)) {return ''; }
        $session = Yii::app()->session;
        if(isset($session['ROLE_NAME_USER'][$mUser->role_id])){
            return $mUser->first_name."<br>[".$session['ROLE_NAME_USER'][$mUser->role_id]."]";
        }
        $mRole = Roles::model()->findByPk($mUser->role_id);
        if($mRole){
            return $mUser->first_name."<br>[$mRole->role_name]";
        }
        return $mUser->first_name;
    }
    
    /**
     * @Author: ANH DUNG Feb 25, 2015
     * @Todo: add ANH DUNG TO TEST SEND MAIL in some new function cron
     */
    public static function AddEmailAnhDung(&$aModelUserMail) {
        $model = Users::model()->findByPk(142134); // // Anh Dũng NB
        if(is_array($aModelUserMail)){
            $aModelUserMail[] = $model;
        }else{
            $aModelUserMail = array($model);
        }
    }
    
    /**
     * @Author: ANH DUNG Dec 12, 2014 -- add Oct 09, 2015
     * @Todo: gen unique session id in any table
     * @param: $className: name of model, string ex Users
     * @param: $fieldName: field name of model need check
     * @return: md5 string 
     */
    public static function generateSessionIdByModel($className, $fieldName){
        $session_id = md5(time() . StringHelper::getRandomString(16));
        $model_ = call_user_func(array($className, 'model'));
        $count = $model_->count("$fieldName='$session_id'");
        if($count>0){
            $session_id = MyFunctionCustom::generateSessionIdByModel($className, $fieldName);
            return $session_id;
        }else{
            return $session_id;
        }
    }
    
    /**
     * @Author: ANH DUNG Jul 24, 2015
     * @Todo: catch error of api
     * @Param: $ex
     */
    public static function ApiCatchError($ex, $objController) {
        $result = ApiModule::$defaultResponse;
        $result['message'] = "Error exnb::: ".$ex->getMessage();
        ApiModule::sendResponse($result, $objController);
    }
    
    /**
     * @Author: ANH DUNG Nov 26, 2014
     * to copy from model to other model in one table
     * @param: model $mFrom  
     * @param: model $mTo
     * @param: array $aFieldNotCopy: array('id','something_else'...)
     * @return: model $mTo
    */
    public static function copyFromToTable($mFrom, &$mTo, $aFieldNotCopy=array()){
        foreach($mFrom->getAttributes() as $field_name=>$field_value){
            if(count($aFieldNotCopy)){
                if(!in_array($field_name, $aFieldNotCopy) && $mTo->hasAttribute($field_name) )
                    $mTo->$field_name = $mFrom->$field_name;        
            }else{
                $mTo->$field_name = $mFrom->$field_name;        
            }
        }
        return $mTo;
    }  
    
        
    /**
     * @Author: ANH DUNG Feb 24, 2016
     * @Todo: get model by slug
     */
    public static function getBySlug($className, $slug) {
        try {
        $criteria = new CDbCriteria();
        $criteria->compare("t.slug", trim($slug));
        $criteria->compare("t.status", STATUS_ACTIVE);
        $model_ = call_user_func(array($className, 'model'));
        $model = $model_->find($criteria);
        if(is_null($model)){
            throw new Exception("Model invalid");
        }
        return $model;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
    
    /**
     * @Author: ANH DUNG Aug 06, 2016
     * @Todo: get model by slug, include multi model
     */
    public static function getBySlugMulti($className, $slug) {
        try {
        $criteria = new CDbCriteria();
        $criteria->compare("t.slug", trim($slug));
        $criteria->compare("t.status", STATUS_ACTIVE);
        $criteria->with = "rTranslateOne";
        $criteria->together = true;
        $model_ = call_user_func(array($className, 'model'));
        $model = $model_->find($criteria);
        if(is_null($model)){
            throw new Exception("Model invalid");
        }
        return $model;
        } catch (Exception $exc) {
            throw new Exception($exc->getMessage());
        }
    }
    
    public static function getUrlHomeFe($needMore = array()) {
        return Yii::app()->createAbsoluteUrl("/");
    }
    
    /**
     * @Author: ANH DUNG Mar 14, 2016
     * @Todo: get format date like: Thứ 6 31-07-2015
     * @param: $date 
     */
    public static function getFeDateVN($date) {
        return MyFormat::$TheDaysOfTheWeek[date('l')].' '.MyFormat::dateConverYmdToDmy($date);
    }
    
    public static function escapeValues($value) {
        return str_replace("'", "''", $value);
    }
    
        /**  ANH DUNG Oct 07, 2014
    *  @to do: copy a file from one directory to another using PHP?
    *  @param string $path_from: /var/www/html/verz/eogchange/upload/image.jpg
    *  @param string $path_to: /var/www/html/verz/eogchange/upload/image1.jpg
    */
    public static function CopyFile($path_from, $path_to) {
        copy($path_from, $path_to);
    }
    
    /**
    * Register an opengraph property.
    * @param string $property: 'og:type'
    * @param string $data: 'website'
    */    
    public static function registerOpenGraph($property, $data)
    {
        Yii::app()->clientScript->registerMetaTag($data, null, null, array('property' => $property));
    }
    
    /**
     * @Author: ANH DUNG Jun 19, 2016
     */
    public static function label($key, $fileName="translation"){
        return Yii::t($fileName, $key);
    }
    
    /**
     * @Author: ANH DUNG Aug 13, 2016
     * @Todo: make request to url
     */
    public static function makeRequestApi($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        return curl_exec($ch);
    }
    
}
