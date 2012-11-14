<?php
class HomePage extends Page {

	public static $db = array(
	);
	
	public static $has_one = array(
	);

	public static $many_many = array(
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		return $fields;
	}

}
class HomePage_Controller extends Page_Controller {

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

	}
	
	public function listingsLocations($arguments){
		
		$addys = DataObject::get('Unit','Rented = 0');
		$data = array();
		foreach ($addys as $d)
		{
			//Add total weight and coordinates
			$lng = substr(strstr($d->GLatLng,','),1);
			$lat = strstr($d->GLatLng,',',true);
			$a = array(
				"id" => $d->ID,
				"lat" => $lat,
				"lng" => $lng,
				"weight" => $d->Bedrooms + 1
			);
			array_push($data, $a);
		}
		return json_encode($data);
	}
	
	public function listingsSearch($arguments){
		$loc = str_replace(" ","",$arguments->requestVar('center'));
		$loc = (strstr($loc, '(')) ? $loc = substr($loc,1,(strlen($loc) - 2)) : $loc;
		$lng = substr(strstr($loc,','),1);
		$lat = strstr($loc,',',true);
		$sqlQuery = new SQLQuery();
		$sqlQuery->select = array(
		  '( 3959 * acos( cos( radians('.$lat.') ) * cos( radians( Lat ) ) * cos( radians( Lng ) - radians('.$lng.') ) + sin( radians('.$lat.') ) * sin( radians( Lat ) ) ) ) AS distance',
		  'Description',
		  'ZipCode As Zip',
		  'Title',
		  'Price',
		  'Bedrooms',
		  'Lat',
		  'Lng',
		  'ID'
		);
		$sqlQuery->from = array("Unit");
		$r = 3000;
		$radius = $r / 5280;
		$sqlQuery->having = array("distance < ".$radius);
		$sqlQuery->orderby = "distance";
		$rawSQL = $sqlQuery->sql();
		$result = $sqlQuery->execute();
		$hasResults= false;
		//var_dump($result);
		$results = new DataObjectSet();
		$data = array();
		foreach($result as $row) {
			//var_dump($row);
			$beds = ($row['Bedrooms'] == -1) ? 'studio' : $row['Bedrooms'].' bedrooms';
			$a = array(
				"title" => $row['Title'],
				"lat" => $row['Lat'],
				"lng" => $row['Lng'],
				"price" => $row['Price'],
				"id" => $row['ID'],
				"bedrooms" => $beds,
				"imgurl" => 'assets/large-default.jpg'
			);
			array_push($data, $a);
		}
		
		return json_encode($data);
	}
	
	public function FeaturedListings()
	{
		$d = DataObject::get('Unit','Featured = true');
		return $d;
	}
}
