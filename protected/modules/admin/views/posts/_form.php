<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'posts-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

	<p class="note"><?php  echo Yii::t('translation','Fields with <span class="required">*</span> are required.')?></p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo Yii::t('translation',$form->labelEx($model,'title')) ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>63)); ?>
		<?php echo Yii::t('translation',$form->error($model,'title'));	 ?>
	</div>
	
	<div class="row">
        <?php echo Yii::t('translation',$form->labelEx($model,'content')) ?>
        <div style="float:left;">
            <?php
            $this->widget('ext.editMe.ExtEditMe',array(
                'model'=>$model,
                'height'=>'250px',
                'width'=>'700px',
                'attribute'=>'content',
                'toolbar'=>Yii::app()->params['ckeditor_editMe'],
                'filebrowserBrowseUrl' => Yii::app()->baseUrl.'/ckfinder/ckfinder.html',
                'filebrowserImageBrowseUrl' => Yii::app()->baseUrl.'/ckfinder/ckfinder.html?type=Images',
                'filebrowserFlashBrowseUrl' => Yii::app()->baseUrl.'/ckfinder/ckfinder.html?type=Flash',
                'filebrowserUploadUrl' => Yii::app()->baseUrl.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                'filebrowserImageUploadUrl' => Yii::app()->baseUrl.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
                'filebrowserFlashUploadUrl' => Yii::app()->baseUrl.'/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
            ));
            ?>
        </div>
        <?php echo Yii::t('translation',$form->error($model,'content')); ?>
    </div>
<div class='clr'></div>

	<div class="row">
		<?php echo Yii::t('translation',$form->labelEx($model,'Status'))?>
		<?php echo $form->dropDownList($model,'status',array(1=>'Active',0=>'Inactive' ));?>
		<?php echo Yii::t('translation',$form->error($model,'Status')); ?>
	</div>

    <?php
    /*
	<div class="row">
		<?php echo Yii::t('translation',$form->labelEx($model,'layout_id')) ?>
		<?php echo $form->textField($model,'layout_id'); ?>
		<?php echo Yii::t('translation',$form->error($model,'layout_id')); ?>
	</div>

    */
    ?>

	<div class="row">
		<?php echo Yii::t('translation',$form->labelEx($model,'order')) ?>
		<?php echo $form->textField($model,'order'); ?>
		<?php echo Yii::t('translation',$form->error($model,'order'));?>
	</div>	

        <div class="row">
		<label for="UsersActions_user_id"><?php echo  Yii::t('translation','Categories')?></label>
                <div id="categories_checkbox" class="categories_checkbox" style="padding-left: 0px; border:1px solid #ccc; height: 220px; width: 400px; overflow: auto;">
                <?php if($model->isNewRecord) echo Categories::getCheckBoxList(); else echo Categories::getCheckBoxListUpdate($model->id); ?>
                </div>
                <div class="add_category" style="padding-left: 115px;">
                    <a id="displayText" href="javascript:toggle();"><?php echo  Yii::t('translation','Add New Category');?></a>
                    <div id="toggleText" style="display: none">
                        </br>
                        <label for="UsersActions_user_id"><?php echo  Yii::t('translation','Name:')?> </label>
                        <?php echo CHtml::textField('Categories[title]'); ?></br>
                        <label for="UsersActions_user_id"><?php echo  Yii::t('translation','Parent:')?> </label>
                        <div id="categories_menu_parent">
                        <?php echo Categories::getDropDownList('Categories[parent_id]','Menus_parent_id','',true); ?>
                        </div></br>
                        <button id="buttonaddcategory" type="button" ><?php echo  Yii::t('translation','Add New')?></button>
                    </div>
                </div>

	</div>
        
        <div class="row">
		<label for="UsersActions_user_id"><?php echo  Yii::t('translation','Tags')?></label>
                <?php echo CHtml::textField('Tags_title'); ?>
                <button id="buttonaddtags" type="button" ><?php echo  Yii::t('translation','Add New')?></button>
                </br>
                <div id="tags_post" style="padding-left: 115px; width: 400px;">
                    
                </div>
                <a id="displaytagsText"  style="padding-left: 115px;" href="javascript:toggletags();"><?php echo  Yii::t('translation','Choose from the most used tags')?></a>
                <div id="toggletagsText" style="display: none; padding-left: 115px;">
                    <?php foreach($tags_most_used as $key => $tag)
                        {

                        ?>
                    <a href="#Tags_title" style="padding-right: 20px;" value="<?php echo $tag['tag_name']; ?>" onclick="addMostTags('<?php echo $tag['tag_name']; ?>');" >
                        <?php echo $tag['tag_name']; ?>
                    </a>

                    <?php
                        }
                    ?>
                </div>
		
	</div>

        <div class="row">
        <?php echo $form->labelEx($model,'featured_image'); ?>
        <div id="current-image">
        <?php if(!$model->isNewRecord && isset($model->featured_image) && $model->featured_image != null) 
        {            
            echo CHtml::image(Yii::app()->baseUrl."/upload/uploaded_".$model->user_id."/adminshow/".$model->media->url, "image");
            echo '<br/>';             
        }            
        ?>
        </div>            
        <div style="padding-left: 115px;">
        <a href="#media" id="set-featured-image">Set Featured Image</a> 
        </div>
        
        <input name="temp_image_name" type="hidden" value="<?php if(!$model->isNewRecord) echo $model->featured_image; ?>" />
        <input name="featured_image_name" type="hidden" value="<?php if(!$model->isNewRecord) echo $model->featured_image; ?>" />       
        <input name="temp_image_name" type="hidden" value="<?php if (!$model->
        isNewRecord)
            echo $model->featured_image; ?>" />
                <input name="featured_image_name" type="hidden" value="<?php if (!$model->
        isNewRecord)
            echo $model->featured_image; ?>" />

            
        <?php if(isset($mesg) && $mesg != null) echo '<br/><div class="errorMessage" style="padding-left:115px;">'.$mesg.'</div>'; ?>
        <?php echo $form->error($model,'featured_image'); ?>
        </div>

    <fieldset>
        <legend><b>SEO Fields</b></legend>
        <div class="row">
            <?php echo $form->labelEx($model,'title_tag'); ?>
            <?php echo $form->textField($model,'title_tag',array('size'=>74,'maxlength'=>200)); ?>
            <?php echo $form->error($model,'title_tag'); ?>
        </div>
        <div class="clr"></div>
        <div class="row">
            <?php echo $form->labelEx($model,'meta_keywords'); ?>
            <?php echo $form->textArea($model,'meta_keywords',array('rows'=>5, 'cols'=>57)); ?>
            <?php echo $form->error($model,'meta_keywords'); ?>
        </div>
        <div class="clr"></div>
        <div class="row">
            <?php echo $form->labelEx($model,'meta_desc'); ?>
            <?php echo $form->textArea($model,'meta_desc',array('rows'=>5, 'cols'=>57)); ?>
            <?php echo $form->error($model,'meta_desc'); ?>
        </div>
    </fieldset>


	<?php echo $form->hiddenField($model,'user_id',array('value'=>Yii::app()->user->getId())); ?>
	<?php echo $form->hiddenField($model,'post_type',array('value'=>'post')); ?>

	<div class="row buttons" style="padding-left:115px;">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

