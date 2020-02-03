<?php 
//Require the Config File
require_once 'config/config.php';

//Require the healpers
require_once 'healper/url_healper.php';
require_once 'healper/session_healper.php';
require 'healper/StaticHealper.php';
require 'healper/formHealper.php';

// Load Librarys

spl_autoload_register(function($className){
	require_once 'library/'.$className.'.php';
});

?>