<?php
class Listing extends Page {

	public static $db = array(
		'VideoLink' => 'Varchar'
	);
	
	public static $has_one = array(
		'VideoThumbnail' => 'Image',
		'Unit' => 'Unit'
	);

	public static $many_many = array(
	);
	
	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->addFieldToTab("Root.Content.Images", new MultipleFileAttachmentField('ListingImages','Listing Images'));
		$fields->addFieldToTab("Root.Content.Video", new HeaderField('VideoHeader','Listing Video'));
		$fields->addFieldToTab("Root.Content.Video", new TextField('VideoLink','Video Link'));
		$fields->addFieldToTab("Root.Content.Video", new FileAttachmentField('VideoThumbnail','Upload a thumbnail for the video'));
		return $fields;
	}

}
class Listing_Controller extends Page_Controller {

	/**
	 * An array of actions that can be accessed via a request. Each array element should be an action name, and the
	 * permissions or conditions required to allow the user to access it.
	 *
	 * <code>
	 * array (
	 *     'action', // anyone can access this action
	 *     'action' => true, // same as above
	 *     'action' => 'ADMIN', // you must have ADMIN permissions to access this action
	 *     'action' => '->checkAction' // you can only access this action if $this->checkAction() returns true
	 * );
	 * </code>
	 *
	 * @var array
	 */
	public static $allowed_actions = array (
		'latTest'
	);

	public function init() {
		parent::init();

	}
	
	
}
