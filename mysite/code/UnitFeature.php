<?php

class UnitFeature extends DataObject {
	static $db = array(
		'name' => 'Varchar(65)',
		'description' => 'Text'
	);
	static $belongs_many_many = array(
		'Units' => 'Unit'
	);
	
	static $summary_fields = array(
		'name'
	);
	
	static $api_access = true;
	
	public function getCMSFields()
	{
	    return new FieldSet(
			new TextField('name', 'Feature Name'),
			new TextAreaField('description', 'Description')
		);
	}

}
