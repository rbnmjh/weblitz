<div class="main_content"> 
   <div class="center_content">
      <div class="right_content">
         <h2>Login:</h2>
         <div class="admin-setting">
            <?php if(isset($error_msg)){
               echo $error_msg;
            } ?>
            <?php
            $form = $this->beginWidget('CActiveForm', array(
                'id'                     => 'login_form',
                'enableClientValidation' => false,
                'enableAjaxValidation'   => false, //turn on ajax validation on the client side
                'clientOptions'          => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions'      => array(
                    'onsubmit'   => '$("#login_form").validate();',
                    'onkeypress' => " if(event.keyCode == 13){ $('#login_form').submit(); } "
                ),
                    ));

            ?>
            <table cellspacing="0" cellpadding="5" border="0" width="91%">
                  <tbody>
                     <tr>
                        <td valign="top">
                           <table class="adminform">
                              <tbody>
                                 <tr>
                                    <th colspan="2">Admin login:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Username/Email:<span>*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($user, 'email', array('class' => 'required text_area', 'maxlength' => '100', 'onclick'   => "$('#error_msg').css('display','none');"));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                 </tr>
                                 <tr>
                                    <td> <label for="#">Password:<span>*</span></label></td>
                                    <td>
                                       <span class="text-wrapper">
                                          <?php
                                             echo $form->passwordField($user, 'password', array('class'     => 'required text_area', 'maxlength' => '100'));
                                          ?>
                                       </span>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td>&nbsp;
                                       <input type="hidden" value="" id="mode" name="mode">
                                       <input type="hidden" value="" id="img_id" name="img_id"></td>
                                    <td>
                                       <?php echo CHtml::submitButton('submit', array('value' => 'Log In')); ?>
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