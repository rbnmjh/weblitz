<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>User > Change Password:</h2>
         <div class="admin-setting">
            <?php 
            if(isset($success_msg)){
               echo $success_msg;
            }
            else if(isset($fail_msg)){
               echo $fail_msg;
            }

            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'change_password_form',
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
                                    <th colspan="2">Change Password:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Old Password:<span>*</span></label></td>
                                    <td>
                                          <?php echo CHtml::passwordField('AdminUser[old_password]', '', array('id'    => 'old_password', 'class' => "required text_area")); ?>
                                    </td>
                                 </tr>
                                 <tr>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">New Password:<span>*</span></label></td>
                                    <td>
                                       <span class="text-wrapper">
                                          <?php echo CHtml::passwordField('AdminUser[new_password]', '', array('id'    => 'new_password', 'class' => "required text_area")); ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">Conform Password:<span>*</span></label></td>
                                    <td>
                                       <span class="text-wrapper">
                                         <?php echo CHtml::passwordField('AdminUser[conform_password]', '', array('id'    => 'conform_password', 'class' => "required text_area")); ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>&nbsp;
                                       <input type="hidden" value="" id="mode" name="mode">
                                       <input type="hidden" value="" id="img_id" name="img_id"></td>
                                    <td>
                                       <?php echo CHtml::submitButton('submit', array('value' => 'Change Password')); ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td align="right" colspan="2">&nbsp;</td>
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