<div style='display:none'>
			<div id='inline_content' style='padding:0 10px 0 10px; background:#fff;'>
            <div id="tabs" style="width: 881px;">
            <ul>
                <li><a href="#tabs-1">Upload From Computer</a></li> 
                <li><a href="#tabs-2">From URL</a></li> 
                <li><a href="#tabs-3">Media Library</a></li> 
            </ul>
            <div id="tabs-1" style="padding-bottom: 37px;">
            
            <div style="float: left;">
            <form id="upload_form" action="<?php echo Yii::app()->
                createAbsoluteUrl('admin/pages/imageupload'); ?>" method="post" enctype="multipart/form-data">
                
                <input type="file" name="uploadedfile">
                <input type="submit" value="Upload file to media library">
            </form>      
            </div>
            
            <div style="clear: both;"></div>
            <div id="list_image_upload" style="height: 390px; overflow: auto; padding: 12px 0px;">            
            </div>
            
            </div>
            
            <div id="tabs-2" style="padding-bottom: 37px;">
            <div class="searchImage" style="float:left;">
            <label for="Images_title">URL: </label>            
            <input id="image_url" type="text" size="45" style="margin-left: 10px;">
            <button id="image_url_button" style="margin-left: 10px;">Download to media library</button>
            <div style="clear: both;"></div>
            </div>
            
            <div style="clear: both;"></div>
            <div id="image_url_result" style="height: 390px; overflow: auto; padding: 12px 0px;">
            </div>
            
            </div>
            
            <div id="tabs-3" style="padding-bottom: 37px;">
            <div class="searchImage" style="float:left; margin-left: 38px;">
            <label for="Images_title">Title: </label>
            <input id="images_title" type="text" name="Images[title]" style="margin-left: 10px;" size="30">
            <button id="search-button" style="margin-left: 10px;">Search</button>
            </div>
            <div style="clear: both;"></div>
            
            <?php
            if ($model->isNewRecord)
                $user_id = Yii::app()->user->id;
            else
                $user_id = $model->user_id;
            ?>
            
            <div id="image-paging">
            <div style="float:right; padding-right: 42px;">
                <?php $this->widget('CLinkPager', array('pages' => $pages, 'id' =>
'link_pager')); ?>
            </div>
            <div style="clear: both;"></div>            
            <ul  id="resultHolder" style="display: block;">            
            </ul>
            </div>            
            <div style="clear:both"></div>
            <button style="float: left; margin-left: 39px;" id="insert-to-post">Set Featured Image</button> 
            <a href="#media" style="float: left; margin-left: 39px;" id="delete-an-media">Delete Image</a> 
            </div>  
            
            
		</div>
        </div>
  </div>


