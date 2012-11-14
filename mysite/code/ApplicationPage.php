<?php
class ApplicationPage extends Page {

	public static $db = array(
	);

	public static $has_one = array(
	);

}
class ApplicationPage_Controller extends Page_Controller {

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
	);
	
	protected static $docuSignAPIKey = "";
	
	protected static $docuSignUser = "";
	
	protected static $docuSignPassword = "";
	
	protected static $docuSignIntegratorKey = "";

	protected static $docuSignTemplateId = "";
	
	protected static $docuSignBaseURL = "https://demo.docusign.net/restapi/v2/";
	
	/**
    * Get the DocuSign Base URL
    *
    * @return string DocuSign Base URL
    **/
	public static function getDocuSignTemplateId(){
		return self::$docuSignTemplateId;
	}

	/**
    * Get the DocuSign Base URL
    *
    * @return string DocuSign Base URL
    **/
	public static function getDocuSignBaseURL(){
		return self::$docuSignBaseURL;
	}
	
	/**
    * Get the DocuSign API Key
    *
    * @return string DocuSign API Key
    **/
	public static function getDocuSignAPIKey(){
		return self::$docuSignAPIKey;
	}
	
	/**
    * Get the DocuSign Username
    *
    * @return string DocuSign Username
    **/
	public static function getDocuSignUser(){
		return self::$docuSignUser;
	}
	
	/**
    * Get the DocuSign Password
    *
    * @return string DocuSign Password
    **/
	public static function getDocuSignPassword(){
		return self::$docuSignPassword;
	}
	
	/**
    * Get the DocuSign Integrator Key
    *
    * @return string Integrator Key
    **/
	public static function getDocuSignIntegratorKey(){
		return self::$docuSignIntegratorKey;
	}
	
	/**
    * Set the DocuSign Credentials
    *
    * @param string $oath_token   OAuth Token
    * @param string $oath_token_secret OAuth Token Secret
    */   
	public static function setDocuSignCredentials($apikey, $username, $pass, $integratorkey){
	 	self::$docuSignAPIKey = $apikey;
	 	self::$docuSignUser = $username;
	 	self::$docuSignPassword = $pass;
	 	self::$docuSignIntegratorKey = $integratorkey;
 	}

 	/**
    * Set the DocuSign Credentials
    *
    */   
	public static function setDocuSignTemplateId($templateid){
	 	self::$docuSignTemplateId = $templateid;
 	}

	public function checkMember(){
		$member = (Member::currentUser()) ? Member::currentUser() : false;
		return $member;
	}

	public function init() {
		parent::init();
		
		// Note: you should use SS template require tags inside your templates 
		// instead of putting Requirements calls here.  However these are 
		// included so that our older themes still work
	}
	
	public function docuSignHeader(){
		return "X-DocuSign-Authentication:<DocuSignCredentials><Username>".self::getDocuSignUser()."</Username><Password>".self::getDocuSignPassword().
		"</Password><IntegratorKey>".self::getDocuSignIntegratorKey()."</IntegratorKey></DocuSignCredentials>";
	}
	
	public function docuTest($arguments)
	{
		//Testing
		$url = self::getDocuSignBaseURL();
		$accountid = self::getDocuSignAPIKey();

		//Get Template
		$getTemplates = "accounts/".$accountid."/envelopes";
		$docu = new RestfulService($url,100);
		$docu->httpHeader(self::docuSignHeader());
		$docu->httpHeader("content-type: application/json");
		$docu->httpHeader("accept: application/json");
		$docu->httpHeader("content-disposition: form-data");

		$appsent = $this->rcApplicationData($arguments);
		var_dump($appsent);
		$d = $docu->request($getTemplates,'POST',$appsent);
		$envelopeData = json_decode($d->getBody());
		$envelopeId = $envelopeData->envelopeId;

		//Send Template
		$sendTemplates = "accounts/".$accountid."/"."envelopes/".$envelopeId;
		$docu2 = new RestfulService($url,100);
		$docu2->httpHeader(self::docuSignHeader());
		$docu2->httpHeader("content-type: application/json");
		$docu2->httpHeader("accept: application/json");
		$senddata = '{"status":"sent"}';

		$envelopeSentStatusCode = $docu2->request($sendTemplates,'PUT',$senddata)->getStatusCode();
		var_dump($envelopeData);
		var_dump($envelopeSentStatusCode);
	}

	function testApplicationData(){
		$d = '{"emailBlurb":"Thank you for applying via our website. Please fill out the Application and Sign it via the link below.","emailSubject":"RentCampusOnline.com - Please DocuSign The Rental Application","templateId":"","templateroles":[{"email":"ll@emelle.me","name":"Lloyd Emelle","roleName":"signer","tabs":{"textTabs":[{"xPosition":"90","yPosition":"175","documentId":"2","pageNumber":"2","name":"cell","tabLabel":"Cell Phone","width":"100"},{"xPosition":"120","yPosition":"397","documentId":"2","pageNumber":"2","name":"cell","tabLabel":"Cell Phone","width":"100"},{"xPosition":"120","yPosition":"249","documentId":"2","pageNumber":"2","name":"address","tabLabel":"Address","width":"320"},{"xPosition":"130","yPosition":"478","documentId":"2","pageNumber":"2","name":"cosgineraddress","tabLabel":"Co-signer Address","width":"320"},{"xPosition":"140","yPosition":"249","documentId":"2","pageNumber":"2","name":"coSignerName","tabLabel":"Co-Signer Name","width":"150"},{"xPosition":"140","yPosition":"450","documentId":"2","pageNumber":"2","name":"relationship","tabLabel":"Relationship to Tenant","width":"150"}],"dateSignedTabs":[{"xPosition":"493","yPosition":"610","documentId":"2","pageNumber":"1","recipientId":"1","name":"Date Signed","tabLabel":"Date Signed"}],"dateTabs":[{"xPosition":"500","yPosition":"548","documentId":"2","pageNumber":"2","name":"date","tabId":"2","tabLabel":"Date Field 1","required":"true","width":"120"},{"xPosition":"90","yPosition":"195","documentId":"2","pageNumber":"2","name":"dob","tabId":"2","tabLabel":"DOB","required":"true","width":"120"},{"xPosition":"90","yPosition":"425","documentId":"2","pageNumber":"2","name":"cosignerdob","tabId":"2","tabLabel":"Co-Signer DOB","required":"false","width":"120"}],"emailTabs":[{"xPosition":"320","yPosition":"175","documentId":"2","pageNumber":"2","name":"email","tabLabel":"Email Address"},{"xPosition":"340","yPosition":"400","documentId":"2","pageNumber":"2","name":"cosignEmail","required":"false"}],"fullNameTabs":[{"xPosition":"140","yPosition":"548","documentId":"2","pageNumber":"1","name":"pg1Name","tabLabel":"Full Name"},{"xPosition":"90","yPosition":"155","documentId":"2","pageNumber":"2","name":"pg2Name","tabLabel":"Full Name"}],"signHereTabs":[{"xPosition":"130","yPosition":"610","documentId":"2","pageNumber":"2","name":"sig","tabId":"2","tabLabel":"lsig"}],"ssnTabs":[{"xPosition":"380","yPosition":"205","documentId":"2","pageNumber":"2","name":"ssn1","tabLabel":"SSN","width":"90"},{"xPosition":"380","yPosition":"425","documentId":"2","pageNumber":"2","name":"ssn2","tabLabel":"Co-Signer SSN","required":"false","width":"90"}]}}]}';
		var_dump(json_encode(json_decode($d)));// json_decode($d);
	}

	public function index($arguments){
		//Check Member
		$d = ($arguments->requestVar('pid')) ? DataObject::get_by_id('Unit',$arguments->requestVar('pid')) : false;
		if($arguments->requestVar('guest') == 1){
			$logout = ($m = Member::currentUser()) ? $m->logOut() : false ;
			$b = ($d) ? array(
			'PropertyId' => $d->ID,
			'Property' => $d->Title,
			'Unit' => $d->UnitNumber
			) : array();
			return $this->customise($b)->renderWith('ApplicationPage');
		}
		if(!$m = Member::currentUser()){
			$b = ($d) ? array(
			'PropertyId' => $d->ID,
			'Property' => $d->Title,
			'Unit' => $d->UnitNumber
			) : array();
			return $this->customise($b)->renderWith('Application_login');
		}
		//var_dump($m);
		$b = ($d) ? array(
			'PropertyId' => $d->ID,
			'Property' => $d->Title,
			'Unit' => $d->UnitNumber
			) : array();
		return $this->customise($b)->renderWith('ApplicationPage');
	}
	
	public function byID($arguments){
		//Redirect
		$id = ($arguments->param('ID')) ? $arguments->param('ID') : "";
		if($m = Member::currentUser()){
		Director::redirect('/'.$arguments->param('URLSegment').'?pid='.$id);
		}else{
		Director::redirect('/'.$arguments->param('URLSegment').'?guest=1&pid='.$id);
		}
	}
	
	public function submit($arguments){
		
		$email = $arguments->requestVar('appEmail');
		$property = $arguments->requestVar('property');
		$cosigner = $arguments->requestVar('cosigner');
		if(empty($email)){
			echo 'Invalid';
			exit;
		}	
		$firstName = $arguments->requestVar('firstName');
		$surname = $arguments->requestVar('surname');
		$pass = $this->generatePassword(6,6);
        $name = $arguments->requestVar('firstName').' '.$arguments->requestVar('surname');
        $unit = $arguments->requestVar('unit');
        //Check if member exists
        $member = DataObject::get_one('Member',"Email = '".$email."'");
        if($member){
        	//Member exists. Check Applicant
        	if(!$member->ApplicationID){
        		//New Applicant
        		$application = new Application();
        		$application->PropertyName = $property;
        		$application->PropertyUnit = $unit;$appsent = ($this->sendApplication($arguments)) ? $application->Status = "sent" : $application->Status = "pending";
	    		if($appsent == 'sent'){
	    		$application->write();
	    		$member->ApplicationID = $application->ID;
	    		$member->write();
	    		}
        		$member->ApplicationID = $application->ID;
        		$member->write();
        		$member->logIn();
        		//Send Application for signing
        	}
        		
        }else{
        	//Create a new Member
    		$member = new Member();
    		$member->FirstName = $firstName;
    		$member->Surname = $surname;
    		$member->Fullname = $name;
    		$member->Email = $arguments->requestVar('appEmail');
    		$member->HomePhoneNumber = $arguments->requestVar('phoneNum');
    		$member->Cosigner = $arguments->requestVar('cosigner');
    		$member->write();
    		$member->changePassword($pass);
    		$application = new Application();
    		$application->PropertyName = $property;
    		$application->PropertyUnit = $unit;
    		$appsent = ($this->sendApplication($arguments)) ? $application->Status = "sent" : $application->Status = "pending";
    		if($appsent == 'sent'){
    		$application->write();
    		$member->ApplicationID = $application->ID;
    		$member->write();
    		}
    		$member->logIn();
    		//Send Application for signing
    		$sendLogin = $this->sendLoginEmail($arguments);
    	}
    	return Director::redirect('/rental-application');
	}
