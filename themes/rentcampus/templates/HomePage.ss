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
		  var myOptions = {
			zoom: 14,
			center: new google.maps.LatLng(39.980223, -75.157581),
			mapTypeId: google.maps.MapTypeId.ROADMAP
		  }
		  var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		  var marker1 = new google.maps.Marker({
			  position: new google.maps.LatLng(39.982329, -75.162053),
			  map: map,
			  title:"1900 N 17th St"
		  });
		  var marker2 = new google.maps.Marker({
			  position: new google.maps.LatLng(39.974414, -75.162151),
			  map: map,
			  title:"1333 N 16th St"
		  });
		  var contentString = '<div id="content" style="width:400px;">'+
			'<h2 id="firstHeading" class="firstHeading">Property Name</h2>'+
			'<div id="bodyContent">'+
			'<p>Marker Content Here</p>'+
			'<p>Amenities: </p>'+
			'</div>'+
			'</div>'
		  var infowindow = new google.maps.InfoWindow({
			  content: contentString
		  });
		  google.maps.event.addListener(marker1, 'click', function() {
			  infowindow.open(map,marker1);
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
			<li class="current">
				<a href="home" data-description="All starts here">Home</a>
			</li>
			<li>
				<a href="listings" data-description="Your New Home">For Rent</a>
				
			</li>
			<li>
				<a href="community" data-description="Posting Board">Community</a>
				
			</li>
			<li>
				<a href="about" data-description="Work we are proud of">About Us</a>
				
			</li>
			<li>
				<a href="contact-us.html" data-description="Enquire here">Contact</a>
			</li>
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
				$Form
				<section class="simple-pricing-table col2 clearfix">
				<h3>Featured Listings</h3>
				<% control ChildrenOf(listings) %>
				<div class="column">

					<div class="header">
					<div class="one-third">
					<img src="$ListingImages.First.Url" height="100" width="180" />
					</div>
						<h2 class="title"> <a href="$Link">$Title</a> </h2>
						<h3 class="price"><span> $725 </span> <br />
						<small>1 bedroom / 1 bathroom</small>
						 </h3>
					</div><!-- end .header -->

					

					<div class="footer">
						<a class="button" href="$Link"> More Info </a>
					</div><!-- end .footer -->
				
				</div><!-- end .column -->
				<% end_control %>
				</section>
		    </div>
                
                <!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
            
        </div>
        
       
    
    </div>
<div id="right_col">
	<div class="page-content">
<img src="themes/rentcampus/images/staytuned.jpg" width="162" height="30" /><br />
    <p>We'll be rolling out lots of new deals, events and services soon. So put an end to the endless searching. </p>
<h3>Mobile Alerts</h3>
<br/>
<p><a class="button fb-bg" href="#">Connect with Facebook</a></p>
<br/>
	<% include Subscribe %>
	</div>
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