</div><!-- form -->
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.stringToSlug.js"></script>
<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.stringToSlug.min.js"></script>
<script src="<?php echo Yii::app()->theme->baseUrl; ?>/admin/js/colorbox/jquery.colorbox.js"></script>
<script>
$("#set-featured-image").click(function() {
   $.colorbox({inline:true, width: "72%", height:"100%", href:"#inline_content"});
});
</script>

<script type="text/javascript">
	jQuery(document).ready(function(){
		validateNumber();
                $("#Pages_title").stringToSlug({
			setEvents: 'keyup keydown blur',
			getPut: '#Pages_slug',
			space: '-'
		});                
	});

	function validateNumber(){
		$(".number").each(function(){
			$(this).unbind("keydown");
			$(this).bind("keydown",function(event){
			    if( !(event.keyCode == 8                                // backspace
			        || event.keyCode == 46                              // delete
			        || event.keyCode == 9							// tab
			        || event.keyCode == 190							// dấu chấm (point) 
			        || (event.keyCode >= 35 && event.keyCode <= 40)     // arrow keys/home/end
			        || (event.keyCode >= 48 && event.keyCode <= 57)     // numbers on keyboard
			        || (event.keyCode >= 96 && event.keyCode <= 105))   // number on keypad
			        ) {
			            event.preventDefault();     // Prevent character input
			    	}
			});
		});
	}
	
</script>

<script language="javascript"> 

function toggletags() {
	var ele = document.getElementById("toggletagsText");
	if(ele.style.display == "block") {
    		ele.style.display = "none";
  	}
	else {
		ele.style.display = "block";
	}
}

function isValueInArray(arr, val) {
    inArray = false;
    for (i = 0; i < arr.length; i++)
    if (val == arr[i])
    inArray = true;
    return inArray;
}

// tags

$("#buttonaddtags").click(addNewTags);
var tags_array = new Array();


function addNewTags(){
    var new_tags = $("input[name='Tags_title']").val();
    if(new_tags == '')
    {
        alert('Tags cannot be blank');
        return;        
    }
    if(!isValueInArray(tags_array, new_tags))
    {
        tags_array.push(new_tags);      
    }
    showTags();
}

function deleteTags(value){   
    for (i = 0; i < tags_array.length; i++)
    if (value == tags_array[i])
        tags_array.splice(i, 1);
    showTags();
}

function addMostTags(value){  
    value = String(value);
    if(!isValueInArray(tags_array, value))
    {
        tags_array.push(value);      
    }
    showTags();
}

function showTags(){
    var str = '';
    if(tags_array.length > 0)
    {
        str += '<div id="'+ 0 +'" name="Tags['+ tags_array[0] +']" style="display: inline;"><a href="#Tags_title" onclick="deleteTags(\''+ tags_array[0] +'\');"><img alt="Delete" src="<?php echo
Yii::app()->createAbsoluteUrl('themes/yii_core/admin/images/icon/delete.png'); ?>"></a>'+ tags_array[0] + '</div>';
        str += '<input type="hidden" name="Tags['+ tags_array[0] +']" value="'+ tags_array[0] +'" >';
        for (i = 1; i < tags_array.length; i++)
        {
            str += '<div id="'+ i +'" name="Tags['+ tags_array[i] +']" style="padding-left: 20px; display: inline;"><a href="#Tags_title" onclick="deleteTags(\''+ tags_array[i] +'\');"><img alt="Delete" src="<?php echo
Yii::app()->createAbsoluteUrl('themes/yii_core/admin/images/icon/delete.png'); ?>"></a>'+ tags_array[i] + '</div>';
            str += '<input type="hidden" name="Tags['+ tags_array[i] +']" value="'+ tags_array[i] +'" >';
        }
    }     
    $("#tags_post").html(str);
}

