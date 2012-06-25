<?php

class SignupPage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class SignupPage_Controller extends Page_Controller {
	public static $allowed_actions = array (
	);

	public function init() {
		parent::init();
	}
	
	public function saveAuthToken(){
		$token = $this->request['token'];
		$auth = explode("=",$token);
		Session::set('AuthToken',$auth[1]);
		echo $auth[1];
	}
	
	public function index(){
		// Check to see if Current Member is logged in
		
		$token = Session::get('AuthToken');
		if($token==''){
			Director::redirect('/Security/login');
			exit;
		}
		
		//First lets check to see if there is a user logged in
		if($m = Member::currentUser()){
			//Member is already logged in. Are they a Facebooker?
			if(empty($m->FacebookId)){
				Director::redirect('/admin');
			}else{
				$this->goToSettings();
			}
		}else{
		// User not logged in
			$graph_url = "https://graph.facebook.com/me?access_token=" . $token;
			$user = json_decode(file_get_contents($graph_url));
			$member = DataObject::get_one('Member', "FacebookId = '".$user->id."'"); ;
			if($member){
				$member->logIn();
				Director::redirect("/settings");
			}else{
				//New Member. Get Member info and create record
				if(!$token){
					Director::redirect('/');
				}
				//New User. Add Record to database
				$m = new Member();
				$m->FacebookId = $user->id;
				$m->FirstName = $user->first_name;
				$m->Surname = $user->last_name;
				$m->Username = @$user->username;
				$m->FacebookLink = $user->link;
				$m->FacebookLocale = $user->locale;
				$m->Fullname = $user->name;
				$m->FacebookTimezone = $user->timezone;
				$m->Gender = @$user->gender;
				$m->Email = (!@empty($user->email)) ? $user->email : $user->id;
				$m->write();
				$m->addToGroupByCode('weightwatchr', 'WeightWatchr');
				$m->write();
				$m->logIn();
			
				//var_dump($user);
				//exit;
				Director::redirect('/settings');
			}
		}
	}
	
	public function goToSettings(){
		$token = Session::get('AuthToken');
		if($token==''){
			Director::redirect('/Security/login');
			exit;
		}
		$graph_url = "https://graph.facebook.com/me?access_token=" . $token;
		$user = json_decode(file_get_contents($graph_url));
		$member = DataObject::get_one('Member', "FacebookId = '".$user->id."'"); ;
		if($member){
			$member->logIn();
			Director::redirect("/settings");
		}else{
			//New Member. Get Member info and create record
			if(!$token){
				Director::redirect('/');
			}
			//New User. Add Record to database
			$m = new Member();
			$m->FacebookId = $user->id;
			$m->FirstName = $user->first_name;
			$m->Surname = $user->last_name;
			$m->Username = @$user->username;
			$m->FacebookLink = $user->link;
			$m->FacebookLocale = $user->locale;
			$m->Fullname = $user->name;
			$m->FacebookTimezone = $user->timezone;
			$m->Gender = @$user->gender;
			$m->Email = (!@empty($user->email)) ? $user->email : $user->id;
			$m->write();
			//$m->addToGroupByCode('weightwatchr', 'WeightWatchr');
			$m->write();
			$m->logIn();
			
			//var_dump($user);
			//exit;
			Director::redirect('/settings');
		}
	}
	
	public function go(){
	//Session::clear_all();
		//Check Request Variable
		
			//Code value sent. Get auth token, and create new user.
		$token = Session::get('AuthToken');
		//get token from url hash
		return $this->renderWith('FbAuthenticate');
	}
}
