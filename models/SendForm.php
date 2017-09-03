<?php
/**
 * Created by PhpStorm.
 * User: Yadier
 * Date: 02/09/2017
 * Time: 17:44
 */

namespace app\models;


use yii\base\Model;

class SendForm extends Model
{
    public function insertCharge()
    {

        \Stripe\Stripe::setApiKey(Yii::$app->stripe->secret_key);

        $request = Yii::$app->request;

        $token = $request->post('stripeToken');

        //$token  = $_POST['stripeToken'];

        $customer = \Stripe\Customer::create(array(
            'email' => 'customer@example.com',
            'source'  => $token
        ));

        $charge = \Stripe\Charge::create(array(
            'customer' => $customer->id,
            'amount'   => 2000,
            'currency' => 'usd'
        ));

    }//end function
}