<?php
if (!$model->isNewRecord) {
?>
    var new_tag;
    <?php
    foreach (TagsPosts::tagsInPost($model->id) as $key => $value) {
?>
        
    new_tag = '<?php echo $value; ?>';
    tags_array.push(new_tag);
    
    <?php
    }
?>
    if(typeof tags_array[0] !== 'undefined')
    showTags();
<?php
}
?>
    
    //featured image    
    var imageUrl = "";
    var currentPage = 0;
    
    function readyAjax(){
    $('li.image').each(function(){
                        $(this).click(function(ev){
                                ev.preventDefault();
                                $('li.image').css("background","none");
                                $(this).css("background","none repeat scroll 0 0 #000000");
                                $('.image-name').css("color","black");
                                var imageId = $(this).val();
                                imageUrl = $(this).attr("name");
                                $('#image-name-'+imageId).css("color","white");
                                $("input[name='temp_image_name']").val($(this).val());
                                });
                                
                        $(this).mouseover(function(ev){
                                $('li.image').css("opacity","0.67");
                                $(this).css("opacity","1");
                                });
                        
                });
    $('#link_pager a').each(function(){
                        $(this).click(function(ev){currentPage = this.href.charAt(this.href.length-1); //alert(currentPage);
                                $('.selected.page')[0].className = 'page';
                                this.parentNode.className = "page selected";

                                ev.preventDefault();
                                $.get(this.href,{ajax:true},function(html){
                                                $('#image-paging').html(html);
                                        });
                                        
                                });
                });
    $('.image-upload-set').each(function(){
        $(this).click(function(ev){
            $("input[name='featured_image_name']").val($(this).attr("value"));
            $.colorbox.close(); 
            $("#current-image").html('<img alt="image" src="<?php echo Yii::app()->baseUrl; ?>/upload/uploaded_'+<?php echo
    $user_id; ?>+'/adminshow/'+$(this).attr("name")+'">');	
        });
    });
    }
    readyAjax();
    
    $('#insert-to-post').click(function(){
        $("input[name='featured_image_name']").val($("input[name='temp_image_name']").val());
        $.colorbox.close(); 
        $("#current-image").html('<img alt="image" src="<?php echo Yii::app()->baseUrl; ?>/upload/uploaded_'+<?php echo
$user_id; ?>+'/adminshow/'+imageUrl+'">');	
    });
    
    $('#delete-an-media').click(function(){//alert(currentPage);
        var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/medias/delete/id/'); ?>";
        url += '/'+$("input[name='temp_image_name']").val();
        
        var request = $.ajax({
            type: "post",
            url: url,
            data: {}
          }).done(function(msg) {
            //$("#image-paging").html(msg); 
            searchAjax(currentPage);               
          });
        	
    });
                    
    $(document).ajaxComplete(function() {
        readyAjax();
    });
    
    //color box search
    function searchAjax(c_page = null){
        var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/pages/imagepaging'); ?>";
        var request = $.ajax({
            type: "get",
            url: url,
            data: { image_title: $('#images_title').val() <?php if (!$model->
isNewRecord)
    echo ', user_id:' . $model->user_id; ?> , c_page: c_page}
          }).done(function(msg) {
            $("#image-paging").html(msg);                
          });

          request.fail(function() {
            alert( "Request fail!");
          }); 
    }
    searchAjax();
    
    $('#search-button').click(function(){        
        searchAjax();        
    });
    
    //tab2 url image
    $('#image_url_button').click(function(){        
        var url = "<?php echo Yii::app()->createAbsoluteUrl('admin/pages/imageurl'); ?>";
        var request = $.ajax({
            type: "get",
            url: url,
            data: { url: $('#image_url').val() <?php if (!$model->
isNewRecord)
    echo ', user_id:' . $model->user_id; ?>}
          }).done(function(msg) {
            $("#image_url_result").append(msg);
            searchAjax();                
          });

          request.fail(function() {
            alert( "Request fail!");
          }); 
        
    });
</script>


<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-ui-1.8.21.custom/js/jquery-ui-1.8.21.custom.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->
baseUrl; ?>/js/jquery-ui-1.8.21.custom/css/smoothness/jquery-ui-1.8.21.custom.css" />

<script type="text/javascript">
$(document).ready(function() {
    $('#tabs').tabs();
});
</script>

<script type="text/javaScript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.form.js"></script>
<script>    
var bar = $('.bar');
var percent = $('.percent');
//var status = $('#list_image_upload');
   
$('#upload_form').ajaxForm({
	complete: function(xhr) {
		$('#list_image_upload').append(xhr.responseText);
        searchAjax();
	}
}); 
</script>