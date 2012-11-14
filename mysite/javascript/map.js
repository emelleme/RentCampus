function MapController($scope,$http,$location){
	$(document).ready(function(){
	//https://maps.google.com/maps?q=1414+Oxford+Avenue,+Philadelphia,+PA&hl=en-US&sll=39.982128,-75.152916&sspn=0.035186,0.084028&oq=1414+ox&t=h&hnear=1414+W+Oxford+St,+Philadelphia,+Pennsylvania+19121&z=16	  
	var point = new google.maps.LatLng(39.97737,-75.15948);
		  
	var image = new google.maps.MarkerImage(
	'assets/marker-images/pin.png',
	new google.maps.Size(64,64),
	new google.maps.Point(0,0),
	new google.maps.Point(32,64)
	);

	var shadow = new google.maps.MarkerImage(
	'assets/marker-images/shadow-pin.png',
	new google.maps.Size(100,64),
	new google.maps.Point(0,0),
	new google.maps.Point(32,64)
	);
		
	var shape = {
	coord: [37,0,40,1,41,2,41,3,41,4,41,5,41,6,41,7,41,8,38,9,37,10,37,11,37,12,37,13,37,14,37,15,37,16,37,17,37,18,37,19,37,20,37,21,39,22,40,23,41,24,42,25,43,26,44,27,44,28,44,29,44,30,44,31,44,32,43,33,42,34,40,35,36,36,34,37,34,38,34,39,34,40,34,41,34,42,34,43,48,44,49,45,50,46,50,47,52,48,53,49,54,50,55,51,53,52,53,53,53,54,53,55,53,56,50,57,49,58,47,59,45,60,43,61,41,62,38,63,13,63,12,62,12,61,12,60,12,59,12,58,12,57,12,56,14,55,14,54,16,53,17,52,19,51,19,50,21,49,22,48,24,47,27,46,29,45,30,44,30,43,30,42,30,41,30,40,30,39,30,38,30,37,27,36,23,35,22,34,20,33,19,32,19,31,19,30,19,29,19,28,20,27,20,26,21,25,22,24,23,23,24,22,25,21,25,20,25,19,25,18,25,17,26,16,26,15,26,14,26,13,26,12,26,11,26,10,24,9,22,8,21,7,21,6,21,5,21,4,21,3,21,2,23,1,26,0,37,0],
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
			center: new google.maps.LatLng(39.984309, -75.152101),
			mapTypeControlOptions: {
			  mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'rc_map']
			}
		}
		  
		var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
		map.mapTypes.set('rc_map', rcMapType);
  		map.setMapTypeId('rc_map');
  		var curcenter = map.getCenter();
			
			var curzoom = map.getZoom();
  		$http.get('/home/listingsSearch?center='+curcenter.toString()).success(function(data) {
					$.each($scope.Markers, function(i, rcdata){
						$scope.Markers[i].setMap(null);
					});
					$scope.Markers = [];
					var dd =[];
					$.each(data, function(i, rcdata){
						dd = [rcdata.title,rcdata.lat,rcdata.lng];
						var myLatLng = new google.maps.LatLng(rcdata.lat, rcdata.lng);
						var circle = new google.maps.Circle({
							center: myLatLng,
							radius: 15,
							map: map,
							strokeColor: "#FF0000",
							strokeOpacity: 0.8,
							strokeWeight: 2,
							fillColor: "#FF0000",
							fillOpacity: 0.35,
							title: rcdata.title
						});
						$scope.Markers.push(circle);
						var contentString = '<div id="content" style="width:350px;text-align:center;">'+
							'<div id="bodyContent">'+
							'<div style="float:left;width:90px">'+
							'<img src="'+rcdata.imgurl+'" height="80" width="80" />'+
							'</div>'+
							'<h2 id="firstHeading" class="firstHeading"><a href="listings/show/'+rcdata.id+'" title="View Details">'+rcdata.title+'</a></h2>'+
							'<h3>$'+rcdata.price+'/month</h3>'+
							'<p>'+rcdata.bedrooms+'</p>'+
							'</div>'+
							'</div>';
						
						var iwindow = new google.maps.InfoWindow({
					  		content: contentString,
					  		position: myLatLng
						});
						
						$scope.InfoWindows.push(iwindow);
					
						google.maps.event.addListener(circle, 'click', function() {
							$scope.maininfowindow.setContent(contentString);
							$scope.maininfowindow.setPosition(myLatLng)
							$scope.maininfowindow.open(map,$scope.marker);
							$scope.marker.setPosition(myLatLng);
						});
				});
				});
  		$scope.Markers = [];
  		$scope.InfoWindows = [];
  		google.maps.event.addListener(map, 'zoom_changed', function() {
			//Show district overlays if loaded
			var curcenter = map.getCenter();
			
			var curzoom = map.getZoom();
		 	
			if(curzoom >=14){
				$scope.maininfowindow.close();
				//Get and show 
				$http.get('/home/listingsSearch?center='+curcenter.toString()).success(function(data) {
					$.each($scope.Markers, function(i, rcdata){
						$scope.Markers[i].setMap(null);
					});
					$scope.Markers = [];
					var dd =[];
					$.each(data, function(i, rcdata){
						dd = [rcdata.title,rcdata.lat,rcdata.lng];
						var myLatLng = new google.maps.LatLng(rcdata.lat, rcdata.lng);
						var circle = new google.maps.Circle({
							center: myLatLng,
							radius: 15,
							map: map,
							strokeColor: "#FF0000",
							strokeOpacity: 0.8,
							strokeWeight: 2,
							fillColor: "#FF0000",
							fillOpacity: 0.35,
							title: rcdata.title
						});
						$scope.Markers.push(circle);
						var contentString = '<div id="content" style="width:350px;text-align:center;">'+
							'<div id="bodyContent">'+
							'<div style="float:left;width:90px">'+
							'<img src="'+rcdata.imgurl+'" height="80" width="80" />'+
							'</div>'+
							'<h2 id="firstHeading" class="firstHeading"><a href="listings/show/'+rcdata.id+'" title="View Details">'+rcdata.title+'</a></h2>'+
							'<h3>$'+rcdata.price+'/month</h3>'+
							'<p>'+rcdata.bedrooms+'</p>'+
							'</div>'+
							'</div>';
						
						var iwindow = new google.maps.InfoWindow({
					  		content: contentString,
					  		position: myLatLng
						});
						
						$scope.InfoWindows.push(iwindow);
					
						google.maps.event.addListener(circle, 'click', function() {
							$scope.maininfowindow.setContent(contentString);
							$scope.maininfowindow.setPosition(myLatLng)
							$scope.maininfowindow.open(map,$scope.marker);
							$scope.marker.setPosition(myLatLng);
						});
				});
				});
				console.log($scope.Markers);
			}else{
				$scope.InfoWindows[0].close();
				$.each($scope.Markers, function(i, rcdata){
					$scope.Markers[i].setMap(null);
				});
			}
		});
  		
  		heatmapData = [];
		$http.get('/home/listingsLocations').success(function(data) {
			var dd =[]
			$.each(data, function(i, rcdata){
				dd = {
					location: new google.maps.LatLng(rcdata.lat,rcdata.lng),
					weight: rcdata.weight
				};
				if(i < 250){
					heatmapData[i] = dd;
				}
				console.log(heatmapData[i]);
			});
			var rcgradient = [
			'rgba(0, 255, 255, 0)',
			'rgba(0, 255, 255, 0.1)',
			'rgba(255, 249, 0, 0.5)',
			'rgba(255, 248, 0, 1)',
			'rgba(255, 237, 0, 1)',
			'rgba(191, 191, 0, 1)',
			'rgba(191, 191, 0, 1)',
			'rgba(191, 191, 0, 1)',
			'rgba(191, 191, 0, 1)',
			'rgba(127, 127, 25, 1)',
			'rgba(91, 91, 24, 1)',
			'rgba(127, 127, 30, 1)',
			'rgba(191, 191, 0, 1)',
			'rgba(255, 255, 0, 1)'
			]
        
			/*heatmap = new google.maps.visualization.HeatmapLayer({
			  data: heatmapData,
			  gradient: rcgradient,
			  radius:30,
			  opacity:0.2
			});
			//heatmap.setMap(map);*/
		});
		$scope.marker = new google.maps.Marker({
			draggable: true,
			raiseOnDrag: false,
			icon: image,
			shadow: shadow,
			shape: shape,
			map: map,
			title: "Rent Campus Map Coming Soon!",
			position: point
		});
		
		var contentString = '<div style="width:400px;text-align:center;">'+
		'<h2 id="firstHeading" class="firstHeading">Welcome to Interactive Map!</h2>'+
		'<div id="bodyContent">'+
		'<p>Zoom in to explore our available listings.</p>'+
		'<p><a href="listings">View All Listings</a></p>'+
		'</div>'+
		'</div>';
		
		$scope.maininfowindow = new google.maps.InfoWindow({
		  content: contentString,
		  maxWidth: 450
		});
		$scope.maininfowindow.open(map,$scope.marker);
		google.maps.event.addListener($scope.marker, 'click', function() {
		  $scope.maininfowindow.open(map,$scope.marker);
		});

})
}

function loadScript() {
var script = document.createElement("script");
script.type = "text/javascript";
script.src = "http://maps.googleapis.com/maps/api/js?key=AIzaSyCgvqlo4BGgoDA0vynL7Zbr8CwfIJjQ57c&sensor=false&callback=initialize";
document.body.appendChild(script);
}

