<?php

class RCImport extends Controller {
	private $sfdatabaseconfig = array(
		"type" => 'MySQLDatabase',
		"server" => 'localhost',
		"username" => 'root',
		"password" => 'd3v-R3ntcampus',
		"database" => 'rentcampus_old'
	);

	private $tables = array(
	"units"=>"units",
	"units_photos","units_types","units_sizes","units_utilities","unit_videos","units_amenities","units_features",
	);

    public function index($arguments) {
    	global $databaseConfig,$sfdatabaseconfig;
    	$a = $this->tables;
    	//$$a="test";
		DB::connect($sfdatabaseconfig);
		$t = new DataObjectSet();

		//First create the units
		$unit = $a['units'];
		$query = new SQLQuery("*","units");

		//$query = new SQLQuery("*","units 
		//	zxINNER JOIN units_amenities ON units_amenities.unitid = units.id","");
		$units = $query->execute();
		//var_dump($units);
		DB::connect($databaseConfig);
		foreach ($units as $u) {
			//var_dump($u);
			
			# Create a new Unit for each old Unit
			//var_dump($u);
			
			$dtest = DataObject::get('Unit',"OldID = ".$u['id']);
			if ($dtest) {
				continue;
			}
			$b = new Unit();
			$b->Title = $u['unitname'];
			$b->Description = $u['description'];
			$b->Address = $u['address'];
			$b->UnitNumber = $u['address2'];
			$b->ZipCode = $u['zip'];
			$b->Price = $u['price'];
			$b->PricePerBedroom = $u['priceperbedroom'];
			$b->SecurityDeposit = $u['securitydeposit'];
			$b->FirstMonthRent = $u['firstmonths'];
			$b->LastMonthRent = $u['lastmonths'];
			$b->Rented = $u['rented'];
			$b->FirstMonthRent = $u['firstmonths'];
			$b->UnitStatus = ($u['active'] == 1) ? 'Active' : 'Inactive' ;
			switch ($u['unitsizeid']) {
				case '3':
					$b->Bedrooms = 1;
					break;
				case '4':
					$b->Bedrooms = 2;	
					break;
				case '5':
					$b->Bedrooms = 3;	
					break;
				case '6':
					$b->Bedrooms = 4;	
					break;
				case '7':
					$b->Bedrooms = 5;	
					break;
				case '8':
					$b->Bedrooms = 6;	
					break;
				case '9':
					$b->Bedrooms = 7;	
					break;
				case '10':
					$b->Bedrooms = 8;	
					break;
				case '11':
					$b->Bedrooms = 9;	
					break;
				case '12':
					$b->Bedrooms = -1;	
					break;
				case '13':
					$b->Bedrooms = 0;	
					break;
				default:
					$b->Bedrooms = 1;
					break;
			}
			$b->Bathrooms = $u['bathrooms'];
			$b->PropertyType = 'Apartment';
			if($u['lat']){
			$b->GLatLng = $u['lat'].','.$u['lng'];
			}
			$b->OldID = $u['id'];
			/* Select all units_phots where unitid = $u['id'] returns filename
			query  */
			//$b->;

			
			$b->write();

		}

		// Select all units that were just created
		$newunits = DataObject::get("Unit","OldID <> 0");
		/*foreach ($newunits as $new) {
			//Strip HTML Tags
			$new->Description = html_entity_decode($new->Description);
			$new->write();
			var_dump("Tags Stripped");
		}

		foreach ($newunits as $new) {
			DB::connect($sfdatabaseconfig);
			$query = new SQLQuery("*","units_features","unitid = ".$new->OldID);
			$amen = $query->execute();

			DB::connect($databaseConfig);
			foreach ($amen as $c) {
				//Check to see if amenity exists
				$am = DataObject::get_one("Amenity","Name = '".$c['title']."'");
				if(!$am){
					//Create new Amenity
					$am = new Amenity();
					$am->Name = $c['title'];
					$am->Description = $c['title'];
					$am->write();
				}
				$allams = $new->Amenities();
				$allams->add($am);
				var_dump($am->Name);
			}
		}
		foreach ($newunits as $new) {
			DB::connect($sfdatabaseconfig);
			$query = new SQLQuery("*","units_utilities","unitid = ".$new->OldID.' AND included = 1');
			$amen = $query->execute();

			DB::connect($databaseConfig);
			foreach ($amen as $c) {
				//Check to see if amenity exists
				$am = DataObject::get_one("Utility","Name = '".$c['title']."'");
				if(!$am){
					//Create new Amenity
					$am = new Utility();
					$am->Name = $c['title'];
					$am->Description = $c['title'];
					$am->write();
				}
				$allams = $new->Utilities();
				$allams->add($am);
				var_dump($am->name);
			}
		}

		//Get Images
		foreach ($newunits as $new) {
			DB::connect($sfdatabaseconfig);
			$query = new SQLQuery("*","units_photos","unitid = ".$new->OldID);
			$photos = $query->execute();

			DB::connect($databaseConfig);
			foreach ($photos as $c) {
				//Check to see if amenity exists
				$am = DataObject::get_one("File","Name = '".$c['filename']."_lg.jpg'");
				if($am){
					$allams = $new->ListingImages();
					$allams->add($am);
					var_dump($am->Name);
				}
			}
		}*/
		exit;
    	
    	//Connect to simpleforum database
    	header('Content-Type: text/plain;encoding=utf-8');
        return $this->customise($data)->renderWith('SFImporter');
    }
    
    public function getData($tablename){
    	$b = $tablename;
    	//foreach($a as $b){
			//$$b = new DataObjectSet();
			$query = new SQLQuery("*", $b);
			$result = $query->execute();
			$entries = new DataObjectSet();
			foreach($result as $row) {
				$xml ='';
				$columns = array_keys($row);
				foreach($columns as $key=>$column){
					if($column == 'post_content' || $column == 'option_value'){
						$xml .= "<".$column."><![CDATA[\n".htmlentities(urlencode($row[$column]))."\n]]></".$column.">";
						$xml .= "\n";
					}else{
						$xml .= "<".$column.">".$row[$column]."</".$column.">";
						$xml .= "\n";
					}
				}
				//Push The XML onto the stack as an entry
			  	//var_dump($xml);
			  	$entry = array(
			  		"Entries" => $xml
			  	);
			  	$entries->push(new ArrayData($entry));
			//}
			}
			//Render Template
			return $entries;
    }
}