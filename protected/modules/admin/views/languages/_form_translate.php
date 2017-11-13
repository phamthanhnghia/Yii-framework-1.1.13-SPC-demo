<?php
$this->breadcrumbs = array(
    Yii::t('translation','Translate Language'),
);
?>

<h1><?php echo Yii::t('translation', 'Translate Language'); ?></h1>
<?php echo MyFormat::BindNotifyMsg(); ?>

<div class="form form_fix_submit">
<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'setting-form-admin-form',
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
    <div class="buttons clear">
        <input type="submit" name="save_1" value="Save">
    </div>
    <div class='clr'></div>

    <?php echo $form->errorSummary($model); ?>
    <div style="height: 700px; overflow: scroll; overflow-x:hidden;">
        <?php foreach ( $aField as $key =>$val): ?>
            <div class="row" >
                  <label><strong><?php echo $aField[$key];?></strong></label></br>
                  <?php
                    $style = "";
                    $k = str_replace('.', '_', $key);
                    if(array_key_exists($k, $error)){
                        $style = 'style="background:#FFEEEE; border-color: #CC0000;width:1000px;"';
                        echo "<div style='color:red;'  class='errorMessage'>$error[$k]</div> ";
                    }
                   ?>
                  <input type="text" <?php (!empty($style)? $style : '');?>  id="<?php echo $key; ?>"  name="<?php echo $key; ?>" value="<?php echo $val ?>"  style="width:1000px;padding: 3px;" maxlength="500"> <br>
            </div></br>
         <?php endforeach; ?>
    </div>
    
    <div class='clr'></div>
    <div class="buttons clear">
        <input type="hidden" name="SavePost" value="1">
        <input type="submit" name="save"  value="Save">
    </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->