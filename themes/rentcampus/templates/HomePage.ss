<!DOCTYPE html>

<html lang="en">
<head>
	<% base_tag %>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Rent Campus Online </title>
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/stylenew.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/style.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/typography.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/form.css" />
    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="mysite/javascript/respond.min.js"></script>
    <script src="mysite/javascript/jquery.easing-1.3.min.js"></script>
    <script src="mysite/javascript/jquery.fancybox-1.3.4.pack.js"></script>
    <script src="mysite/javascript/jquery.smartStartSlider.min.js"></script>
	<script src="mysite/javascript/jquery.jcarousel.min.js"></script>
	<script src="mysite/javascript/jquery.cycle.all.min.js"></script>
	<script src="mysite/javascript/jquery.isotope.min.js"></script>
	<script src="mysite/javascript/mediaelement-and-player.min.js"></script>
	<script src="mysite/javascript/custom.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Fontdiner+Swanky|Black+Ops+One|Slackey' rel='stylesheet' type='text/css' />
	<script type="text/javascript">
		function initialize() {
		  
		var point = new google.maps.LatLng(39.982329, -75.162053);
		  
		var image = new google.maps.MarkerImage(
			'assets/marker-images/image.png',
			new google.maps.Size(50,80),
			new google.maps.Point(0,0),
			new google.maps.Point(25,80)
		);
		var shadow = new google.maps.MarkerImage(
			'assets/marker-images/shadow.png',
			new google.maps.Size(94,80),
			new google.maps.Point(0,0),
			new google.maps.Point(25,80)
		);
		
		var shape = {
			coord: [38,0,41,1,44,2,46,3,48,4,49,5,49,6,49,7,49,8,49,9,49,10,45,11,45,12,45,13,44,14,44,15,43,16,43,17,43,18,42,19,42,20,42,21,42,22,41,23,41,24,41,25,40,26,40,27,40,28,40,29,40,30,39,31,39,32,39,33,39,34,38,35,38,36,38,37,38,38,38,39,38,40,41,41,43,42,44,43,40,44,41,45,42,46,43,47,44,48,44,49,44,50,44,51,44,52,43,53,42,54,26,55,25,56,25,57,24,58,24,59,24,60,24,61,24,62,23,63,23,64,22,65,22,66,22,67,22,68,21,69,21,70,21,71,20,72,20,73,20,74,20,75,19,76,19,77,18,78,28,79,16,79,16,78,17,77,17,76,17,75,17,74,17,73,18,72,18,71,18,70,18,69,19,68,19,67,19,66,19,65,20,64,20,63,20,62,21,61,21,60,21,59,22,58,22,57,22,56,23,55,23,54,23,53,23,52,24,51,11,50,11,49,10,48,10,47,10,46,10,45,9,44,9,43,9,42,9,41,10,40,11,39,12,38,16,37,20,36,21,35,20,34,22,33,22,32,23,31,23,30,24,29,24,28,21,27,24,26,25,25,21,24,21,23,26,22,26,21,27,20,27,19,27,18,27,17,28,16,28,15,21,14,21,13,29,12,29,11,21,10,30,9,30,8,30,7,17,6,29,5,28,4,27,3,27,2,21,1,21,0,38,0],
			type: 'poly'
		};
		  
		  var myMapStyles = [
			  {
				featureType: "road.arterial",
				stylers: [
				  { lightness: -27 },
				  { gamma: 2.62 },
				  { visibility: "on" }
				]
			  },{
				featureType: "road.local",
				stylers: [
				  { gamma: 0.7 },
				  { visibility: "on" },
				  { hue: "#ff0000" },
				  { lightness: 12 }
				]
			  },{
				featureType: "landscape.man_made",
				stylers: [
				  { visibility: "on" },
				  { saturation: -1 },
				  { lightness: 28 }
				]
			  },{
				featureType: "poi.school",
				stylers: [
				  { hue: "#ff0900" },
				  { lightness: -13 },
				  { saturation: -9 },
				  { gamma: 0.95 }
				]
			  },{
				featureType: "poi.park",
				stylers: [
				  { lightness: -31 }
				]
			  },{
				featureType: "poi.sports_complex",
				stylers: [
				  { visibility: "on" },
				  { gamma: 0.98 },
				  { lightness: -14 }
				]
			  },{
				featureType: "transit.line",
				stylers: [
				  { invert_lightness: true }
				]
			  },{
			  },{
				featureType: "road.highway",
				stylers: [
				  { lightness: -15 },
				  { gamma: 0.7 }
				]
			  },{
				featureType: "administrative.land_parcel",
				stylers: [
				  { lightness: -18 }
				]
			  }
			]
		
		var rcMapType = new google.maps.StyledMapType(myMapStyles,
    	{name: "RentCampus Map"});
    	
    	var myOptions = {
			scrollwheel: false,
			zoom: 14,
			center: new google.maps.LatLng(39.992223, -75.158581),
			mapTypeControlOptions: {
			  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'rc_map']
			}
		  }
		  
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		map.mapTypes.set('rc_map', rcMapType);
  		map.setMapTypeId('rc_map');
  		
		  
		var marker = new google.maps.Marker({
			draggable: true,
			raiseOnDrag: false,
			icon: image,
			shadow: shadow,
			shape: shape,
			map: map,
			title: "Rent Campus Map Coming Soon!",
			position: point
		});
		
		var contentString = '<div id="content" style="width:400px;text-align:center;">'+
		'<h2 id="firstHeading" class="firstHeading">Interactive Map Coming Soon!</h2>'+
		'<div id="bodyContent">'+
		'<p>Bear with us as we fine tune the interactive map for you. :-)</p>'+
		'<p><a href="listings">View All Listings</a></p>'+
		'</div>'+
		'</div>';
		
		var infowindow = new google.maps.InfoWindow({
		  content: contentString
		});
		infowindow.open(map,marker);
		google.maps.event.addListener(marker, 'click', function() {
		  infowindow.open(map,marker);
		});

		}

		function loadScript() {
		var script = document.createElement("script");
		script.type = "text/javascript";
		script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCgvqlo4BGgoDA0vynL7Zbr8CwfIJjQ57c&sensor=false&callback=initialize";
		document.body.appendChild(script);
		}

