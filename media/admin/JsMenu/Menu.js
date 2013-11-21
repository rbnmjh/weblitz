// JavaScript Document

var myMenu =
			[
						[null,'Home','../common/mainadmin.php',null,'Control Panel'],
				_cmSplit,
				[null,'User',null,null,'User Management',
					['<img src="../../images/MenuThemeOffice/users_add.png" />','Add New User','../user/create_user.php?action=add',null,'Add User'],
					['<img src="../../images/MenuThemeOffice/users.png" />','List All User','../user/user_list.php',null,'List Users'],				
									
				],
				_cmSplit,
				
				/*[null,'Artist Manager',null,null,'Artist Management',
				 		['<img src="../../images/MenuThemeOffice/user.png" />','Add New Artist','../artist/add_artist_info.php5?action=add',null,'Add Artist'],
						['<img src="../../images/MenuThemeOffice/user.png" />','List All Artist','../artist/list_artist_info.php5',null,'List Artist'],
						['<img src="../../images/MenuThemeOffice/user.png" />','Add Artist Info','../artist/add_artist_detail_info.php5',null,'Artist Info'							
						],					
				],
				_cmSplit,*/
				
				[null,'General',null,null,'General Management',					
					['<img src="../../images/MenuThemeOffice/document.png" />','Add Contents','../general/addcontent.php?page=home',null,'Content'
						/*['<img src="../../images/MenuThemeOffice/document.png" />','Home', '../general/addcontent.php?page=home', null,'Add Content'],
						['<img src="../../images/MenuThemeOffice/document.png" />','Events and Exhibitions', '../general/addcontent.php?page=aboutus', null,'Add Content'],	
						['<img src="../../images/MenuThemeOffice/document.png" />','News', '../general/addcontent.php?page=faq', null,'Add Content'],	
						['<img src="../../images/MenuThemeOffice/document.png" />','Testimonials', '../general/addcontent.php?page=testimonial', null,'Add Content'],	
						['<img src="../../images/MenuThemeOffice/document.png" />','Contacts', '../general/addcontent.php?page=contact', null,'Add Content'],	*/

					],
					['<img src="../../images/MenuThemeOffice/document.png" />','Add Specimen','../general/addspecimen.php?page=demand',null,'Specimen'					

					],
					
					['<img src="../../images/MenuThemeOffice/document.png" />','Upload file','../filelist/file_list.php',null,'Upoad file'			
					],
					/*['<img src="../../images/MenuThemeOffice/document.png" />','List Product Info',null,null,null,
						['<img src="../../images/MenuThemeOffice/document.png" />','List Size', '../general/listproductinfo.php5?info=Size', null,'List Size'],
						['<img src="../../images/MenuThemeOffice/document.png" />','List Color', '../general/listproductinfo.php5?info=Color', null,'List Color'],	
						['<img src="../../images/MenuThemeOffice/document.png" />','List Material', '../general/listproductinfo.php5?info=Material', null,'List Material'],	
					],*/	  				
				],
				_cmSplit,
				
				/*[null,'Catalog',null,null,'Catalog Management',
					['<img src="../../images/MenuThemeOffice/categories.png" />','Category',null,null,'Category Management',
						['<img src="../../images/MenuThemeOffice/categories.png" />','Add Category','../catalog/category.php?action=Add',null,'Manage Category'],
						['<img src="../../images/MenuThemeOffice/categories.png" />','List All Category','../catalog/category_list.php',null,'Manage Category'],
					],
					
					['<img src="../../images/MenuThemeOffice/categories.png" />','Products',null,null,'Product Management',
						['<img src="../../images/MenuThemeOffice/categories.png" />','Add New Product','../catalog/product.php?act=Add',null,'Edit contact details'],
						['<img src="../../images/MenuThemeOffice/categories.png" />','List All Product','../catalog/product_list.php',null,'Manage contact categories']
					],
					
					['<img src="../../images/MenuThemeOffice/sections.png" />','Banner',null,null,'Banner Management',						
						['<img src="../../images/MenuThemeOffice/sections.png" />','Add Banner','../banner/add_banner.php?act=Add',null,'Manage Banner'],
						['<img src="../../images/MenuThemeOffice/sections.png" />','List All Banner','../banner/banner_list.php',null,'Manage Banner']					
					],
				],				
				
				[null,'Order',null,null,'Order',
					['<img src="../../images/MenuThemeOffice/categories.png" />','List Order','../order/order_list.php',null,'Order Management'						
					],					
				],	*/			
				
			];
			cmDraw ('myMenuID', myMenu, 'hbr', cmThemeOffice, 'ThemeOffice');