/***************************************************************
Privates
****************************************************************/
	public function sendApplication($arguments)
	{
		//Testing
		$url = self::getDocuSignBaseURL();
		$accountid = self::getDocuSignAPIKey();

		//Get Template
		$getTemplates = "accounts/".$accountid."/envelopes";
		$docu = new RestfulService($url,100);
		$docu->httpHeader(self::docuSignHeader());
		$docu->httpHeader("content-type: application/json");
		$docu->httpHeader("accept: application/json");
		$docu->httpHeader("content-disposition: form-data");

		$appsent = $this->rcApplicationData($arguments);
		var_dump($appsent);
		$d = $docu->request($getTemplates,'POST',$appsent);
		$envelopeData = json_decode($d->getBody());
		$envelopeId = $envelopeData->envelopeId;

		//Send Template
		$sendTemplates = "accounts/".$accountid."/"."envelopes/".$envelopeId;
		$docu2 = new RestfulService($url,100);
		$docu2->httpHeader(self::docuSignHeader());
		$docu2->httpHeader("content-type: application/json");
		$docu2->httpHeader("accept: application/json");
		$senddata = '{"status":"sent"}';

		$envelopeSentStatusCode = $docu2->request($sendTemplates,'PUT',$senddata)->getStatusCode();
		$value = ($envelopeSentStatusCode == 200) ? true : false ;
		return $value;
	}
	private function generatePassword($length=9, $strength=0) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength & 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength & 2) {
			$vowels .= "AEUY";
		}
		if ($strength & 4) {
			$consonants .= '23456789';
		}
		if ($strength & 8) {
			$consonants .= '@#$%';
		}
	 
		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}

	private function sendLoginEmail(&$arguments){
		//$id = $addressinfo->ID;
        $address = $arguments->requestVar('property');
        $pass = $this->generatePassword(6,6);
        //Send User Email
        $From = 'admin@rentcampusonline.com';
        $to = $arguments->requestVar('appEmail');
        $subject = "RentCampusOnline.com Application - Important Information"; 
        $passemail = new Email($From, $to, $subject);
        $passemail->setTemplate('ApplicantEmail'); 
        $d = array(
        	'Email' => $to,
        	'FirstName' => $arguments->requestVar('firstName'),
        	'TempPass' => $pass
    	);
    	$passemail->populateTemplate($d);
    	$passemail->send();
	}
	private function rcApplicationData(&$arguments){
		$signerEmail = $arguments->requestVar('appEmail');
		$signerFirstName = $arguments->requestVar('firstName');
		$signerSurname = $arguments->requestVar('surname');
		$signerPhone = $arguments->requestVar('phoneNum');
		$signerProperty = $arguments->requestVar('property');
		$signerUnit = $arguments->requestVar('unit');
		$signerCosigner = $arguments->requestVar('cosigner');


		$signHereTabs=array(
			array(
			"xPosition"=>"130",
			"yPosition"=>"580",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "sig",
            "tabId"=> "2",
            "tabLabel"=> "lsig"
			)
		);

		$emailTabs=array(
			array(
			"xPosition"=>"320",
			"yPosition"=>"175",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "email",
            "tabLabel" => "Email Address"
			),
			array(
			"xPosition"=>"340",
			"yPosition"=>"400",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "cosignEmail",
            "required" => "false"
			)
		);

		$dateSignedTabs = array(
			array(
			"xPosition"=>"493",
			"yPosition"=>"548",
			"documentId"=> "1",
			"pageNumber"=> "1",
			"recipientId" => "1",
            "name"=> "Date Signed",
            "tabLabel"=> "Date Signed"
			),
			array(
			"xPosition"=>"493",
			"yPosition"=>"610",
			"documentId"=> "1",
			"pageNumber"=> "2",
			"recipientId" => "1",
            "name"=> "Date Signed",
            "tabLabel"=> "Date Signed2"
			),
		);
		$dateTabs=array(
			array(
			"xPosition"=>"90",
			"yPosition"=>"205",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "dob",
            "tabId"=> "2",
            "tabLabel"=> "DOB",
            "required" => "true",
            "width"=>"120"
			),
			array(
			"xPosition"=>"90",
			"yPosition"=>"425",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "cosignerdob",
            "tabId"=> "2",
            "tabLabel"=> "Co-Signer DOB",
            "required" => "false",
            "width"=>"120"
			)
		);

		$fullNameTabs=array(
			array(
			"xPosition"=>"140",
			"yPosition"=>"548",
			"documentId"=> "1",
			"pageNumber"=> "1",
            "name"=> "pg1Name",
            "tabLabel"=> "Full Name"
			),
			array(
			"xPosition"=>"90",
			"yPosition"=>"155",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "pg2Name",
            "tabLabel"=> "Full Name"
			)
		);
		$textTabs=array(
			array(
			"xPosition"=>"90",
			"yPosition"=>"175",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "cell",
            "tabLabel"=>"Cell Phone",
            "width"=>"100"
			),
			array(
			"xPosition"=>"120",
			"yPosition"=>"249",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "address",
            "tabLabel"=>"Address",
            "width"=>"320"
			),
			array(
			"xPosition"=>"140",
			"yPosition"=>"580",
			"documentId"=> "1",
			"pageNumber"=> "1",
            "name"=> "property",
            "tabLabel"=>"Property",
            "value" => $arguments->requestVar('property'),
            "width"=>"320"
			)
		);
		
		$cosigntextTabs=array(
			array(
			"xPosition"=>"90",
			"yPosition"=>"175",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "cell",
            "tabLabel"=>"Cell Phone",
            "width"=>"100"
			),
			array(
			"xPosition"=>"120",
			"yPosition"=>"397",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "Cosigner Phone",
            "tabLabel"=>"Cosigner Phone",
            "width"=>"100"
			),
			array(
			"xPosition"=>"120",
			"yPosition"=>"249",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "address",
            "tabLabel"=>"Address",
            "width"=>"320"
			),
			array(
			"xPosition"=>"130",
			"yPosition"=>"478",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "cosgineraddress",
            "tabLabel"=>"Co-signer Address",
            "width"=>"320"
			),
			array(
			"xPosition"=>"140",
			"yPosition"=>"367",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "coSignerName",
            "tabLabel"=>"Co-Signer Name",
            "width"=>"150"
			),
			array(
			"xPosition"=>"140",
			"yPosition"=>"450",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "relationship",
            "tabLabel"=>"Relationship to Tenant",
            "width"=>"150"
			),
			array(
			"xPosition"=>"140",
			"yPosition"=>"580",
			"documentId"=> "1",
			"pageNumber"=> "1",
            "name"=> "property",
            "tabLabel"=>"Property",
            "value" => $arguments->requestVar('property'),
            "width"=>"320"
			)
		);
		$textTabs = ($arguments->requestVar('cosigner') != 'none') ? $cosigntextTabs : $textTabs ;
		$ssnTabs = array(
			array(
			"xPosition"=>"380",
			"yPosition"=>"205",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "ssn1",
            "tabLabel"=>"SSN",
            "width"=>"90"
			),
			array(
			"xPosition"=>"380",
			"yPosition"=>"425",
			"documentId"=> "1",
			"pageNumber"=> "2",
            "name"=> "ssn2",
            "tabLabel"=>"Co-Signer SSN",
            "required"=>"false",
            "width"=>"90"
			)
		);
		
		$tabs = array(
			"signHereTabs"=>$signHereTabs,
			"textTabs"=>$textTabs,
			);

		$documents = array(
			array(
			"documentId" => "1",
			"name" => "Rental Application 2012-2013.pdf")
		);

		$signersTabs = array(
			"textTabs" => $textTabs,
			"dateSignedTabs" => $dateSignedTabs,
			"dateTabs" => $dateTabs,
			"emailTabs" => $emailTabs,
			"fullNameTabs" => $fullNameTabs,
			"signHereTabs" => $signHereTabs,
			"ssnTabs" => $ssnTabs);
		$signers = array(
			array(
			"email" => $signerEmail,
			"name" => $signerFirstName.' '.$signerSurname,
			"roleName" => "signer",
			"tabs" => $signersTabs));
		$recipients = array(
			"signers" => $signers);
		$request = array(
			"emailBlurb"=> "Thank you for applying via our website. Please fill out the Application and Sign it via the link below.",
			"emailSubject" => "RentCampusOnline.com - Please DocuSign The Rental Application",
			"templateId" => $this->getDocuSignTemplateId(),
			"templateRoles" => $signers

		);
		return json_encode($request);
	}
}
