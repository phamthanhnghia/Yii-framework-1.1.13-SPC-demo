<?php
class MyFunctionCustom extends CActiveRecord
{

    /* NGUYEN DUNG - 10-16-2013
     * to Truncate a string in PHP to the word closest to a certain number of characters?
     * http://stackoverflow.com/questions/79960/how-to-truncate-a-string-in-php-to-the-word-closest-to-a-certain-number-of-chara
     * @param: $string
     * @param: $your_desired_width
     * return short string
     */
    public static function ShortenString($string, $your_desired_width){
        $string = strip_tags($string);
        if(strlen($string)<$your_desired_width) 
            return $string;
        $res =  preg_replace('/\s+?(\S+)?$/', '', substr($string, 0, $your_desired_width));
       return $res.'...';
    }
    
    /*
     * ANH DUNG recode 2013-10-14
     * for render event
     * @param: model Event $events: 2013 
     * @param: date $date: 2013-10-20
     * @return calendar with event
     */
    public static function EventCalender($events='',$date='') {
        //This puts the day, month, and year in seperate variables
        if(empty($date))
            $date = date('Y-m-d');
        $date = new DateTime($date);
        //$day = date('d', strtotime($date)) ;
        $cMonth = $date->format('m');
        $cYear = $date->format('Y');
     
        /*
         * ANH DŨNG ADD 
         */
        $prev_year = $cYear;
        $next_year = $cYear;
        $prev_month = $cMonth-1;
        $next_month = $cMonth+1;

        if ($prev_month == 0 ) {
            $prev_month = 12;
            $prev_year = $cYear - 1;
        }
        if ($next_month == 13 ) {
            $next_month = 1;
            $next_year = $cYear + 1;
        }
        $days_in_prev_month = cal_days_in_month(0, $prev_month, $prev_year) ;
        $days_in_next_month = cal_days_in_month(0, $next_month, $next_year) ;
        /*
         * END ANH DŨNG ADD
         */
        //Here we generate the first day of the month
        $first_day = mktime(0,0,0,$cMonth, 1, $cYear) ;

        //This gets us the month name
        $title = date('F', $first_day) ;

        //Here we find out what day of the week the first day of the month falls on
        $day_of_week = date('D', $first_day) ;

        //Once we know what day of the week it falls on, we know how many blank days occure before it. If the first day of the week is a Sunday then it would be zero

        switch($day_of_week){
            case "Sun": $blank = 0; break;
            case "Mon": $blank = 1; break;
            case "Tue": $blank = 2; break;
            case "Wed": $blank = 3; break;
            case "Thu": $blank = 4; break;
            case "Fri": $blank = 5; break;
            case "Sat": $blank = 6; break;
        }

        //We then determine how many days are in the current month
        $days_in_month = cal_days_in_month(0, $cMonth, $cYear) ;
        $calender = '';

        //Here we start building the table heads
        $calender.= '<table>';
        $calender.= '<thead>
                            <tr>
                                <th class="first">Sun</th>
                        	<th>Mon</th>
                            	<th>Tues</th>
                            	<th>Wed</th>
                            	<th>Thu</th>
                            	<th>Fri</th>
                            	<th>Sat</th>
                            </tr>
                   </thead><tbody>';

        //This counts the days in the week, up to 7
        $day_count = 1;
        // to show prev month
        $days_in_prev_month = $days_in_prev_month-$blank+1;

        $calender.= "<tr>";

        //first we take care of those blank days
        while ( $blank > 0 )
        {
            $classFirst = '';
            if($day_count==1)
                $classFirst = 'first';
            $calender.= "<td class='$classFirst lasttmonth'><div class='date'>$days_in_prev_month</div>
                         <div class='content'></div></td>";
            $blank = $blank-1;
            $days_in_prev_month++;
            $day_count++;
        }

        //sets the first day of the month to 1
        $day_num = 1;

        //count up the days, untill we've done all of them in the month
        while ( $day_num <= $days_in_month )
        {
            // begin to determinate show class first at cell sunday
            $cDay = new DateTime($cYear.'-'.$cMonth.'-'.$day_num);
            $cDayName = $cDay->format('l');
            $cDayClass = '';
            if(strtolower($cDayName)=='sunday')
                $cDayClass = 'first';
            // end to show class first at cell sunday
            if(empty($events)){
                $status_of_calender= "<td class='$cDayClass'><div class='date'>".$day_num."</div>
                                        <div class='content'></div></td>";
            }else{
                $status_of_calender= "";
                $FlgEvent = false;
                $list_name_events=array();
                if(count($events)>0)
                foreach($events as $event) {
                    $day_of_event = date('d',strtotime($event['datetime_from']));
                    if ($day_of_event == $day_num){
                        $status_of_slot = $event->viewStatusOfSlot();
                        if($status_of_slot == 'Session Full'){
                            $list_name_events[$event['slug']] = $event['name'];
                            $FlgEvent = true;
                            //break;
                        }
                        elseif ($status_of_slot == 'Session Almost Full'){
                           $list_name_events[$event['slug']] = $event['name'];
                            $FlgEvent = true;
                            //break;
                        }
                        else {                          
                           $list_name_events[$event['slug']] = $event['name'];
                            $FlgEvent = true;
                           // break;
                        }

                    }
                }
                if($FlgEvent == false){
                    $status_of_calender .= "<td class='$cDayClass'>
                                              <div class='date'>".$day_num."</div>
                                               <div class='content'></div>
                                            </td>";
                }else{
                    $str="<ul>";
                    foreach ($list_name_events as $k=>$v){
                          $str.="<li><a href='".Yii::app()->createAbsoluteUrl('site/register_event/'. $k)."' target='_blank'>" . $v . "</a></li>";
                    }
                    $str.="</ul>";
                    $status_of_calender .= "<td class='$cDayClass'>
                                                  <div class='date'>".$day_num."</div>
                                                  <div class='content'>".$str."</div>
                                            </td>";
                }
            }

            $calender.= $status_of_calender;

            $day_num++;
            $day_count++;

            //Make sure we start a new row every week
            if ($day_count > 7)
            {
                $calender.= "</tr><tr>";
                $day_count = 1;
            }
        }

        $day_next_month=1;
        //Finaly we finish out the table with some blank details if needed
        while ( $day_count >1 && $day_count <=7 )
        {
            $calender.= "<td class='lasttmonth'><div class='date'>$day_next_month</div>
                         <div class='content'></div></td>";
            $day_next_month++;
            $day_count++;
        }
        $calender.= "</tr></tbody></table>";
        echo $calender;
    }
        
    /**
     * trims text to a space then adds ellipses if desired
     * @param string $input text to trim
     * @param int $length in characters to trim to
     * @param bool $ellipses if ellipses (...) are to be added
     * @param bool $strip_html if html tags are to be stripped
     * @return string
     */
    public function trim_text($input, $length, $ellipses = true, $strip_html = true) {
        //strip tags, if desired
        if ($strip_html) {
            $input = strip_tags($input);
        }

        //no need to trim, already shorter than trim length
        if (strlen($input) <= $length) {
            return $input;
        }

        //find last space within length
        $last_space = strrpos(substr($input, 0, $length), ' ');
        $trimmed_text = substr($input, 0, $last_space);

        //add ellipses (...)
        if ($ellipses) {
            $trimmed_text .= '...more';
        }

        return $trimmed_text;
    }
    
    /* Nguyen Dung 10-15-2013
     * @return: unique request_number in table subscription plan 
     * @param: $className: name of model, string ex Users
     * @param: $fieldName: field name of model need check
     * @return: int: 56461213
     */    
    public static function generateRequestNumberByModel($className, $fieldName){
        $request_number = rand(10000000, 100000000);
        $model_ = call_user_func(array($className, 'model'));
        $count = $model_->count($fieldName.'='.$request_number.'');
        if($count>0){
            $request_number = MyFunctionCustom::generateRequestNumber($className, $fieldName);
            return $request_number;
        }else 
            return $request_number;
    }
    
    

	/**
	 * Returns auto generate max id: ID0001.
	 * @param:$className: Users
	 * @param:$prefix_code: ID
	 * @param:$length_max_id: int: 6
	 * @param:$fieldName: name of field generate max id in database: ex: customer_id, user_no....
         * @how to do: $model->user_no = MyFunctionCustom::getNextId('Users','ID',6,'user_no');
	 */  		
    public static function getNextId($className,$prefix_code, $length_max_id, $fieldName){
        $prefix_code_length = strlen($prefix_code);
        $criteria = new CDbCriteria;
        $criteria->select='MAX(CONVERT(SUBSTR(t.'.$fieldName.','.($prefix_code_length+1).'),SIGNED)) as MAX_ID';
        $criteria->compare("t.$fieldName",$prefix_code,true);
        $model_ = call_user_func(array($className, 'model'));        
        $model = $model_->find($criteria);
        $max_id =  (null == $model->MAX_ID) ? 0 : $model->MAX_ID;
        $max_id++;
        $addition_zero_num 	= $length_max_id - strlen($max_id) - strlen($prefix_code);
        $code = $prefix_code;
        for($i=1;$i<=$addition_zero_num;$i++)
            $code.='0';
        $code.= $max_id;
        return $code;
    }
		
	/**
	 * Returns auto generate max id: ID0001.
	 * @param:$className: Users
	 * @param:$prefix_code: ID
	 * @param:$length_max_id: int: 6
	 * @param:$fieldName: name of field generate max id in database: ex: customer_id, user_no....
         * @how to do: $model->user_no = MyFunctionCustom::getNextId('Users','ID',6,'user_no');
	 */  		
    public static function getNextIdForUser($className,$prefix_code, $length_max_id, $fieldName, $role_id, $needMore=array()){
        $prefix_code_length = strlen($prefix_code);
        $criteria = new CDbCriteria;
        $criteria->select='MAX(CONVERT(SUBSTR(t.'.$fieldName.','.($prefix_code_length+1).'),SIGNED)) as MAX_ID';
        $criteria->compare('t.role_id',$role_id);
        $criteria->compare("t.$fieldName",$prefix_code,true);
        if(isset($needMore['customer_all_system_store_card'])){
            // from saveCustomerStoreCard, khi tạo KH thẻ kho
            $criteria->compare('t.area_code_id', $needMore['customer_all_system_store_card']);
        }  else {
            // KH PTTT
            $criteria->compare('t.area_code_id',Yii::app()->user->parent_id);
        }
//        $session=Yii::app()->session;
//        if(isset($session['CUSTOMER_OF_AGENT_MAINTAIN'])){		
//                $criteria->addInCondition('t.id', $session['CUSTOMER_OF_AGENT_MAINTAIN']); 
//        } 		
        $model_ = call_user_func(array($className, 'model'));        
        $model = $model_->find($criteria);
        $max_id =  (null == $model->MAX_ID) ? 0 : $model->MAX_ID;
        $max_id++;
        $addition_zero_num 	= $length_max_id - strlen($max_id) - strlen($prefix_code);
        $code = $prefix_code;
        for($i=1;$i<=$addition_zero_num;$i++)
            $code.='0';
        $code.= $max_id;
        return $code;
    }
		
