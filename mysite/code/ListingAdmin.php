<?php

	class ListingAdmin extends DataObjectAsPageAdmin {
    
    public static $managed_models = array(
        'Unit'
    );
 
    static $url_segment = 'units';
    static $menu_title = 'Listings';
}

?>
