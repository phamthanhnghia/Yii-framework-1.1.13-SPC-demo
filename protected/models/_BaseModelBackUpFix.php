<?php
class _BaseModelBackUpFix extends CActiveRecord
{
    public $optionYesNo = array('1' => 'Yes', '0' => 'No');
    public $optionActive = array('1' => 'Shown', '0' => 'Hidden');
    public $optionGender = array('1' => 'Male', '0' => 'Female', '2' => 'Unspecified');
    public $uploadImageFolder = 'upload/cms'; //remember remove ending slash
    public $defineImageSize = array();
    public $allowImageType = 'jpg, png, jpeg';
    public $maxImageFileSize = 3145728; //3MB
    public $fieldDateTime = "created_date"; // date or time to create dir save file of image
    public $countQtyFile = 1; // count qty of file of image

    public function baseSaveImage($fieldName, $diffModel = false) {
        //haidt - to save image different model
        if ($diffModel == false) {
                $this->$fieldName = CUploadedFile::getInstance($this, $fieldName);
        }
        if(array_key_exists($fieldName, $this->attributesBeforeSave))
            $oldImage = $this->attributesBeforeSave[$fieldName];

        if (is_null($this->$fieldName))
        {
            if(!empty($oldImage))
            {
                $this->$fieldName = $oldImage;
                $this->update(array($fieldName));
            }
            return false;
        }

        if(!empty($oldImage))
            $this->deleteImages($fieldName, $oldImage);
        
        $ext = strtolower($this->$fieldName->getExtensionName());
        
        $FileNameClient = strtolower(MyFunctionCustom::remove_vietnamese_accents($this->$fieldName->getName()));
        $FileNameClient = str_replace($ext, "", $FileNameClient);
        $fileName = time()."$this->countQtyFile-".MyFunctionCustom::slugify($FileNameClient).'.'.$ext;

        $imageHelper = new ImageHelper();
        $this->rebuildUploadFolder();
        $imageHelper->createDirectoryByPath($this->uploadImageFolder);
        $this->$fieldName->saveAs($this->uploadImageFolder . '/' . $fileName);
        $this->$fieldName = $fileName;
        $this->update(array($fieldName));

        if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
        {
            $this->resizeImage($fieldName, $this->uploadImageFolder . '/');
        }
    }
    
    /**
     * @Author: ANH DUNG Feb 17, 2016
     * @Todo: rebuild upload foleder
     */
    public function rebuildUploadFolder() {
        $year = MyFormat::GetYearByDate($this->$fieldDateTime);
        $month = MyFormat::GetYearByDate($this->$fieldDateTime, array('format'=>'m'));
        $this->uploadImageFolder . "/$year/$month";
    }

    public function baseResizeImage($fieldName)
    {
        $this->rebuildUploadFolder();
        $sizeRefactory = array();
        foreach ($this->defineImageSize[$fieldName] as $item)
        {
            $sizeExplode = explode('x', $item['size']);
            $sizeRefactory[$item['alias']] = array('width' => $sizeExplode[0], 'height' => $sizeExplode[1]);
        }
        $ImageHelper = new ImageHelper();
        $ImageHelper->folder = $this->uploadImageFolder;
        $ImageHelper->file = $this->$fieldName;
        $ImageHelper->thumbs = $sizeRefactory;
	$ImageHelper->createFullImage = FALSE;
        $ImageHelper->createThumbs();
    }

    public function baseDeleteImages($fieldName, $oldImage)
    {
        if (!empty($oldImage))
        {
            ImageHelper::deleteFile($this->uploadImageFolder . '/' . $oldImage);
            if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
            {
                $imageSize = $this->defineImageSize[$fieldName];
                foreach ($imageSize as $item)
                {
                    ImageHelper::deleteFile($this->uploadImageFolder . '/' . $item['alias'] . '/' . $oldImage);
                }
            }
        }
    }

