<?php
// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey("sk_live_S9Ff7ewU9AmtZmI2I1QdK5kd");
// Token is created using Stripe.js or Checkout!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];
$customer = \Stripe\Customer::create(array(
    'email' => 'INFO@PONDERNET.COM',
    'source'  => $token
));
// Charge the user's card:
$charge = \Stripe\Charge::create(array(
    "amount" => 50,
    "currency" => "usd",
    "description" => "Example charge",
    "source" => $token,
));

\Stripe\Stripe::setApiKey("sk_test_BQokikJOvBiI2HlWgH4olfQ2");

$payout = \Stripe\Payout::create(array(
    "amount" => 5000,
    "currency" => "usd",
));

echo '<h1>Successfully charged $0.50!</h1>';
?>