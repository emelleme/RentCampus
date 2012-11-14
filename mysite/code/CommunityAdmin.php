<?php

	class CommunityAdmin extends ModelAdmin {
    
    public static $managed_models = array(
        'Category','Post'
    );
 
    static $url_segment = 'posts';
    static $menu_title = 'Community';
}

?>
