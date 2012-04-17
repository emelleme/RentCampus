<?php

class Unit extends DataObjectAsPage{

	public static $db = array(
		"Address" => "Varchar(100)",
		"UnitNumber" => "Varchar",
		"ZipCode" => "Varchar",
		"UnitSize" => "Int",
		"PropertyType" => "Enum('Apartment,Condo,Single Family Home,Duplex')",//Make this enum
		"UnitCount" => "Int",//Number of Units at address
		#"Neighborhood" => "Varchar(70)",
		"Bathrooms" => "Varchar",
		"MoveInDate" => "Date",
		"Summary" => "Text",
		"Rented" => "Boolean",
		"UnitStatus" => "Enum('Active,Inactive')",
		"Price" => "Decimal",
		"PricePerBedroom" => "Decimal",
		"SecurityDeposit" => "Decimal",
		"FirstMonthRent" => "Decimal",
		"LastMonthRent" => "Decimal",
		"PricingNote" => "Text" //Back-end note about unit price
	);
	
	static $defaults = array(
		'PropertyType'=>'Apartment',
		'Price' => '0.00',
		'PricePerBedroom' => '0.00',
		'SecurityDeposit' => '0.00',
		'FirstMonthRent' => '0.00',
		'LastMonthRent' => '0.00'
	);

	public static $has_one = array(
		"LeaseDoc" => "File",
		"GuaranteeofLease" => "File"
	);

	public static $has_many = array(
		"Photos" => "Image"
	);
	
	static $summary_fields = array(
		'Rented' => 'Rented',
		'UnitStatus' => 'UnitStatus'
	);
	
	//The class of the page which will list this DataObject
    static $listing_class = 'ListingPage';
    //Class Naming (optional but reccomended)
    static $plural_name = 'Units';
    static $singular_name = 'Unit';
    
    public function getCMSFields() {
		$f = parent::getCMSFields();
		$f->renameField('Content','Full Description');
		$f->addFieldToTab('Root.AddressInfo', new TextField('Address', 'Address'));
 		$f->addFieldToTab('Root.AddressInfo', new TextField('UnitNumber', 'Unit Number'));
 		$f->addFieldToTab('Root.AddressInfo', new TextField('ZipCode', 'ZipCode'));
 		
 		$f->addFieldToTab('Root.UnitInfo', new TextField('UnitSize', 'Unit Size (e.g. 650)'));
 		$f->addFieldToTab('Root.UnitInfo', new DropDownField('PropertyType','PropertyType',singleton('Unit')->dbObject('PropertyType')->enumValues()));
 		$f->addFieldToTab('Root.UnitInfo', new TextField('UnitCount', 'Number of Units Available'));
 		$f->addFieldToTab('Root.UnitInfo', new TextField('UnitStatus'));
 		$f->addFieldToTab('Root.UnitInfo', new TextField('Bathrooms','Number of Bathrooms'));
 		
 		$f->addFieldToTab('Root.Pricing', new TextField('Price','Price'));
 		$f->addFieldToTab('Root.Pricing', new TextField('PricePerBedroom'));
 		$f->addFieldToTab('Root.Pricing', new TextField('SecurityDeposit'));
 		$f->addFieldToTab('Root.Pricing', new TextField('FirstMonthRent'));
 		$f->addFieldToTab('Root.Pricing', new TextField('LastMonthRent'));
 		$f->addFieldToTab('Root.Pricing', new TextAreaField('PricingNote','Additional Notes about Pricing'));
 		
 		$date = new DateField('MoveInDate'); $date->setLocale('en_US'); $date->setConfig('showcalendar',true);
 		$f->addFieldToTab('Root.Main', new TextAreaField('Summary','Summary'),'Content');
 		$f->addFieldToTab('Root.Main', $date,'Content');
 		
 		$f->addFieldToTab('Root.Files', new FileIframeField('LeaseDoc','Lease Document'));
 		$f->addFieldToTab('Root.Files', new FileIframeField('GuaranteeofLease','Guarantee of Lease Document'));
 		
 		
		return $f;
	}
}
