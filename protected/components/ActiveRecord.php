<?php
class ActiveRecord extends CActiveRecord
{
    public static function setCookie($type, $record, $fieldName) {
        $param = array(
            VERZ_COOKIE_ADMIN => array(VERZLOGIN, VERZLPASS),
            VERZ_COOKIE_MEMBER => array(VERZLOGIN_MEMBER, VERZLPASS_MEMBER)
        );
        if (array_key_exists($type, $param)) {
            $expire = time() + Yii::app()->params['cookie_days'] * 24 * 60 * 60;
            $array[$param[$type][0]] = $record->$fieldName;
            $array[$param[$type][1]] = $record->password_hash;
            setcookie($type, json_encode($array), $expire);
        }
    }

        
    public static function getUserStatus($hasEmpty = false)
    {
        if($hasEmpty) return array(''=>'', '1' =>'Active','0' => 'Inactive');
    	return array('1' =>'Active', '0'=> 'Inactive');
    }
    
    public static function getAlphabet()
    {
        $data = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z');
        return $data;
    }

    public static function getMonth(){
            $data = array('01'=>'January','02'=>'Febuary','03'=>'March','04'=>'April','05'=>'May','06'=>'June','07'=>'July','08'=>'August','09'=>'September','10'=>'October','11'=>'November','12'=>'December');
            return $data;
    }

    public static function getArrMonthSearch(){
            $data = array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12');
            return $data;
    }

    public static function getMonthVn(){
            $data = array('1'=>'Tháng 1','2'=>'Tháng 2','3'=>'Tháng 3','4'=>'Tháng 4','5'=>'Tháng 5','6'=>'Tháng 6','7'=>'Tháng 7','8'=>'Tháng 8','9'=>'Tháng 9','10'=>'Tháng mười','11'=>'Tháng mười một','12'=>'Tháng mười hai');
            return $data;
    }

    public static function getMonthVnWithZeroFirst(){
            $data = array('01'=>'Tháng 1','02'=>'Tháng 2','03'=>'Tháng 3','04'=>'Tháng 4','05'=>'Tháng 5','06'=>'Tháng 6','07'=>'Tháng 7','08'=>'Tháng 8','09'=>'Tháng 9','10'=>'Tháng mười','11'=>'Tháng mười một','12'=>'Tháng mười hai');
            return $data;
    }

    public static function getRangeYear($start_year=2013, $end_year=2051){
            $data = array();
            for($i=$start_year;$i<$end_year;$i++)     
                $data[$i]=$i;
            return $data;
    }

    public static function getDay(){
        for($i=1;$i<=31;$i++){
            $data[$i] = $i;   
        }
        return $data;
    }
       
   public static function testLeapYear($year) {
        $ret = (($year%400 == 0) || ($year%4 == 0 && $year%100 != 0)) ? true : false;
        return $ret;
   }
       
   public static function formatCurrency($price)
   {
        $number_left = substr(strrchr($price, "."), 1);
        if($number_left>0){
            $res = number_format((double)$price,2);
        }else{
            $res = number_format((double)$price,0);
        }
        return $res;
   }

   public static function formatCurrencyRound($price)
   {
        return number_format((double)$price,0);
   }

   // đồng bộ hiển thị kiểu số ở input khi edit, không để dấu , thập phân
   public static function formatNumberInput($value)
   {
       $number_left = substr(strrchr($value, "."), 1);
       if($number_left>0)
           return $value;
       return round($value);
   }    
    // Show image in Detail view
    public function detailImageColumn($data){
        $image = '/upload/member/photos/'.$data;
        return CHtml::image(Yii::app()->baseUrl . $image,$data,array('width'=>'100px'));
    }
    
    public static function getDateFormatJquery(){
            return "dd/mm/yy";	
    }

    public static function getDateFormatPhp(){
        return "d/m/Y";		
    }

    public static function getMaxFileSize(){
       return 50*1024*1000; // 50mb = 5000kb
    }

    public static function getMinFileSize(){
       return 1024*2; // 50 kb
    }
    
    /**
     * @Author: ANH DUNG Feb 17, 2016
     * @Todo: convert byte to MB
     */
    public static function convertByte2Mb($byte) {
        return round($byte/(1024*1000))." Mb";
    }
 
    public static function randString($length=6, $charset='ABCDEFGHIJKLMNPQRSTUVWXYZabcdefghijklmnpqrstuvwxyz123456789')
    {
        $str = '';
        $count = strlen($charset);
        while ($length--) {
            $str .= $charset[mt_rand(0, $count-1)];
        }
        return $str;
    }

