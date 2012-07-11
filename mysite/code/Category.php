<?php

class Category extends DataObject {

	public static $db = array(
		"Name" => "Varchar(100)",
		"Description" => "Text",
	);
	
	public static $has_many = array(
		'Posts' => 'Post'
	);

}

?>