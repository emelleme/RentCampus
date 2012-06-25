function PhoneController($scope,$http,$location){
	var self = this;
	/* ie fix >:( */
	//$location.url('/');

	$scope.savePhone = function(){
		$http.get('members/saveCell/'+$scope.cellNumber).success(function(data) {
			if(data == 'invalid'){
				$('#phoneNotice').fadeOut('slow').html('Invalid Phone Number!');
			}else{
				$('#cellPhone').fadeOut().html('<p class="success">Cell set to <span>'+data+'</span>.</p>').fadeIn('slow');
			}
		});
	}
}


