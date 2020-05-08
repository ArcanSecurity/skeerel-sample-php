<?php

use Skeerel\Skeerel;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

require_once '../vendor/autoload.php';
require_once '../credentials.php';
require_once '../functions.php';

try {
    $skeerel = new Skeerel($website_id, $website_secret);

    $live = isset($_GET['live']);
    $first = isset($_GET['first']) ? intval($_GET['first']) : null;
    $limit = isset($_GET['limit']) ? intval($_GET['limit']) : null;
    $payments = $skeerel->listPayments($live, $first, $limit);

    echo "<pre>";
    print_r($payments);
    echo "</pre>";
} catch (Exception $e) {
    echo $e->getMessage();
}
