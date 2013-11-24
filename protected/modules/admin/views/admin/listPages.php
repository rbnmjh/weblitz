<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Page > List Page:</h2>
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
                     <th align="left">Description</th>
                     <th align="left">image</th>
                     <th align="left">status</th>
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = $row_count*$current_page+1;
                     foreach($page as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count; ?></td>
                     <td><?php echo $item->name; ?></td>
                     <td><?php echo $item->content; ?></td>
                     <td>
                      <?php if($item->image!=''){?>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/uploads/page/'.$item->image; ?>" data-lightbox="image-1">
                            <?php echo CHtml::image(Yii::app()->baseUrl .'/uploads/page/admin-thumbs/'.$item->image, 'page')?>
                        </a>
                      <? } ?>
                    </td>
                     <td><?php if($item->status=='0')echo 'unpublished'; 
                               elseif($item->status=='1')echo 'published';
                         ?>
                      </td>   
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editPages/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeletePages/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php $count++ ;} ?>
                  <tr>
                     <td colspan="5"> <?php $this->widget('CLinkPager', array(
                        'pages' => $pages,
                        )) ?>
                     </td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addPages">
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

