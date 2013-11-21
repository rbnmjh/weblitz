<?php

class AdminController extends Controller {

	public $layout = '//layouts/admin';

   public function checkLogin() {

  
      if (isset(Yii::app()->user->role) && Yii::app()->user->role = 'admin') {
         return true;
      }else{
         return false;
      }
   }

   public function actionIndex() {

      if ($this->checkLogin()) {
         $data['tab'] = 0;
         $this->render('index', $data);
      }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionLogin() {
		$this->layout = '//layouts/admin_login';

      if ($this->checkLogin()) {
         $this->redirect(Yii::app()->request->baseUrl . '/admin');
      }else{

         $user = new AdminUser();
         $data['user'] = $user;
         if (isset($_POST['AdminUser'])) {          
            $loginForm = new LoginForm();
            $loginForm->username = $_POST['AdminUser']['email'];
            $loginForm->password = $_POST['AdminUser']['password'];
            if ($loginForm->validate() && $loginForm->login()) {
               $this->redirect(Yii::app()->request->baseUrl . '/admin/');
            }
            else {
               $data['error_msg'] = 'User name or password not match.';
            }
         }
         $data['tab'] = 0;
         $this->render('login', $data);
      }
   }

   public function actionLogout() {
      if ($this->checkLogin()) {
         Yii::app()->user->logout(false);
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }

   public function actionChangePassword(){
      if ($this->checkLogin()) {
         $data = array();
         $user_id = Yii::app()->user->user_id;
         $user = AdminUser::model()->findByPk($user_id);
         if(isset($_POST['AdminUser'])){
            $old_password = $_POST['AdminUser']['old_password'];
            $password = $_POST['AdminUser']['new_password'];
            if($user->password == md5($old_password)){
               $user->password = md5($password);
               $user->update();
               $data['success_msg'] = 'password change successfully.';
            }
            else{
               $data['fail_msg'] = 'Old password not match.';
            }
         }

         $this->render('changePassword', $data);
      }
      else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   
   public function actionEditUserInfo(){
      if ($this->checkLogin()) {
          $user_id = Yii::app()->user->user_id;
          $user = AdminUser::model()->findByPk($user_id);
          if(isset($_POST['AdminUser'])){
             $user->attributes = $_POST['AdminUser'];
             $user->update();

          }
          $data['user'] = $user;
          $this->render('editUserInfo', $data);
       }
      else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }
   /*
   public function actionEditContactInfo(){
      if ($this->checkLogin()) {
         $contact_info = ContactInfo::model()->find('id=1');
         if(isset($_POST['ContactInfo'])){
            $contact_info->attributes = $_POST['ContactInfo'];
            $contact_info->update();
         }
         $data['contactInfo'] = $contact_info;
         $this->render('editContactInfo', $data);
      }
      else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
   }*/ 

   public function actionAddPortfolio(){
      if ($this->checkLogin()) {
         $portfolio = new Portfolio;          
         if(isset($_POST['Portfolio'])){
          $portfolio = new Portfolio; 
          if($_POST['Portfolio']['status']==''){
            $_POST['Portfolio']['status']=1;
          }
          $portfolio->attributes = $_POST['Portfolio'];
          $uploaded_files = CUploadedFile::getInstance($portfolio, 'image');           
             if($portfolio->save()){
                if($uploaded_files!=""){
                  $tmp = explode('.', $uploaded_files);
                  $file_extension = strtolower(end($tmp));
                  $file_name = Common::generate_filename() . '.' . $file_extension;
                  $uploaded_files->saveAs("uploads/portfolio/$file_name");
                  require 'media/image_lib/WideImage.php';
                  $image = WideImage::load("uploads/portfolio/$file_name");
                  $resized_pic = $image->resize(1024, 400, 'outside')->crop('center', 'center', 1024, 400);
                  $resized_pic->saveToFile("uploads/portfolio/$file_name");
                  //$thumbs_pic = $image->resize(70, 25, 'outside')->crop('center', 'center', 70, 25);
                  //$thumbs_pic->saveToFile("uploads/slider/thumbs/$file_name");
                  $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
                  $admin_thumbs_pic->saveToFile("uploads/portfolio/admin-thumbs/$file_name");
                  $portfolio->image = $file_name;
                  $portfolio->save();
                   
                }
               Yii::app()->user->setFlash('msg', "Portfolio added successfully.");
               $this->redirect(Yii::app()->request->baseUrl.'/admin/listPortfolio');
               }else{
                  $data['fail_msg'] = 'Fail to add Portfolio.';
               }
         }
         $data['portfolio'] = $portfolio;
         $this->render('addPortfolio', $data);
         }else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }

   }

  public function actionListPortfolio(){
    if ($this->checkLogin()) {
      $criteria = new CDbCriteria();
      $criteria->order = 'id DESC';
      $item_count =32;
      $page_size =5;
      $count=Portfolio::model()->count($criteria);
      $pages=new CPagination($count);
      
         // results per page
      $pages->pageSize=2;
      $pages->applyLimit($criteria);
      $end =($pages->offset+$pages->limit <= $item_count ? $pages->offset+$pages->limit : $item_count);

    $sample =range($pages->offset+1, $end);

      $models = Portfolio::model()->findAll($criteria);
      $this->render('listPortfolio', array(
         'portfolio' => $models,
         //'page_size'=>$page_size,
         'pages' => $pages,
         'sample'=>$sample,
      )); 
}
 else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
    //$portfolio = Portfolio::model()->findAll();
    //$data['portfolio'] = $portfolio;
    //$this->render('listPortfolio',$data);
  }

  public function actionDeletePortfolio($id) {
    if ($this->checkLogin()) {
       $portfolio = Portfolio::model()->findByPk($id);
       if (isset($portfolio)) {       
          $portfolio->delete();
           if ($portfolio->attributes['image']!='' && file_exists('uploads/portfolio/' . $portfolio->attributes['image'])) 
                          unlink('uploads/portfolio/' . $portfolio->attributes['image']);
           if ($portfolio->attributes['image']!='' && file_exists('uploads/portfolio/admin-thumbs/' . $portfolio->attributes['image'])) 
                          unlink('uploads/portfolio/admin-thumbs/' . $portfolio->attributes['image']);             
       }$this->redirect(Yii::app()->request->baseUrl . '/admin/ListPortfolio');
      }else{
      $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
    }      
  }

  public function actionEditPortfolio($id){
   if ($this->checkLogin()){
     $portfolio = Portfolio::model()->findByPk($id);         
     if(!empty($portfolio)){
         if(isset($_POST['Portfolio'])){
              $old_file = $portfolio->attributes['image'];
              $portfolio->attributes = $_POST['Portfolio'];
              $portfolio->image = $old_file;
              $uploaded_files= CUploadedFile::getInstance($portfolio, 'image');
              if ($portfolio->save()) {
               if(!empty($uploaded_files)){ // check if uploaded file is set or not
                 $tmp = explode('.', $uploaded_files);
                 $file_extension = strtolower(end($tmp));
                 $file_name = Common::generate_filename() . '.' . $file_extension;
                 $uploaded_files->saveAs('uploads/portfolio/'.$file_name);
                 require 'media/image_lib/WideImage.php';
                 $image = WideImage::load("uploads/portfolio/$file_name");
                 //$thumbs_pic = $image->resize(214, 124, 'outside')->crop('center', 'center', 214, 124);
                 //$thumbs_pic->saveToFile("uploads/gallery/thumbs/$file_name");
                 $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
                 $admin_thumbs_pic->saveToFile("uploads/portfolio/admin-thumbs/$file_name");
                 $portfolio->image = $file_name;
                 $portfolio->update();
                 if($old_file!='' && file_exists('uploads/portfolio/'. $old_file))
                    unlink('uploads/portfolio/'. $old_file);
                 //if($old_file!='' && file_exists('uploads/gallery/thumbs/'. $old_file))
                   // unlink('uploads/gallery/thumbs/'. $old_file);
                 if($old_file!='' && file_exists('uploads/portfolio/admin-thumbs/'. $old_file))
                    unlink('uploads/portfolio/admin-thumbs/'. $old_file);
                 }
                 Yii::app()->user->setFlash('msg', "Portfolio Updated Successfully!");
                 $this->redirect(Yii::app()->request->baseUrl.'/admin/listPortfolio');
        
              }else {
                 $data['fail_msg'] = 'Fail to edit Gallery.';
              }
            }
         $data['portfolio'] = $portfolio;
         $this->render('editPortfolio', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listPortfolio');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionAddPages(){
    if ($this->checkLogin()) {
    $page = new Pages();
    $data['page'] = $page;
     if(isset($_POST['Pages'])){
      $page = new Pages();
      if($_POST['Pages']['status']==''){
         $_POST['Pages']['status']=1;
      }
      $page->attributes = $_POST['Pages'];
      $uploaded_files = CUploadedFile::getInstance($page, 'image');        
        if($page->save()){            
          if($uploaded_files!=""){
            $tmp = explode('.', $uploaded_files);
            $file_extension = strtolower(end($tmp));
            $file_name = Common::generate_filename() . '.' . $file_extension;
            $uploaded_files->saveAs("uploads/page/$file_name");
            require 'media/image_lib/WideImage.php';
            $image = WideImage::load("uploads/page/$file_name");
            $resized_pic = $image->resize(1024, 400, 'outside')->crop('center', 'center', 1024, 400);
            $resized_pic->saveToFile("uploads/page/$file_name");
            //$thumbs_pic = $image->resize(70, 25, 'outside')->crop('center', 'center', 70, 25);
            //$thumbs_pic->saveToFile("uploads/slider/thumbs/$file_name");
            $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
            $admin_thumbs_pic->saveToFile("uploads/page/admin-thumbs/$file_name");
            $page->image = $file_name;
            $page->save();
                 
          }
          Yii::app()->user->setFlash('msg', "Page added successfully.");
          $this->redirect(Yii::app()->request->baseUrl.'/admin/listPages');
         }else{
       $data['fail_msg'] = 'Fail to add Page.';
           }
      }
   
   
  $this->render('addPages',$data);
   }
   else {
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionListPages(){
    $page = Pages::model()->findAll();
    $data['page'] = $page;
    $this->render('listPages',$data);
  }

  public function actionDeletePages($id) {
    if ($this->checkLogin()) {
       $page = Pages::model()->findByPk($id);
       if (isset($page)) {       
          $page->delete();
           if ($page->attributes['image']!='' && file_exists('uploads/page/' . $page->attributes['image'])) 
                          unlink('uploads/page/' . $page->attributes['image']);
           if ($page->attributes['image']!='' && file_exists('uploads/page/admin-thumbs/' . $page->attributes['image'])) 
                          unlink('uploads/page/admin-thumbs/' . $page->attributes['image']); 
       }$this->redirect(Yii::app()->request->baseUrl . '/admin/ListPages');
      }else{
      $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
    }      
  }

  public function actionEditPages($id){
   if ($this->checkLogin()){
     $page = Pages::model()->findByPk($id);         
     if(!empty($page)){
         if(isset($_POST['Pages'])){
              $old_file = $page->attributes['image'];
              $page->attributes = $_POST['Pages'];
              $page->image = $old_file;
              $uploaded_files= CUploadedFile::getInstance($page, 'image');
              if ($page->save()) {
               if(!empty($uploaded_files)){ // check if uploaded file is set or not
                 $tmp = explode('.', $uploaded_files);
                 $file_extension = strtolower(end($tmp));
                 $file_name = Common::generate_filename() . '.' . $file_extension;
                 $uploaded_files->saveAs('uploads/page/'.$file_name);
                 require 'media/image_lib/WideImage.php';
                 $image = WideImage::load("uploads/page/$file_name");
                 //$thumbs_pic = $image->resize(214, 124, 'outside')->crop('center', 'center', 214, 124);
                 //$thumbs_pic->saveToFile("uploads/gallery/thumbs/$file_name");
                 $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
                 $admin_thumbs_pic->saveToFile("uploads/page/admin-thumbs/$file_name");
                 $page->image = $file_name;
                 $page->update();
                 if($old_file!='' && file_exists('uploads/page/'. $old_file))
                    unlink('uploads/page/'. $old_file);
                 //if($old_file!='' && file_exists('uploads/gallery/thumbs/'. $old_file))
                   // unlink('uploads/gallery/thumbs/'. $old_file);
                 if($old_file!='' && file_exists('uploads/page/admin-thumbs/'. $old_file))
                    unlink('uploads/page/admin-thumbs/'. $old_file);
                 }
                 Yii::app()->user->setFlash('msg', "Page Updated Successfully!");
                 $this->redirect(Yii::app()->request->baseUrl.'/admin/listPages');
        
              }else {
                 $data['fail_msg'] = 'Fail to edit Page.';
              }
            }
         $data['page'] = $page;
         $this->render('editPages', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listPages');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionAddTestimonial(){
    if ($this->checkLogin()) {
    $testimonial = new Testimonial();
    $data['testimonial'] = $testimonial;
     if(isset($_POST['Testimonial'])){
      $testimonial = new Testimonial();
      $testimonial->attributes = $_POST['Testimonial'];
      $uploaded_files = CUploadedFile::getInstance($testimonial, 'image');        
        if($testimonial->save()){            
          if($uploaded_files!=""){
            $tmp = explode('.', $uploaded_files);
            $file_extension = strtolower(end($tmp));
            $file_name = Common::generate_filename() . '.' . $file_extension;
            $uploaded_files->saveAs("uploads/testimonial/$file_name");
            require 'media/image_lib/WideImage.php';
            $image = WideImage::load("uploads/testimonial/$file_name");
            $resized_pic = $image->resize(1024, 400, 'outside')->crop('center', 'center', 1024, 400);
            $resized_pic->saveToFile("uploads/testimonial/$file_name");
            //$thumbs_pic = $image->resize(70, 25, 'outside')->crop('center', 'center', 70, 25);
            //$thumbs_pic->saveToFile("uploads/slider/thumbs/$file_name");
            $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
            $admin_thumbs_pic->saveToFile("uploads/testimonial/admin-thumbs/$file_name");
            $testimonial->image = $file_name;
            $testimonial->save();                 
          }
          Yii::app()->user->setFlash('msg', "Testimonial added successfully.");
          $this->redirect(Yii::app()->request->baseUrl.'/admin/listTestimonial');
         }else{
         $data['fail_msg'] = 'Fail to add Page.';
         }
     }  
   $this->render('addTestimonial',$data);
   }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionListTestimonial(){
    $testimonial = Testimonial::model()->findAll();
    $data['testimonial'] = $testimonial;
    $this->render('listTestimonial',$data);
  }

  public function actionDeleteTestimonial($id) {
    if ($this->checkLogin()) {
       $testimonial = Testimonial::model()->findByPk($id);
       if (isset($testimonial)) {       
          $testimonial->delete();
           if ($testimonial->attributes['image']!='' && file_exists('uploads/testimonial/' . $testimonial->attributes['image'])) 
                          unlink('uploads/testimonial/' . $testimonial->attributes['image']);
           if ($testimonial->attributes['image']!='' && file_exists('uploads/testimonial/admin-thumbs/' . $testimonial->attributes['image'])) 
                          unlink('uploads/testimonial/admin-thumbs/' . $testimonial->attributes['image']); 
       }$this->redirect(Yii::app()->request->baseUrl . '/admin/ListTestimonial');
      }else{
      $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
    }      
  }

  public function actionEditTestimonial($id){
   if ($this->checkLogin()){
     $testimonial = Testimonial::model()->findByPk($id);         
     if(!empty($testimonial)){
         if(isset($_POST['Testimonial'])){
              $old_file = $testimonial->attributes['image'];
              $testimonial->attributes = $_POST['Testimonial'];
              $testimonial->image = $old_file;
              $uploaded_files= CUploadedFile::getInstance($testimonial, 'image');
              if ($testimonial->save()) {
               if(!empty($uploaded_files)){ // check if uploaded file is set or not
                 $tmp = explode('.', $uploaded_files);
                 $file_extension = strtolower(end($tmp));
                 $file_name = Common::generate_filename() . '.' . $file_extension;
                 $uploaded_files->saveAs('uploads/testimonial/'.$file_name);
                 require 'media/image_lib/WideImage.php';
                 $image = WideImage::load("uploads/testimonial/$file_name");
                 //$thumbs_pic = $image->resize(214, 124, 'outside')->crop('center', 'center', 214, 124);
                 //$thumbs_pic->saveToFile("uploads/gallery/thumbs/$file_name");
                 $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
                 $admin_thumbs_pic->saveToFile("uploads/testimonial/admin-thumbs/$file_name");
                 $testimonial->image = $file_name;
                 $testimonial->update();
                 if($old_file!='' && file_exists('uploads/testimonial/'. $old_file))
                    unlink('uploads/testimonial/'. $old_file);
                 //if($old_file!='' && file_exists('uploads/gallery/thumbs/'. $old_file))
                   // unlink('uploads/gallery/thumbs/'. $old_file);
                 if($old_file!='' && file_exists('uploads/testimonial/admin-thumbs/'. $old_file))
                    unlink('uploads/testimonial/admin-thumbs/'. $old_file);
                 }
                 Yii::app()->user->setFlash('msg', "Testimonial Updated Successfully!");
                 $this->redirect(Yii::app()->request->baseUrl.'/admin/listTestimonial');
        
              }else {
                 $data['fail_msg'] = 'Fail to edit Testimonial.';
              }
            }
         $data['testimonial'] = $testimonial;
         $this->render('editTestimonial', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listTestimonial');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionAddOurTeam(){
    if ($this->checkLogin()) {
    $ourteam = new Ourteam();
    $data['ourteam'] = $ourteam;
     if(isset($_POST['Ourteam'])){
      $ourteam = new Ourteam();
      if($_POST['Ourteam']['status']==''){
         $_POST['Ourteam']['status']=1;
      }
      $ourteam->attributes = $_POST['Ourteam'];
      $uploaded_files = CUploadedFile::getInstance($ourteam, 'image');        
        if($ourteam->save()){            
          if($uploaded_files!=""){
            $tmp = explode('.', $uploaded_files);
            $file_extension = strtolower(end($tmp));
            $file_name = Common::generate_filename() . '.' . $file_extension;
            $uploaded_files->saveAs("uploads/ourteam/$file_name");
            require 'media/image_lib/WideImage.php';
            $image = WideImage::load("uploads/ourteam/$file_name");
            $resized_pic = $image->resize(1024, 400, 'outside')->crop('center', 'center', 1024, 400);
            $resized_pic->saveToFile("uploads/ourteam/$file_name");
            //$thumbs_pic = $image->resize(70, 25, 'outside')->crop('center', 'center', 70, 25);
            //$thumbs_pic->saveToFile("uploads/slider/thumbs/$file_name");
            $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
            $admin_thumbs_pic->saveToFile("uploads/ourteam/admin-thumbs/$file_name");
            $ourteam->image = $file_name;
            $ourteam->save();                 
          }
          Yii::app()->user->setFlash('msg', "Team's Image added successfully.");
          $this->redirect(Yii::app()->request->baseUrl.'/admin/listOurTeam');
         }else{
         $data['fail_msg'] = 'Fail to add Team image.';
         }
     }  
   $this->render('addOurTeam',$data);
   }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionListOurTeam(){
    $ourteam = Ourteam::model()->findAll();
    $data['ourteam'] = $ourteam;
    $this->render('listOurTeam',$data);
  }

  public function actionDeleteOurTeam($id) {
    if ($this->checkLogin()) {
       $ourteam = Ourteam::model()->findByPk($id);
       if (isset($ourteam)) {       
          $ourteam->delete();
           if ($ourteam->attributes['image']!='' && file_exists('uploads/ourteam/' . $ourteam->attributes['image'])) 
                          unlink('uploads/ourteam/' . $ourteam->attributes['image']);
           if ($ourteam->attributes['image']!='' && file_exists('uploads/ourteam/admin-thumbs/' . $ourteam->attributes['image'])) 
                          unlink('uploads/ourteam/admin-thumbs/' . $ourteam->attributes['image']); 
       }$this->redirect(Yii::app()->request->baseUrl . '/admin/ListOurTeam');
      }else{
      $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
    }      
  }

  public function actionEditOurTeam($id){
   if ($this->checkLogin()){
     $ourteam = Ourteam::model()->findByPk($id);         
     if(!empty($ourteam)){
         if(isset($_POST['Ourteam'])){
              $old_file = $ourteam->attributes['image'];
              $ourteam->attributes = $_POST['Ourteam'];
              $ourteam->image = $old_file;
              $uploaded_files= CUploadedFile::getInstance($ourteam, 'image');
              if ($ourteam->save()) {
               if(!empty($uploaded_files)){ // check if uploaded file is set or not
                 $tmp = explode('.', $uploaded_files);
                 $file_extension = strtolower(end($tmp));
                 $file_name = Common::generate_filename() . '.' . $file_extension;
                 $uploaded_files->saveAs('uploads/ourteam/'.$file_name);
                 require 'media/image_lib/WideImage.php';
                 $image = WideImage::load("uploads/ourteam/$file_name");
                 //$thumbs_pic = $image->resize(214, 124, 'outside')->crop('center', 'center', 214, 124);
                 //$thumbs_pic->saveToFile("uploads/gallery/thumbs/$file_name");
                 $admin_thumbs_pic = $image->resize(120, 60, 'outside')->crop('center', 'center', 120, 60);
                 $admin_thumbs_pic->saveToFile("uploads/ourteam/admin-thumbs/$file_name");
                 $ourteam->image = $file_name;
                 $ourteam->update();
                 if($old_file!='' && file_exists('uploads/ourteam/'. $old_file))
                    unlink('uploads/ourteam/'. $old_file);
                 //if($old_file!='' && file_exists('uploads/gallery/thumbs/'. $old_file))
                   // unlink('uploads/gallery/thumbs/'. $old_file);
                 if($old_file!='' && file_exists('uploads/ourteam/admin-thumbs/'. $old_file))
                    unlink('uploads/ourteam/admin-thumbs/'. $old_file);
                 }
                 Yii::app()->user->setFlash('msg', "OurTeam Updated Successfully!");
                 $this->redirect(Yii::app()->request->baseUrl.'/admin/listOurTeam');
        
              }else {
                 $data['fail_msg'] = 'Fail to edit Our Team.';
              }
            }
         $data['ourteam'] = $ourteam;
         $this->render('editOurTeam', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listOurTeam');
         }        
        
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionAddSiteSetting(){
    if ($this->checkLogin()) {
    $sitesetting = new Sitesetting();
    $data['sitesetting'] = $sitesetting;
     if(isset($_POST['Sitesetting'])){
      $sitesetting = new Sitesetting();      
      $sitesetting->attributes = $_POST['Sitesetting'];            
        if($sitesetting->save()){           
          $sitesetting->save();                 
          Yii::app()->user->setFlash('msg', "Site setting added successfully.");
          $this->redirect(Yii::app()->request->baseUrl.'/admin/listSiteSetting');
         }else{
         $data['fail_msg'] = 'Fail to add SiteSetting.';
         }
     }  
   $this->render('addSiteSetting',$data);
   }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionListSiteSetting(){
    $sitesetting = Sitesetting::model()->findAll();
    $data['sitesetting'] = $sitesetting;
    $this->render('listSiteSetting',$data);
  }

  public function actionDeleteSiteSetting($id){
    if ($this->checkLogin()) {
       $sitesetting = Sitesetting::model()->findByPk($id);
       if (isset($sitesetting)) {       
          $sitesetting->delete();            
       }$this->redirect(Yii::app()->request->baseUrl . '/admin/listSiteSetting');
      }else{
      $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
    } 
  }

  public function actionEditSiteSetting($id){
   if ($this->checkLogin()){
     $sitesetting = Sitesetting::model()->findByPk($id);         
     if(!empty($sitesetting)){
         if(isset($_POST['Sitesetting'])){              
              $sitesetting->attributes = $_POST['Sitesetting'];              
              if ($sitesetting->save()){               
                 $sitesetting->update();                 
                 Yii::app()->user->setFlash('msg', "Site Setting Updated Successfully!");
                 $this->redirect(Yii::app()->request->baseUrl.'/admin/listSiteSetting');
        
              }else {
                 $data['fail_msg'] = 'Fail to edit Contact us.';
              }
            }
         $data['sitesetting'] = $sitesetting;
         $this->render('editSiteSetting', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listSiteSetting');
         }     
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionAddContactUs(){
    if ($this->checkLogin()) {
    $contactus = new Contactus();
    $data['contactus'] = $contactus;
     if(isset($_POST['Contactus'])){
      $contactus = new Contactus();      
      $contactus->attributes = $_POST['Contactus'];            
        if($contactus->save()){           
          $contactus->save();                 
          Yii::app()->user->setFlash('msg', "Contact us added successfully.");
          $this->redirect(Yii::app()->request->baseUrl.'/admin/listContactUs');
         }else{
         $data['fail_msg'] = 'Fail to add Contact.';
         }
     }  
   $this->render('addContactUs',$data);
   }else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }

  public function actionListContactUs(){
    $contactus = Contactus::model()->findAll();
    $data['contactus'] = $contactus;
    $this->render('listContactUs',$data);
  }

  public function actionDeleteContactUs($id){
    if ($this->checkLogin()) {
       $contactus = Contactus::model()->findByPk($id);
       if (isset($contactus)) {       
          $contactus->delete();            
       }$this->redirect(Yii::app()->request->baseUrl . '/admin/listContactUs');
      }else{
      $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
    } 
  }

  public function actionEditContactUs($id){
   if ($this->checkLogin()){
     $contactus = Contactus::model()->findByPk($id);         
     if(!empty($contactus)){
         if(isset($_POST['Contactus'])){              
              $contactus->attributes = $_POST['Contactus'];              
              if ($contactus->save()) {               
                 $contactus->update();                 
                 Yii::app()->user->setFlash('msg', "Contact us Updated Successfully!");
                 $this->redirect(Yii::app()->request->baseUrl.'/admin/listContactUs');
        
              }else {
                 $data['fail_msg'] = 'Fail to edit Contact us.';
              }
            }
         $data['contactus'] = $contactus;
         $this->render('editContactUs', $data);

         }
         else{
             Yii::app()->user->setFlash('msg', "Unable to edit requested page.");
            $this->redirect(Yii::app()->request->baseUrl . '/admin/listContactUs');
         }     
      }
    else{
         $this->redirect(Yii::app()->request->baseUrl . '/admin/login');
      }
  }
}