angular.directive('jq:slider', function() {
	return function(elm) {
	  elm.slider({
		range: true,
		min: 0,
		max: 2000,
		values: [ 500, 1500 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
		}
	  });
	};
});
