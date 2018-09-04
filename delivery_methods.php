<?php

use Skeerel\Data\Address\Country;
use Skeerel\Data\Delivery\Color;
use Skeerel\Data\Delivery\DeliveryMethod;
use Skeerel\Data\Delivery\DeliveryMethods;
use Skeerel\Data\Delivery\PickUpPoint;
use Skeerel\Data\Delivery\PickUpPoints;
use Skeerel\Data\Delivery\Type;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

require_once 'vendor/autoload.php';

$zip = htmlentities($_GET['zip_code']);
$city = htmlentities($_GET['city']);
$country = Country::fromAlpha2($_GET['country']);

$dateTwoDays = "le " . date('d M', strtotime(date('Y-m-d') . ' + 2 days'));
$dateThreeDays = "le " . date('d M', strtotime(date('Y-m-d') . ' + 3 days'));


// A standard delivery mode
$deliveryMethodStandard = new DeliveryMethod();
$deliveryMethodStandard->setId("standard");
$deliveryMethodStandard->setType(Type::HOME);
$deliveryMethodStandard->setPrimary(true);
$deliveryMethodStandard->setName("Livraison Standard");
$deliveryMethodStandard->setDeliveryTextContent("sous 72 heures");
$deliveryMethodStandard->setPrice(499);



// But also a pick up mode
$deliveryMethodRelay = new DeliveryMethod();
$deliveryMethodRelay->setId("my_relay");
$deliveryMethodRelay->setType(Type::RELAY);
$deliveryMethodRelay->setName("Point relais");
$deliveryMethodRelay->setDeliveryTextContent($dateTwoDays);
$deliveryMethodRelay->setPrice(299);

// Pick up points
$pickUpPoint1 = new PickUpPoint();
$pickUpPoint1->setId("1");
$pickUpPoint1->setName("Point retrait 1");
$pickUpPoint1->setAddress("Adresse exemple 1");
$pickUpPoint1->setZipCode($zip);
$pickUpPoint1->setCity($city);
$pickUpPoint1->setCountry($country);
$pickUpPoint1->setDeliveryTextContent("demain");
$pickUpPoint1->setDeliveryTextColor(Color::GREEN);
$pickUpPoint1->setPrice(399);
$pickUpPoint1->setPriceTextColor(Color::RED);

$pickUpPoint2 = new PickUpPoint();
$pickUpPoint2->setId("2");
$pickUpPoint2->setPrimary(true);
$pickUpPoint2->setName("Point retrait 2");
$pickUpPoint2->setAddress("Adresse exemple 2");
$pickUpPoint2->setZipCode($zip);
$pickUpPoint2->setCity($city);
$pickUpPoint2->setCountry($country);

$pickUpPoint3 = new PickUpPoint();
$pickUpPoint3->setId("3");
$pickUpPoint3->setName("Point retrait 3");
$pickUpPoint3->setAddress("Adresse exemple 3");
$pickUpPoint3->setZipCode($zip);
$pickUpPoint3->setCity($city);
$pickUpPoint3->setCountry($country);

$pickUpPointsRelay = new PickUpPoints();
$pickUpPointsRelay->add($pickUpPoint1);
$pickUpPointsRelay->add($pickUpPoint2);
$pickUpPointsRelay->add($pickUpPoint3);

$deliveryMethodRelay->setPickUpPoints($pickUpPointsRelay);



// And why not getting the order directly in the store
$deliveryMethodCollect = new DeliveryMethod();
$deliveryMethodCollect->setId("store_collect");
$deliveryMethodCollect->setType(Type::COLLECT);
$deliveryMethodCollect->setName("Retrait en magasin");
$deliveryMethodCollect->setDeliveryTextContent("dans 2 heures");
$deliveryMethodCollect->setPrice(0);

// Collect up points
$collectPoint1 = new PickUpPoint();
$collectPoint1->setId("1");
$collectPoint1->setName("Magasin 1");
$collectPoint1->setAddress("Adresse exemple 1");
$collectPoint1->setZipCode($zip);
$collectPoint1->setCity($city);
$collectPoint1->setCountry($country);

$collectPoint2 = new PickUpPoint();
$collectPoint2->setId("2");
$collectPoint2->setName("Magasin 2");
$collectPoint2->setAddress("Adresse exemple 2");
$collectPoint2->setZipCode($zip);
$collectPoint2->setCity($city);
$collectPoint2->setCountry($country);

$collectPoint3 = new PickUpPoint();
$collectPoint3->setId("3");
$collectPoint3->setName("Magasin 3");
$collectPoint3->setAddress("Adresse exemple 3");
$collectPoint3->setZipCode($zip);
$collectPoint3->setCity($city);
$collectPoint3->setCountry($country);

$pickUpPointsCollect = new PickUpPoints();
$pickUpPointsCollect->add($collectPoint1);
$pickUpPointsCollect->add($collectPoint2);
$pickUpPointsCollect->add($collectPoint3);

$deliveryMethodCollect->setPickUpPoints($pickUpPointsCollect);



// We add everything to the main object
$deliveryMethods = new DeliveryMethods();
$deliveryMethods->add($deliveryMethodStandard);
$deliveryMethods->add($deliveryMethodRelay);
$deliveryMethods->add($deliveryMethodCollect);

// And we show
echo $deliveryMethods->toJson();