<?php

/**
 * 
 * @todo Class for handle image. Required: EPhpThumb extension
 * @author qbao@verzdesign.co
 * @example Using create_thumbs function
 *
 */
class ImageProcessing {

    public $folder = 'upload';
    public $file = '';
    public $thumbs = array();

    /**
     * @todo Create thumb images to specific folders from exist image 
     * @example 
     * $ImageProcessing = new ImageProcessing();
     * $ImageProcessing->folder = '/upload/admin/artist';         
     * $ImageProcessing->file = 'photo.jpg';
     * $ImageProcessing->thumbs =array('thumb1' => array('width'=>'1336','height'=>'768'),
     *                                  'thumb2' =>  array('width'=>'800','height'=>'600'));
     *   $ImageProcessing->create_thumbs();
     * @author bb
     */
    public function create_thumbs() {
        if (count($this->thumbs) > 0) {
            $this->createDirectoryByPath($this->folder);
            foreach ($this->thumbs as $folderThumb => $size) {
                $this->createSingleDirectoryByPath($this->folder . '/' . $folderThumb);

                $thumb = new EPhpThumb($this->folder);
                $thumb->init();
                $thumb->create(Yii::getPathOfAlias('webroot') . $this->folder . '/' . $this->file)
                        ->resize($size['width'], $size['height'])
                        ->save(Yii::getPathOfAlias('webroot') . $this->folder . '/' . $folderThumb . '/' . $this->file);
            }
        }
    }

    /**
     * @todo delete image file
     * @param type $source: "/upload/admin/artist/photo.jpg"
     * @author bb
     */
    public function delete($source) {//  "/upload/admin/artist/photo.jpg"
        if (file_exists(Yii::getPathOfAlias("webroot") . $source))
            unlink(Yii::getPathOfAlias("webroot") . $source);
//        if(file_exists($source))
//            unlink($source);
    }

    /** it is static function 
     * @todo delete image file
     * @param type $source: "/upload/admin/artist/photo.jpg"
     * @author NguyenDung
     */
    public static function deleteFile($source) {//  "/upload/admin/artist/photo.jpg"
        if (file_exists(Yii::getPathOfAlias("webroot") . $source))
            unlink(Yii::getPathOfAlias("webroot") . $source);
    }

    /**
     * 
     * @todo RESIZE & CROP
     * @param type $fileName
     * @example 
     * $ImageProcessing = new ImageProcessing();
      $ImageProcessing->folder = '/upload/admin/artist';
      $ImageProcessing->file = 'photo.jpg';
      $ImageProcessing->thumbs =array('width'=>'1336','height'=>'768');
      $ImageProcessing->resizeAndCrop('fileNameOfDestinationImage');
     * @author bb
     */
    public function resizeAndCrop($fileName) {
        $thumb = new EPhpThumb();
        $thumb->init();
        $thumb->create(Yii::getPathOfAlias('webroot') . $this->folder . '/' . $this->file)
                ->adaptiveResize($this->thumbs['width'], $this->thumbs['height'])
                ->save(Yii::getPathOfAlias('webroot') . $this->folder . '/' . $fileName);
    }

    /**
     * 
     * @todo create directory from path
     * @param type $path: '/upload/admin/artist'
     * @author bb
     */
    public function createDirectoryByPath($path) {
        $aFolder = explode('/', $path);
        if (is_array($aFolder)) {
            $this->removeEmptyItemFromArray($aFolder);
            $root = Yii::getPathOfAlias('webroot');

            $currentPath = $root;
            foreach ($aFolder as $key => $folder) {
                $currentPath = $currentPath . '/' . $folder;
                if (!is_dir($currentPath))
                    mkdir($currentPath);
            }
        }
    }

    public function removeEmptyItemFromArray(&$arr) {
        foreach ($arr as $key => $value)
            if (is_null($value)) {
                unset($arr[$key]);
            }
    }

    /**
     * @todo create directory from path
     * @param type $path: /upload/member/555/avatar
     * @author NguyenDung
     */
    public static function createDirectory($path) {
        $path = trim($path, '/');
        $aFolder = explode('/', $path);
        if (is_array($aFolder)) {
            $root = Yii::getPathOfAlias('webroot');
            $currentPath = $root;
            foreach ($aFolder as $folder) {
                $currentPath = $currentPath . '/' . $folder;
                if (!is_dir($currentPath)) {
                    mkdir($currentPath);
                    chmod($currentPath, 0755);
                }
            }
        }
    }

