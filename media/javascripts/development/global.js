/*
* Bistecca
* Copyright 2012-2013, Simplicix Media
* www.simplicix.com
* 12/29/2012
*/
$(document).ready(function() {
	/* #Configurations
	================================================== */
	// All the markers
	// You can get the latitude and longitude from http://www.dbsgeo.com/latlon/
	// First value is the name displayed in selectbox
	// Second value is latitude, third value is longitude
	/*
     var locations = [
      ['Seattle, Washington', 47.55808074240213, -122.30396747589111],
      ['Toronto, Canada', 43.66431708081812, -79.36768054962158],
      ['Miami, Florida', 25.79533186639593, -80.19753456115723]
    ];
   */
	// By default, first location is used for the contact map.
	// If you want to put another location, you can swap the following lines and put your infos
     
	//var contact_location = ['Headquarters', 47.55808074240213, -122.30396747589111];
	//var contact_location = locations[0];

	// Set to true if you want to zoom on first location instead of having a full view of the map
	// This will also show first location info instead of a text telling to change location to see info, etc.
	// You would also need to remove this div manually if you set to true (located line 180-182 in the index file)
	var setFirstLocation = false;
	/* Text Variables
	================================================== */
	var  emailError 	= "Please enter a valid email address",
		nameError		= "Please enter your name",
		commentsError	= "Please enter your comment";

	/* #Mobile check
	================================================== */
	var isMobile = false;

	if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|Windows Phone|ZuneWP7/i.test(navigator.userAgent) ) {
	 	isMobile = true;
	 	$('html').addClass('mobile');
	}

	/* #Paralax
	================================================== */
	if(!isMobile){
		$(window).stellar();	// init stellar

		var prevEvent = false;

		// inview
		$('.panel').bind('inview', function(event, isInView, visiblePartX, visiblePartY) {

			// current
			dataslide = $(this).attr('data-slide');

			if (isInView) {
				// element is now visible in the viewport
				if (visiblePartY == "both") {
					$('#top li').not('[data-slide="' + dataslide + '"]').removeClass('active');
					$('#top li[data-slide="' + dataslide + '"]').addClass('active');
                         if($('#top li[data-slide="' + dataslide + '"] a').text() == ''){
                            var title = 'Bukhara grill - Home';
                         }
                         else{
                            title = 'Bukhara grill - ' + $('#top li[data-slide="' + dataslide + '"] a').text();
                         }
                         $(document).attr('title', title);
				} else if (visiblePartY == "top" && prevEvent != "both") {
					$('#top li').not('[data-slide="' + dataslide + '"]').removeClass('active');
					$('#top li[data-slide="' + dataslide + '"]').addClass('active');
                         if($('#top li[data-slide="' + dataslide + '"] a').text() == ''){
                            title = 'Bukhara grill - Home';
                         }
                         else{
                            title = 'Bukhara grill - ' + $('#top li[data-slide="' + dataslide + '"] a').text();
                         }
                         
                         $(document).attr('title', title);
					//console.log('Top and != both condition - ' + visiblePartY + ' - ' + prevEvent);
				} else {
					//console.log('meh');
				}
				prevEvent = visiblePartY;
			} else {
				//prevEvent = false;
				$('#top li[data-slide="' + dataslide + '"]').removeClass('active');
			}
		});
	}

    //Create a function that will be passed a slide number and then will scroll to that slide using jquerys animate. The Jquery
    //easing plugin is also used, so we passed in the easing method of 'easeInOutQuint' which is available throught the plugin.
    function goToByScroll(dataslide, click, href) {
    	if(href){
    		$slideTo = $(href);
    	} else {
    		$slideTo = $('.panel[data-slide="' + dataslide + '"]');
    	}

		$('html,body').stop().animate({
            scrollTop: $slideTo.offset().top - 60
		}, 2000, 'easeInOutQuint');
	}

    //When the user clicks on the navigation links, get the data-slide attribute value of the link and pass that variable to the goToByScroll function
    $('#top').find('li, #logo > div').click(function (e) {
        //e.preventDefault();
        dataslide = $(this).attr('data-slide');
        goToByScroll(dataslide, true);
    });

    $(".to-top").click(function(e){
    	e.preventDefault();
    	goToByScroll(false, true, $(this).attr('href'));
    });

	/* #External Links
	================================================== */
	$(function() {	// graceful alternative to target blank non-validation
		$('a[rel*=external], .social a').click( function() {
			window.open(this.href);
			return false;
		});
	});

	/* #Mobile Nav
	================================================== */
	$('#top').mobileMenu();
	$('.select-menu').customSelect();

	/* #Front page slider
	================================================== */
	$('#front').flexslider({
        animation: "slide",
		controlNav: false
    });

	/* #Wine paralax
	================================================= */
	if(!isMobile){
		// this remove the wine elements for too small windows
		function fixParalax(){
			if($(window).width() < 1700){
				$("#grapes, #grape, #wine-glass").fadeOut(function(){$(this).css('z-index', '-500')});
			} else {
				$("#grapes, #grape, #wine-glass").fadeIn().css('z-index', '10');;
			}
		};

		// call it once
		fixParalax();

		// and on resize
		$(window).resize(function() {
			fixParalax();
		});
	}

	/* #Smooth scrolling
	================================================= */
	$('#top a').click(function(event){
		event.preventDefault();
		$('#top li a').removeClass('active');
		$(this).addClass('active');
	});

	$("a[href^='#']").click(function(e){
		e.preventDefault();
	});

	/* #Social effect
	================================================= */
	$(".social li a").hover(function() {
		var e = this;
		$(e).stop().animate({ marginTop: "-8px", paddingBottom: "8px", opacity : 1 }, 250, function() {
			$(e).animate({ marginTop: "-4px", paddingBottom: "4px" }, 250);
		});
	},function(){
		var e = this;
		$(e).stop().animate({ marginTop: "0px", paddingBottom: "0px", opacity : 0.9 }, 250, function() {
			$(e).animate({ marginTop: "0px", paddingBottom: "0px" }, 250);
		});
	});
	/* #Colorbox on gallery
	================================================= */
	$('#gallery .thumbnail').colorbox({
		rel:'gal',
		current: '',
		maxWidth:"85%",
		maxHeight:"85%",
		scrolling: false,
		opacity: 0.5,
		title: function(){
			return $(this).find('figcaption > div').html();
		}
	});
	/* #Locations
	================================================= */
	var locations_map;
	var locationsMarker = [];
	var bounds = new google.maps.LatLngBounds();
	// le marker image
	var marker_image = new google.maps.MarkerImage(
	  'media/images/icons/marker.png',
	  new google.maps.Size(38,55),
	  new google.maps.Point(0,0),
	  new google.maps.Point(0,55)
	);
	// le marker shadow
	var marker_shadow = new google.maps.MarkerImage(
	  'media/images/icons/marker-shadow.png',
	  new google.maps.Size(70,55),
	  new google.maps.Point(0,0),
	  new google.maps.Point(0,55)
	);
	// la shape
	var marker_shape = {
	  coord: [25,0,27,1,29,2,31,3,32,4,33,5,34,6,34,7,35,8,36,9,36,10,37,11,37,12,37,13,37,14,37,15,37,16,37,17,37,18,37,19,37,20,37,21,37,22,37,23,36,24,36,25,35,26,35,27,34,28,34,29,33,30,32,31,32,32,31,33,30,34,30,35,29,36,28,37,28,38,27,39,26,40,26,41,25,42,24,43,24,44,23,45,23,46,22,47,22,48,21,49,21,50,20,51,20,52,20,53,19,54,18,54,18,53,17,52,17,51,16,50,16,49,16,48,15,47,15,46,14,45,13,44,13,43,12,42,12,41,11,40,10,39,10,38,9,37,8,36,8,35,7,34,6,33,6,32,5,31,4,30,4,29,3,28,3,27,2,26,1,25,1,24,1,23,0,22,0,21,0,20,0,19,0,18,0,17,0,16,0,15,0,14,0,13,0,12,1,11,1,10,1,9,2,8,3,7,3,6,4,5,5,4,7,3,8,2,10,1,12,0,25,0],
	  type: 'poly'
	};
	if(!setFirstLocation){
		$("#locations-select").append('<option value="-1">-- Choose a location --</option>');
	}
	// Push all locations to selectbox
	var length = locations.length,
		element = null;
	for (var i = 0; i < length; i++) {
	  element = locations[i];
	  $("#locations-select").append("<option value='"+ i +"'>"+ element[0] +"</option>");
	}
	// trigger on selectbox
	$("#locations-select").change(function() {
		var current_val = $(this).val();
		changePos(current_val, true);
	});

	// change map position
	function changePos(current_val, alreadyChanged){
		// change the select
		if(!alreadyChanged){
			$("#locations-select").val(current_val);
		}

		// if its the 'no location' set bounds
		if(current_val == -1){
			locations_map.fitBounds(bounds);
			current_val = 0;
		} else {
			var latLng = new google.maps.LatLng(locations[current_val][1], locations[current_val][2]);
			locations_map.panTo(latLng);
			locations_map.setZoom(12);
			current_val++;
		}

		// display left info box
		if($('#locations-info > div:eq('+ current_val +')').is(":hidden")){
			$("#locations-info > div:visible").fadeOut(500, function(){
				$('#locations-info > div:eq('+ current_val +')').fadeIn(500);
			});
		}
	}

	// init locations
	function initLocationsMap() {

		// map settings
		var locationsMapOptions = {
		  zoom: 15,
		  scrollwheel: false,
		  center: new google.maps.LatLng(locations[0][1], locations[0][2]),
		  mapTypeId: google.maps.MapTypeId.ROADMAP
		};

		// init the map
		locations_map = new google.maps.Map(document.getElementById('locations-map'),
			locationsMapOptions);

		// infowindows
		var infowindow = new google.maps.InfoWindow(), marker, i;

		// foreach positions
		for (i = 0; i < locations.length; i++) {

			// marker position
			var pos = new google.maps.LatLng(locations[i][1], locations[i][2]);

			// marker style
			locationsMarker[i] = new google.maps.Marker({
			  raiseOnDrag: false,
			  icon: marker_image,
			  shadow: marker_shadow,
			  shape: marker_shape,
			  map: locations_map,
			  position: pos
			});

			// add this locations to bounds
			bounds.extend(pos);

			// click function
			google.maps.event.addListener(locationsMarker[i], 'click', (function(marker, i) {
				return function() {
					// infowindow content

					var infoVar = i+ 1;

					infowindow.setContent('<div class="locations-infobox"><h3>' + $('#locations-info > div:eq('+ infoVar +') > h3').html() + '</h3>' + $('#locations-info > div:eq('+ infoVar +') > address').html() + '</div>');
					infowindow.open(locations_map, locationsMarker[i]);

					// change pos on click with false to change select value
					changePos(i, false);
				}
			})(locationsMarker[i], i));

			// fit bounds
			locations_map.fitBounds(bounds);
		}
	}

	initLocationsMap();

	// Set first location
	if(setFirstLocation){
		changePos(0, true);
	}

	/* #Contact Map
	================================================= */
	// trigger click
//	google.maps.event.addListener(marker_contact, 'click', function() {
//		marker_contact.info.open(contact_map, marker_contact);
//	});

    // trying to close the winddow on click
//    google.maps.event.addListener(marker_contact, 'closeclick', function(){
//       marker_contact.close();
//    });


	/* #Contact Form
	================================================= */

	/* Submit Action */
	$("#contact-form button").click(function(e) {
		/* Prevent default action right here */
		e.preventDefault();
		/* Hide any previous response */
		$("#contact-form #response").hide();
		/* Append the loading logo */
		$(this).parent().append('<img src="'+base_url+'/media/images/loading.gif" class="loading" alt="Loading..." />');
		/* Get the values */
        var name = $('#contact-form #FullName').val();
        var email = $('#contact-form #email').val();
        var comments = $('#contact-form #message').val();
		/* Field validation */
		if(name == ""){
			mailResponse(nameError);
			return false;
		} else if(!validateEmail(email)){
			mailResponse(emailError);
			return false;
		} else if(comments == ""){
			mailResponse(commentsError);
			return false;
		}

		/* Ajax post */
		$.ajax({
            type: 'post',
            url: base_url+'/home/sendEmail',
            data: 'name=' + name + '&email=' + email + '&comments=' + comments,
            success: function(results) {
				/* Show success message */
				mailResponse(results, 'success');
				/* Reset values */
				$("#contact-form #FullName").val('');
				$("#contact-form #email").val('');
				$("#contact-form #message").val('');
                    setInterval(removeMsg, 10000);
                    
            },
			error: function(error){
				mailResponse(error);
			}
        });
		return false;
	});
     
     $("#subsribe_btn").click(function(e) {
		e.preventDefault();
          $('#subscribe_loading').show();
          var email = $('#subsribe_email').val();
		/* Field validation */
		if(!validateEmail(email)){
               $('#subscrib_error').addClass('error');
               $('#subscrib_error').removeClass('success');
			$('#subscrib_error').text('Please enter valid email address.');
               $('#subscrib_error').show();
               $('#subscribe_loading').hide();
			return false;
		}
          else{
             $('#subscrib_error').text('');
             $('#subscrib_error').hide();
          }

		/* Ajax post */
		$.ajax({
            type: 'post',
            url: base_url+'/home/Subscribe',
            data: 'subsribe_email=' + email,
            success: function(results) {
				/* Show success message */
                    $('#subscrib_error').addClass('success');
                    $('#subscrib_error').removeClass('errpr');
				$('#subscrib_error').text('Thank you for subscribe.');
                    $('#subscrib_error').show();
                    $('#subscribe_loading').show();
                    $('#subscribe_loading').hide();
                    setInterval(removeMsg, 10000);
                    
            },
			error: function(error){
				$('#subscrib_error').addClass('errpr');
                    $('#subscrib_error').removeClass('success');
				$('#subscrib_error').text('Fail to subscribe.');
                    $('#subscrib_error').show();
                    $('#subscribe_loading').hide();
                    setInterval(removeMsg, 10000);
			}
        });
		return false;
	});
	/* #Mailing list
	================================================== */
	$("#mailing-list button").click(function(e) {
		/* Validate email */
		if(validateEmail($("#mailing-list #email").val())){
			$("#mailing-list #response-newsletter").fadeOut();
			return true;
		} else {
			e.preventDefault();
			$("#mailing-list #response-newsletter").hide().html('<span class="error">'+ emailError +'</span>').fadeIn("slow");
			return false;
		}
	});
	/* #Email Validation
	================================================== */
	function validateEmail(value){
		var hasError = false;
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		var emailaddressVal = value;
		if(!emailReg.test(emailaddressVal) || emailaddressVal == "") {
			return false;
		} else {
			return true;
		}
	}
	/* Mail Response */
	function mailResponse(msg, type){
		if(!type){
			var type = 'error';
		}
		$("#contact-form img.loading").fadeOut(1000).remove();
		$("#contact-form #response").hide().html('<span class="'+ type +'">'+ msg +'</span>').fadeIn("slow");
	}
	
     $("#switch .background a").click(function() {
		$("#theme").attr({href : 'media/stylesheets/themes/' + $(this).attr('id') + ".css"});
		$(".background .current").removeClass('current');
		$(this).toggleClass('current');
	});
	$("#switch .color a").click(function() {
		$("#color").attr({href : 'media/stylesheets/themes/' + $(this).attr('id') + ".css"});
		$(".color .current").removeClass('current');
		$(this).toggleClass('current');
		// contact icon color
		marker_contact.setIcon('media/images/themes/' + $(this).attr('id') + "/marker.png");
		//locations map
		for(var i = 0; i < locationsMarker.length; i++){
			locationsMarker[i].setIcon('media/images/themes/' + $(this).attr('id') + "/marker.png");
		}
	});
	$("#show").css({"margin-left" : "-200px"});
	$("#hide, #show").click(function() {
		if($("#switch").is(':visible')){
			$("#switch").animate({'margin-left' : '-200px'}, 1000, function(){$(this).hide()});
			$("#show").animate({'margin-left' : '0px'}, 1000).show();
		} else {
			$("#show").animate({'margin-left' : '-200px'}, 1000, function(){$(this).hide()});
			$("#switch").show().animate({'margin-left': '0'}, 1000);
		}
	});
});

function removeMsg(){
   $("#contact-form #response").html('<span class="success"></span>');
   $('#subscrib_error').hide();
}
