<?php
/**
 * ForumRole
 *
 * This decorator adds the needed fields and methods to the {@link Member}
 * object.
 *
 * @package forum
 */
class PotentialMemberRole extends DataObjectDecorator {

	/**
	 * Define extra database fields
	 *
	 * Return an map where the keys are db, has_one, etc, and the values are
	 * additional fields/relations to be defined
	 */
	public function extraStatics($class = null, $extension = null) {
		$fields = array(
			'db' => array(
				'HomePhoneNumber' => 'Varchar',
				'MobilePhoneNumber' => 'Varchar',
				'MobilePhoneNumber' => 'Varchar',
				'LicenseNumber' => 'Varchar',
				'Social' => 'Varchar',
				'Address' => 'Varchar(100)',
				'Address2' => 'Varchar',
				'City' => 'Varchar',
				'State' => 'Varchar',
				'ZipCode' => 'Varchar',
				'MethodofContact' => "Enum('Cell,Home,Work,Email')",
				'pin' => 'Varchar(6)'
			),
			'belongs_many_many' => array(
				'FavoriteListings' => 'Unit'
			)
		);
		
		return $fields;
	}
	
	public function updateCMSFields(FieldSet $fields) {
		//$allForums = DataObject::get('Forum');
		 if(Permission::checkMember($this->owner->ID, "POTENTIAL_RESIDENT")) {
			$fields->addFieldToTab('Root.Address', new TextField('Address','Address'));
			$fields->addFieldToTab('Root.Address', new TextField('Address2','Address 2'));
			$fields->addFieldToTab('Root.Address', new TextField('City','City'));
			$fields->addFieldToTab('Root.Address', new TextField('State','State'));
			$fields->addFieldToTab('Root.Address', new TextField('ZipCode','Zip Code'));
		}
		//$fields->removeByName('pin');
		
	}
	
	public function updateFrontEndFields(FieldSet $fields) {
		$fields->removeByName('pin');
		$fields->removeByName('Password');
		$fields->removeByName('Email');
		$fields->removeByName('Locale');
		$fields->removeByName('DateFormat');
		$fields->removeByName('TimeFormat');
		$fname = new TextField('FirstName','First Name');
		$fname->setAttribute('placeholder','First Name');
		$fields->push($fname);
		
		$fname = new TextField('Surname','Last Name');
		$fname->setAttribute('placeholder','Last Name');
		$fields->push($fname);
		
		$phone = new TextField('PhoneNumber','Phone Number');
		$phone->setAttribute('placeholder','Messages will be sent here.');
		$fields->push($phone);
		
	}
}
