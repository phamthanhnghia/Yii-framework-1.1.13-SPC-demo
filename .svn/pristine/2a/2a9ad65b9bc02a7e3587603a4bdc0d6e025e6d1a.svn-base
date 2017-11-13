<div class="clr" style="margin:5px;"></div>
<div class="row">
    <?php echo $form->labelEx($model, "[$language]name",array('class'=>' '. $model->removeClassErrors($language,'name'))); ?>
    <div class="">
        <?php echo $form->textField($model, "[$language]name", array('maxlength' => 255,'class'=>'w-800 ' .$model->removeClassErrors($language,'name'))); ?>
        <?php if($model->showErrorLangMessage($language,'name'))  echo $form->error($model, "[$language]name"); ?>
    </div>
</div>

<div class="">
    <?php echo $form->labelEx($model, "[$language]content",array('class'=>'item_b '. $model->removeClassErrors($language,'content'))); ?>
    <div class="">
        <?php // echo $form->textArea($model, "[$language]content", array('rows' => 6, 'cols' => 50, 'class' => '')); ?>
        <?php echo $form->textArea($model,"[$language]content",array('class'=>'ckeditor')); ?>
        <div class="clr"></div>
        <?php if($model->showErrorLangMessage($language,'content'))  echo $form->error($model, "[$language]content"); ?>
    </div>
</div>

<div class="row">
    <?php echo $form->labelEx($model, "[$language]short_content",array('class'=>' '. $model->removeClassErrors($language,'short_content'))); ?>
    <div class="">
        <?php echo $form->textArea($model,"[$language]short_content",array('rows'=>5, 'class'=>"w-800")); ?>
        <div class="clr"></div>
        <?php if($model->showErrorLangMessage($language,'short_content'))  echo $form->error($model, "[$language]short_content"); ?>
    </div>
</div>
