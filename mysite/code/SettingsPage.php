<?php

class SettingsPage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class SettingsPage_Controller extends Page_Controller {
	public static $allowed_actions = array (
		'group',
		'save',
		'saveCell'
	);
	
	public function init() {
		parent::init();
		$token = Session::get('AuthToken');
		if($token==''){
			Director::redirect('/Security/login');
			exit;
		}
		if(!$member = Member::currentUser()){
			Director::redirect('/Security/login?backUrl=settings');
		}
		$graph_url = "https://graph.facebook.com/me?fields=cover,picture&access_token=" . $token;
		$user = json_decode(file_get_contents($graph_url));
		$member->Avatar = $user->picture;
		/*$member->CoverPhotoa = new GD($user->cover->source);
		$folder = $this->ParentID ? $this->Parent()->Filename : ASSETS_DIR . "/"; 
		$member->CoverPhoto = ASSETS_DIR ."/coverphotos/" . $member->FacebookId.".jpg";
		$member->CoverPhotoa->resizeByWidth(626)->crop($user->cover->offset_y+75,0,626,160)->writeTo(Director::baseFolder(). '/' .$member->CoverPhoto);
		*/
		//var_dump($member->CoverPhotoa->hasGD());	
	}
	
	public function index($arguments)
	{
		if(!$member = Member::currentUser()){
			Director::redirect('/Security/login?backUrl=settings');
		}
		if($member->inGroup(8)){ //Landlords
			$member->GroupName = DataObject::get_by_id('Group',8)->Title;
			return $this->renderWith(array('LandLord','SettingsPage'));
		}else if($member->inGroup(5)){ //Potential Tenant
			$member->GroupName = DataObject::get_by_id('Group',5)->Title;
			return $this->renderWith(array('PotentialTenant','SettingsPage'));
		}else if($member->inGroup(3)){ //Current Tenant
			$member->GroupName = DataObject::get_by_id('Group',3)->Title;
			return $this->renderWith(array('CurrentTenant','SettingsPage'));
		}else if($member->inGroup(11)){ //Community Member
			$member->GroupName = DataObject::get_by_id('Group',11)->Title;
			return $this->renderWith(array('CommunityMember','SettingsPage'));
		}else if($member->inGroup(6)){ //Community Member
			Director::redirect('/admin');
		}else{
			return $this->renderWith(array('NewMember','SettingsPage'));
		}
	}
	
	public function group($arguments){
		$member = Member::currentUser();
		//Show Member Group Selection form
		
		return $this->renderWith(array('NewMember','SettingsPage'));
	}
	
	public function save($arguments){
		$member = Member::currentUser();
		//Save to database
		$id = $arguments->param('ID');
		if($id == 'group'){
			//Update Group
			$ut = $arguments->requestVar('userType');
			if($ut == 'landlord'){
				//Add to LandLord Group
				$member->Groups()->removeAll();
				$member->Groups()->addManyByGroupID(array(9));
			}else if($ut == 'potential'){
				$member->Groups()->removeAll();
				$member->Groups()->addManyByGroupID(array(5));
			}else if($ut == 'current'){
				$member->Groups()->removeAll();
				$member->Groups()->addManyByGroupID(array(3));
			}else if($ut == 'community'){
				$member->Groups()->removeAll();
				$member->Groups()->addManyByGroupID(array(11));
			}
		}
		Director::redirect('/members');
	}
	
	public function saveCell($arguments){
		$member = Member::currentUser();
		if(!$member = Member::currentUser()){
			Director::redirect('/Security/login');
			exit;
		}
		$id = Director::URLParam('ID');
		$phone = $this->validate_usphone($id);
		if($phone){
			$member->MobilePhoneNumber = $id;
			$member->write();
			return $phone;
		}else{
			return 'invalid';
		}
	}
	
	private function validate_usphone($phonenumber,$useareacode=true)
	{
		if ( preg_match("/^[ ]*[(]{0,1}[ ]*[0-9]{3,3}[ ]*[)]{0,1}[-]{0,1}[ ]*[0-9]{3,3}[ ]*[-]{0,1}[ ]*[0-9]{4,4}[ ]*$/",$phonenumber) || (preg_match("/^[ ]*[0-9]{3,3}[ ]*[-]{0,1}[ ]*[0-9]{4,4}[ ]*$/",$phonenumber) && !$useareacode)) return eregi_replace("[^0-9]", "", $phonenumber);
		return false;
	}
}
