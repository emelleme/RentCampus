function ListingController($scope,$http,$location){
	/* ie fix >:( */
	$location.url('/');

	$scope.bedrooms = [
	{count:0,label:'Studio'},
	{count:1,label:1},
	{count:2,label:2},
	{count:3,label:3},
	{count:4,label:4},
	{count:5,label:5},
	{count:6,label:6},
	{count:7,label:7},
	{count:8,label:8},
	{count:9,label:9}
	];
	$scope.bedroom = $scope.bedrooms[0];
	
	$scope.bathrooms = [
	{count:1},
	{count:2},
	{count:3},
	{count:4},
	{count:5}
	];
	$scope.bathroom = $scope.bathrooms[0];
	
	$scope.listingNoticeClass = "info";
	$scope.listingNoticeMessage = "Listing Search";
	
	$http.get('listings/all').success(function(data) {
		
		angular.forEach(data, function(listing, i){
			if (listing.rented == true) {
					listing.img = 'assets/rented.png'
				}else if(listing.img == false){
					listing.img = 'assets/large-default.jpg'
				}
			//console.log(listing.rented)
		});
		$scope.listings = data;
		//console.log($scope.listings);
	});
	
	$scope.bedroomclickAction = function(){
		$http.get('listings/search/Bedrooms/'+$scope.bedroom.count+'/'+$scope.bathroom.count).success(function(data) {
			angular.forEach(data, function(listing, i){
				if (listing.rented == true) {
					listing.img = 'assets/rented.png'
				}else if(listing.img == false){
					listing.img = 'assets/large-default.jpg'
				}
				console.log(listing.img)
			});
		
			$scope.listings = data;
			if(data.length == 0)
			{
				$scope.listingNoticeClass = "error";
				$scope.listingNoticeMessage = "Sorry, No Matches found.";
			}else{
				$scope.listingNoticeClass = "success";
				$scope.listingNoticeMessage = data.length +" Results found!";
			}
		});
	}
	
	$scope.bathroomclickAction = function(){
		$http.get('listings/search/Bathrooms/'+$scope.bathroom.count+'/'+$scope.bedroom.count).success(function(data) {
			angular.forEach(data, function(listing, i){
				if (listing.rented == true) {
					listing.img = 'assets/rented.png'
				}else if(listing.img == false){
					listing.img = 'assets/large-default.jpg'
				}
				console.log(listing.img)
			});
		$scope.listings = data;
			if(data.length == 0)
			{
				$scope.listingNoticeClass = "error";
				$scope.listingNoticeMessage = "Sorry, No Matches found.";
			}else{
				$scope.listingNoticeClass = "success";
				$scope.listingNoticeMessage = data.length +" Results found!";
			}
		});
	}
	
	$('#amount').val('$500 - $1500');
	$("#slider-range").slider({
		range: true,
		min: 0,
		max: 3000,
		values: [ 500, 1500 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		},
		stop: function( event, ui ) {
			//Get values and filter results
			$http.get('listings/range/'+ ui.values[ 0 ] +"/" + ui.values[ 1 ] ).success(function(data) {
				angular.forEach(data, function(listing, i){
					if (listing.img == false) {
						listing.img = 'assets/large-default.jpg'
					};
					console.log(listing.img)
				});
				$scope.listings = data;
				if(data.length == 0)
				{
					$scope.listingNoticeClass = "error";
					$scope.listingNoticeMessage = "Sorry, No Matches found.";
				}else{
					$scope.listingNoticeClass = "success";
					$scope.listingNoticeMessage = data.length +" Results found!";
				}
			});
		}
	});
}


