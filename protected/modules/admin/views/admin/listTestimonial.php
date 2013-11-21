<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Testimonial > List Testimonial:</h2>
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
                     <th align="left"><strong>Title</strong></th>
                     <th align="left">Company</th>
                     <th align="left">Image</th>
                     <th align="left">Message</th>
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = 1;
                     foreach($testimonial as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count++; ?></td>
                     <td><?php echo $item->name; ?></td>
                     <td><?php echo $item->company; ?></td>
                     <td><a href="<?php echo Yii::app()->request->baseUrl.'/uploads/testimonial/'.$item->image; ?>" data-lightbox="image-1">
                        <?php echo CHtml::image(Yii::app()->baseUrl .'/uploads/testimonial/admin-thumbs/'.$item->image, 'testimonial')?></a></td>
                     <td><?php echo $item->message; ?></td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editTestimonial/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteTestimonial/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php } ?>
                  <tr>
                     <td colspan="5"> <?php $this->widget('CLinkPager'/*, array(
    'pages' => $pages,
)*/) ?></td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addTestimonial">
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

