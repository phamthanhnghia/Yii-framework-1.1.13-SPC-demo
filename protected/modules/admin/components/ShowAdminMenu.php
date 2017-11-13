<?php
class ShowAdminMenu
{
/**
 * return menu ul li.
 */
    public $str="";	
    public function haschild($id,$arrobj)
    {
        $session=Yii::app()->session;
        foreach($arrobj as $obj){
            if($obj->parent_id == $id)
            {
                if($obj->menu_link =='')
                {
                    continue;
                }
               $aLinks = explode('/', $obj->menu_link);
                $c = '';
                $a = '';
                if(count($aLinks)==2)
                {
                    $c = $aLinks[1];
                    $a = 'Index';
                }
                elseif(count($aLinks)>2)
                {
                     $c = $aLinks[1];
                     $a = ucfirst($aLinks[2]);
                }
                
                // for session check menu
                if($session['ALLOW_SESSION_MENU']){
                    if(!isset($session['MENU_CONTROLLER_ACTION'])) // nếu chưa tồn tại thì khởi tạo
                        $session['MENU_CONTROLLER_ACTION'] = array();
                    $sessionTemp = $session['MENU_CONTROLLER_ACTION'];
                    if(!isset($sessionTemp[$c])){
                        $sessionTemp[$c] = ActionsUsers::getActionArrayAllowForCurrentUserByControllerName($c);
                        $session['MENU_CONTROLLER_ACTION'] = $sessionTemp;
                    }
                    $aActionAllowed = $session['MENU_CONTROLLER_ACTION'][$c];
                // end for session check menu
                }else{
                    $aActionAllowed = ActionsUsers::getActionArrayAllowForCurrentUserByControllerName($c);
                }
                
                if(in_array($a, $aActionAllowed))
                {
                    return 1;
                }
            }
        }// end foreach($arrobj as $obj){
        return 0;
    }
    
    
    public function findchild($id,$arrobj,$selected_id='',$userRoleMenuId=array())
    {
        foreach($arrobj as $obj)
        {
            $temp_id 		= $obj->id;
            $temp_parent_id = $obj->parent_id;
            if($temp_parent_id==$id)
            {
                $name       = $obj->menu_name;
                if(!$this->haschild($temp_id,$arrobj) && $obj->menu_link !='') // nếu không còn con và có link thì cho ra
//                    if(in_array($temp_id, $userRoleMenuId))// close at May 13, 2014 
                        $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl($obj->menu_link)."'>$obj->menu_name</a></li>";

                if($this->haschild($temp_id,$arrobj)==1)
                {
//                    if(in_array($temp_id, $userRoleMenuId)) // close at May 13, 2014 
//                    {
                        $this->str.="<li><a href='#'>".$obj->menu_name."</a><ul>";
                        $this->findchild($temp_id,$arrobj,$selected_id,$userRoleMenuId);
                        $this->str.="</ul></li>";
//                    }
                }
            }
        }
    }
    public function showMenu()
    {
        // xử lý cache đoạn show menu vào session của user, đỡ dc 1 mớ truy vấn
        $session=Yii::app()->session;
//        if(isset($session['STRING_MENU']) && $session['STRING_MENU']!=''){            
//            return $session['STRING_MENU'];
//        }
        // xử lý cache đoạn show menu vào session của user, đỡ dc 1 mớ truy vấn

        if (Yii::app()->session['LOGGED_USER'] != null)
        {
            $userObj = new Users();
            $userObj = Yii::app()->session['LOGGED_USER'];
            $value = '';

            $userRoleId = $userObj->role_id;
            // hiện tại chưa cần check cái này, vì không có user ngoài fe login
//            $appicationId = Roles::getAppicationIdByRoleId($userRoleId);
//             if($appicationId!=BE){                                                        
//                    Yii::app()->user->logout();
//                    Yii::app()->controller->redirect(Yii::app()->createAbsoluteUrl('admin/site/login'));
//             }            
            
//            $userRoleMenu = RolesMenus::model()->findAll(array('condition'=>'role_id='.$userRoleId));    
            $userRoleMenuId = array();
//            if($userRoleMenu)
//            foreach($userRoleMenu as $u)
//                    $userRoleMenuId[]=$u->menu_id;

            $menusTemp = Menus::model()->findAll(array('condition'=>'show_in_menu="1"','order'=>'display_order asc'));
            $AllowSessionMenu = Yii::app()->params['allow_session_menu'];            
            if($AllowSessionMenu=='yes'){
                $session['ALLOW_SESSION_MENU'] = 1;
            }else{
                $session['ALLOW_SESSION_MENU'] = 0;
            }

            // MAY 12, 2014 ANH DUNG ADD 
            $menus = array();
            foreach($menusTemp as $menuTemp)
            {
                if($menuTemp->menu_link =='')
                {
                    $menus[] = $menuTemp;
                    continue;
                }
                
                $aLinks = explode('/', $menuTemp->menu_link);
                $c = ''; // controller name
                $a = ''; // action name 
                if(count($aLinks)==2)
                {
                    $c = $aLinks[1];
                    $a = 'Index';
                }
                elseif(count($aLinks)>2)
                {
                     $c = $aLinks[1];
                     $a = ucfirst($aLinks[2]);
                }
                
                // for session check menu
                if($session['ALLOW_SESSION_MENU']){
                    if(!isset($session['MENU_CONTROLLER_ACTION'])) // nếu chưa tồn tại thì khởi tạo
                        $session['MENU_CONTROLLER_ACTION'] = array();
                    $sessionTemp = $session['MENU_CONTROLLER_ACTION'];
                    if(!isset($sessionTemp[$c])){
                        $sessionTemp[$c] = ActionsUsers::getActionArrayAllowForCurrentUserByControllerName($c);
                        $session['MENU_CONTROLLER_ACTION'] = $sessionTemp;
                    }
                    $aActionAllowed = $session['MENU_CONTROLLER_ACTION'][$c];
                // end for session check menu
                }else{
                    $session['MENU_CONTROLLER_ACTION'] = array(); // reset session
                    $aActionAllowed = ActionsUsers::getActionArrayAllowForCurrentUserByControllerName($c);
                }
                
//                $aActionAllowed = array_map('trim', $aActionAllowed);// Now 14, 2014 ANH DUNG ADD, co the khong can, khi nao bi loi thi co the mo ra
                
                if(in_array($a, $aActionAllowed))
                {
                    $menus[] = $menuTemp;
                }
            }
            // MAY 12, 2014 ANH DUNG ADD 
            
            $this->str="<ul id='navmenu'>";
//            $this->str.="<li><a href='".Yii::app()->createAbsoluteUrl('/admin/site/news')."'>Thông Báo</a></li>";
            if($menus!= NULL)
            {			
                $this->findchild(0,$menus,$value,$userRoleMenuId);

            }
            $this->str.="</ul>";
            
            // xử lý cache đoạn show menu vào session của user, đỡ dc 1 mớ truy vấn
            if($session['ALLOW_SESSION_MENU']){
                if(!isset($session['STRING_MENU']))
                    $session['STRING_MENU'] = $this->str;
            }else{
                $session['STRING_MENU'] = '';
            }
            // xử lý cache đoạn show menu vào session của user, đỡ dc 1 mớ truy vấn
            
            if(Yii::app()->user->id){
                if(isset(Yii::app()->user->application_id) && Yii::app()->user->application_id==BE)
                        return $this->str;
                else return '';
            }else return '';
        }
        return '';
    }	        
}