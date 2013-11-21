<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "exact",
          elements : "Testimonial_message",
		theme : "advanced",
		skin : "o2k7",
          skin_variant : "silver",
		plugins : "autolink,lists,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,autosave",

		// Theme options
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,formatselect,fontsizeselect,code,forecolor",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,image",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : false,

		// Example word content CSS (should be your site CSS) this one removes paragraph margins
		content_css : "css/word.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js"
  });
</script> 
<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Testimonial > Add Testimonial:</h2>
         <p class="note">Fields with <span class="required">*</span> are required.</p> 
         <div class="admin-setting">
           <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }

              $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'Testimonial_form',
                'enableClientValidation' => true,
                'enableAjaxValidation'   => false, //turn on ajax validation on the client side
                'clientOptions'          => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions'      => array(
                    'onsubmit'   => 'return true;',
                    'enctype'    => 'multipart/form-data',
                    'onkeypress' => " if(event.keyCode == 13){} "
                ),
              ));

            ?>
            <table cellspacing="0" cellpadding="5" border="0" width="100%">
                  <tbody>
                     <tr>
                        <td valign="top">
                           <table class="adminform">
                              <tbody>
                                 <tr>
                                    <th colspan="2">Add Testimonial Content:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Name<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($testimonial, 'name', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Company</label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($testimonial, 'company', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Image</label></td>
                                    <td>
                                       <?php
                                          echo $form->filefield($testimonial, 'image', array('class' => 'required text_area', 'size' => '10'));
                                       ?>
                                    </td>
                                 </tr>
                                 
                                 <tr>
                                    <td><label for="#">Message<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textArea($testimonial, 'message', array('class' => 'required text_area', 'width' => '1000', 'height' => '1000' ,'maxlength' => '700','rows'=>'250','cols'=>'100'));
                                       ?>
                                    </td>
                                 </tr>
                                 
                                 
                                 <tr>
                                    <td>&nbsp;</td>
                                    <td>
                                       <?php echo CHtml::submitButton('submit', array('value' => 'Add')); ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="right" colspan="4">&nbsp;</td>
                                 </tr>
                              </tbody>
                           </table>
                        </td>
                     </tr>
                  </tbody>
               </table>
            <?php $this->endWidget(); ?>
         </div>  
      </div> 
   </div> 
   <div class="clear"></div>
</div>
<script>/*
  $(function(){
  $("#Page_form").submit(function() {
                        // update underlying textarea before submit validation
                        tinyMCE.triggerSave();
                }).validate({
                        ignore: "",
                        rules: {
                                'Page[title]': "required",                                
                                'Page[content]': "required"                                
                        },                        
                        messages:{
                                'Page[title]': "Field required",                                
                                'Page[content]': "Field required"                               
                        },   
                         errorElement: "div",
                        errorPlacement: function(error, element) {
                                // position error label after generated textarea
                                if (element.is("textarea")) {
                                        $('#Page_content_parent').after(error);
                                }
                                else {
                                        element.after(error);
                                }
                        }
                });
}); */
</script>