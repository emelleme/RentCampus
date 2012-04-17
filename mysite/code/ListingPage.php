<?php

	#doc
	#	classname:	ListingPage
	#	scope:		PUBLIC
	#
	#/doc
	
	class ListingPage extends DataObjectasPageHolder
	{
		#	internal variables
		
		static $item_class = 'Unit';
		//Set the sort for the items (defaults to Created DESC)
		static $item_sort = 'Title ASC';
		###	
	
	}
	###

?>
