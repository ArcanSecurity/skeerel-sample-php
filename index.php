<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

session_start();

require_once 'vendor/autoload.php';


\Skeerel\Skeerel::generateSessionStateParameter();

?>
<html>
	<head></head>
	<body>

    <!--
        data-need-shipping-address in case you need a shipping address
        data-need-billing-address  in case you need a billing address
        data-delivery-methods-url  if you need to ship something to the user
        data-payment               if the session is for the user to pay
        data-payment-test          if the payment must be done in test mode
        data-amount                amount is in the smallest common currency unit. For instance here 10,00€ 10.00USD, ¥1000
        data-currency              the currency of the transaction
    -->
    <script type="text/javascript" src="https://api.skeerel.com/assets/v2/javascript/api.min.js"
            id="skeerel-api-script"
            data-website-id="YOUR_WEBSITE_ID"
            data-state="<?php echo \Skeerel\Util\Session::get(\Skeerel\Skeerel::DEFAULT_COOKIE_NAME); ?>"
            data-redirect-url="The url where the user will be redirected once he has complete"
            data-need-shipping-address=""
            data-need-billing-address=""
            data-delivery-methods-url="https://site.com/delivery_methods.php?user=__USER__&zip_code=__ZIP_CODE__&city=__CITY__&country=__COUNTRY__"
            data-payment=""
            data-payment-test=""
            data-amount="1000"
            data-currency="eur"></script>
	</body>
</html>