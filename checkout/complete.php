<?php

use Skeerel\Skeerel;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

require_once '../vendor/autoload.php';
require_once '../credentials.php';

// Verify that the state parameter is the same
try {
	if (Skeerel::verifyAndRemoveSessionStateParameter($_GET['state'])) {
	    $skeerel = new Skeerel($website_id, $website_secret);
	    $user = $skeerel->getData($_GET['token']);

	    echo "<pre>";
	    print_r($user);
	    echo "</pre>";
	} else {
		echo "State parameter cannot be verified";
	}
} catch (Exception $e) {
	echo $e->getMessage();
}