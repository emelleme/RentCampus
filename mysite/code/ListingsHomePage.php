<?php
class ListingsHomePage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class ListingsHomePage_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	public static $allowed_actions = array (
	);

	public function init() {
		parent::init();
		//add hash bang to end of url
		$a = Director::currentPage();


	}
	
	public function show($arguments) {
		$base = Director::absolutebaseURL();
		$link = $arguments->getURL().'/';
		if($member = Member::currentUser()){
			if ($member->FacebookId != null){
				$token = Session::get('AuthToken');
				$graph_url = "https://graph.facebook.com/me?fields=cover,picture&access_token=" . $token;
				$user = json_decode(file_get_contents($graph_url));
				
				$a = new RestfulService('https://graph.facebook.com/me/rentcampus:view?apartment='.$base.$link.'&access_token='. $token);
		 		$c = $a->request('','POST');//var_dump($c->getBody());
			}
		}
		$id = Director::URLParam('ID');
		$d = DataObject::get_by_id('Unit',$id);
		$d->ThisURL = $base.$link;
		return $this->customise($d)->renderWith('Listing','Listing');
	}
	
	public function share($arguments)
	{
		$base = Director::absolutebaseURL();
		$msg = $arguments->requestVar('msg');
		$link = 'listings/show/'.$arguments->param('ID').'/';
		$sharelink = 'listings/share/'.$arguments->param('ID').'/?msg='.$msg;
		
		if($msg == ''){
			$msg = 'Hey! I just viewed a listing on http://RentCampusOnline.com. Check it out!';
		}
		if($member = Member::currentUser()){
			if ($member->FacebookId != null){
				//Share note to users timeline
				$token = Session::get('AuthToken');
				if($token == null ){
					Director::redirect('https://www.facebook.com/dialog/oauth?client_id=173057479484090&scope=email,sms,offline_access,publish_stream,user_about_me,user_birthday,publish_actions,friends_about_me,friends_actions:rentcampus&redirect_uri='.$base.$sharelink.'&response_type=code%20token');
				}
				$e = new RestfulService('https://graph.facebook.com/me/feed?link='.$base.$link.'&message='.$msg.'&access_token='. $token);
		 		$f = $e->request('','POST');
			}
		}else{
			header('Location:https://www.facebook.com/dialog/oauth?client_id=173057479484090&scope=email,sms,offline_access,publish_stream,user_about_me,user_birthday,publish_actions,friends_about_me,friends_actions:rentcampus&redirect_uri='.$base.$sharelink.'&response_type=code%20token');
				
		}
		Director::redirect($base.$link);
	}
	
	public function none($arguments)
	{
		return '[]';
	}
	
	public function search($arguments)
	{
		$query = Director::URLParam('ID');
		$q = Director::URLParam('OtherID');
		$v = Director::URLParam('AnotherID');
		if($query == 'Bedrooms'){
			$other = "Bathrooms";
		}else{
			$other = "Bedrooms";
		}
		$a = array();
		$d = DataObject::get('Unit',$query." = ".$q." AND ".$other." = ".$v);
		if(!$d){
		return '[]';
		}
		foreach ($d as $data)
		{
			$img = false;
			$images = $data->ListingImages()->getIdList();
			if(!empty($images)){
				$img = $data->getManyManyComponents('ListingImages')->First()->Filename;
			}
			$b = array(
			"id" => $data->ID,
			"title" => $data->Title,
			"price" => "$".$data->Price,
			"snippet" => $data->Description,
			"bedrooms" => $data->Bedrooms,
			"bathrooms" => $data->Bathrooms,
			"img" => $img);
			array_push($a,$b);
		}
		$j = json_encode($a);
		return $j;
	}
	
	public function range($arguments)
	{
		$low = Director::URLParam('ID');
		$high = Director::URLParam('OtherID');
		$a = array();
		$d = DataObject::get('Unit',"Price > ".$low." AND Price < ".$high);
		if(!$d){
		return '[]';
		}
		foreach ($d as $data)
		{
			$img = false;
			$images = $data->ListingImages()->getIdList();
			if(!empty($images)){
				$img = $data->getManyManyComponents('ListingImages')->First()->Filename;
			}
			$b = array(
			"id" => $data->ID,
			"title" => $data->Title,
			"price" => "$".$data->Price,
			"snippet" => $data->Description,
			"bedrooms" => $data->Bedrooms,
			"bathrooms" => $data->Bathrooms,
			"img" => $img);
			array_push($a,$b);
		}
		$j = json_encode($a);
		return $j;
		
	}
	
	public function all($arguments){
		$id = Director::URLParam('ID');
		$d = DataObject::get('Unit',"UnitStatus='Active'",null,null,"30");
		$a = array();
		foreach ($d as $data)
		{
			$img = false;
			$images = $data->ListingImages()->getIdList();
			if(!empty($images)){
				$img = $data->getManyManyComponents('ListingImages')->First()->Filename;
			}
			$b = array(
			"id" => $data->ID,
			"title" => $data->Title,
			"price" => "$".$data->Price,
			"snippet" => $data->Description,
			"bedrooms" => $data->Bedrooms,
			"bathrooms" => $data->Bathrooms,
			"img" => $img,
			"rented" => $data->Rented);
			array_push($a,$b);
		}
		$j = json_encode($a);
		return $j;
		
	}
	
	public function latTest($arguments){
		$a = new RestfulService('http://maps.googleapis.com/maps/api/geocode/json?address=1931 N 7th St+19122&sensor=true');
		$addy = $a->request();
		if($addy->getStatusCode() == 200){
			//Status Good. Parse geocode
			$results = json_decode($addy->getBody());
			$lat = $results->results[0]->geometry->location->lat;
			$lng = $results->results[0]->geometry->location->lng;
			$glatlng = $lat.','.$lng;
			var_dump($results->results[0]->address_components[1]->long_name);
		}
	}
}