    /**
     * 
     * @todo Create single directory. 
     *          Create directory from the last path.
     *          You have to make sure that the parent directorry already exists
     * @param string $path: '/upload/admin/artist/thumb'
     * @author bb
     * 
     */
    public function createSingleDirectoryByPath($path) {
        $path = Yii::getPathOfAlias('webroot') . $path;
        if (!is_dir($path))
            mkdir($path);
    }

    /**
     * 
     * @todo bind image by phpthumb for unavailable size of no image for other case
     * 
     * Return absolute url by relative path. If no image exist. It will return noimage url
     * Require an exist noimage in format:   "/upload/noimage/200x300.jpg"
     * 
     * @param string $path relative path "/upload/noimage/200x300.jpg"
     * @param int $width 
     * @param int $height          * 
     * 
     * @copyright (c) 12/6/2013, bb Verz Design
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function bindImage($path, $width, $height) {
        $baseUrl = Yii::app()->createAbsoluteUrl('/');
        $noimagePath = '/upload/noimage/' . $width . 'x' . $height . '.jpg';
        if (!file_exists(Yii::getPathOfAlias("webroot") . $path)) {
            if (!file_exists(Yii::getPathOfAlias("webroot") . $noimagePath))
                return Yii::app()->baseUrl . '/upload/noimage/noimage-all.jpg';
            return Yii::app()->baseUrl . $noimagePath;
        }
        return $baseUrl.$path;
    }

    /** @AnhDung Feb 18, 2016
     * Return href of image by model
     * @param model $model
     * @param string $size may be size1, size2=> array(150x200)
     * @param array $customField anything canbe
     * 
     * @return string href
     * 
     * @copyright (c) 12/6/2013, bb Verz Design
     * @author bb  <quocbao1087@gmail.com>
     */
    public static function bindImageByModel($model, $size = null, $needMore = array(), $field_created_date="created_date") {
        $className = get_class($model);
        $path = "";
        $width = $height = 100;
        if($field_created_date == 'created_date'){
            $year = MyFormat::GetYearByDate($model->created_date);
            $month = MyFormat::GetYearByDate($model->created_date, array('format'=>'m'));
            $path = "/".$model->pathUpload."/$year/$month";
        }
        
        if ($className == 'MuradBanner') {
            $path = "$path/$model->file_name";
            return self::bindImage($path, 100, 100);
        } elseif ($className == 'MuradProductImage') {
            $path = "$path/$size/$model->file_name";
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'MuradNews') {
            $path = "$path/$size/$model->feature_image";
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'MuradVideo') {
            $path = "$path/$size/$model->file_name";
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'MuradCategory') {
            $path = "$path/$size/$model->file_name";
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'MuradProduct') {
            $path = "$path/$size/$model->file_name";
            return self::bindImage($path, $width, $height);
        } 
        elseif ($className == 'GasTextFile' && !empty($model->file_name) && !empty($model->created_date)) {
            $year = MyFormat::GetYearByDate($model->created_date);
            $pathUpload = GasTextFile::$pathUpload."/$year/".$customField['size'] . '/';
            $path = '/' . $pathUpload . $model->file_name;
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'GasProfileDetail' && !empty($model->file_name) && !empty($model->date_expired)) {            
            $year = MyFormat::GetYearByDate($model->date_expired);
            $pathUpload = GasProfileDetail::$pathUpload."/$year/".$customField['size'] . '/';
            $path = '/' . $pathUpload . $model->file_name;
            return self::bindImage($path, $width, $height);        
        } elseif ($className == 'GasCustomerCheck' && !empty($model->file_report) ) {
            $year = MyFormat::GetYearByDate($model->created_date);
            $month = MyFormat::GetYearByDate($model->created_date, array( 'format'=>'m') );
            $pathUpload = GasCustomerCheck::$pathUpload."/$year/$month/".$customField['size'] . '/';
            $path = '/' . $pathUpload . $model->file_report;
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'GasIssueTicketsDetailFile' && !empty($model->file_name) && !empty($model->created_date)) {
            $aDate = explode('-', $model->created_date);
            $pathUpload = GasIssueTickets::$pathUpload."/$aDate[0]/$aDate[1]";            
            $path = '/' . $pathUpload . '/size1' . '/' . $model->file_name;
            if(isset($customField['size'])){
                $path = '/' . $pathUpload . "/".$customField['size'] . '/' . $model->file_name;
            }
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'GasFile' && !empty($model->file_name) && !empty($model->created_date)) {
            $aDate = explode('-', $model->created_date);
            $pathUpload = GasFile::$pathUpload."/$aDate[0]/$aDate[1]";            
            $path = '/' . $pathUpload . '/size1' . '/' . $model->file_name;
            if(isset($customField['size'])){
                $path = '/' . $pathUpload . "/".$customField['size'] . '/' . $model->file_name;
            }
            
            return self::bindImage($path, $width, $height);
        } elseif ($className == 'UsersRef' && !empty($model->image_sign)) {
            $pathUpload = UsersRef::$pathUpload;
            $path = '/' . $pathUpload . '/size1' . '/' . $model->image_sign;
            if(isset($customField['size'])){
                $path = '/' . $pathUpload . "/".$customField['size'] . '/' . $model->image_sign;
            }
            return self::bindImage($path, $width, $height);
        }
        else {
            $path = '/upload/settings/noimage';
            return self::bindImage($path, $width, $height);
        }
    }

