<?php

use Skeerel\Skeerel;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../vendor/autoload.php';
require_once '../credentials.php';
require_once '../functions.php';

try {
    $skeerel = new Skeerel($website_id, $website_secret);
    $result = $skeerel->refundPayment($_GET['id'], isset($_GET['amount']) ? intval($_GET['amount']) : null);

    echo "<pre>";
    print_r($result);
    echo "</pre>";
} catch (Exception $e) {
    echo $e->getMessage();
}
