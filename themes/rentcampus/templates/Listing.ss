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
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/fancybox.css" />
	

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
</head>

<body class="home blog">



<div id="cork">

<div id="wrapper">

	<div id="container">
	
	<nav id="main-nav">
		
		<ul>
			<% include Navigation %>
			
			<!--<li class="current">
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
			</li>-->
		</ul>

	</nav><!-- end #main-nav -->
    <div id="logo">	
	<a href="index.php"><img src="themes/rentcampus/images/rent-campus-logo.png" alt="Rent Campus Online" ></a>
	</div>
        
	<div id="main">
	
	<div id="left_col">
    	<div id="mainLeft">
                	
            	<!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
		    <div class="page-content">
				<section class="simple-pricing-table col3 clearfix">

				<div class="column featured">

					<div class="header">
						<h3 class="title"> $Title </h3>
						<h3 class="price">$Bedrooms bedroom<br /> <span> $$Price </span> <br />
						 </h3>
						<h5 class="description"> $Description </h5>
					</div><!-- end .header -->

					<p class="features">
						<strong>Property Type</strong>: Apartment<br/>
						$Bedrooms bedroom / $Bathrooms bathroom
					</p><!-- end .features -->

					<div class="footer">
						
						<% if UnitStatus = Active %>
						<p class="info"><a class="button medium" href="#" style="margin-top:5px;"> BOOK VIEWING </a><br />
						Note: Appointments are scheduled for 30 minutes with 24 hour advance notice.</br>
						<strong>Monday</strong>: 11:00 am - 5:00 pm<br />
						<strong>Tuesday</strong>: 11:00 am - 5:00 pm<br />
						<strong>Wednesday</strong>: 11:00 am - 5:00 pm<br />
						<strong>Thursday</strong>: 11:00 am - 5:00 pm<br />
						<strong>Friday</strong>: 11:00 am - 5:00 pm<br />
						<strong>Saturday</strong>: 1:00 pm - 4:00 pm
						</p>
						<% else %>
						<p class="error">THIS UNIT IS NO LONGER AVAILABLE.</p>
						<% end_if %>
					</div><!-- end .footer -->
				
				</div><!-- end .column -->
				<aside id="sidebar">

				<% control ListingImages %>
				<a href="$Link" class="image-gallery" title="$Parent.Parent.Title" rel="group-one"><img src="$CroppedImage(270,100).Url"/></a>
				<% end_control %>
				</aside>
			</section><!-- end .simple-pricing-table -->
				<h4><a href="listings">Back to Listings</a></h4>
		    </div>
                
                <!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
            
        </div>
        
       
    
    </div>
    <div id="right_col">
    
    <div class="page-content">
		<% if UnitStatus = Active %>
		<p style="text-align: center;"><a class="button large" href="#"> RENT IT NOW! </a></p>
		<% else %>
		<p class="error">UNIT HAS BEEN RENTED</p>
		<% end_if %>
		<span class="acc-trigger">
			<h4><a href="#">Property Details</a></h4>
		</span>

		<div class="acc-container">
			<div class="content">
			<p><strong>Unit #</strong>:$UnitNumber<br/>
			<strong>Square Feet</strong>:$UnitSize<br/>
			<strong>Bedrooms</strong>:$Bedrooms<br/>
			<strong>Bathrooms</strong>:$Bathrooms<br/>
			<strong>Rental Term</strong>:$MinimumRentalTerm<br/>
			<strong>Status</strong>: $UnitStatus<br/></p>
			</div>
		</div><!-- end .acc-container -->
		
		<span class="acc-trigger">
			<h4><a href="#">Amenities</a></h4>
		</span>

		<div class="acc-container">
			<div class="content">
			<% control Amenities %>
			<ul class="arrow dotted">
			<li>$Name</li>
			</ul>
			<% end_control %>
			</div>
		</div><!-- end .acc-container -->

		<span class="acc-trigger">
			<h5><a href="#">Utilities</a></h5>
		</span>

		<div class="acc-container">
			<div class="content">
			<% control Utilities %>
			<ul class="arrow dotted">
			<li>$Name</li>
			</ul>
			<% end_control %>
			</div>
		</div><!-- end .acc-container -->

		

		
		<ul class="star dotted">
		<li><a href="">Share with Friends</a></li>
		</ul>
		
		<ul class="arrow-2 dotted">
		<li><a href="">Email to Mom</a></li>
		</ul>
	</div>
	
	<div class="page-content">
	
		<img src="http://maps.googleapis.com/maps/api/staticmap?center=39.981192,-75.14611550000001&zoom=16&size=200x200&maptype=roadmap&markers=icon:http://phillypolice.com/assets/icons/map/homemarker.png|(39.981192,%20-75.14611550000001)&sensor=true" height="180" width="180" />
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
    <li>215.895.2575</li>
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