	/** Dùng hàm này sinh ra mã user của hệ thống, khác với mã khách hàng của đại lý
	 * Returns auto generate max id: ID0001.
	 * @param:$className: Users
	 * @param:$prefix_code: ID
	 * @param:$length_max_id: int: 6
	 * @param:$fieldName: name of field generate max id in database: ex: customer_id, user_no....
         * @how to do: $model->user_no = MyFunctionCustom::getNextId('Users','ID',6,'user_no');
         * 
	 */  		
    public static function getNextIdForEmployee($className,$prefix_code='HM_' , $length_max_id=8, $fieldName='code_account'){
        $prefix_code_length = strlen($prefix_code);
        $criteria = new CDbCriteria;
        $criteria->select='MAX(CONVERT(SUBSTR(t.'.$fieldName.','.($prefix_code_length+1).'),SIGNED)) as MAX_ID';        
        $criteria->addNotInCondition('t.role_id', CmsFormatter::$aRoleRestrictCode); 
        $model_ = call_user_func(array($className, 'model'));        
        $model = $model_->find($criteria);
        $max_id =  (null == $model->MAX_ID) ? 0 : $model->MAX_ID;
        $max_id++;
        $addition_zero_num 	= $length_max_id - strlen($max_id) - strlen($prefix_code);
        $code = $prefix_code;
        for($i=1;$i<=$addition_zero_num;$i++)
            $code.='0';
        $code.= $max_id;
        return $code;
    }
		
		
	/** hình như chỉ đang dùng cho KH thẻ kho
	 * Returns auto generate max id: ID0001.
	 * @param:$className: Users
	 * @param:$prefix_code: ID
	 * @param:$length_max_id: int: 6
	 * @param:$fieldName: name of field generate max id in database: ex: customer_id, user_no....
         * @how to do: $model->user_no = MyFunctionCustom::getNextId('Users','ID',6,'user_no');
	 */  		
    public static function getNextIdForCustomerAgent($className, $prefix_code, $length_max_id, $fieldName, $role_id, $needMore=array()){
        if(trim($prefix_code)=='')
        {
            Yii::log("Uid: " .Yii::app()->user->id. ". Name: bị rỗng . length_max_id: $length_max_id - Lỗi tạo mã kH prefix_code rỗng-> function getNextIdForCustomerAgent;");
            throw new CHttpException(404, 'Lỗi Tạo Mã Khách Hàng. Tên Khách Hàng Không Hợp Lệ. Vui Lòng Thử Lại');
        }        
        $prefix_code_length = strlen($prefix_code);
        $criteria = new CDbCriteria;
        $criteria->select='MAX(CONVERT(SUBSTR(t.'.$fieldName.','.($prefix_code_length+1).'),SIGNED)) as MAX_ID';
        $criteria->compare('t.role_id',$role_id);
        $criteria->compare("t.$fieldName",$prefix_code,true);
        if(isset($needMore['type'])){
            $criteria->compare('t.type', $needMore['type']);// phát sinh mã KH bảo trì hay PTTT
            //loại khách hàng, hiện tại 07-11-2013 system có 2 loại: 1: bảo trì vs 2: PTTT, 3 KH thẻ kho toàn hệ thống
        }
        if(isset($needMore['customer_all_system'])){
            // nothing to do, là trường hợp tạo KH khi làm phần thẻ kho, nghĩa là lúc đó sẽ lấy KH trên toàn hệ thống
            // dc truyền vào ở action actionCreate_customer_store_card
        }else{// KH bảo trì vs PTTT  sẽ phát sinh mã theo đại lý: vd sẽ có 2 hoặc nhiều tên ANH001 cho nhiều đại lý
            $criteria->compare('t.area_code_id',Yii::app()->user->parent_id);// fix at Apr 19, 2014 for multi user agent
        }
        $model_ = call_user_func(array($className, 'model'));        
        $model = $model_->find($criteria);
        $max_id =  (null == $model->MAX_ID) ? 0 : $model->MAX_ID;
        $max_id++;
        $addition_zero_num 	= $length_max_id - strlen($max_id) - strlen($prefix_code);
        $code = $prefix_code;
        for($i=1;$i<=$addition_zero_num;$i++)
            $code.='0';
        $code.= $max_id;
        return $code;
    }
	    
	/**
	 * Returns auto generate max id: ID0001.
	 * @param:$className: Users
	 * @param:$prefix_code: ID
	 * @param:$length_max_id: int: 6
	 * @param:$fieldName: name of field generate max id in database: ex: code_bussiness, code_account, customer_id, user_no....
	 * @param: array $role_id_not_in: will not add condition with role input
         * @how to do: $model->user_no = MyFunctionCustom::getNextId('Users','ID',6,'user_no', array(1,2));
	 */  		
    public static function getNextIdBusinessForEmployee($className, $prefix_code, $length_max_id, $fieldName, $needMore=array(), $role_id_not_in=array()){
        $prefix_code_length = strlen($prefix_code);
        $criteria = new CDbCriteria;
        $criteria->select='MAX(CONVERT(SUBSTR(t.'.$fieldName.','.($prefix_code_length+1).'),SIGNED)) as MAX_ID';
        $criteria->addNotInCondition('t.role_id',$role_id_not_in);
        $criteria->compare("t.$fieldName",$prefix_code,true);
        if(isset($needMore['id_not_in']) && count($needMore['id_not_in'])>0)
            $criteria->addNotInCondition('t.id',$needMore['id_not_in']);
        $model_ = call_user_func(array($className, 'model'));        
        $model = $model_->find($criteria);
        $max_id =  (null == $model->MAX_ID) ? 0 : $model->MAX_ID;
        $max_id++;
        $addition_zero_num 	= $length_max_id - strlen($max_id) - strlen($prefix_code);
        $code = $prefix_code;
        for($i=1;$i<=$addition_zero_num;$i++)
            $code.='0';
        $code.= $max_id;
        return $code;
    }
	    
    
    public static function updateCodeAccountUser(){
        $criteria = new CDbCriteria;        
        $criteria->addNotInCondition('t.role_id', CmsFormatter::$aRoleRestrictCode);         
        $models = Users::model()->findAll($criteria);
        foreach($models as $item){
            if(empty($item->code_account)){
                $item->code_account = MyFunctionCustom::getNextIdForEmployee('Users');
                $item->update('code_account');
            }
        }
    }
	/*
     * to make slug (url string)
     */
    public static function slugify($text)
    { 
      // replace non letter or digits by -
      $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

      // trim
      $text = trim($text, '-');

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // lowercase
      $text = strtolower($text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      if (empty($text))
      {
        return 'n-a';
      }

      return $text;
    }    
        
    /** to do: tính ra ngày phải thanh toán của KH đó, dựa trên ngày bán hàng và loại thanh toán của KH đó
     * @param: $date_sell: 2013-05-25
     * @param: $mTypePay: model of gasTypePay
     * @param: $day_sell,$month_sell,$year_sell: 02, 06, 2014
     * @return: date : 2013-05-28
     */
    public static function getDateOfPayment($date_sell,$mTypePay,$day_sell,$month_sell,$year_sell){
        $resDate = '';
        switch ($mTypePay->type) { // Loại 1: thanh toán theo số ngày quy định : vd 1 ngày, 2 ngày….
            case PAY_TYPE_1:
                    $day_add = (int)$mTypePay->pay_day;
                    $date_pay = new DateTime($date_sell);
                    $date_pay->modify('+'.$day_add.' day');
                    return $date_pay->format('Y-m-d');
                break;
            case PAY_TYPE_2: // Loại 2: định trước 1 ngày thanh toán      
                    $day_of_week = (int)$mTypePay->pay_day;
                    $strDay = CmsFormatter::$days[$day_of_week]; // is Monday, Tuesday, Wednesday...
//                    $day_name = date('l', strtotime($day_of_week));
                    if(strtolower($strDay)=='sunday'){                        
                        $resDate = new DateTime($date_sell);// fix datetime Jun-02-2014
                        $resDate->modify($strDay.' this week');
                        return $resDate->format('Y-m-d');
//                        return date('Y-m-d', strtotime($strDay.' this week',  strtotime($date_sell)));
                    }
                    else{
                        $resDate = new DateTime($date_sell);
                        $resDate->modify($strDay.' next week');
                        return $resDate->format('Y-m-d');
//                        return date('Y-m-d', strtotime($strDay.' next week',  strtotime($date_sell)));
                    }
                break;
            case PAY_TYPE_3: //  Loại 3 ngày 5 hàng tháng 
                $aDayJson = json_decode($mTypePay->json_type_3, true);
                foreach ($aDayJson[JSON_DAYS] as $key => $value) {
                    if(in_array($day_sell, $value)){
                        if($aDayJson[JSON_DAY_PAY_IN_MONTH][$key] == PAY_IN_MONTH){
                            // trả vào 1 ngày trong tháng mua
                            return $year_sell.'-'.$month_sell.'-'.$aDayJson[JSON_DAY_PAY][$key];
                        }else{
                            // trả vào 1 ngày trong tháng kế tiếp
                            $resDate = new DateTime($date_sell);// fix datetime Jun-02-2014
                            $resDate->modify('next month');
                            return $resDate->format('Y-m').'-'.$aDayJson[JSON_DAY_PAY][$key];
//                            return date('Y-m', strtotime('next month',  strtotime($date_sell))).'-'.$aDayJson[JSON_DAY_PAY][$key];
                        }
                    }
                }                
                break;
                //Loại 4 gối đầu (không làm) không thể xác định
            default:
                return '';
                break;
        }
    }
	
    /* to do: tính ra số ngày khoảng cách giữa 2 ngày 
     * @param: $date_from: 2013-05-25
     * @param: $date_to: 2013-06-25
     * @return: number : 30
     */
    public static function getDayBetween($date_from, $date_to){
		if(empty($date_from)) return false;
		$date1 = new DateTime($date_from);
		$date2 = new DateTime($date_to);
		return $diff = $date2->diff($date1)->format("%a");			
	}
	
	
    /* to do: so sánh ngày 2 ngày xem ngày nào lớn hơn
     * @param: $date_payment: 2013-05-25
     * @param: $date_report: 2013-06-25
     * @return: number : 1: lớn hơn (Trong hạn), 2: nhỏ hơn (Quá hạn), 3: bằng nhau (Tới hạn)
     */
    public static function compareTwoDay($date_payment, $date_report){
		if(empty($date_payment)) return false;
		$date_payment_dt = new DateTime($date_payment);
		$date_report_dt = new DateTime($date_report);

		if ($date_payment_dt > $date_report_dt) return TRONG_HAN;
		elseif($date_payment_dt < $date_report_dt) return QUA_HAN;
		else return TOI_HAN;	
	}	
	
    /* to do: tính toán index cột excel
     * @param: $index: 
     * @return: name index 
     */        
	public static function columnName($index)
	{
			--$index;
			if($index >= 0 && $index < 26)
					return chr(ord('A') + $index);
			else if ($index > 25)
					return (MyFunctionCustom::columnName($index / 26)).(MyFunctionCustom::columnName($index%26 + 1));
			else
					throw new Exception("Invalid Column # ".($index + 1));
	}

        public static function clearHtmlModel($model, $aAttSave){
            foreach($aAttSave as $field_name)
                if(isset($model->$field_name))
                    $model->$field_name = ActiveRecord::clearHtml($model->$field_name);
            return $model;
        }
    
        
        public static function updateListCustomerOfAgentLogin(){
            if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT){
                $session=Yii::app()->session;
                $session['CUSTOMER_OF_AGENT_MAINTAIN'] = GasMaintain::getCustomerOfAgent(MyFormat::getAgentId());
            }
        }        
		
