<!DOCTYPE html>

<html lang="en" ng-app>
<head>
	<% base_tag %>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Rent Campus Online </title>
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/blitzer/jquery-ui.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/stylenew.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/style.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/typography.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/form.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/fancybox.css" />
	
	

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
    <script src="http://code.angularjs.org/angular-0.10.4.min.js" ng:autobind></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
    <script src="mysite/javascript/respond.min.js"></script>
    <script src="mysite/javascript/jquery.easing-1.3.min.js"></script>
    <script src="mysite/javascript/jquery.fancybox-1.3.4.pack.js"></script>
    <script src="mysite/javascript/jquery.smartStartSlider.min.js"></script>
	<script src="mysite/javascript/jquery.jcarousel.min.js"></script>
	<script src="mysite/javascript/jquery.cycle.all.min.js"></script>
	<script src="mysite/javascript/jquery.isotope.min.js"></script>
	<script src="mysite/javascript/mediaelement-and-player.min.js"></script>
	<script src="mysite/javascript/custom-listings.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Fontdiner+Swanky|Black+Ops+One|Slackey' rel='stylesheet' type='text/css' />
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
	
	<div id="left_col">
    	<div id="mainLeft">
                	
            	<!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
		    <div class="page-content">
		    	<p class="note">Price Range: <span id="currentValue"><input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;" value="$500 - $1500"  /></span></p>
		    	
				<div id="slider-range" jq:slider></div>
				<br>
				<section class="simple-pricing-table col2 clearfix">
				
				<% control ChildrenOf(listings) %>
				<div class="column">

					<div class="header">
					<div class="one-third">
					<!--<img src="$CroppedImage(270,100).Url"/>-->
					<img src="$ListingImages.First.Url" height="180" width="180" />
					</div>
						<h2 class="title"> <a href="$Link">$Title</a> </h2>
						<h3 class="price"><span> $725 </span> <br />
						<small>1 bedroom / 1 bathroom</small>
						 </h3>
						<h5 class="description"> $Content.LimitCharacters(200) </h5>
					</div><!-- end .header -->

					

					<div class="footer">
						<a class="button" href="$Link"> More Info </a>
						<a class="button" href="#"> RENT NOW </a>
					</div><!-- end .footer -->
				
				</div><!-- end .column -->
				<% end_control %>

				$Form
		    </div>
                
                <!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
            
        </div>
        
       
    
    </div>
<div id="right_col">
	<% include Sidebar %>
	<!--<div class="page-content">
	
		<img src="http://maps.googleapis.com/maps/api/staticmap?center=39.981192,-75.14611550000001&zoom=16&size=200x200&maptype=roadmap&markers=icon:http://phillypolice.com/assets/icons/map/homemarker.png|(39.981192,%20-75.14611550000001)&sensor=true" height="180" width="180" />
	</div>-->
	
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
    <% include Footer %>
    
</div>
<!-- /wrapper -->

</div>
<!-- /cork -->

</body>
</html>
