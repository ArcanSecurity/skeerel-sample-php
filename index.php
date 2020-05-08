<?php

use Skeerel\Skeerel;
use Skeerel\Util\Session;

error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

require_once 'vendor/autoload.php';
require_once 'credentials.php';
require_once 'functions.php';

Skeerel::generateSessionStateParameter();

?>
<!DOCTYPE HTML>
<html>
	<head>
        <title>Checkout</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    </head>
	<body>
        <div id="skeerel-button-holder"></div>

        <script type="text/javascript" src="https://api.skeerel.com/assets/v2/javascript/api.min.js"></script>
        <script type="text/javascript">
            SkeerelCheckout.insertDefaultButton(document.getElementById("skeerel-button-holder"), "skeerel-pay-button");

            document.getElementById("skeerel-pay-button").onclick = function() {
                const skeerelCheckout = new SkeerelCheckout(
                    "<?php echo $website_id; ?>", // Website id
                    "<?php echo Session::get(Skeerel::DEFAULT_COOKIE_NAME); ?>", // state parameter
                    "<?php echo getBaseUrl() . "checkout/complete.php"; ?>", // redirect url
                    true, // need shipping address?
                    "<?php echo getBaseUrl() . "checkout/delivery_methods.php?user=__USER__&zip_code=__ZIP_CODE__&city=__CITY__&country=__COUNTRY__" ?>", // delivery methods url
                    1000, // amount to pay
                    "eur", // currency
                    null, // profile id
                    null, // custom data
                    true // is test mode?
                );

                // Create and show the iframe
                skeerelCheckout.start();
            };
        </script>
    </body>
</html>