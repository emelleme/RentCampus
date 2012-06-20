function ListingController($scope,$http,$location){
	/* ie fix >:( */
	$location.url('/');

	$scope.bedrooms = [
	{count:1},
	{count:2},
	{count:3}
	];
	$scope.bedroom = $scope.bedrooms[0];
	
	$scope.bathrooms = [
	{count:1},
	{count:2},
	{count:3}
	];
	$scope.bathroom = $scope.bathrooms[0];
	
	$scope.listingNoticeClass = "info";
	$scope.listingNoticeMessage = "Listing Search";
	
	$http.get('listings/all').success(function(data) {
		$scope.listings = data;
	});
	
	$scope.bedroomclickAction = function(){
		console.log($scope.bedroom.count);
		$http.get('listings/search/Bedrooms/'+$scope.bedroom.count+'/'+$scope.bathroom.count).success(function(data) {
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
		max: 2000,
		values: [ 500, 1500 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		},
		stop: function( event, ui ) {
			//Get values and filter results
			$http.get('listings/range/'+ ui.values[ 0 ] +"/" + ui.values[ 1 ] ).success(function(data) {
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


