<?php

namespace App\Repositries;

use App\Interfaces\Payment;
use Illuminate\Support\Facades\Http;

class PaymobPayment implements Payment {

    private string $token;
    private string $orderId;
    private float $amount = 0;
    private string $currency = "EGP";
    private int $expiration = 3600;
    private string $paymentKey;
    public string $iframeId;
    public string $apiUrl;
    public string $integrationId;

    public function __construct()
    {
        $this->currency = config('payment.paymob.currency');
        $this->expiration = config('payment.paymob.expiration');
        $this->iframeId = config('payment.paymob.iframe_id');
        $this->apiUrl = config('payment.paymob.api_url');
        $this->integrationId = config('payment.paymob.integration_id');

        $this->authentication();
    }

    public function authentication()
    {
        $authentication = $this->http('post', 'auth/tokens', [
            'api_key' => config('payment.paymob.api_key')
        ]);

        if (isset($authentication['token'])) {
            $this->token = $authentication['token'];
        } else {
            throw new \Exception(__('Paymob authentication failed'));
        }

        return $this;
    }

    public function createOrder(array $orderData)
    {
        $this->amount = $orderData['amount'] * 100;
        $response = $this->http('post', 'ecommerce/orders', [
            'auth_token'        => $this->token,
            "delivery_needed"   => false,
            "amount_cents"      => $this->amount,
            "currency"          => $this->currency,
            "items"             => $orderData['items']
        ]);

        $this->orderId = $response['id'];

        return $this;
    }

    public function createPayment($customer)
    {
        $response = $this->http('post', 'acceptance/payment_keys', [
            'auth_token'        => $this->token,
            "amount_cents"      => $this->amount,
            "currency"          => $this->currency,
            'expiration'        => $this->expiration,
            'order_id'          => $this->orderId,
            'integration_id'    => $this->integrationId,
            "billing_data"      => [
                "first_name"        => $customer->name,
                "last_name"         => $customer->name,
                "email"             => $customer->email,
                "phone_number"      => '01000000000',
                "apartment"         => "NA",
                "floor"             => "NA",
                "street"            => "NA",
                "building"          => "NA",
                "shipping_method"   => "NA",
                "postal_code"       => "NA",
                "city"              => "NA",
                "country"           => "NA",
                "state"             => "NA"
            ]
        ]);
        $this->paymentKey = $response['token'];

        return $this;
    }

    public function pay()
    {
        return "https://accept.paymobsolutions.com/api/acceptance/iframes/{$this->iframeId}?payment_token={$this->paymentKey}";
    }

    private function http($type, $url, $data = [])
    {
        $response = Http::{$type}($this->apiUrl . $url, $data);

        return $response->json();
    }
}
