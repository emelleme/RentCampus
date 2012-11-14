<?php

global $project;
$project = 'mysite';

/* What kind of environment is this: development, test, or live (ie, production */
Director::set_environment_type("dev");

// Use _ss_environment.php file for configuration include
//require_once("conf/ConfigureFromEnv.php");

$dbname = "SS_rentcampus_dev";
$server = "localhost";
$username = "root";
$password = "d3v-R3ntcampus";

//global $database;
//$database = $dbname;

/* Cloud Values override */
$dbname = (getenv("OPENSHIFT_DB_USERNAME") != FALSE) ? $_ENV['OPENSHIFT_DB_USERNAME'] : $dbname;
$server = (getenv('OPENSHIFT_DB_HOST') !== FALSE) ? $_ENV['OPENSHIFT_DB_HOST'] : $server;
$username = (getenv("OPENSHIFT_DB_USERNAME") != FALSE) ? $_ENV['OPENSHIFT_DB_USERNAME'] : $username;
$password = (getenv("OPENSHIFT_DB_PASSWORD") != FALSE) ? $_ENV['OPENSHIFT_DB_PASSWORD'] : $password;

global $databaseConfig;
global $sfdatabaseconfig;
$databaseConfig = array(
        "type" => 'MySQLDatabase',
        "server" => $server,
        "username" => $username,
        "password" => $password,
        "database" => $dbname,
        "path" => '',
);

$sfdatabaseconfig = array(
		"type" => 'MySQLDatabase',
		"server" => 'localhost',
		"username" => 'root',
		"password" => 'd3v-R3ntcampus',
		"database" => 'rentcampus_old',
        "path" => '',
	);

MySQLDatabase::set_connection_charset('utf8');
// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.org/themes/

DataObject::add_extension('Member', 'ResidentRole');

// Set DocuSign Credentials
ApplicationPage_Controller::setDocuSignCredentials('176c0826-26c0-4e53-be41-5aced8b72d09','lloyd.emelle@gmail.com','password1','EMEL-500965de-c616-4ae4-9c8c-353aef96b03a');
ApplicationPage_Controller::setDocuSignTemplateId('b2b45665-4980-4083-95a3-37ce6fd5e85a');
Director::addRules(50, array('listings/$Action/$ID/$OtherID/$AnotherID' => 'ListingsHomePage_Controller'));
Director::addRules(50, array('canvas/$Action/$Method/$ID' => 'CanvasPage_Controller'));
Director::addRules(50, array('rcimport/$Action/$ID' => 'RCImport'));
// Set the site locale
i18n::set_locale('en_US');

// enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();
LeftAndMain::setApplicationName("RentCampus CRM");
LeftAndMain::set_loading_image('http://www.emelle.me/assets/images/Logo.loading.png','height:100px;width:584px');
