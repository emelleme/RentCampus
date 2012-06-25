<?php

class CanvasPage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class CanvasPage_Controller extends Page_Controller {
	public static $allowed_actions = array (
	);
	
	public function init() {
		parent::init();
		
	}

	public function index($arguments){
		// Note: you should use SS template require tags inside your templates 
		// instead of putting Requirements calls here.  However these are 
		// included so that our older themes still 
		$vars = $arguments->requestVars();
			//Code value sent. Get auth token, and create new user.
		
		$app_id = "173057479484090";
		$app_secret = "a1493a7bf12c3d5e8129ceb5408ce61d";
		$my_url = "http://dev.rent-campus.com/canvas/";

		//session_start();
		$code = @$_REQUEST["code"];

		if(empty($code)) {
		 $_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
		 $dialog_url = "http://www.facebook.com/dialog/oauth?client_id=" 
		   . $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
		   . $_SESSION['state'] . '&scope=user_about_me,user_education_history,publish_stream,publish_actions,status_update,friends_about_me,friends_actions:rentcampus';

		 echo("<script> top.location.href='" . $dialog_url . "'</script>");
		}

		
		 $token_url = "https://graph.facebook.com/oauth/access_token?"
		   . "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
		   . "&client_secret=" . $app_secret . "&code=" . $code;

		 $response = file_get_contents($token_url);
		 $params = null;
		 parse_str($response, $params);

		 $graph_url = "https://graph.facebook.com/me?access_token=" 
		   . $params['access_token'];
		$_SESSION['access_token'] = $params['access_token'];
		 $user = json_decode(file_get_contents($graph_url));
		 //var_dump($user);
		 //Check to see if user is in database
		 $d = DataObject::get_one('Member', "Email='".$user->id."'");
			 if(!$d){
			 	var_dump('not a member');
			 	exit;
			 }else{
			 	$d->logIn();
			 }
		 	
		 	//Spread Love, thats the brooklyn way
		 	/*$a = new RestfulService('https://graph.facebook.com/me/snaxmag:love?art=http://www.snaxmagazine.com&access_token='. $params['access_token']);
		 	$c = $a->request('','POST');
		 	$e = new RestfulService('https://graph.facebook.com/me/feed?link=http://www.snaxmagazine.com/app&name=SNAX Magazine&picture=http://www.snaxmagazine.com/themes/gallery/images/logoface.jpg&message=Pre-Order your copy of SNAX Magazine today!&description=Snax magazine brings artists together to tell a story through their art.  Each issue centers around a theme that can be represented and cultivated in limitless ways.&access_token='. $params['access_token'],20);
		 	$f = $e->request('','POST'); */
		 	//var_dump($c->getBody());
		 	$data = array('UserInfo'=>$user);
			Director::redirectBack();
	}
}
