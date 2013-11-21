(function(){
   $form_validater = {
      set_change_password_form_rules: function(){
         $('#change_password_form').validate({
            rules: {
               'user[old_password]'    : "required",
               'user[new_password]'   : "required",
               'user[conform_password]'  : {
                  'required':true,
                  'equalTo':'#new_password'
               }
            },
            messages: {
               'user[old_password]'    : "Enter old password.",
               'user[new_password]'   : "Enter new password",
               'user[conform_password]'  : {
                  'required': "Enter conform prassword.",
                  'equalTo': "new passwrod and conform passwrod not match."
               }
            }
         });
      },
      set_login_form_rules : function(){
         $('#login_form').validate({
            rules: {
               'User[email]'   : {
                  required:true,
                  email:true
               },
               'User[password]'   : "required"
            },
            messages: {
               'User[email]'   :  {
                  'required':"Enter your email.",
                  'email':"Enter valid email."
               },
               'User[password]'   : "Enter your phone number."
            }
         });
      },
      set_edit_user_form_rules: function(){
         $('#edit_user_form').validate({
            rules: {
               'User[first_name]': "required",
               'User[last_name]': "required",
               'User[email]'   : {
                  required:true,
                  email:true
               }
            },
            messages: {
               'User[first_name]': "Enter first name.",
               'User[last_name]': "Enter last name.",
               'User[email]'   : {
                  'required':"Enter your email.",
                  'email':"Enter valid email."
               }
            }
         });
      },
      set_add_menu_form_rules: function(){
         $('#add_menu_form').validate({
            rules: {
               'MenusWine[title]'  : "required"
            },
            messages: {
               'MenusWine[title]'  : "Enter Menu title."
            }
         });
      },
      set_add_menu_item_form_rules: function(){
         $('#add_menu_item_form').validate({
            rules: {
               'MenuItems[item_title]'  : "required",
               'MenuItems[price]' : {
                  required : true,
                  number: true
               }

            },
            messages: {
               'MenuItems[item_title]'  : "Enter menu item title.",
               'MenuItems[price]' : {
                  required : 'Enter price.',
                  number: 'Enter valid price'
               }
            }
         });
      },
      set_add_wine_form_rules: function(){
         $('#add_wine_form').validate({
            rules: {
               'MenusWine[title]'  : "required"
            },
            messages: {
               'MenusWine[title]'  : "Enter Wine title."
            }
         });
      },
      set_add_wine_item_form_rules: function(){
         $('#add_wine_item_form').validate({
            rules: {
               'WineItems[wine_title]'  : "required"/*,
               'WineItems[glass_price]' : {
                  required : true,
                  number: true
               },
               'WineItems[bottle_price]' : {
                  required : true,
                  number: true
               }*/

            },
            messages: {
               'WineItems[wine_title]'  : "Enter wine item title."
            /*   'WineItems[glass_price]' : {
                  required : 'Enter price.',
                  number: 'Enter valid price'
               },
               'WineItems[bottle_price]' : {
                  required : 'Enter price.',
                  number: 'Enter valid price'
               }*/
            }
         });
      },
      set_add_resturent_form_rules: function(){
         $('#add_resturent_form').validate({
            rules: {
               'Restaurant[name]'    : "required",
               'Restaurant[address]'   : "required",
               'Restaurant[longitude]' : {
                  required : true,
                  number: true
               },
               'Restaurant[latitude]' : {
                  required : true,
                  number: true
               },
               'Restaurant[phone]'   : "required",
               'Restaurant[operating_info]' : "required"
            },
            messages: {
               'Restaurant[name]'    : "Enter restaurent name.",
               'Restaurant[address]'   : "Enter restaurent address.",
               'Restaurant[longitude]' : {
                  required : 'Enter restaurent longitude.',
                  number: 'Enter valid longitude'
               },
               'Restaurant[latitude]' : {
                  required : 'Enter restaurent latitude.',
                  number: 'Enter valid latitude'
               },
               'Restaurant[phone]'   : "Enter restaurent phone nunmber.",
               'Restaurant[operating_info]' : "Enter operating our description."
            }
         });
      },
      set_edit_contact_form_rules: function(){
         $('#edit_contact_form').validate({
            rules: {
               'ContactInfo[company_name]'    : "required",
               'ContactInfo[address]'   : "required",
               'ContactInfo[phone]'   : "required",
               'ContactInfo[email]'   : {
                  'required': true,
                  'email': true
               },
               'ContactInfo[description]' : "required"
            },
            messages: {
               'ContactInfo[company_name]'    : "Enter company name.",
               'ContactInfo[address]'   : "Enter company address",
               'ContactInfo[phone]'   : "Enter phone number",
               'ContactInfo[email]'   : {
                  'required':"Enter email.",
                  'email':"Enter valid email."
               },
               'ContactInfo[description]' : "Enter contact description."
            }
         });
      }
   }
})(jQuery);

