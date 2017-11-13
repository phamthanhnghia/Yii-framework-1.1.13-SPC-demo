<?php
/**
 * 
 * Class for handle data entry - data input. 
 * @author bb  <quocbao1087@gmail.com>
 * @copyright (c) 6/6/2013, bb
 *  
 */

class InputHelper
{   
    /**
     * Set attributes by indicate array
     * 
     * @param model $model
     * @param array $aAttributes
     * @param array $aInput
     * @example  
     *          $model = new Users;
     *          $aAttributes = array('first_name', 'last_name', 'email');
     *          $aInput = $_POST['Users'];
     *          InputHelper::setAttributes($model, $aAttributes, $aInput);    
     * 
     *          It will set $model->first_name = $aInput['first_name'], etc..
     * 
     * @author bb  <quocbao1087@gmail.com>
     * @copyright (c) 6/6/2013, bb
     */
    public static function setAttributes(&$model, $aAttributes, $aInput)
    {
        foreach($aAttributes as $attribute)
        {
            self::checkInput($aInput[$attribute]);
            $model->$attribute = $aInput[$attribute];
        }   
    }
    
    /**
     * Set attributes but ignore some attribute by an array
     * 
     * @param model $model
     * @param array $aIgnoreAttributes
     * @param array $aInput
     * @example  
     *          $model = new Users;
     *          $aAttributes = array('status', 'approved');
     *          $aInput = $_POST['Users'];
     *          InputHelper::ignoreAttributes($model, $aAttributes, $aInput);    
     * 
     *          It will set $model->attributes= $aInput;
     *          But Ignore status, approved attributes
     * 
     * @author bb  <quocbao1087@gmail.com>
     * @copyright (c) 6/6/2013, bb
     */
    public static function ignoreAttributes(&$model, $aIgnoreAttributes, $aInput)
    {
        foreach($aIgnoreAttributes as $ignoreAttribute)
        {
            if(isset($aInput[$ignoreAttribute]))
                unset($aInput[$ignoreAttribute]);
        }        
        
        foreach($aInput as $input)
        {
            self::checkInput($aInput[$input]);
        }
        $model->attributes = $aInput;
    }
    
    /*
     * NGUYEN DUNG
     * $param: $aIgnoreAttributesPost = array('status', 'approved');
     */
    public static function ignoreAttributesPost($aIgnoreAttributesPost){
        if(is_array($aIgnoreAttributesPost))
        foreach($aIgnoreAttributesPost as $ignoreAttribute)
        {
            if(isset($_POST[$ignoreAttribute]))
                unset($_POST[$ignoreAttribute]);
        }                
    }
    
    /**
     * @todo Need to code this function for security purpose
     * @param unsafe $input string or array of string
     * @return safe input (security)
     * @author Unknow People <unknow@unknow.com>
     */
    public static function checkInput(&$input)
    {
        
    }
    
    public static function removeScriptTag($string) {
        $CHtmlPurifier = new CHtmlPurifier();
        $CHtmlPurifier->options = array('HTML.ForbiddenElements' => array('script','style','applet'));
        $string =  $CHtmlPurifier->purify($string);
        $scriptRemove = array("<script>", "</script>", "script",'text/javascript');
        $string = trim($string);
        return str_replace($scriptRemove, "", $string);    
    }    
    
    public static function removeScriptTagOnly($string) {
        $CHtmlPurifier = new CHtmlPurifier();
        $CHtmlPurifier->options = array('HTML.ForbiddenElements' => array('script','applet'));
        $string =  $CHtmlPurifier->purify($string);
        $scriptRemove = array("<script>", "</script>", "script",'text/javascript');
        $string = trim($string);
        return str_replace($scriptRemove, "", $string);    
    }    
    
    /**
     * @Author: ANH DUNG 12-23-2013
     * @Todo: remove all tag html only alloovable <br>
     * @Param: string $text
     * @Return: string after remove
     */
    public static function stripTagAllowableBr ($text){
        $text = trim($text);
        return strip_tags($text, '<br>');
    }    
    
}
