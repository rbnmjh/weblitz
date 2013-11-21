<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
   <head>
      <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
      <title>Admin Panel</title>
      <?php
      //-------------------  add css/js script here  -------------------//
      $script = Yii::app()->clientScript;
      $script->registerCssFile(Yii::app()->request->baseUrl . '/media/admin/style.css');
      $script->registerCssFile(Yii::app()->request->baseUrl . '/media/admin/style2.css');
      $script->registerCssFile(Yii::app()->request->baseUrl . '/media/admin/style3.css');
      $script->registerCssFile(Yii::app()->request->baseUrl . '/media/admin/rokmoomenu.css');
      $script->registerScriptFile(Yii::app()->request->baseUrl . '/media/javascripts/jquery.js');
      $script->registerScriptFile(Yii::app()->request->baseUrl . '/media/tinymce/jscripts/tiny_mce/tiny_mce.js');
      ?>
   </head>
   <body>
      <div id="main_container">
         <div class="header">
            <div id="logo" class="span4">
               <div data-slide="1">
                  <a href="#front">weblitz<em>’</em> <span>Studios</span></a>
               </div>
            </div>
            <div class="right_header">Welcome Admin  | 
               <?php if(isset(Yii::app()->user->user_id) && Yii::app()->user->role == 'admin'){
                  echo '<a href="'. Yii::app()->request->baseUrl .'/admin/logout" class="logout">Logout</a></div>';
               }
               else
               {
                   echo '<a href="'. Yii::app()->request->baseUrl .'/admin/login" class="login">Login</a></div>';
               }
             ?>  
         </div>
         <?php echo $content; ?>
         <div class="footer">
         </div>
      </div>
   </body>
</html>