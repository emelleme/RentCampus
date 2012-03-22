<?php

global $project;
$project = 'mysite';

$dbname = (getenv("OPENSHIFT_DB_USERNAME") != FALSE) ? $_ENV['OPENSHIFT_DB_USERNAME'] : "SS_dbname";
global $database;
$database = $dbname;

// Use _ss_environment.php file for configuration
require_once("conf/ConfigureFromEnv.php");

/*
global $databaseConfig;
$databaseConfig = array(
        "type" => 'MySQLDatabase',
        "server" => 'localhost',
        "username" => 'username',
        "password" => 'dbpasswrd',
        "database" => 'SS_dbname,
        "path" => '',
);
*/

MySQLDatabase::set_connection_charset('utf8');

// This line set's the current theme. More themes can be
// downloaded from http://www.silverstripe.org/themes/
SSViewer::set_theme('blackcandy');

// Set the site locale
i18n::set_locale('en_US');

// enable nested URLs for this site (e.g. page/sub-page/)
SiteTree::enable_nested_urls();
LeftAndMain::setApplicationName("Emelle.me Content Manager");
LeftAndMain::set_loading_image('http://www.emelle.me/assets/images/Logo.loading.png','height:100px;width:584px');