    //tuan-user to advertisement
    public function delete_advertise($source) {//  "/upload/admin/artist/photo.jpg"
//        if(file_exists(Yii::getPathOfAlias("webroot").$source))
//            unlink(Yii::getPathOfAlias("webroot").$source);
        if (file_exists($source))
            unlink($source);
    }

    /*
     * ---------------------------------------------
     * Author : dtoan
     * Email  : ghostkissboy12@gmail.com
     * addWarterMark
     * $groundImage : duong dan file goc
     * $dirwartermark : duong dan file sau khi dong dau hinh
     * $waterPos : vi tri duoc dong dau ( 1->9)
     * $waterImage : duong dan hinh dong dau
     * ---------------------------------------------
     */

    public static function addWarterMark($groundImage, $dirwartermark = null, $waterPos = 5, $waterImage = null) {
        if (!empty($dirwartermark)) {
            @copy($groundImage, $dirwartermark);
            $groundImage = $dirwartermark;
        }
        if (empty($waterImage)) {
            $waterImage = Yii::getPathOfAlias('webroot') . '/upload/admin/settings/'.Yii::app()->params['image_watermark'];
        }

        $water_info = getimagesize($waterImage);
        $w = $water_info[0];
        $h = $water_info[1];
        $water_im = imagecreatefrompng($waterImage);
        imageAlphaBlending($water_im, false);
        imageSaveAlpha($water_im, true);

        if (!empty($groundImage) && file_exists($groundImage)) {
            $ground_info = getimagesize($groundImage);
            $ground_w = $ground_info[0];
            $ground_h = $ground_info[1];
            switch ($ground_info[2]) {
                case 1:$ground_im = imagecreatefromgif($groundImage);
                    break;
                case 2:$ground_im = imagecreatefromjpeg($groundImage);
                    break;
                case 3:$ground_im = imagecreatefrompng($groundImage);
                    break;
                default:die($formatMsg);
            }
        } else {
            die("File error");
        }

        if (($ground_w < $w) || ($ground_h < $h))
            return;

        switch ($waterPos) {
            case 0:
                $posX = rand(0, ($ground_w - $w));
                $posY = rand(0, ($ground_h - $h));
                break;
            case 1:
                $posX = 0;
                $posY = 0;
                break;
            case 2:
                $posX = ($ground_w - $w) / 2;
                $posY = 0;
                break;
            case 3:
                $posX = $ground_w - $w;
                $posY = 0;
                break;
            case 4:
                $posX = 0;
                $posY = ($ground_h - $h) / 2;
                break;
            case 5:
                $posX = ($ground_w - $w) / 2;
                $posY = ($ground_h - $h) / 2;
                break;
            case 6:
                $posX = $ground_w - $w;
                $posY = ($ground_h - $h) / 2;
                break;
            case 7:
                $posX = 0;
                $posY = $ground_h - $h;
                break;
            case 8:
                $posX = ($ground_w - $w) / 2;
                $posY = $ground_h - $h;
                break;
            case 9:
                $posX = $ground_w - $w;
                $posY = $ground_h - $h;
                break;
            default:
                $posX = rand(0, ($ground_w - $w));
                $posY = rand(0, ($ground_h - $h));
                break;
        }

        imagealphablending($ground_im, true);
        imagecopy($ground_im, $water_im, $posX, $posY, 0, 0, $w, $h);
        @unlink($groundImage);

        ImageJpeg($ground_im, $groundImage);
        if (isset($water_info))
            unset($water_info);
        if (isset($water_im))
            imagedestroy($water_im);
        unset($ground_info);
        imagedestroy($ground_im);
    }

}