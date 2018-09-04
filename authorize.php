<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

require_once 'vendor/autoload.php';

// Verify that the state parameter is the same
try {
	if (\Skeerel\Skeerel::verifyAndRemoveSessionStateParameter($_GET['state'])) {
	    $skeerel = new \Skeerel\Skeerel('4bc9b636-631e-4b10-ad8c-b80e7935024b', '5XPcvHZ-zbQjJa1RLlZ7NGtgIpRpWNTWhfKq74Rg2v4');
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