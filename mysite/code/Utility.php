<?php

class Utility extends DataObject {
	static $db = array(
		'Name' => 'Varchar(65)',
		'Description' => 'Text'
	);
	static $belongs_many_many = array(
		'Units' => 'Unit'
	);
	
	static $summary_fields = array(
		'Name'
	);
	
	static $api_access = true;
	
	public function getCMSFields()
	{
	    return new FieldSet(
			new TextField('Name', 'Feature Name'),
			new TextAreaField('Description', 'Description')
		);
	}

}
