<?php

/**
 * Common Class contain all function that required in bee in play
 */
Class Common {

   /**
    * Function array_debug is for testing array data type
    * @param type $value
    * @return type formatted array
    */
   public static function array_debug($value) {
      echo "<pre>";
      print_r($value);
      echo "</pre>";
   }

   /**
    * @function generate ramdom file name
    * @return string file name
    */
   public static function generate_filename() {
      $possible_letters = '23456789bcdfghjkmnpqrstvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
      $codelength = 40;
      $code = '';
      $i = 0;

      while ($i < $codelength) {
         $code .= substr($possible_letters, mt_rand(0, strlen($possible_letters) - 1), 1);
         $i++;
      }

      return $code;
   }

   /**
    * This function generate title.
    * @return string title in [site_name - title] format.
    */
   public static function getPageTitle($pageTitle) {
      $split_pageTitle = explode(' - ', $pageTitle);
      $title = $split_pageTitle[0];
      $split_pageTitle2 = explode(' ', $split_pageTitle[1]);
      $title .= ' - ' . $split_pageTitle2[0];
      return $title;
   }
   
   /**
    * return meta data of specific page
    */
   public static function getMetaData($pageTitle) {
      $split_pageTitle = explode(' - ', $pageTitle);
      $split_pageTitle2 = explode(' ', $split_pageTitle[1]);
      $split_pageTitle2[0];

      if ($split_pageTitle2[0] == 'home') {
         $desc = 'this is home page..';
         $keyword = "";
      }
      
      $data['desc'] = $desc;
      $data['keyword'] = $keyword;
      return $data;
   }
   
   public static function getSliders(){
      $sliders = Slider::model()->findAllByAttributes(array('is_active'=>1));
      $slider_list = array();
      if(isset($sliders)){
         foreach($sliders as $slider){
            array_push($slider_list, $slider->attributes);
         }
      }
      
      return $slider_list;
   }
   
   /*public static function getMenuList(){
      $menus = MenusWine::model()->findAllByAttributes(array('type'=>'menu'));
      $menuList = array();
      foreach ($menus as $menu){
         $menuList[$menu->id] = $menu->title;
      }

      return $menuList;
   }
   
   public static function getWineMenus($type){
      $menus = MenusWine::model()->findAllByAttributes(array('type'=>$type));
      return $menus;
   }
   
   public static function getMenuItems($menu_id){
      $items = MenuItems::model()->findAllByAttributes(array('menu_id'=>$menu_id));
      $itemList = array();
      foreach($items as $item){
         array_push($itemList, $item->attributes);
      }
      
      return $itemList;
   }
   
   public static function getWineItems($wine_id){
      $items = WineItems::model()->findAllByAttributes(array('wine_id'=>$wine_id));
      $itemList = array();
      foreach($items as $item){
         array_push($itemList, $item->attributes);
      }
      
      return $itemList;
   }


   public static function getWineList(){
      $menus = MenusWine::model()->findAllByAttributes(array('type'=>'wine'));
      $menuList = array();
      foreach ($menus as $menu){
         $menuList[$menu->id] = $menu->title;
      }

      return $menuList;
   }*/
   
   
   public static function getAboutUsData(){
      //`page``page_title``content`
      $content = Page::model()->findByAttributes(array('page'=>'aboutus'));
      if(isset($content)){
         return $content->content;
      }
   }

}