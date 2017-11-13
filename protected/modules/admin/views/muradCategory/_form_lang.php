<div id="tabs">
    <ul>
        <?php foreach(Languages::getAlllanguage() as $key=> $lang): ?>
        <li class="<?php echo ($key=='') ? 'active' : ''; ?>">
            <a href="#<?php echo $lang->code ?>"><?php echo $lang->title;?></a>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php foreach(Languages::getAlllanguage() as $key=> $lang): ?>
    <div id="<?php echo $lang->code ?>" class="">
       <?php $this->renderPartial(
               '_form_translate',
               array(
                    'model'      => $model->getDataWithLangauge($model, $lang->code),
                    'form'       => $form,
                    'language'   => $lang->code
                )
           ); 
       ?>
    </div>
    <?php endforeach; ?>
</div> <!-- end <div id="tabs">-->