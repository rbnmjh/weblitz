<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Contact Us > List Contact us:</h2>
         <?php if(Yii::app()->user->hasFlash('msg')):?>
             <div class="info">
             <?php echo Yii::app()->user->getFlash('msg'); ?>
            </div>
      <?php endif; ?>
         <div class="admin-setting">
            <table class="adminlist">
               <tbody>
                  <tr>
                     <th>#</th>
                     <th align="left">Email</th>
                     <th align="left">Message</th>
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = $row_count*$current_page+1;
                     foreach($contactus as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count; ?></td>
                     <td><?php echo $item->email; ?></td>
                     <td><?php echo $item->message; ?></td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editContactUs/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteContactUs/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php $count++ ;} ?>
                  <tr>
                     <td colspan="3"> <?php $this->widget('CLinkPager', array(
                              'pages' => $pages,)) ?>
                     </td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addContactUs">
                           <strong>Add New</strong>
                        </a>
                     </td>
                  </tr>
               </tbody>
            </table>
         </div>  
      </div> 
   </div> 
   <div class="clear"></div>
</div>

