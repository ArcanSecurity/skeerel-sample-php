<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../vendor/autoload.php';
require_once '../credentials.php';
require_once '../functions.php';

try {
    $skeerel = new \Skeerel\Skeerel($website_id, $website_secret);
    $website = $skeerel->getWebsiteDetails();

    echo "<pre>";
    print_r($website);
    echo "</pre>";
} catch (Exception $e) {
    echo $e->getMessage();
}
