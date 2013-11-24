<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Our Team > List Our Team:</h2>
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
                     <th align="left">Image</th>
                     <th align="left">Description</th>
                     <th align="left">Status</th>
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = $row_count*$current_page+1;
                     foreach($ourteam as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count; ?></td>
                     <td><?php echo $item->name; ?></td>                     
                     <td><a href="<?php echo Yii::app()->request->baseUrl.'/uploads/ourteam/'.$item->image; ?>" data-lightbox="image-1">
                           <?php echo CHtml::image(Yii::app()->baseUrl .'/uploads/ourteam/admin-thumbs/'.$item->image, 'ourteam')?></a></td>
                     <td><?php echo $item->content; ?></td>
                     <td><?php if($item->status=='0')echo 'unpublished'; 
                               elseif($item->status=='1')echo 'published';
                         ?>
                     </td> 
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editOurTeam/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteOurTeam/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php $count++; } ?>
                  <tr>
                     <td colspan="5"> <?php $this->widget('CLinkPager', array(
                           'pages' => $pages,)) ?>
                     </td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addOurTeam">
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

