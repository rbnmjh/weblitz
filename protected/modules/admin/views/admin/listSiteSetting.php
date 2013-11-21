<div class="main_content"> 
   <?php $this->renderPartial('//blocks/admin_menu'); ?>
   <div class="center_content">
      <div class="right_content">
         <h2>Site Setting > List Site setting:</h2>
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
                     <th align="left">Phone</th>
                     <th align="left">Location</th>
                     <th align="left">Latitude</th> 
                     <th align="left">Longitude</th>
                     <th align="left" width="90">Action</th>
                  </tr>
                  <?php 
                     $count = $row_count*$current_page+1;
                     foreach($sitesetting as $item){
                  ?>
                  <tr>
                     <td align="center"><?php echo $count; ?></td>
                     <td><?php echo $item->site_email; ?></td>
                     <td><?php echo $item->phone; ?></td>
                     <td><?php echo $item->location; ?></td>
                     <td><?php echo $item->lat; ?></td>
                     <td><?php echo $item->lon; ?></td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/editSiteSetting/'.$item->id; ?>">Edit</a>&nbsp; &nbsp;
                        <a href="<?php echo Yii::app()->request->baseUrl.'/admin/DeleteSiteSetting/'.$item->id; ?>">Delete</a>
                      
                     </td>
                  </tr>
                  <?php $count++;} ?>
                  <tr>
                     <td colspan="6"> <?php $this->widget('CLinkPager', array(
                                    'pages' => $pages,)) ?>
                     </td>
                     <td>
                        <a href="<?php echo Yii::app()->request->baseUrl ?>/admin/addSiteSetting">
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

