<?php

class Unit extends DataObject{

	public static $db = array(
		"Title" => "Varchar(100)",
		"Featured" => "Boolean",
		"Description" => "Text",
		"Address" => "Varchar(100)",
		"UnitNumber" => "Varchar",
		"ZipCode" => "Varchar",
		"UnitSize" => "Int",
		"PropertyType" => "Enum('Apartment,Condo,Single Family Home,Duplex')",//Make this enum
		"UnitCount" => "Int",//Number of Units at address
		"Neighborhood" => "Varchar(70)",
		"Bedrooms" => "Int",
		"Bathrooms" => "Int",
		"MoveInDate" => "Date",
		"Summary" => "Text",
		"Rented" => "Boolean",
		"UnitStatus" => "Enum('Active,Inactive')",
		"Signage" => "Boolean",
		"Price" => "Decimal",
		"PricePerBedroom" => "Decimal",
		"SecurityDeposit" => "Decimal",
		"FirstMonthRent" => "Decimal",
		"LastMonthRent" => "Decimal",
		"MinimumRentalTerm" => "Varchar",
		"GLatLng" => "Varchar(100)",
		"PricingNote" => "Text" //Back-end note about unit price
	);
	
	static $defaults = array(
		'PropertyType'=>'Apartment',
		'Price' => '0.00',
		'PricePerBedroom' => '0.00',
		'SecurityDeposit' => '0.00',
		'FirstMonthRent' => '0.00',
		'LastMonthRent' => '0.00',
		'UnitStatus' => 'Active'
	);
	
	function canEdit($member = null){
		if(permission::check('ADMIN')){
		    return true;
		}else{
		    return false;
		}
	}

	public static $has_one = array(
		"LeaseDoc" => "File",
		"GuaranteeofLease" => "File"
	);

	public static $many_many = array(
		'ListingImages' => 'Image',
		'Amenities' => 'Amenity',
		'Utilities' => 'Utility',
		'MemberFavorites' => 'Member'
	);
	
	static $summary_fields = array(
		'Title' => 'Title',
		'UnitStatus' => 'Unit Status'
	);
	
	//The class of the page which will list this DataObject
    static $listing_class = 'ListingPage';
    //Class Naming (optional but reccomended)
    static $plural_name = 'Units';
    static $singular_name = 'Unit';
    
    public function onBeforeWrite(){
    	if(!$this->record['GLatLng'] || !$this->record['Neighborhood']) {
    		//Get Latitude and Longitude
    		$a = new RestfulService('http://maps.googleapis.com/maps/api/geocode/json?address='.$this->record['Address'].'+'.$this->record['ZipCode'].'&sensor=true');
		$addy = $a->request();
		if($addy->getStatusCode() == 200){
			//Status Good. Parse geocode
			$results = json_decode($addy->getBody());
			$lat = $results->results[0]->geometry->location->lat;
			$lng = $results->results[0]->geometry->location->lng;
			$glatlng = $lat.','.$lng;
			$n = $results->results[0]->address_components[1]->long_name;
			$this->record['GLatLng'] = $glatlng;
			$this->record['Neighborhood'] = $n;
		}
	 	}
 	parent::onBeforeWrite();
    }
    
    public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->renameField('Content','Full Description');
		$f->removeFieldFromTab('Root.Main','Neighborhood');
		$f->addFieldToTab('Root.AddressInfo', new TextField('Address', 'Address'));
 		$f->addFieldToTab('Root.AddressInfo', new TextField('UnitNumber', 'Unit Number'));
 		$f->addFieldToTab('Root.AddressInfo', new TextField('ZipCode', 'ZipCode'));
 		
 		// get all existing features
        $tags= DataObject::get('Amenity',null);
        if (!empty($tags)) {
        	// create an array('ID'=>'Name')
            $map = $tags->toDropdownMap('ID', 'Name');
            
            // create a Checkbox group based on the array
            $f->addFieldToTab('Root.Amenities',
                new CheckboxSetField(
                    $name = "Amenities",
                    $title = "Select Amenities",
                    $source = $map
            ));
        }
        
        // get all existing features
        $util= DataObject::get('Utility',null);
        if (!empty($util)) {
        	// create an array('ID'=>'Name')
            $map = $util->toDropdownMap('ID', 'Name');
            
            // create a Checkbox group based on the array
            $f->addFieldToTab('Root.Utilities',
                new CheckboxSetField(
                    $name = "Utilities",
                    $title = "Select Utilities",
                    $source = $map
            ));
        }
 		
 		$f->addFieldToTab("Root.ListingImages", new MultipleFileAttachmentField('ListingImages','Listing Images'));
 		
 		$f->addFieldToTab('Root.UnitInfo', new TextField('Bedrooms','Number of Bedrooms'));
 		$f->addFieldToTab('Root.UnitInfo', new TextField('Bathrooms','Number of Bathrooms'));
 		$f->addFieldToTab('Root.UnitInfo', new TextField('UnitSize', 'Square Feet (e.g. 650)'));
 		$f->addFieldToTab('Root.UnitInfo', new DropDownField('PropertyType','PropertyType',singleton('Unit')->dbObject('PropertyType')->enumValues()));
 		$f->addFieldToTab('Root.UnitInfo', new TextField('UnitCount', 'Number of Units Available'));
 		$f->addFieldToTab('Root.UnitInfo', new TextField('MinimumRentalTerm', 'Minimum Rental Term'));
 		
 		$f->addFieldToTab('Root.Pricing', new TextField('Price','Price'));
 		$f->addFieldToTab('Root.Pricing', new TextField('PricePerBedroom'));
 		$f->addFieldToTab('Root.Pricing', new TextField('SecurityDeposit'));
 		$f->addFieldToTab('Root.Pricing', new TextField('FirstMonthRent'));
 		$f->addFieldToTab('Root.Pricing', new TextField('LastMonthRent'));
 		$f->addFieldToTab('Root.Pricing', new TextAreaField('PricingNote','Additional Notes about Pricing'));
 		
 		$date = new DateField('MoveInDate'); $date->setLocale('en_US'); $date->setConfig('showcalendar',true);
 		$f->addFieldToTab('Root.Main', new TextAreaField('Summary','Summary'),'Content');
 		$f->addFieldToTab('Root.Main', $date,'Content');
 		
 		$f->addFieldToTab('Root.Files', new FileAttachmentField('LeaseDoc','Lease Document'));
 		$f->addFieldToTab('Root.Files', new FileAttachmentField('GuaranteeofLease','Guarantee of Lease Document'));
 		
		return $f;
	}
}