		// MyFunctionCustom::updateListAgentOfUserMaintainLogin();
        public static function updateListAgentOfUserMaintainLogin(){
            return ;
            if(Yii::app()->user->role_id==ROLE_CHECK_MAINTAIN){
                $session=Yii::app()->session;
                $session['AGENT_OF_USER_MAINTAIN'] = GasAgentCustomer::getEmployeeMaintainAgent(Yii::app()->user->id);
            }
        }
        
        // MyFunctionCustom::saveCustomerAgent();
        public static function saveCustomerAgent($customer_id){
            return ;
            // hàm này có lẽ trc đây dùng, nhưng hiện tại Apr 19, 2014 thì ko thấy sử dụng
            if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT){
                    $criteria = new CDbCriteria();
                    $criteria->compare('customer_id',$customer_id);
                    $criteria->compare('agent_id', MyFormat::getAgentId());

                    if(GasAgentCustomer::model()->count($criteria)==0){
                            $model = new GasAgentCustomer();
                            $model->customer_id = $customer_id;
                            $model->agent_id = Yii::app()->user->id;
                            $model->save();
                    }
            }
        }
		
            // MyFunctionCustom::initNameOfRole();
    public static function initNameOfRole(){
        $session=Yii::app()->session;
        if(!isset($session['ROLE_NAME_USER']))
                $session['ROLE_NAME_USER'] = Roles::getArrRoleName();            
    }		
		
    public static function checkChangePassword(){	
//                    return;
            $mUser = Users::model()->findByPk(Yii::app()->user->id);
            //Yii::app()->user->role_id==ROLE_AGENT
            if($mUser && $mUser->temp_password==$mUser->username){
                    Yii::app()->user->setFlash('successChangeMyPassword', "Bạn phải đổi mật khẩu trước khi tiếp tục thao tác.");
                    Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/site/change_my_password'));
            }		
    }
		
    public static function remove_vietnamese_accents($str)
    {
		$str = trim($str);
        $accents_arr=array(
            "à","á","ạ","ả","ã","â","ầ","ấ","ậ","ẩ","ẫ","ă",
            "ằ","ắ","ặ","ẳ","ẵ","è","é","ẹ","ẻ","ẽ","ê","ề",
            "ế","ệ","ể","ễ",
            "ì","í","ị","ỉ","ĩ",
            "ò","ó","ọ","ỏ","õ","ô","ồ","ố","ộ","ổ","ỗ","ơ",
            "ờ","ớ","ợ","ở","ỡ",
            "ù","ú","ụ","ủ","ũ","ư","ừ","ứ","ự","ử","ữ",
            "ỳ","ý","ỵ","ỷ","ỹ",
            "đ",
            "À","Á","Ạ","Ả","Ã","Â","Ầ","Ấ","Ậ","Ẩ","Ẫ","Ă",
            "Ằ","Ắ","Ặ","Ẳ","Ẵ",
            "È","É","Ẹ","Ẻ","Ẽ","Ê","Ề","Ế","Ệ","Ể","Ễ",
            "Ì","Í","Ị","Ỉ","Ĩ",
            "Ò","Ó","Ọ","Ỏ","Õ","Ô","Ồ","Ố","Ộ","Ổ","Ỗ","Ơ",
            "Ờ","Ớ","Ợ","Ở","Ỡ",
            "Ù","Ú","Ụ","Ủ","Ũ","Ư","Ừ","Ứ","Ự","Ử","Ữ",
            "Ỳ","Ý","Ỵ","Ỷ","Ỹ",
            "Đ"
        );

        $no_accents_arr=array(
            "a","a","a","a","a","a","a","a","a","a","a",
            "a","a","a","a","a","a",
            "e","e","e","e","e","e","e","e","e","e","e",
            "i","i","i","i","i",
            "o","o","o","o","o","o","o","o","o","o","o","o",
            "o","o","o","o","o",
            "u","u","u","u","u","u","u","u","u","u","u",
            "y","y","y","y","y",
            "d",
            "A","A","A","A","A","A","A","A","A","A","A","A",
            "A","A","A","A","A",
            "E","E","E","E","E","E","E","E","E","E","E",
            "I","I","I","I","I",
            "O","O","O","O","O","O","O","O","O","O","O","O",
            "O","O","O","O","O",
            "U","U","U","U","U","U","U","U","U","U","U",
            "Y","Y","Y","Y","Y",
            "D"
        );
        return str_replace($accents_arr,$no_accents_arr,$str);
    }
    
    // dung de sinh ma KH tu dong cho dai ly, dua theo ten KH
	// @param: $name vd Nguyễn Văn Tiến
    // @return: TIEN001
    public static function genCodeBusinessCustomerAgent($name, $needMore=array()){
        $aRes = MyFunctionCustom::getCodeNameFormat($name, $needMore);
        return MyFunctionCustom::getNextIdForCustomerAgent('Users', $aRes['name'], $aRes['length_max_id'], 'code_bussiness', ROLE_CUSTOMER, $needMore);
    }

    /**
     * @Author: ANH DUNG 11-25-2013
     * @Todo: trim full name of user to get name getNameRemoveVietnamese 
     * @Param: $name full name user
     * @Return: array('name'=>name,'length_max_id'=>$length_max_id)
     */    
    public static function getCodeNameFormat($name, $needMore=array()){ 
        $name = MyFunctionCustom::getNameRemoveVietnamese($name);
        if(isset($needMore['type']) && $needMore['type'] == CUSTOMER_TYPE_STORE_CARD){
            // nothing to do -> at 01-04-2014 cho kh thẻ kho, cho phép nhập số
        }else{
            $name = trim(str_replace(range(0,9),'', $name)); // to remove number on name
        }
        $name = strtoupper($name);
        $lenName = strlen($name);
        //ex $name is nguyen  result is => nguyend001 or 000000000001
        $length_max_id = 18;
        if($lenName==14)
            $length_max_id = 17;
        elseif($lenName==13)
            $length_max_id = 16;
        elseif($lenName==12)
            $length_max_id = 15;
        elseif($lenName==11)
            $length_max_id = 14;
        elseif($lenName==10)
            $length_max_id = 13;
        elseif($lenName==9)
            $length_max_id = 12;
        elseif($lenName==8)
            $length_max_id = 11;
        elseif($lenName==7)
            $length_max_id = 10;
        elseif($lenName==6)
            $length_max_id = 9;
        elseif($lenName==5)
            $length_max_id = 8;
        elseif($lenName==4)
            $length_max_id = 7;
        elseif($lenName==3)
            $length_max_id = 6;
        elseif($lenName==2)
            $length_max_id = 5;
        elseif($lenName==1)
            $length_max_id = 4;

        if($lenName > 14)
        {
            Yii::log("Uid: " .Yii::app()->user->id. ". Name: $name - Lỗi tạo mã kH tên KH quá dài > 14 ký tự");
            throw new CHttpException(404, 'Lỗi Tạo Mã Khách Hàng. Tên Khách Hàng Quá Dài. Vui Lòng Thử Lại');
        }
        // fix 01-02-2013 for ma kh 000000000019
//         hiện tại mã KH là: TOAN001 (3 số đuôi) nếu về sau tăng lên thành TOAN00001 ( 5 số đuôi) thì sẽ mở đoạn sau ra 
//            $length_max_id +=2;
//            $length_max_id +=1; // Aug 02, 2014  mở tăng thêm 1 số nữa cho Mã KH lên TOAN0001
            $length_max_id +=2; // Sep 06, 2014  mở tăng thêm 2 số nữa cho Mã KH lên   TOAN00001
//         hiện tại mã KH là: TOAN001 nếu về sau tăng lên thành TOAN00001 thì sẽ mở đoạn sau ra 
        return array('name'=>$name, 'length_max_id'=>$length_max_id);
    }
    
    /**
     * @Author: ANH DUNG 11-25-2013
     * @Todo: sinh mã nhân viên tự động giống mã KH
     * @Param: $name full name user vd Nguyễn Văn Tiến    
     * @Param: $needMore SOME var need in update
     * @Return: string TIEN001
     */
    public static function getCodeBusinessEmployee($name, $needMore){
        $aRes = MyFunctionCustom::getCodeNameFormat($name);
        return MyFunctionCustom::getNextIdBusinessForEmployee('Users', $aRes['name'], $aRes['length_max_id'], 'code_bussiness',$needMore);
    }
    
    /* dung de tach lay ten va bo tieng viet di
     * // vd Nguyễn Văn Tiến will return Tien
     * @return: only tên tiếng việt không dấu
     */
    public static function getNameRemoveVietnamese($name){
        $name = trim($name);
        $split = explode(" ", $name);
        // Get the last value in the array.
        // count($split) returns the total amount of values.
        // Use -1 to get the index.
        $name = $split[count($split)-1];
        $name = MyFunctionCustom::remove_vietnamese_accents($name);        
        return trim($name);
    }
    
    // LIST CUSTOMER MAINTAIN kiểm tra điều kiện có thể show button update customer của đại lý ko
    // return true is allow update, else false not allow
    public static function agentCanUpdateCustomer($modelCustomer, $needMore=array()){
        // hiện tại allow update khi customer dc tạo trong ngày
        $dateToday = date('Y-m-d');
        $dateToday = new DateTime($dateToday);
        $dateCreateCustomer = new DateTime($modelCustomer->created_date);
        // chỉ có điều phối dc tạo KH thẻ kho
        if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT)
            return false;
        // chỉ có điều phối dc tạo KH thẻ kho
        
        // cho phép admin chỉnh sửa KH thẻ kho
        if(  Yii::app()->user->role_id==ROLE_ADMIN && isset($needMore['store_card']) ){
            return true;
        }
            
        if( Yii::app()->user->role_id==ROLE_DIEU_PHOI ){
            $dayAllow = date('Y-m-d'); // Jan 16, 2015 Hiện tại chỉ có điều phối được quyền sửa KH bò mối
            $dayAllow = MyFormat::modifyDays($dayAllow, Yii::app()->params['days_update_customer_bo_moi'], '-');
            return MyFormat::compareTwoDate($modelCustomer->created_date, $dayAllow);
        }
        
        if(Yii::app()->user->parent_id != $modelCustomer->area_code_id) // nếu không phải kh của đại lý thì ko cho phép update
            return false;
        if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT && ( $dateToday < $dateCreateCustomer || Yii::app()->params['can_update_customer_maintain']=='yes'))
            return true;
        return false;
    }
    
    // LIST PTTT kiểm tra điều kiện có thể show button update customer của đại lý ko
    // return true is allow update, else false not allow
    public static function agentCanUpdateMarketDevelopment($modelMarket){
        // hiện tại allow update khi customer dc tạo trong ngày
//        return true;
//        $dateToday = date('Y-m-d');
//        $dateToday = new DateTime($dateToday);
//        $dateCreate = new DateTime($modelMarket->created_date);
        
        // thiết đặt số ngày cho phép cập nhật PTTT
        if($modelMarket->file_scan_id) return false;
        $dayAllow = date('Y-m-d');
        $dayAllow = MyFormat::modifyDays($dayAllow, GasCheck::$DAY_UPDATE_PTTT, '-');
        // Apr 21, 2014 tạm thời dùng cái này sửa cho đại lý trảng dài sửa PTTT THEO config của sổ quỹ và thẻ kho
        // close ngày Jun 09, 2014
//        $session=Yii::app()->session;
//        if(!isset($session['getAgentDaysAllowUpdate'])){
//            $session['getAgentDaysAllowUpdate'] = GasCashBook::getAgentDaysAllowUpdate();
//        }
//        $dayAllow = MyFormat::modifyDays($dayAllow, $session['getAgentDaysAllowUpdate'], '-');
        // Apr 21, 2014 tạm thời dùng cái này sửa cho đại lý trảng dài sửa PTTT THEO config của sổ quỹ và thẻ kho
        
        $canUpdate = MyFormat::compareTwoDate($modelMarket->created_date, $dayAllow);
        
        if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT && $modelMarket->agent_id!=MyFormat::getAgentId())
            return false;
        if(Yii::app()->user->role_id==ROLE_SUB_USER_AGENT && ( $canUpdate || Yii::app()->params['can_update_customer_maintain']=='yes'))
            return true;
        return false;
    }
    
    
    // 11-06-2013 ANH DUNG, check user can delete record if this user create it
    public static function checkCanDeleteRecord($model, $field_name){
        if($model->$field_name==Yii::app()->user->id ||  Yii::app()->user->role_id==ROLE_ADMIN)
            return true;
        throw new CHttpException(400,'Bạn không thể xóa dữ liệu này.');
    }

    // 11-08-2013 
    public static function updateAllModel($className){
        $model_ = call_user_func(array($className, 'model'));        
        $res = $model_->findAll();
        if(count($res)>0)
            foreach($res as $item)
                $item->update();
    }    
	

    // 11-09-2013 
    public static function buildAddressUser($mUser){
        if(!$mUser) return;
        $name = trim(MyFunctionCustom::remove_vietnamese_accents($mUser->first_name));
        $house_numbers = trim(MyFunctionCustom::remove_vietnamese_accents($mUser->house_numbers));
        $phone = preg_replace('/\s+/', '', $mUser->phone); // For all whitespace
        $remove = array( "-", ".");
        $phone = str_replace($remove, "", $phone);         
        $address_vi = $mUser->code_bussiness. ' ' . $name. ' '.$phone.' '.$house_numbers;
        
        /* FOR PTTT IMPORT FILE EXCEL */
        if($mUser->IsFromPtttExcel==1){
            $mUser->address_vi = $mUser->code_bussiness. ' ' . $name. ' '.$phone.' '.MyFunctionCustom::remove_vietnamese_accents($mUser->address);
            return ;
        }
        /* FOR PTTT IMPORT FILE EXCEL */
        
        $address = $house_numbers;

        if(!empty($mUser->street_id)){
                $mGetName = GasStreet::model()->findByPk($mUser->street_id);
                $street = $mGetName?$mGetName->name:'';
                $address.= ', '.$street;
                $address_vi.= ' '.MyFunctionCustom::remove_vietnamese_accents(trim($street));
        }
        if(!empty($mUser->ward_id)){
                $mGetName = GasWard::model()->findByPk($mUser->ward_id);
                $ward = $mGetName?$mGetName->name:'';
                $address.= ', '.$ward;
                $address_vi.= ' '.MyFunctionCustom::remove_vietnamese_accents(trim($ward));
        }		
        if(!empty($mUser->district_id)){
                $mGetName = GasDistrict::model()->findByPk($mUser->district_id);
                $district = $mGetName?$mGetName->name:'';
                $address.= ', '.$district;
                $address_vi.= ' '.MyFunctionCustom::remove_vietnamese_accents(trim($district));
        }		
        if(!empty($mUser->province_id)){
                $mGetName = GasProvince::model()->findByPk($mUser->province_id);
                $province = $mGetName?$mGetName->name:'';
                $address.= ', '.$province;
                $address_vi.= ' '.MyFunctionCustom::remove_vietnamese_accents(trim($province));
        }
        $address = trim($address,',');
        $address = trim($address);
        // 1. address_temp -- for temp use, hiện giờ đóng lại
        //$mUser->address_temp = trim($address,',');
        // 2. address
        $mUser->address = trim($address,',');

        // 3. address_vi
        $address_vi = trim($address_vi);
        $address_vi = strtolower($address_vi);
        $mUser->address_vi = trim($address_vi);
        //return $mUser;
        //$mUser->update(array('address','address_vi'));
    }        
    
    public static function getMaterialsJson(){
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.parent_id<>0');
        $criteria->addNotInCondition('t.materials_type_id', GasMaterialsType::$ARR_NOT_SEARCH);
        $criteria->compare('t.status', STATUS_ACTIVE);
        $models = GasMaterials::model()->findAll($criteria);        
        $returnVal=array();
        foreach($models as $model)
        {
            $unit_use = 1; // Đơn vị sử dụng
            if(array_key_exists($model->materials_type_id, CmsFormatter::$MATERIAL_TYPE_BINH_BO_VALUE_KG))
                $unit_use = CmsFormatter::$MATERIAL_TYPE_BINH_BO_VALUE_KG[$model->materials_type_id];

            $returnVal[] = array(
                'label'=>$model->materials_no.'- '.$model->name. ' - '.$model->name_vi,
                'value'=>$model->name,
                'id'=>$model->id,
                'materials_no'=>$model->materials_no,
                'name'=>$model->name,
                'unit'=>$model->unit,
                'materials_type_id'=>$model->materials_type_id,                    
                'name_vi'=>$model->name_vi,
                'unit_use'=> $unit_use,
            );
        }
        return CJSON::encode($returnVal);
    }
    
    // lấy data cho autocomplete by type vật tư
    public static function getMaterialsJsonByType($type, $needMore=array()){
        $criteria = new CDbCriteria();
        if(!empty($type)){
            if(is_array($type)){
                $criteria->addInCondition('t.materials_type_id', $type);
            }else{
                $criteria->compare('t.materials_type_id', $type);
            }
        }

        $criteria->addCondition('t.parent_id<>0');            
        $criteria->compare('t.status', STATUS_ACTIVE);
        $models = GasMaterials::model()->findAll($criteria);        
        $returnVal=array();
        foreach($models as $model)
        {
            $unit_use = 1; // Đơn vị sử dụng
            if(array_key_exists($model->materials_type_id, CmsFormatter::$MATERIAL_TYPE_BINH_BO_VALUE_KG))
                $unit_use = CmsFormatter::$MATERIAL_TYPE_BINH_BO_VALUE_KG[$model->materials_type_id];

            $returnVal[] = array(
                'label'=>$model->materials_no.'- '.$model->name. ' - '.$model->name_vi,
                'value'=>$model->name,
                'id'=>$model->id,
                'materials_no'=>$model->materials_no,
                'name'=>$model->name,
                'unit'=>$model->unit,
                'materials_type_id'=>$model->materials_type_id,                    
                'name_vi'=>$model->name_vi,
                'unit_use'=> $unit_use,
                'price' => $model->price,
            );
        }
        return CJSON::encode($returnVal);
    }
    
    /**
     * @Author: ANH DUNG Nov 12, 2015
     * @Todo: get json material and inventory tại thời điểm hiện tại
     * @param: $type
     * @param: $sTableInventory string html inventory
     * @param: $needMore anything
     */
    public static function getMaterialsJsonByTypeWithInventory($type, &$sTableInventory, $needMore=array()){
        $criteria = new CDbCriteria();
        if(!empty($type)){
            if(is_array($type)){
                $criteria->addInCondition('t.materials_type_id', $type);
            }else{
                $criteria->compare('t.materials_type_id', $type);
            }
        }

        $criteria->addCondition('t.parent_id<>0');            
        $criteria->compare('t.status', STATUS_ACTIVE);
        $models     = GasMaterials::model()->findAll($criteria);
        // Now 12, 2015 for inventory of material
        $cRole = Yii::app()->user->role_id;
        $date_from  = date('Y-m-d'); $date_to = date('Y-m-d'); $agent_id = MyFormat::getAgentId();
        if($cRole == ROLE_ADMIN){
            $agent_id = 100; // quan 2
        }
        $aInventory = Sta2::getInventoryOfAgent($agent_id, $date_from, $date_to, $models);
        $index_inventory = 1;
        // for inventory
        $returnVal  = array();
        foreach($models as $model)
        {
            $unit_use = 1; // Đơn vị sử dụng
            if(array_key_exists($model->materials_type_id, CmsFormatter::$MATERIAL_TYPE_BINH_BO_VALUE_KG))
                $unit_use = CmsFormatter::$MATERIAL_TYPE_BINH_BO_VALUE_KG[$model->materials_type_id];

            $returnVal[] = array(
                'label'=>$model->materials_no.'- '.$model->name. ' - '.$model->name_vi,
                'value'=>$model->name,
                'id'=>$model->id,
                'materials_no'=>$model->materials_no,
                'name'=>$model->name,
                'unit'=>$model->unit,
                'materials_type_id'=>$model->materials_type_id,
                'name_vi'=>$model->name_vi,
                'unit_use'=> $unit_use,
                'price' => $model->price,
                'inventory' => $aInventory[$model->id],
            );
            if($aInventory[$model->id] != 0 ){
                self::buildTableTrInventory($sTableInventory, $model, $aInventory[$model->id], $index_inventory++);
            }
        }
        return CJSON::encode($returnVal);
    }
    
    
    /**
     * @Author: ANH DUNG Nov 19, 2015
     * @Todo: something
     * @Param: 
     */
    public static function buildTableTrInventory(&$sTableInventory, $model, $inventory, $index_inventory) {
        $sTableInventory .= "<tr>";
        $sTableInventory .= "<input type='hidden' name='json_inventory[$model->id]' value='$inventory'>";
            $sTableInventory .= "<td class='w-20 item_c' >$index_inventory</td>";
            $sTableInventory .= "<td class='w-400 padding_5'>$model->name</td>";
            $sTableInventory .= "<td class='item_c'>$model->unit</td>";
            $sTableInventory .= "<td class='item_c'>".ActiveRecord::formatCurrency($inventory)."</td>";
        $sTableInventory .= "</tr>";
    }
    
    
    /**
     * @Author: ANH DUNG Nov 12, 2015
     * @Todo: get model array id => model
     */
    public static function getMaterialsModel($type, $needMore=array()){
        $criteria = new CDbCriteria();
        if(!empty($type)){
            if(is_array($type)){
                $criteria->addInCondition('t.materials_type_id', $type);
            }else{
                $criteria->compare('t.materials_type_id', $type);
            }
        }

        $criteria->addCondition('t.parent_id<>0');            
        $criteria->compare('t.status', STATUS_ACTIVE);
        $models     = GasMaterials::model()->findAll($criteria);
        $returnVal  = array();
        foreach($models as $model)
        {
            $returnVal[$model->id] = array(
                'label'=>$model->materials_no.'- '.$model->name. ' - '.$model->name_vi,
                'value'=>$model->name,
                'id'=>$model->id,
                'materials_no'=>$model->materials_no,
                'name'=>$model->name,
                'unit'=>$model->unit,
                'materials_type_id'=>$model->materials_type_id,
                'name_vi'=>$model->name_vi,
                'price' => $model->price,
            );
        }
        return $returnVal;
    }
    
    
    /** 12-19-2013 to save customer store card
     * 1/ user for actionCreate_customer_store_card gascustomerController line 627
     * 2/ may be at create nhập/xuất kho
     * @param type $model model User
     */
    public static function saveCustomerStoreCard($model, $needMore=array()){
        $aAttSave = array('first_name','last_name',
        'province_id','district_id','ward_id','house_numbers',
        'street_id','phone','address','address_vi','name_agent',        
        'is_maintain',// vì cột is_maintain không dùng trong loại KH của thẻ kho nên ta sẽ dùng cho 1: KH bình bò, 2. KH mối
        'parent_id',
        'sale_id','payment_day','beginning',
        'channel_id', // May 14, 2015 trạng thái lấy hàng của KH
        );				        
        $model->validate($aAttSave);
        // quan trọng khi làm, nhớ chỗ saveCustomerAgent bên dưới
        if(!$model->hasErrors()){
                if(is_null($model->id)){
                    $model = MyFunctionCustom::clearHtmlModel($model, $aAttSave);
                    $model->role_id = ROLE_CUSTOMER;
                    $model->type = CUSTOMER_TYPE_STORE_CARD;
                    $model->application_id = BE;
                    if(empty($model->area_code_id))
                        $model->area_code_id = MyFormat::getAgentId(); // lưu agent id cho KH, cách cũ là session không đúng khi data nhiều,
                        // cột này hiện tại ko dùng làm gì cả với KH là CUSTOMER_TYPE_STORE_CARD
                    // $model->area_code_id xử lý thêm khi cho admin tạo KH thẻ kho. lúc đó gen code của getCodeAccount sẽ lấy id của area_code_id
                    $needMore=array('type'=>CUSTOMER_TYPE_STORE_CARD, 'customer_all_system'=>1);
                    $model->code_account = MyFunctionCustom::getNextIdForUser('Users', Users::getCodeAccount($model->area_code_id).'_', 
                            MAX_LENGTH_CODE, 
                            'code_account', ROLE_CUSTOMER,
                            array('customer_all_system_store_card'=>$model->area_code_id));
                    $model->code_bussiness = MyFunctionCustom::genCodeBusinessCustomerAgent($model->first_name, $needMore);
                    $aAttSave[] = 'role_id';
                    $aAttSave[] = 'code_account';
                    $aAttSave[] = 'code_bussiness';
                    $aAttSave[] = 'application_id';
                    $aAttSave[] = 'type';
                    $aAttSave[] = 'area_code_id';
                    $model->save(true, $aAttSave);
                    if(is_null($model->id)){
                        throw new CHttpException(404, 'Lỗi Tạo Mã Khách Hàng. Tên Khách Hàng Không Hợp Lệ. Vui Lòng Thử Lại');
                    }

                }else{ // update
                    if(isset($needMore['old_first_name'])){
                        $oldName = MyFunctionCustom::getNameRemoveVietnamese($needMore['old_first_name']);
                        $newName = MyFunctionCustom::getNameRemoveVietnamese($model->first_name);
//                            if(!empty($oldName) && strtolower($oldName) !=  strtolower($newName) && Yii::app()->user->role_id==ROLE_AGENT ){
                        if(!empty($oldName) && strtolower($oldName) !=  strtolower($newName) ){
                                $aAttSave[] = 'code_bussiness';	
                                $needMore=array('type'=>CUSTOMER_TYPE_STORE_CARD, 'customer_all_system'=>1);
                                $model->code_bussiness = MyFunctionCustom::genCodeBusinessCustomerAgent($model->first_name, $needMore);
                        }				
                    }
                    $model->update($aAttSave);
                }
        }    
        
        
    }

    /** @Author: ANH DUNG 12-20-2013
     * @Todo: tính dư đầu kỳ của vật tư với từng đại lý xác định
     * @Param: $agent_id mã đại lý
     * @Param: $material_id mã vật tư
     * @Param: $date_view Ngày xem thẻ kho vd $date_view = 2013-22-26 thì tính dư đầu kỳ là ngày hôm trc $date_delivery = 2013-11-25
     * @Return: array $OpeningStock: dư đầu kỳ, $aSumEachType: mảng phát sinh cho từng loại
     */    
    public static function calcOpeningBalance($agent_id, $materials_id, $date_view, $needMore=array()){
        $res=array();
        // nếu là thống kê tổng hợp thì sẽ tính khác
        if(isset($needMore['model']) && $needMore['model']->checkbox_view_general){
            // 1. lấy toàn bộ vật tư cấp cha và gồm cả mảng vật tư cấp con
            // mảng cấp cha trỏ đến obj id cấp cha+model+chtml list id cấp con + mảng model cấp con
            $aMaterials = GasMaterials::getArrayModelParentAndListSubId();
            $res['aMaterials'] = $aMaterials;
            foreach($aMaterials as $key=>$obj){
//                $objParent = $obj['parent_obj'];
                $res['parent_obj'][$obj['parent_obj']->id] = $obj['parent_obj'];
                $objSubModel = $obj['sub_arr_model'];// is array $key=>$mMaterial sub
                // 2. Lấy tồn đầu kỳ cho mỗi cấp cha đc nhập ban đầu bởi đại lý
                $opening_balance = MyFunctionCustom::getOpeningBalanceOfParentMaterial($agent_id, $obj['sub_chtml_listData']);
                // 3. Tính tổng nhập cho mỗi cấp cha
                $totalImport = MyFunctionCustom::calcTotalExportImport($agent_id, $obj['sub_chtml_listData'], $date_view, TYPE_STORE_CARD_IMPORT);
                // 4. Tính tổng xuất cho mỗi cấp cha
                $totalExport = MyFunctionCustom::calcTotalExportImport($agent_id, $obj['sub_chtml_listData'], $date_view, TYPE_STORE_CARD_EXPORT);
                
                $temp = array();
                $temp['parent_obj'] = $obj['parent_obj'] ;
                $temp['opening_balance'] = $opening_balance ;
                $temp['totalImport'] = $totalImport ;
                $temp['totalExport'] = $totalExport ;
                $res['array_materials_type_id'][$obj['parent_obj']->materials_type_id][$obj['parent_obj']->id] = $temp; // 02-13-2014 sửa chỗ này, gom nhóm theo loại vật tư
                if(!isset($res[$obj['parent_obj']->materials_type_id]['opening_balance']))
                    $res[$obj['parent_obj']->materials_type_id]['opening_balance'] = $opening_balance;
                else
                    $res[$obj['parent_obj']->materials_type_id]['opening_balance'] += $opening_balance;
                if(!isset($res[$obj['parent_obj']->materials_type_id]['totalImport']))
                    $res[$obj['parent_obj']->materials_type_id]['totalImport'] = $totalImport;
                else
                    $res[$obj['parent_obj']->materials_type_id]['totalImport'] += $totalImport;
                if(!isset($res[$obj['parent_obj']->materials_type_id]['totalExport']))
                    $res[$obj['parent_obj']->materials_type_id]['totalExport'] = $totalExport;
                else
                    $res[$obj['parent_obj']->materials_type_id]['totalExport'] += $totalExport;
            }
        }else{ // thống kê thông thường theo từng vật tư
            if(empty($materials_id)) return array();
            $OpeningStock = MyFunctionCustom::calcOpeningStockOnly($agent_id, $materials_id, $date_view);
            // 5. tính phát sinh trong ngày
            $aSumEachType = MyFunctionCustom::calcTransaction($agent_id, $materials_id, $date_view);
            $mMaterial = GasMaterials::model()->findByPk($materials_id);
            $mMaterialParent = GasMaterials::model()->findByPk($mMaterial->parent_id);
            $res = array('OpeningStock'=>$OpeningStock, 
                    'aSumEachType'=>$aSumEachType,
                    'mMaterial'=> $mMaterial,
                    'mMaterialParent'=> $mMaterialParent,
                    );            
        }
        $_SESSION['data-excel'] = $res;
        return $res;         
    }
   
    /** @Author: ANH DUNG 01-01-2014
     * @Todo: tách hàm ra chỉ làm nhiệm vụ tính dư đầu  đại lý nhập 
     * @Param: $agent_id mã đại lý
     * @Param: $material_id mã vật tư
     * @Param: $date_view Ngày xem thẻ kho vd $date_view = 2013-22-26 thì tính dư đầu kỳ là ngày hôm trc $date_delivery = 2013-11-25
     * @Return: number số dư đầu kỳ mà đại lý nhập khi bắt đầu sử dụng chức năng thẻ kho của vật tư này
     */   
     public static function calcOpeningStockOnly($agent_id, $materials_id, $date_view){
            // vd $date_view = 2013-22-26 thì tính dư đầu kỳ là ngày hôm trc $date_delivery = 2013-11-25
            // 1. Lấy tồn đầu kỳ đc nhập ban đầu bởi đại lý
            $opening_balance = MyFunctionCustom::getOpeningBalanceOfMaterial($agent_id, $materials_id);
            // 2. Tính tổng nhập 
            $totalImport = MyFunctionCustom::calcTotalExportImport($agent_id, $materials_id, $date_view, TYPE_STORE_CARD_IMPORT);
            // 3. Tính tổng xuất        
            $totalExport = MyFunctionCustom::calcTotalExportImport($agent_id, $materials_id, $date_view, TYPE_STORE_CARD_EXPORT);
            // 4. kết quả tính tồn đầu kỳ của vật tư
            return $OpeningStock = $opening_balance+$totalImport-$totalExport; // tồn đầu kỳ của vật tư => $OpeningStock         
     }
    

    /** @Author: ANH DUNG 12-20-2013
     * @Todo: tính dư đầu kỳ được đại lý nhập khi bắt đầu sử dụng chức năng thẻ kho - ban đầu của 1 vật tư 
     * @Param: $agent_id mã đại lý
     * @Param: $material_id mã vật tư
     * @Return: number số dư đầu kỳ mà đại lý nhập khi bắt đầu sử dụng chức năng thẻ kho của vật tư này
     */       
    public static function getOpeningBalanceOfMaterial($agent_id, $materials_id){
        $criteria = new CDbCriteria();
        $criteria->compare('t.agent_id', $agent_id);
        $criteria->compare('t.materials_id', $materials_id);
        $criteria->compare('t.type', OPENING_BALANCE_MATERIAL);
//        $criteria->addCondition("t.year<".date('Y'));
        $criteria->addCondition("t.year < ". MyFunctionCustom::GetYearForReport() ); // Fix change Jan 02, 2015
        $criteria->select = "sum(qty) as qty"; // fix Jun 30, 2014
        $model = GasMaterialsOpeningBalance::model()->find($criteria);        
        if($model)
            return $model->qty?$model->qty:0;
        return 0;
    }
    
    /** @Author: ANH DUNG 12-30-2013
     * @Todo: tính tồn đầu kỳ cho mỗi cấp cha đc nhập ban đầu bởi đại lý
     * @Param: $agent_id mã đại lý
     * @Param: $aSubMaterialId array id vật tư cấp con
     * @Return: number số tổng dư đầu kỳ của các vật tư cấp con mà đại lý nhập khi bắt đầu sử dụng chức năng thẻ kho của vật tư cấp cha
     */       
    public static function getOpeningBalanceOfParentMaterial($agent_id, $aSubMaterialId){
        $criteria = new CDbCriteria();
        $criteria->select = "sum(qty) as qty";
        $criteria->compare('t.agent_id', $agent_id);
        $criteria->addInCondition('t.materials_id', $aSubMaterialId);
        $criteria->compare('t.type', OPENING_BALANCE_MATERIAL);
//        $criteria->addCondition("t.year<".date('Y'));
        $criteria->addCondition("t.year < ". MyFunctionCustom::GetYearForReport() ); // Fix change Jan 02, 2015
        $model = GasMaterialsOpeningBalance::model()->find($criteria);
        if($model)
            return $model->qty?$model->qty:0;
        return 0;
    }
    
    /** @Author: ANH DUNG 12-20-2013
     * @Todo: tính tổng nhập hoặc xuất của 1 vật tư trong kỳ
     * @Param: $agent_id mã đại lý
     * @Param: $material_id mã vật tư
     * @Param: $date_delivery ngày tính dư đầu kỳ, tồn cuối của ngày hôm trước là tồn đầu của ngày hôm sau
     * @Param: $type_store_card loại nhập xuất 1: Nhập, 2: xuất
     * @Param: $needMore nếu sau này cần thêm biến
     * @Return: number tổng số nhập hoặc xuất của vật tư này
     */       
     public static function calcTotalExportImport($agent_id, $materials_id, $date_delivery, $type_store_card){
        $criteria = new CDbCriteria();
        $criteria->compare('t.user_id_create', $agent_id);
        if(is_array($materials_id)){
            $criteria->addInCondition('t.materials_id', $materials_id);
        }else{
            $criteria->compare('t.materials_id', $materials_id);
        }
        $criteria->compare('t.type_store_card', $type_store_card);    
        if(is_array($materials_id)){ // Thẻ kho tổng hợp, sẽ lấy cả =
            $criteria->addCondition("t.date_delivery <= '$date_delivery'");
        }else{ // Báo Cáo Nhập Xuất Tồn chỉ lấy < 
            $criteria->addCondition("t.date_delivery < '$date_delivery'");
        }
        $criteria->select = "sum(qty) as qty";
        $model = GasStoreCardDetail::model()->find($criteria);
        if($model)
            return $model->qty?$model->qty:0;        
        return 0;
     }
    
     
     // sửa của hàm trên, lấy tất cả rổi group lại cho tối ưu
     // chỉ sử dụng cho // Báo Cáo Nhập Xuất Tồn chỉ lấy < 
     public static function calcTotalExportImportFixQuery($agent_id, $date_delivery, $type_store_card){
        $criteria = new CDbCriteria();
        if(!empty($agent_id)){
            $criteria->compare('t.user_id_create', $agent_id);
        }else{
            // nếu không chọn đại lý có thể sẽ lấy toàn hệ thống, khi đó sẽ ko tính kho nhập xuất
            $criteria->addNotInCondition("t.user_id_create", CmsFormatter::$LIST_WAREHOUSE_ONLY_NHAP_XUAT);
        }
        $criteria->compare('t.type_store_card', $type_store_card);    
         // Báo Cáo Nhập Xuất Tồn chỉ lấy < 
        $criteria->addCondition("t.date_delivery < '$date_delivery'");
        // chỗ này sửa: vì câu trên t.date_delivery <  sẽ lấy all data, không đúng với kế hoạch cut data 
        $criteria->addCondition("year(t.date_delivery) >= ". MyFunctionCustom::GetYearForReport() ); // Fix change Jan 02, 2014
        $criteria->select = "t.materials_id, sum(qty) as qty";
        $criteria->group = "t.materials_id";
        $models = GasStoreCardDetail::model()->findAll($criteria);
        return CHtml::listData($models,'materials_id','qty');
     }
    
    /** @Author: ANH DUNG 01-01-2014
     * @Todo: tính tổng nhập hoặc xuất của các vật tư trong khoảng thời gian
     * @Param: $agent_id mã đại lý
     * @Param: $material_id mảng mã vật tư
     * @Param: $date_from ngày tính dư đầu kỳ, tồn cuối của ngày hôm trước là tồn đầu của ngày hôm sau
     * @Param: $date_to loại nhập xuất 1: Nhập, 2: xuất
     * @Param: $type_store_card loại nhập xuất 1: Nhập, 2: xuất
     * @Return: number số dư đầu kỳ của vật tư này
     */       
     public static function calcTotalExportImportInRangeDate($agent_id, $materials_id, $date_from, $date_to, $type_store_card){
        $criteria = new CDbCriteria();
        if(!empty($agent_id)){
            $criteria->compare('t.user_id_create', $agent_id);
        }else{
            // nếu không chọn đại lý có thể sẽ lấy toàn hệ thống, khi đó sẽ ko tính kho nhập xuất
            $criteria->addNotInCondition("t.user_id_create", CmsFormatter::$LIST_WAREHOUSE_ONLY_NHAP_XUAT);
        }
        if(is_array($materials_id)){ // fix Jun 30, 2014 for giảm query xuống
            $criteria->addInCondition('t.materials_id', $materials_id);
        }
        
        $criteria->compare('t.type_store_card', $type_store_card);
        $criteria->addBetweenCondition("t.date_delivery",$date_from,$date_to); 	
        $criteria->select = "materials_id, sum(qty) as qty";
        $criteria->group = "t.materials_id";
        $model = GasStoreCardDetail::model()->findAll($criteria);
        return CHtml::listData($model,'materials_id','qty');
     }
    
    /** @Author: ANH DUNG 01-05-2014
     * @Todo: tính tổng nhập hoặc xuất của 1 vật tư parent trong khoảng thời gian
     * @Param: $agent_id mã đại lý
     * @Param: $material_id mảng mã vật tư con của parent
     * @Param: $date_from ngày tính dư đầu kỳ, tồn cuối của ngày hôm trước là tồn đầu của ngày hôm sau
     * @Param: $date_to đến ngày
     * @Param: $type_store_card loại nhập xuất 1: Nhập, 2: xuất
     * @Return: number số dư đầu kỳ của vật tư này
     */         
     public static function sumParentTotalExportImportInRangeDate($agent_id, $materials_id, $date_from, $date_to, $type_store_card){
        $criteria = new CDbCriteria();
        $criteria->compare('t.user_id_create', $agent_id);
        $criteria->addInCondition('t.materials_id', $materials_id);
        $criteria->compare('t.type_store_card', $type_store_card);        
        $criteria->addBetweenCondition("t.date_delivery",$date_from,$date_to); 	
        $criteria->select = "sum(qty) as qty";        
        $model = GasStoreCardDetail::model()->find($criteria);       
        if($model)
            return $model->qty?$model->qty:0;        
        return 0;        
     }
     
    /** @Author: ANH DUNG Jun 28, 2014
     * @Todo: tính tổng nhập hoặc xuất của all vật tư trong khoảng thời gian group by theo agent
     * @Param: $agent_id mã đại lý
     * @Param: $date_from ngày tính dư đầu kỳ, tồn cuối của ngày hôm trước là tồn đầu của ngày hôm sau
     * @Param: $date_to đến ngày
     * @Param: $type_store_card loại nhập xuất 1: Nhập, 2: xuất
     * @Return: array
     */         
     public static function sumTotalExportImportGroupByAgent($agent_id, $date_from, $date_to, $type_store_card){
        $criteria = new CDbCriteria();
        $criteria->addInCondition('t.user_id_create', $agent_id);
        $criteria->compare('t.type_store_card', $type_store_card);        
        $criteria->addBetweenCondition("t.date_delivery",$date_from,$date_to); 	
        $criteria->select = "t.user_id_create, t.materials_id, sum(qty) as qty";        
        $criteria->group = "t.user_id_create, t.materials_id";
        $models = GasStoreCardDetail::model()->findAll($criteria);
        $aRes = array();
        foreach($models as $item){
            $aRes[$item->user_id_create][$item->materials_id] = $item->qty;
        }
        return $aRes;        
     }
    
    /** @Author: ANH DUNG 12-20-2013
     * @Todo: tính tổng nhập hoặc xuất của 1 vật tư trong kỳ
     * @Param: $agent_id mã đại lý
     * @Param: $material_id mã vật tư
     * @Param: $date_view ngày phát sinh giao dịch ex 2013-12-26
     * @Return: array mảng các loại phát sinh trong kỳ của vật tư này
     */
     public static function calcTransaction($agent_id, $materials_id, $date_view){
        $aRes = array();
        foreach(CmsFormatter::$STORE_CARD_ALL_TYPE as $id_type=>$name){
            $criteria = new CDbCriteria();
            $criteria->compare('t.user_id_create', $agent_id);
            $criteria->compare('t.materials_id', $materials_id);
            $criteria->compare('t.type_in_out', $id_type);        
            $criteria->compare('t.date_delivery', $date_view);        
            $criteria->select = "sum(qty) as qty, t.type_store_card";
            $model = GasStoreCardDetail::model()->find($criteria);
            if($model)
                $aRes[$id_type][$model->type_store_card] = $model->qty?$model->qty:0; 
         }
         return $aRes;
     }
   
     
    /** @Author: ANH DUNG Jun 08, 2014
    * @Todo: tính tồn đầu kỳ cho mỗi cấp con đc cộng dồn theo năm 
    * ( gồm nhập ban đầu bởi đại lý + ps trong các năm khác)
    * @Param: $agent_id mã đại lý
    * @Param: $aMaterialId array id vật tư cấp con
    * @Return: number số tổng dư đầu kỳ của các vật tư cấp con đến năm tính
    * vd: năm nay là 2015 thì hàm này sẽ sum tồn cuối của năm 2013 và 2014 lại
    * hàm này có thể sử dụng để tính tồn toàn hệ thống - vui lòng check khi sử dụng
    * lưu ý chỗ này có thể cộng cả tồn của Xưởng Đồng Nai => sai = đã fix notInCondition
    */       
    public static function getOpeningBalanceArrMaterialYearBefore($agent_id, $aMaterialId, $needMore=array()){
        if(count($aMaterialId)<1)
            return array();
        $criteria = new CDbCriteria();
        $criteria->select = "t.agent_id, t.materials_id, sum(qty) as qty";
        if(!empty($agent_id))
            $criteria->compare('t.agent_id', $agent_id);
        if(count($aMaterialId))
            $criteria->addInCondition('t.materials_id', $aMaterialId);
        $criteria->compare('t.type', OPENING_BALANCE_MATERIAL);
        $criteria->addCondition("t.year<".date('Y')); // Close Jan 02, 2015
        // Mar 11, 2015 - chỗ này year chắc không phải so sánh như kiểu của tồn kho admin/gasstorecard/view_store_movement_summary
        // chỉ hỗ trợ chạy trong năm, theo kiểu cắt dữ liệu ( không dùng hàm MyFunctionCustom::GetYearForReport() )
//        $criteria->addCondition("t.year < ". MyFunctionCustom::GetYearForReport() ); // Fix change Jan 02, 2015
        $criteria->addNotInCondition("t.agent_id", CmsFormatter::$LIST_WAREHOUSE_ONLY_NHAP_XUAT);
        $criteria->group = 't.materials_id';
        $models = GasMaterialsOpeningBalance::model()->findAll($criteria);
        return  CHtml::listData($models,'materials_id','qty');
    }
    
    /**
     * @Author: ANH DUNG Jan 02, 2014
     * Ref: 1. http://daukhimiennam.com/admin/gasstorecard/view_store_movement_summary
     * 2.
     * 3.
     */
    public static function GetYearForReport() {
        /** Jan 02, 2014
         * xử lý cho chốt báo cáo cuối năm, sẽ cho cộng của năm trước vào, rồi sau đó có thể
         * sẽ xóa ( cắt dữ liệu) đi như kế hoạch,
         * hoặc sẽ giữ hẳn 1 năm rồi mới cắt, nghĩa là cuối năm 2015 sẽ cắt của năm 2013
         */
        return $year = date('Y') - 1; // clsoe May 18, 2015 để chạy theo dữ liệu cut 
//        return $year = date('Y'); // Close on Jan 01, 2016, nên Open đoạn trên vào cuối năm để nó chạy đúng khi xem năm cũ
        // Jan 02, 2014
    }
    
    // Tương tự hàm trên nhưng dùng cho /admin/gasstorecard/view_store_movement_summary, có thể chỉ dùng lấy cho 1 đại lý, nếu ko chọn đại lý có thể sẽ lấy all
    public static function getOpeningBalanceYearBefore($agent_id, $needMore=array()){
        /** Jan 02, 2014
         * xử lý cho chốt báo cáo cuối năm, sẽ cho cộng của năm trước vào, rồi sau đó có thể
         * sẽ xóa ( cắt dữ liệu) đi như kế hoạch,
         * hoặc sẽ giữ hẳn 1 năm rồi mới cắt, nghĩa là cuối năm 2015 sẽ cắt của năm 2013
         */
//        $year = date('Y') - 1;
        // Jan 02, 2014
        $criteria = new CDbCriteria();
        $criteria->select = "t.agent_id, t.materials_id, sum(qty) as qty";
        if(!empty($agent_id))
            $criteria->compare('t.agent_id', $agent_id);
        $criteria->compare('t.type', OPENING_BALANCE_MATERIAL);
//        $criteria->addCondition("t.year<".date('Y'));// change Jan 02, 2014 xem ghi chú ở function MyFunctionCustom::GetYearForReport()
        $criteria->addCondition("t.year < ". MyFunctionCustom::GetYearForReport() ); // change Jan 02, 2014
        if(empty($agent_id)){
            // nếu không chọn đại lý có thể sẽ lấy toàn hệ thống, khi đó sẽ ko tính kho nhập xuất
            $criteria->addNotInCondition("t.agent_id", CmsFormatter::$LIST_WAREHOUSE_ONLY_NHAP_XUAT);
        }
        $criteria->group = 't.materials_id';
        $models = GasMaterialsOpeningBalance::model()->findAll($criteria);
        return  CHtml::listData($models,'materials_id','qty');
    }
    
    // Jun 28, 2014 lấy dư đầu kỳ của vật tư và group theo từng đại lý, phục vụ báo cáo tồn kho hệ thống
    // admin/gasreports/inventory
    public static function getOpeningBalanceGroupByAgent($agent_id, $aMaterialId, $aMaterialTypeId ,$needMore=array()){
        if(count($agent_id)<1)
            return array();
        $criteria = new CDbCriteria();
        $criteria->select = "t.agent_id, t.materials_id, sum(qty) as qty";
        $criteria->addInCondition('t.agent_id', $agent_id);
        if(!empty($aMaterialId)){
            if(is_array($aMaterialId) && count($aMaterialId)){
                $criteria->addInCondition('t.materials_id', $aMaterialId);
            }else{
                $criteria->compare('t.materials_id', $aMaterialId);
            }
        }
        if(!empty($aMaterialTypeId)){
            if(is_array($aMaterialTypeId) && count($aMaterialTypeId)){
                $criteria->addInCondition('t.materials_type_id', $aMaterialTypeId);
            }else{
                $criteria->compare('t.materials_type_id', $aMaterialTypeId);
            }
        }
            
        $criteria->compare('t.type', OPENING_BALANCE_MATERIAL);
//        $criteria->addCondition("t.year<".date('Y'));// change Jan 02, 2014 xem ghi chú ở function MyFunctionCustom::GetYearForReport()
        $criteria->addCondition("t.year < ". MyFunctionCustom::GetYearForReport() );
        $criteria->group = 't.agent_id, t.materials_id';
        $models = GasMaterialsOpeningBalance::model()->findAll($criteria);
        $aRes = array();
        foreach($models as $item){
            $aRes[$item->agent_id][$item->materials_id] = $item->qty;
        }
        return  $aRes;
    }
    
    /**
     * @Author: ANH DUNG Jan 19, 2015
     * @Todo: check server bao tri
     * @Param: $mUser thong tin user dang login, luon lay thong tin moi nhat 
     */
    public static function checkServerMaintenance($mUser){
        $ok = true;
        if(isset(Yii::app()->user->id) && Yii::app()->user->role_id!= ROLE_ADMIN && Yii::app()->params['server_maintenance'] == 'yes'){
            $ok=false;
        }
        
        if(isset(Yii::app()->user->id)){
//            $mUser = Users::model()->findByPk(Yii::app()->user->id); // Close Jan 28, 2015
            if($mUser && $mUser->status==STATUS_INACTIVE){
                GasTrackLogin::SaveTrackLogin(GasTrackLogin::TYPE_ADMIN_INACTIVE); // Aug 22, 2014
                $ok=false;
            }
        }
        
        // tạm thời đóng vì chưa dùng đến phần check time cho phép login của user
//        $timeCurrent = date('Y-m-d H:i:s');
//        $timeSettingDisable = date('Y-m-d ').Yii::app()->params['time_disable_login'];
//        if(trim(Yii::app()->params['time_disable_login']) != '' && Yii::app()->user->role_id!= ROLE_ADMIN && MyFormat::compareTwoDate($timeCurrent, $timeSettingDisable)){
//            $ok=false;
//            $session=Yii::app()->session;
//            $session['TEXT_ACCESS_NOT_ALLOW'] = "Hệ thống cấm truy cập từ ".Yii::app()->params['time_disable_login'];
//        }
        
        if(!$ok)
            Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('site/UnderConstruction'));
    }
    
    /**
     * @Author: ANH DUNG 12-25-2013
     * @Todo: load thẻ select loại thu chi trong gascashbookControllers => gascashbook/_form
     * @Param: $nameSelect tên thẻ select
     * @Return: string html select
     */    
    public static function buildSelectTypeCashBook($nameSelect, $empty=false){
        $mTypeCashBook = MyFunctionCustom::getDataForSelectTypeCashBook();
        $str = "<select name=\"$nameSelect\">";
            if($empty)
                $str.= "<option value=\"\">Select</option>";
            foreach($mTypeCashBook as $id=>$name){
                $str.= "<option value=\"$id\">$name</option>";
            }
        $str.= "</select>";
        return $str;
    }
    
    public static function getDataForSelectTypeCashBook(){
        $criteria = new CDbCriteria();
        $criteria->compare('t.type_lookup', MASTER_TYPE_LOOKUP_CASH_BOOK);
        $criteria->order = 't.type ASC, t.name ASC';
        return CHtml::listData(GasMasterLookup::model()->findAll($criteria),'id','name');
    }
    
    /** @Author: ANH DUNG 12-26-2013
     * @Todo: sổ quỹ: tính dư đầu kỳ của đại lý 
     * @Param: $agent_id mã đại lý
     * @Param: $date_view ngày xem: ex 2013-12-26
     * @Return: number số dư đầu kỳ đại lý 
     */       
    public static function getOpeningBalanceOfAgent($agent_id, $date_view, $needMore=array()){        
        if(empty($agent_id)) return array();
        $mUser = Users::model()->findByPk($agent_id);
        $opening_balance = $mUser->beginning;
        // 2. Tính tổng thu 
        $totalRevenue = MyFunctionCustom::calcTotalRevenueAndCost($agent_id, $date_view, MASTER_TYPE_REVENUE);
        // 3. Tính tổng chi        
        $totalCost = MyFunctionCustom::calcTotalRevenueAndCost($agent_id, $date_view, MASTER_TYPE_COST);
        // 4. kết quả tính tồn đầu kỳ đến ngày $date_view của đại lý
        $opening_balance = $opening_balance+$totalRevenue-$totalCost; 
        $res = array('opening_balance'=>$opening_balance, 
                'mUser'=> $mUser,
                );
        $_SESSION['data-excel'] = $res;  
        return $res;
    }    
    
    /** @Author: ANH DUNG 12-20-2013
     * @Todo: tính tổng thu hoặc chi trong kỳ của đại lý
     * @Param: $agent_id mã đại lý
     * @Param: $date_view ngày xem
     * @Param: $type loại thu hoặc chi 1: Thu, 2: Chi
     * @Return: number tổng số thu hoặc chi của đại lý này
     */       
     public static function calcTotalRevenueAndCost($agent_id, $date_view, $type){
        $criteria = new CDbCriteria();
        $criteria->compare('t.agent_id', $agent_id);
        $criteria->addCondition("t.release_date < '$date_view'");
        $criteria->compare('t.type', $type);
        $criteria->select = "sum(amount) as amount";
        $model = GasCashBookDetail::model()->find($criteria);
        if($model)
            return $model->amount?$model->amount:0;        
        return 0;
     }    
     
    /** @Author: ANH DUNG 12-29-2013
     * @Todo: lấy dữ liệu nhập sổ quỹ trong 1 khoảng ngày của đại lý 
     * @Param: $agent_id mã đại lý
     * @Param: $date_from ngày bắt đầu
     * @Param: $date_to ngày kết thúc
     * @Return: array model $mCashBookDetail gas_gas_cash_book_detail
     */       
    public static function getModelOpeningBalanceOfAgentInRangeDate($agent_id, $date_from, $date_to, $needMore=array()){
        $criteria = new CDbCriteria();
        $criteria->compare('t.agent_id', $agent_id);
        $criteria->addBetweenCondition("t.release_date",$date_from,$date_to);	
        $criteria->order = 't.release_date ASC, t.id ASC';
        $aModelCashBookDetail = GasCashBookDetail::model()->findAll($criteria);
        $res = array('aModelCashBookDetail'=>$aModelCashBookDetail, 
//                'mUser'=> $mUser,
                );
        $_SESSION['data-excel'] = $res;  
        return $res;
    }    
         
                
    /** @Author: ANH DUNG 01-01-2014
     * @Todo: tính nhập xuất tồn chi tiết từng vật tư với từng đại lý xác định
     * @Param: $agent_id mã đại lý
     * @Param: $date_from từ ngày 
     * @Param: $date_to đến Ngày
     * @Return: array $OpeningStock: dư đầu kỳ, $aSumEachType: mảng phát sinh cho từng loại
     */    
    public static function calcStoreMovement($agent_id, $date_from, $date_to, $needMore=array()){
        // không dùng hàm này nữa đã viết lại bên Sta2
        $res=array();
        // 1. lấy toàn bộ vật tư cấp cha và gồm cả mảng vật tư cấp con
        // mảng cấp cha trỏ đến obj id cấp cha+model+chtml list id cấp con + mảng model cấp con
        $aMaterials = GasMaterials::getArrayModelParentAndListSubId();
        $res['aMaterials'] = $aMaterials;
        foreach($aMaterials as $key=>$obj){
            $objParent = $obj['parent_obj'];
            $objSubModel = $obj['sub_arr_model']; // is array $key=>$mMaterial sub
            $detailSubMaterial = array();
            // 2. Lấy tồn đầu kỳ cho mỗi cấp cha đc nhập ban đầu bởi đại lý
            $parentOpeningBalance = 0; //MyFunctionCustom::getOpeningBalanceOfParentMaterial($agent_id, $obj['sub_chtml_listData']);
            // 3. Tính tổng nhập cho mỗi cấp cha
            $parentTotalImport = 0; // MyFunctionCustom::calcTotalExportImport($agent_id, $obj['sub_chtml_listData'], $date_from, TYPE_STORE_CARD_IMPORT);
            // 4. Tính tổng xuất cho mỗi cấp cha
            $parentTotalExport = 0; //MyFunctionCustom::calcTotalExportImport($agent_id, $obj['sub_chtml_listData'], $date_from, TYPE_STORE_CARD_EXPORT);
            // 5. Tính tồn đầu kỳ đến ngày  $date_from cho từng cấp con
            if(count($objSubModel)){
                foreach($objSubModel as $key=>$mMaterial){
                    // tồn đầu ky
                    $OpeningStock = MyFunctionCustom::calcOpeningStockOnly($agent_id, $mMaterial->id, $date_from);
                    $detailSubMaterial['OpeningStock'][$mMaterial->id] = $OpeningStock;
                    $parentOpeningBalance+=$OpeningStock;
                }
            }
            
            // Jun 30, 2014 tách đoạn này cho bớt query
            // 6. Tính tổng nhập trong khoảng ngày $date_from, $date_to cho từng cấp con 
            $detailSubMaterial['Import'] = MyFunctionCustom::calcTotalExportImportInRangeDate($agent_id, $obj['sub_chtml_listData'], $date_from, $date_to, TYPE_STORE_CARD_IMPORT);
            // 7. Tính tổng xuất trong khoảng ngày $date_from, $date_to cho từng cấp con
            $detailSubMaterial['Export'] = MyFunctionCustom::calcTotalExportImportInRangeDate($agent_id, $obj['sub_chtml_listData'], $date_from, $date_to, TYPE_STORE_CARD_EXPORT);
            // Jun 30, 2014 tách đoạn này cho bớt query
            
            
            // 8. Tính tổng nhập trong khoảng ngày $date_from, $date_to cho cấp cha
            $parentTotalImport = MyFunctionCustom::sumParentTotalExportImportInRangeDate($agent_id, $obj['sub_chtml_listData'], $date_from, $date_to, TYPE_STORE_CARD_IMPORT);
            // 9. Tính tổng xuất trong khoảng ngày $date_from, $date_to cho cấp cha
            $parentTotalExport = MyFunctionCustom::sumParentTotalExportImportInRangeDate($agent_id, $obj['sub_chtml_listData'], $date_from, $date_to, TYPE_STORE_CARD_EXPORT);
                        
            $temp = array();
            $temp['parent_obj'] = $obj['parent_obj'] ;
            $temp['parentOpeningBalance'] = $parentOpeningBalance;
            $temp['parentTotalImport'] = $parentTotalImport;
            $temp['parentTotalExport'] = $parentTotalExport;
            $temp['detailSubMaterial'] = $detailSubMaterial ;
            $res[$obj['parent_obj']->id] = $temp;
        }
       
        $_SESSION['data-excel'] = $res;
        return $res;         
    }
    
    
}
?>