<!DOCTYPE html>

<html lang="en" class="ng-app" ng-app="">
<head>
	<% base_tag %>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Rent Campus Online </title>
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/stylenew.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/style.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/typography.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/form.css" />
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?libraries=geometry,places,visualization&sensor=true"></script>
    <script src="http://code.angularjs.org/angular-1.0.0.min.js" ng:autobind></script>
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
	<script src="mysite/javascript/map.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Fontdiner+Swanky|Black+Ops+One|Slackey' rel='stylesheet' type='text/css' />
	<script type="text/javascript">
		
//window.onload = loadScript;
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
	<a href="home"><img src="themes/rentcampus/images/rent-campus-logo.png" alt="Rent Campus Online" ></a>
	</div>
        
	<div id="main">
	<article class="slide" style="border:1px solid transparent;">
		<div ng-controller="MapController" id="map_canvas" style="width:873px;height:337px;margin:22px auto;"></div>
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
    <!-- /main -->
        
    <div class="clear"></div>
        
    <div id="main_footer"></div>
                
    <div class="clear"></div>
        
</div>
<!-- /container -->
	
	<% include Footer %>
    <!-- /footer -->
    
</div>
<!-- /wrapper -->

</div>
<!-- /cork -->

</body>
</html>
