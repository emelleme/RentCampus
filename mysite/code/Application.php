<?php

class Application extends DataObject {

	public static $db = array(
		"PropertyId" => "Varchar(100)",
		"PropertyName" => "Text",
		"PropertyUnit" => "Varchar",
		"Deposit" => "Currency",
		"Fee" => "Currency",
		"MoveInDate" => "Date",
		"Notes" => "Text",
		"Status" => "Text"
	);
	
	public static $has_one = array(
		'Member' => 'Member'
	);
	
	public static $many_many = array(
	);

}

?>