    public function baseRemoveImage($fieldName = array(), $deleteFolder = true)
    {
        $updateFiled = array();
        if (!empty($fieldName) && is_array($fieldName))
        {
            foreach($fieldName as $fieldItem)
            {
                ImageHelper::deleteFile($this->uploadImageFolder. '/' . $this->$fieldItem);
                if (array_key_exists($fieldItem, $this->defineImageSize) && is_array($this->defineImageSize[$fieldItem]))
                {
                    $imageSize = $this->defineImageSize[$fieldItem];
                    foreach ($imageSize as $item)
                    {
                        ImageHelper::deleteFile($this->uploadImageFolder . '/' . $item['alias'] . '/' . $this->$fieldItem);
                        if ($deleteFolder == true && file_exists($this->uploadImageFolder . '/' . $item['alias'] ))
                            rmdir ($this->uploadImageFolder . '/' . $item['alias'] );
                    }
                    $this->$fieldItem = '';
                    $updateFiled[] = $fieldItem;
                }
            }
            if ($deleteFolder == true && file_exists($this->uploadImageFolder))
                rmdir ($this->uploadImageFolder);
            $this->update($updateFiled);
        }
    }

    public function tablePrefix()
    {
        return $tablePrefix = Yii::app()->db->tablePrefix;
    }

    protected function beforeDelete()
    {
        if(count($this->defineImageSize) > 0)
        {
            $this->baseRemoveImage(array_keys($this->defineImageSize), true);
        }
        return parent::beforeDelete();
    }

    public function saveImages()
    {
        foreach($this->defineImageSize as $fieldName=>$size)
        {
            $this->baseSaveImage($fieldName);
        }
    }

    /**
     * return array fieldName=>value. Usefull for send email. special param need to overrite or add to this array.
     * $param = array(
    '{FULL_NAME}'   => $mUser->full_name,
    '{EMAIL}'       => $mUser->email,
    '{PHONE}'       => $mUser->phone
    );
     */
    public function getParamArray()
    {
        $param = array();
        foreach ($this->attributes as $fieldName=>$value)
        {
            $param['{'.strtoupper($fieldName).'}'] = $value;
        }
        return $param;
    }

    public function getImageUrl($fieldName, $imageSizeAlias = null)
    {
        if($imageSizeAlias == null)
        {
            $image = $this->uploadImageFolder . '/'.$this->$fieldName;
            if (file_exists($image) && $this->$fieldName!= '') 
                return Yii::app()->createAbsoluteUrl($image);
            else
                return Yii::app()->theme->baseUrl . '/admin/js/holder.js/200X200';
        }
        //has image in database
        if ($this->$fieldName != "")
        {
            if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
            {
                foreach ($this->defineImageSize[$fieldName] as $item)
                {
                    if($item['alias'] == $imageSizeAlias)
                    {
                            $thumb = $this->uploadImageFolder . '/' . $item['alias'] . '/' . $this->$fieldName;
                            $image = $this->uploadImageFolder . '/' . $this->$fieldName;

                            if (!file_exists($thumb) && file_exists($image))
                                $this->resizeImage($fieldName);

                            if (file_exists($thumb))
                                return Yii::app()->createAbsoluteUrl($thumb);
                            else
                                return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
                    }
                }
                return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
            }
        }
        else //don't have image in database
        {
            return $this->getDefaultImageUrl($fieldName, $imageSizeAlias);
        }
    }
        
    public function getDefaultImageUrl($fieldName, $imageSizeAlias)//noiamge
    {
        if (array_key_exists($fieldName, $this->defineImageSize) && is_array($this->defineImageSize[$fieldName]))
        {
            foreach ($this->defineImageSize[$fieldName] as $item)
            {
                    if($item['alias'] == $imageSizeAlias)
                    {
                        if(isset($item['default']) && $item['default'] != '')
                        {
                            return Yii::app()->createAbsoluteUrl($item['default']);
                        }
                        else
                            return Yii::app()->theme->baseUrl . '/admin/js/holder.js/' . $item['size'];
                    }
            }
            return Yii::app()->theme->baseUrl . '/admin/js/holder.js/200X200';
        }
    }

}
?>
