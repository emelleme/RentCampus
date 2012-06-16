<?php

	class ListingAdmin extends ModelAdmin {
    
    public static $managed_models = array(
        'Unit','UnitFeature'
    );
 
    static $url_segment = 'units';
    static $menu_title = 'Listings';
}

?>
