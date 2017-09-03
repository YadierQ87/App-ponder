<?php
/**
 * Created by PhpStorm.
 * User: Yadier
 * Date: 02/09/2017
 * Time: 16:34
 */

//user: INFO@PONDERNET.COM
//passwd: Yadier.17

require_once('vendor/autoload.php');

$stripe = array(
    "secret_key"      => "sk_test_BQokikJOvBiI2HlWgH4olfQ2",
    "publishable_key" => "pk_test_6pRNASCoBOKtIshFeQd4XMUh"
);

\Stripe\Stripe::setApiKey($stripe['secret_key']);
?>