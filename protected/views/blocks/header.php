<div class="header_top">
	<div class="page_wrap">
		<ul class="social_icon">
			<li><a href="https://www.facebook.com" title="Facebook">f</a></li>
			<li><a href="#" title="Twitter">l</a></li>
			<li><a href="#" title="Google+">g</a></li>
			<li class="last" title="Linkedin"><a href="#">n</a></li>
		</ul>
	</div>
</div><!-- end header_top -->
<div class="main_header">
	<div class="page_wrap">
		<nav id="nav">
			 <ul>
				<?php $home_url =Yii::app()->baseUrl;
					  $page_url=$home_url.'/page/';
					  $objective_url=$page_url.'objectives';
					  $media_url=$home_url.'/media/index';
					  $member_url=$page_url.'member';
					  $library_url=$page_url.'library';
					  $workshop_url=$page_url.'trainings';
					  $consultancy_url=$page_url.'consultancy';
					  $network_url=$page_url.'network';
					  $partner_url=$home_url.'/partner'

				 ?>

				<li class="top_menu"><a href="<?php echo $home_url;?>" class='site' >Home</a></li>				
				<li class="top_menu"> <a href="#" >About</a>
					<ul>							
						<li class='last'> <a href="<?php  echo $objective_url;?>" >Objectives</a></li>
						<li class='last'> <a href="<?php  echo $media_url;?>" >Media</a></li>
					</ul>
				</li>
				<li class="top_menu"><a href="#" title="Activities" class="top_menu">Activites</a></li>
				<li class="top_menu"><a href="#" title="Services" class="top_menu">Services</a>
					<ul>	
						<li> <a href="<?php  echo $library_url;?>">Library</a></li>
						<li> <a href="<?php  echo $workshop_url;?>" >Workshop</a></li>
						<li> <a href="<?php  echo $consultancy_url;?>" >Consultancy</a></li>
						<li class='last'> <a href="<?php  echo $network_url;?>" >Network</a></li>
						
					</ul>

				</li>
				<li class="top_menu"><a href="<?php echo $partner_url; ?>" class="partner">Partner</a></li>
				<li class="top_menu"><a href="#" class="contact">Contact</a></li>
				<li class="top_menu"><a href="#" class="csr">CSR</a></li>
				<li class="last" title="Publication"><a href="<?php echo Yii::app()->baseUrl.'/publication'?>" class='publication'>Publication</a></li>
			</ul>


			
	
		</nav><!-- end nav -->
		<div id="logo">
			<h1><a href="index.html" title="NBI">NBI</a></h1>
		</div><!-- end logo -->
	</div>
</div><!-- end main_header -->
<script>
	$(function(){
		var contro='<?php echo Yii::app()->controller->id; ?>';
		if(contro==='page'){
				$('nav#nav a').each(function(){
					if($(this).prop("href") === window.location.href){
							$(this).closest('li.top_menu').children('a:first').addClass('active');
							return false;
					}
				});	
			 
		}  
		else{
			$('nav#nav a').each(function(){
					if(contro===$(this).attr('class')){
						$(this).addClass('active');
						return false;
					}

			});
			
		}

	}); 
	
</script>