window.onload = loadScript;
	</script>
</head>

<body class="home blog">



<div id="cork">

<div id="wrapper">

	<div id="container">
	
	<nav id="main-nav">
		
		<ul>
			<% include Navigation %>
		</ul>

	</nav><!-- end #main-nav -->
    <div id="logo">	
	<a href="index.php"><img src="themes/rentcampus/images/rent-campus-logo.png" alt="Rent Campus Online" ></a>
	</div>
        
	<div id="main">
	<article class="slide" style="border:1px solid transparent;">
		<div id="map_canvas" style="width:873px;height:337px;margin:22px auto;"></div>
	</article><!-- end .slide (Responsive Layout) -->
	
	<div id="left_col">
    	<div id="mainLeft">
                	
            	<!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
		    <div class="page-content">
				$Content
				<section class="simple-pricing-table col2 clearfix">
				<h3>Featured Listings</h3>
				<% control FeaturedListings %>
				<div class="column">

					<div class="header">
					<div class="one-third">
					<img src="$ListingImages.First.Url" height="100" width="180" />
					</div>
						<h2 class="title"> <a href="/listings/show/$ID">$Title</a> </h2>
						<h3 class="price"><span> $$Price </span> <br />
						<small>$Bedrooms bedroom / $Bathrooms bathroom</small>
						 </h3>
					</div><!-- end .header -->
					<!--<br clear="all" />-->
					
					<div class="footer">
						<a class="button" href="/listings/show/$ID"> More Info </a> <a class="button" href="/listings/show/$ID"> Rent Now </a>
					</div><!-- end .footer -->
				
				</div><!-- end .column -->
				<% end_control %>
				</section>
		    </div>
                
                <!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
            
        </div>
        
       
    
    </div>
<div id="right_col">
	<% include Sidebar %>
	
</div>
    <div class="clear"></div>
</div>

<!-- MAIN CONTENT -->

        <!-- /main -->
        
        <div class="clear"></div>
        
        <div id="main_footer"></div>
                
        <div class="clear"></div>
        
    </div>
    <!-- /container -->
        
    </div>
    <!-- /footer wrapper -->
    
    <div id="footer_wrapper">
    
    <div id="footer">
    
    <div class="padding">
    
    <ul class="one">
    <li class="header">Listings</li>
    <li><a href="/events">Latest Listings</a></li>
    <li><a href="/events/tickets">All Listings</a></li>
    <li><a href="/events/past">Search Listings</a></li>
	
    </ul>
    
    <ul class="two">
    <li class="header">About</a></li>
    <li><a href="/about">About Us</a></li>
    <li><a href="/about/members">Privacy Policy</a></li>
    <li><a href="/about/join">Terms of Service</a></li>
    </ul>
    
    <ul class="three">
    <li class="header">Contact</li>
    <li><a href="/contact">Contact Us</a></li>
    <li><a href="/contact/co-sponsorship/">Landlord Portal</a></li>
    <li>&nbsp;</li>
    
    </ul>
    
    <ul class="four">
    	<li class="header">Posting Board</li>
		<li><a href="#" target="_blank">For Sale</a></li>
	 	<li><a href="#" target="_blank">Services</a></li>
	 	<li><a href="#" target="_blank">Jobs</a></li>
    </ul>
    
    <ul class="five">
    <li class="header">Main Office</li>
    <li>1414 W Oxford St. <br/>
		Philadelphia,Pa 19121<br />
	</li>
	<li class="header">Phone</li>
    <li>215.825.3344</li>
    <li>&nbsp;</li>
    </ul>
    
    <div class="links">
    <a href="http://www.youtube.com/rentcampus" target="_blank"><img src="themes/rentcampus/images/youTube.png" width="54" height="54" border="0" /></a>
	<a href="http://www.facebook.com/pages/RentCampus/115296141847785" target="_blank"><img src="themes/rentcampus/images/facebook.png" width="54" height="54" border="0" /></a>
    </div>

<div class="links">
    <a href="http://picasaweb.google.com/RentCampus" target="_blank"><img src="themes/rentcampus/images/picasa.png" width="54" height="54" border="0" /></a>
	<a href="http://rentcampusonline.blogspot.com/" target="_blank"><img src="themes/rentcampus/images/blogger.png" alt="" width="54" height="54" border="0" /></a>
    </div>
    
    
    </div>
    <!-- /footer -->
    
</div>
<!-- /wrapper -->

</div>
<!-- /cork -->

</body>
</html>
