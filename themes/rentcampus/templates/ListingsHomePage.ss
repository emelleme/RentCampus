<!DOCTYPE html>

<html lang="en" class="ng-app" ng-app="">
<head>
	<% base_tag %>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="fragment" content="!" />
	<title>Rent Campus Online </title>
	<link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/themes/blitzer/jquery-ui.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/stylenew.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/style.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/typography.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/form.css" />
	<link rel="stylesheet" type="text/css" href="themes/rentcampus/css/fancybox.css" />
	<link rel="stylesheet" type="text/css" href="chosen-lib/chosen.css" />
	
	

    <script type="text/javascript" src="http://www.google.com/jsapi"></script>
   
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.12/jquery-ui.min.js"></script>
     <script src="http://code.angularjs.org/angular-1.0.0.min.js" ng:autobind></script>
    <script src="mysite/javascript/respond.min.js"></script>
    <script src="mysite/javascript/jquery.easing-1.3.min.js"></script>
    <script src="mysite/javascript/jquery.fancybox-1.3.4.pack.js"></script>
    <script src="mysite/javascript/jquery.smartStartSlider.min.js"></script>
	<script src="mysite/javascript/jquery.jcarousel.min.js"></script>
	<script src="mysite/javascript/jquery.cycle.all.min.js"></script>
	<script src="mysite/javascript/jquery.isotope.min.js"></script>
	<script src="mysite/javascript/mediaelement-and-player.min.js"></script>
	<script src="chosen-lib/chosen.jquery.js" type="text/javascript"></script>
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
	<a href="home"><img src="themes/rentcampus/images/rent-campus-logo.png" alt="Rent Campus Online" ></a>
	</div>
        
	<div id="main">
	
	<div id="left_col">
    	<div id="mainLeft">
                	
            	<!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
		    <div class="page-content" ng-controller="ListingController">
		    
		    	<p class="note">Price Range: <span id="currentValue">
		    	<input type="text" id="amount" style="border:0; color:#f6931f; font-weight:bold;width:160px;"/></span>
		    	<span>
		    	Bedrooms:
		    	<select id="bedrooms" ng-model="bedroom" ng-options="b.label for b in bedrooms" ng-click="bedroomclickAction()" style="width:50px;">
				</select>
				</span>
				<span>
		    	Bathrooms: 
		    	<select id="bathrooms" ng-model="bathroom" ng-options="b.count for b in bathrooms" ng-click="bathroomclickAction()" style="width:50px;">
				</select>
				</span>
		    	</p>
		    	
				<div id="slider-range" jq:slider></div>
				<br />
				<section class="simple-pricing-table col2 clearfix">
					<header class="page-header"><h1>Listings</h1></header>
				
					<p id="listingNotice" class="{{listingNoticeClass}}">{{listingNoticeMessage}}</p>
					<div id="listingList">
						<div class="column" ng-repeat="listing in listings">

						<div class="header">
						<div class="one-third">
						<!--<img src="$CroppedImage(270,100).Url"/>-->
						<img ng-src="{{listing.img}}" height="180" width="180" />
						</div>
						<h2 class="title"> <a href="listings/show/{{listing.id}}">{{listing.title}}</a> </h2>
						<h3 class="price"><span> {{listing.price}} </span> <br />
						<small>{{listing.bedrooms}} bedroom / {{listing.bathrooms}} bathroom</small>
						 </h3>
						<div class="description">{{listing.snippet}}</div>
				</section>

				
		    </div>
                
                <!-- HOME PAGE CONTENT DISPLAYED INITIALLY -->
            
        </div>
        
       
    
    </div>
<div id="right_col">
	<% include Sidebar %>
	<!--<div class="page-content">
	
		<img src="http://maps.googleapis.com/maps/api/staticmap?center=39.981292,-75.159616&zoom=16&format=png&sensor=false&size=640x480&maptype=roadmap&style=feature:road.arterial|lightness:-27|gamma:2.62|visibility:on&style=feature:road.local|gamma:0.7|visibility:on|hue:0xff0000|lightness:12&style=feature:landscape.man_made|visibility:on|saturation:-1|lightness:28&style=feature:poi.school|hue:0xff0900|lightness:-13|saturation:-9|gamma:0.95&style=feature:poi.park|lightness:-31&style=feature:poi.sports_complex|visibility:on|gamma:0.98|lightness:-14&style=feature:transit.line|invert_lightness:true&style=feature:road.highway|lightness:-15|gamma:0.7&style=feature:administrative.land_parcel|lightness:-18&markers=icon:http://phillypolice.com/assets/icons/map/homemarker.png|(39.981192,%20-75.14611550000001)&sensor=true" height="180" width="180" />
	</div>
	-->
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