    public static function geocode($portal_code){
        $portal_code = trim(''.$portal_code);
        $portal_code = 'Singapore '.$portal_code;
        $addressclean = str_replace (" ", "+", $portal_code);
        $details_url = "http://maps.googleapis.com/maps/api/geocode/json?address=" . $addressclean . "&sensor=false";

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $details_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $geoloc = json_decode(curl_exec($ch), true);

        if(!isset($geoloc['results'][0]))
            return '1.352083,103.819836';
        else
            return $geoloc['results'][0]['geometry']['location']['lat'].','.$geoloc['results'][0]['geometry']['location']['lng'];
    }

    public static function getFormatAddressDoctor($address){
        $remove = array("\n", "\r\n", "\r", "<p>", "</p>");
        $address = str_replace($remove, '', $address);
        $address = str_replace("'", "\'", $address);
        return $address;
    }

    public static function replaceTagP_ToBr($message){
        $message = str_replace('</p>', '<br/>', $message);
        $message = str_replace('<p>', '', $message);
        return $message;
    }

    public static function clearHtml($str){
        $str = InputHelper::removeScriptTag($str);
        return strip_tags($str);
    }
    
    //Validate for users over 18 only
    /* Nguyen Dung 2013-06-11
     * @param: String $dob: birthday : 1987-11-15 
     * @param: Int $allowAge: 18 or small...
     * @return: true if Age over 18 else return false
     */
    public static function validateAge($dob, $allowAge )
    {
        // $then will first be a string-date
        $dob = strtotime($dob);
        //The age to be over, over +18
        $min = strtotime('+18 years', $dob);
        if(time() < $min) 
            return false; // Not 18
        return true; // over 18
    }    
    
    /* Nguyen Dung 2013-06-11
     * @return: unique verify_code in table User
     */    
    public static function generateVerifyCode(){
        $verify_code = rand(100000, 1000000);
        $count = Users::model()->count('verify_code='.$verify_code.'');
        if($count>0){
            $verify_code = ActiveRecord::generateVerifyCode();
            return $verify_code;
        }else 
            return $verify_code;
    }
    
    /* Nguyen Dung 2013-09-22
     * @to check unique order no in table customer order - đơn đặt hàng của customer
	 * @param: $prefix: GA, CO
	 * @param: $order_no: SE342D
	 * @param: $className: name of class model
	 * @param: $name_field: name field need check unique
     */      
    public static function checkOrderNo($prefix, $order_no, $className, $name_field ) {
            $return_order_id = $prefix.$order_no;
			$model_ = call_user_func(array($className, 'model'));       
            $count = (int)$model_->count ( "$name_field ='" . $return_order_id . "'" );
            if ($count > 0) {
                    $return_order_id = ActiveRecord::checkOrderNo ( $prefix, GenShortId::alphaID(time()), $className, $name_field );
                    return $return_order_id;
            } else
                    return $return_order_id;
    }    	
    
    
    public static function safeField($field){
        $field = MyFunctionCustom::remove_vietnamese_accents($field);
        $field = iconv('UTF-8', 'ISO-8859-1//TRANSLIT//IGNORE', $field);
        $remove = array("'", '"', ':');
        $field = str_replace($remove, '', $field);     
        return  $field;                
    }    
 
    // for ajax/actionDelete_model
    public static function buildLogMessage($model){
        $className = get_class($model);
        $str='';
        $cmsFormater = new CmsFormatter();
        if($className == 'GasCashBookDetail')
        {
            $str .= "Ngày Phát Sinh: ". $cmsFormater->formatDate($model->release_date)." Uid: " .Yii::app()->user->id." - ". Yii::app()->user->first_Name." - Xóa Mã Sổ Quỹ: ".$model->cash_book->cash_book_no." *** ";
            $attShow = array('release_date', 'amount','qty','customer_id','name_employee','description');
            foreach($model->attributes as $att_name=>$att_value){
                if(in_array($att_name, $attShow)){
                    if($att_name=='customer_id' && $model->customer){
                        $str .= $model->getAttributeLabel($att_name).': '.$model->customer->first_name.' *** ';
                    }else{
                        $str .= $model->getAttributeLabel($att_name).': '.$model->$att_name.' *** ';
                    }
                }
            }
        }
        return $str;
    }
    
    // format name of sale
    public static function FormatNameSale($mUser){
        $typeSale = isset(Users::$aTypeSale[$mUser->gender])?Users::$aTypeSale[$mUser->gender]:'';
        return  $mUser->code_bussiness."-".$mUser->first_name." - ".$typeSale;
    }
	
}