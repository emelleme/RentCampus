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
		$id = Director::URLParam('ID');
		$d = DataObject::get_by_id('Unit',$id);
		return $this->customise($d)->renderWith('Listing','Listing');
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
			 $img = $data->getManyManyComponents('ListingImages')->First()->Filename;
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
			 $img = $data->getManyManyComponents('ListingImages')->First()->Filename;
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
		$d = DataObject::get('Unit');
		$a = array();
		foreach ($d as $data)
		{
			 $img = $data->getManyManyComponents('ListingImages')->First()->Filename;
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
}
