<?php

namespace App\Interfaces;

interface Payment {

    public function authentication();

    public function createOrder(array $orderData);

    public function createPayment($customer);

    public function pay();
}
