<?php

class Post extends DataObject {

	public static $db = array(
		"Title" => "Varchar(100)",
		"Content" => "Text",
	);
	
	public static $has_one = array(
		'Category' => 'Category',
		'Owner' => 'Member'
	);
	
	public static $many_many = array(
		'FavoritedBy' => 'Member'
	);

}

?>