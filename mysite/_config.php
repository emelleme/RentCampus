<?php

global $project;
$project = 'mysite';

/* What kind of environment is this: development, test, or live (ie, production */
Director::set_environment_type("dev");

// Use _ss_environment.php file for configuration include
//require_once("conf/ConfigureFromEnv.php");

$dbname = "SS_rentcampus";
$server = "localhost";
$username = "root";
$password = "d3v-Emelle";

//global $database;
//$database = $dbname;

/* Cloud Values override */
$dbname = (getenv("OPENSHIFT_DB_USERNAME") != FALSE) ? $_ENV['OPENSHIFT_DB_USERNAME'] : $dbname;
$server = (getenv('OPENSHIFT_DB_HOST') !== FALSE) ? $_ENV['OPENSHIFT_DB_HOST'] : $server;
$username = (getenv("OPENSHIFT_DB_USERNAME") != FALSE) ? $_ENV['OPENSHIFT_DB_USERNAME'] : $username;
$password = (getenv("OPENSHIFT_DB_PASSWORD") != FALSE) ? $_ENV['OPENSHIFT_DB_PASSWORD'] : $password;

global $databaseConfig;
$databaseConfig = array(
        "type" => 'MySQLDatabase',
        "server" => $server,
        "username" => $username,
        "password" => $password,
        "database" => $dbname,
        "path" => '',
);

MySQLDatabase::set_connection_charset('utf8');
// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.org/themes/
SSViewer::set_theme('blackcandy');

// Set the site locale
i18n::set_locale('en_US');

// enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();
LeftAndMain::setApplicationName("RentCampus CRM");
LeftAndMain::set_loading_image('http://www.emelle.me/assets/images/Logo.loading.png','height:100px;width:584px');
