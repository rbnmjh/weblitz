<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Site setting > Add site setting:</h2>
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
                'id'                     => 'Sitesetting_form',
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
                                    <th colspan="2">Add Sitesetting Content:</th>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Email<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($sitesetting, 'site_email', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Phone<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($sitesetting, 'phone', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Location<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($sitesetting, 'location', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Latitude<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($sitesetting, 'lat', array('class' => 'required text_area', 'maxlength' => '100'));
                                       ?>
                                    </td>
                                 </tr>
                                 <tr>
                                    <td><label for="#">Longitude<span class="required">*</span></label></td>
                                    <td>
                                       <?php
                                          echo $form->textField($sitesetting, 'lon', array('class' => 'required text_area', 'maxlength' => '100'));
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
                                    <td align="right" colspan="5">&nbsp;</td>
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
