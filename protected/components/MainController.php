<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class MainController extends CController
{
    protected $listActionsCanAccess;   
    
    //check controller access rules - PDQuang
    protected function checkControllerRules($controller, $module=null, $application)
    {
        $accessArray = array();
        //user roles
        $user_actions = UsersActions::model()->findAll("controller like '$controller' and module like '$module'");
        
        if($user_actions)
        {
            foreach($user_actions as $key => $user_action)
            {
                $array_action = array_map('trim',explode(",",trim($user_action->actions)));
                $accessArray[] = array($user_action->type,
                                        'actions'=>$array_action,
                                        'users'=>array($user_action->user->username),                                        
                                    );                
            }
        }
        
        //menu roles
        $menu = Menus::model()->find(array('condition' => "controller_name like '$controller' and module_name like '$module' and application_id = $application", 
                                    'order' => 'desc'));        
        if($menu)
        {
            $roles_menu = RolesMenus::model()->findAll("menu_id = $menu->id");
            foreach($roles_menu as $key => $role_menu)
            {
                $array_action = array_map('trim',explode(",",trim($role_menu->actions)));
                $accessArray[] = array('allow',
                                        'actions'=>$array_action,
                                        'users'=>array('@'),
                                        'expression'=>'Yii::app()->user->role_id == '.$role_menu->role_id
                                    );                
            }
        }
        $accessArray[] = array('deny', 
        );

        return $accessArray;
    }
    
    //new check controller access rules - PDQuang
    protected function controllerRules($controller, $module=null)
    {
        $accessArray = array();
        $controller_model = Controllers::model()->find("controller_name like '$controller' and module_name like '$module'");
        if(!$controller_model)
            return array(array('deny'));
        
        //user roles, ưu tiên cho role custom của user
        $criteria = new CDbCriteria();
        $criteria->compare("t.user_id", Yii::app()->user->id);
        $criteria->compare("t.controller_id", $controller_model->id);
        $criteria->compare("t.can_access", 'allow');
        $actions_user = ActionsUsers::model()->findAll($criteria);// thực tế chỉ find ra 1. Chỉ có 2 dòng allow và deny
        if($actions_user)
        {
            foreach($actions_user as $key => $user_action)
            {
                if($user_action->user){
                    $array_action = array_map('trim',explode(",",trim($user_action->actions)));
                    $accessArray[] = array($user_action->can_access,
                            'actions'=>$array_action,
                            // 'users'=>array('@'), // có thể dùng cái này, vì cái bên dưới dường như ko có ý nghĩa
                            'users'=>array($user_action->user->username),
                        );
                }else
                   $user_action->delete(); // delete data not valid 										
            }
        }else{
                
            //menu roles  
            $criteria = new CDbCriteria();
            $criteria->compare("t.roles_id", Yii::app()->user->role_id);
            $criteria->compare("t.controller_id", $controller_model->id);
            $criteria->compare("t.can_access", 'allow');
            $actions_role = ActionsRoles::model()->findAll($criteria);  // thực tế chỉ find ra 1. Chỉ có 2 dòng allow và deny
            if($actions_role)
            {
                foreach($actions_role as $key => $action_role)
                {
                    if($action_role->roles_id==Yii::app()->user->role_id){ // ANH DUNG ADD 10-17-2013
                        $array_action = array_map('trim',explode(",",trim($action_role->actions)));
                        $accessArray[] = array('allow',
                                                'actions'=>$array_action,
                                                'users'=>array('@'),
                                                'expression'=>'Yii::app()->user->role_id == '.$action_role->roles_id
                                            );                
                    }
                }
            }
        }
        
        $accessArray[] = array('deny'); // ANH DUNG CLOSE JAN 29, 2015
//        $accessArray[] = array('deny', 'users'=>array('*'));// ANH DUNG ADD JAN 29, 2015
//        đoạn này có thẻ mở ra sau nếu phát hiện bug, hiện tại không có bug nên chưa mở
        
        // need debug to add role here
        return $accessArray;
    }
    
    function init() {
        $this->setActionsAccess();
        parent::init();
    }
    
    protected function setActionsAccess()
    {
        if(isset(Yii::app()->user->role_id))
            $this->listActionsCanAccess = ControllerActionsName::getListActionsCanAccess($this->accessRules(), Yii::app()->user->role_id);
    }
    
    /**
     * @return array action filters
     */
    public function filters()
    {
            return array(
                    'accessControl', // perform access control for CRUD operations
            );
    }

    protected function checkControllerAccessRules($controller,$application)
    {
        if(empty($controller))
        {
            $accessArray = array();
            $accessArray[] = array('deny',  // deny all users to perform 'index' and 'view' actions
                'users'=>array('*'),
            );
        }
        else
        {
            $menu = Menus::model()->findAll(array('condition'=>'controller_name = "'.$controller.'" AND application_id ='.$application));
            if(!empty($menu))
            {
                $list_menu_id='';
                for($i=0; $i< count($menu);++$i)
                {
                    $v = $menu[$i];
                    if ($i == (count($menu) - 1))
                        $list_menu_id .= $v->id;
                    else
                        $list_menu_id .= $v->id.',';
                }
                //echo $list_menu_id;
                $list_menu = $list_menu_id;
                $list_menu_id = explode(",", $list_menu_id);
                $criteria = new CDbCriteria;
                $criteria->addInCondition('t.menu_id', $list_menu_id, 'AND');
                $criteria->group = 't.role_id';
                $menu_role = RolesMenus::model()->findAll($criteria);
                $accessArray = array();
                /*
                $accessArray[] = array('allow',  // allow all users to perform 'index' and 'view' actions
                    'actions'=>array('index','view'),
                    'users'=>array('*')
                );
                print_r($accessArray);
                */
                if(!empty($menu_role))
                {
                    for($i=0; $i< count($menu_role);++$i)
                    {
                        $v = $menu_role[$i];
                        //echo $v->role_id;
                        $menuOfRole = RolesMenus::model()->findAll('menu_id IN ('.$list_menu.') AND role_id='.$v->role_id);
                        $action_name = '';
                        for($t=0; $t < count($menuOfRole);++$t)
                        {
                            $w = $menuOfRole[$t];
                            if ($t === (count($menuOfRole) - 1))
                                $action_name .= $w->actions;
                            else{
                                if(!empty($w->actions)){
                                    $action_name .= $w->actions.",";
                                }
                            }
                        }
                        $action_name = explode(",", trim($action_name));
                        $accessArray[] = array('allow',  // allow all users to perform 'index' and 'view' actions
                            'actions'=>$action_name,
                            'users'=>array('@'),
                            'expression'=>'isset($user->role_id) && (Yii::app()->user->role_id == '.$v->role_id.')'
                        );

                    }
                    $accessArray[] = array('deny',  // deny all users to perform 'index' and 'view' actions
                        'users'=>array('*'),
                    );
                    //print_r($accessArray);
                } else
                {
                    $accessArray = array();
                    $accessArray[] = array('allow',  // allow all users to perform 'index' and 'view' actions
                        'users'=>array('*'),
                    );
                }
            }else
            {
                $accessArray = array();
                $accessArray[] = array('allow',  // allow all users to perform 'index' and 'view' actions
                    'users'=>array('*'),
                );
            }
        }
        //print_r($accessArray);
        return $accessArray;
    }
    

    public function beforeRender($view) {
        parent::beforeRender($view);
        $this->rewriteForSeo();
        return true;        
    }
    
    public function rewriteForSeo(){
	if (isset(Yii::app()->controller->module->id)) {
	    $module = Yii::app()->controller->module->id;
	} else {
	    $module = "front_end";
	}        
	$controller = strtolower(Yii::app()->controller->id);
	$action = strtolower(Yii::app()->controller->action->id);
	//echo $module . " - ".$controller. " - ".$action." 456";   
                
        // 1. find with $controller $action in table SEO
//        $criteria=new CDbCriteria; 
//        $criteria->compare('LOWER(t.module)',strtolower($module)); 
//        $criteria->compare('LOWER(t.controller)',strtolower($controller)); 
//        $criteria->compare('LOWER(t.action)',strtolower($action)); 
//        $mSeo = Seo::model()->find($criteria);
        $SEO_NAME='';
        $titlePage='';
        $meta_description='';
        $meta_keywords='';
        $product_info='';
        $setting_meta_description = Yii::app()->params['meta_description'];// Jun 11, 2016 make SEO
        $setting_meta_keywords = Yii::app()->params['meta_keywords'];// Jun 11, 2016 Make SEO
        $aActionVideo = array("detail","detailradio");
        if(isset($_GET['category_slug']) || ($controller=="product" && $action=='detail') ):
            if(isset($_GET['category_slug'])){
                $model = MyFormat::getBySlugNotException('MuradCategory', $_GET['category_slug']);
            }else{
                $mProduct = MyFormat::getBySlugNotException("MuradProduct", $_GET['slug']);
                if(!is_null($mProduct)):
                    $slug = str_replace("-", " ", $_GET['slug']);
                    $product_info= $mProduct->getName().", ". $slug;
                    $model = MuradCategory::model()->findByPk($mProduct->category_id);
                endif;
            }
            
            if(!is_null($model)):
                $meta_description = $product_info.", ".$model->meta_description.", $setting_meta_description";
                $meta_keywords = $product_info.", ".$model->meta_keywords.", $setting_meta_keywords";
            endif;
        elseif($controller=="videos" && in_array($action, $aActionVideo)):
            $model = MyFormat::getBySlugNotException("MuradVideo", $_GET['slug']);
            $slug = str_replace("-", " ", $_GET['slug']);
            $meta_description = $model->getName().", $slug, $setting_meta_description";
            $meta_keywords = $model->getName().", $slug, $setting_meta_keywords";
        elseif($controller=="news" || $controller=="videos"):// Jul 05, 2016  vì bị google phân tích Pages with duplicate meta descriptions
            $slug = isset($_GET['slug']) ? $_GET['slug'] : "";
            $slug = str_replace("-", " ", $slug);
            $meta_description = $slug.", $setting_meta_description";
            $meta_keywords = $slug.", $setting_meta_keywords";
        endif;
        
        
        $titlePage=trim($titlePage);
        if(!empty($titlePage))
            $this->setPageTitle($titlePage);
        if(!empty($meta_description))
            Yii::app()->clientScript->registerMetaTag($meta_description, 'description');
        else // default in system configure
            Yii::app()->clientScript->registerMetaTag($setting_meta_description, 'description');
        if(!empty($meta_keywords))
            Yii::app()->clientScript->registerMetaTag($meta_keywords, 'keywords');
        else 
            Yii::app()->clientScript->registerMetaTag($setting_meta_keywords, 'keywords');
    }
    
}

?>