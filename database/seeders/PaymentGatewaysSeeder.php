<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentGatewaysSeeder extends Seeder
{
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('payment_gateways')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('payment_gateways')->insert([
            [
                'identifier' => 'paypal',
                'currency' => 'USD',
                'title' => 'Paypal',
                'model_name' => 'Paypal',
                'description' => '',
                'keys' => json_encode([
                    'sandbox_client_id' => 'YOUR_PAYPAL_SANDBOX_CLIENT_ID',
                    'sandbox_secret_key' => 'YOUR_PAYPAL_SANDBOX_SECRET_KEY',
                    'production_client_id' => 'YOUR_PAYPAL_PRODUCTION_CLIENT_ID',
                    'production_secret_key' => 'YOUR_PAYPAL_PRODUCTION_SECRET_KEY'
                ]),
                'status' => 0,
                'test_mode' => 1,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'stripe',
                'currency' => 'USD',
                'title' => 'Stripe',
                'model_name' => 'StripePay',
                'description' => '',
                'keys' => json_encode([
                    'public_key' => 'YOUR_STRIPE_TEST_PUBLIC_KEY',
                    'secret_key' => 'YOUR_STRIPE_TEST_SECRET_KEY',
                    'public_live_key' => 'pk_live_xxxxxxxxxxxxxxxxxxxxxxxx',
                    'secret_live_key' => 'sk_live_xxxxxxxxxxxxxxxxxxxxxxxx'
                ]),
                'status' => 0,
                'test_mode' => 1,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'razorpay',
                'currency' => 'INR',
                'title' => 'Razorpay',
                'model_name' => 'Razorpay',
                'description' => '',
                'keys' => json_encode([
                    'public_key' => 'YOUR_RAZORPAY_TEST_KEY',
                    'secret_key' => 'YOUR_RAZORPAY_TEST_SECRET_KEY'
                ]),
                'status' => 0,
                'test_mode' => 1,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'flutterwave',
                'currency' => 'USD',
                'title' => 'Flutterwave',
                'model_name' => 'Flutterwave',
                'description' => '',
                'keys' => json_encode([
                    'public_key' => 'YOUR_FLUTTERWAVE_TEST_PUBLIC_KEY',
                    'secret_key' => 'YOUR_FLUTTERWAVE_TEST_SECRET_KEY'
                ]),
                'status' => 0,
                'test_mode' => 1,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'paytm',
                'currency' => 'INR',
                'title' => 'Paytm',
                'model_name' => 'Paytm',
                'description' => '',
                'keys' => json_encode([
                    'paytm_merchant_key' => 'YOUR_PAYTM_MERCHANT_KEY',
                    'paytm_merchant_mid' => 'YOUR_PAYTM_MERCHANT_ID',
                    'paytm_merchant_website' => 'WEBSTAGING',
                    'industry_type_id' => 'Retail',
                    'channel_id' => 'WEB'
                ]),
                'status' => 0,
                'test_mode' => 1,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'offline',
                'currency' => 'USD',
                'title' => 'Offline Payment',
                'model_name' => 'OfflinePayment',
                'description' => '',
                'keys' => json_encode([
                    'bank_information' => 'Write your bank information and instructions here'
                ]),
                'status' => 0,
                'test_mode' => 0,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'paystack',
                'currency' => 'NGN',
                'title' => 'Paystack',
                'model_name' => 'Paystack',
                'description' => null,
                'keys' => json_encode([
                    'secret_test_key' => 'YOUR_PAYSTACK_TEST_SECRET_KEY',
                    'public_test_key' => 'YOUR_PAYSTACK_TEST_PUBLIC_KEY',
                    'secret_live_key' => 'sk_live_xxxxxxxxxxxxxxxxxxxxxxxxx',
                    'public_live_key' => 'pk_live_xxxxxxxxxxxxxxxxxxxxxxxxx'
                ]),
                'status' => 0,
                'test_mode' => 1,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'fawrypay',
                'currency' => 'ALL',
                'title' => 'fawrypay',
                'model_name' => 'fawrypay',
                'description' => null,
                'keys' => json_encode([
                    'merchant_code' => '400000018108',
                    'secure_key' => 'YOUR_FAWRY_SECURE_KEY',
                    'merchant_code_test' => '.',
                    'secure_key_test' => '.',
                    'expiry_in_hours' => '48'
                ]),
                'status' => 1,
                'test_mode' => 0,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'paymob',
                'currency' => 'USD',
                'title' => 'paymob',
                'model_name' => 'paymob',
                'description' => null,
                'keys' => json_encode([
                    'api_key' => 'ZXlKMGVYQWlPaUpLVjFRaUxDSmhiR2NpT2lKSVV6VXhNaUo5LmV5SndjbTltYVd4bFgzQnJJam8xTmpFNU9EZ3NJbU5zWVhOeklqb2lUV1Z5WTJoaGJuUWlMQ0p1WVcxbElqb2lhVzVwZEdsaGJDSjkuVjRmbFhiT01XYU9hUFp2Tm1DN3drZXo5T0dKY0ZYMDBrOXVURnJoVUE3UXJybVRkOWlPODRiY3Z2Rzk1ZExhUWZENkpmUGhlR3ViRGJyM0t6V01qanc=',
                    'iframe_id' => '685658',
                    'HMAC' => 'B2EFA44AA543F328D0BAD80DC60D9CD2',
                    'integration_id' => '5008387'
                ]),
                'status' => 0,
                'test_mode' => 0,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'Wallet',
                'currency' => 'USD',
                'title' => 'Wallet',
                'model_name' => 'Wallet',
                'description' => null,
                'keys' => json_encode([]),
                'status' => 1,
                'test_mode' => 0,
                'is_addon' => 0,
            ],
            [
                'identifier' => 'card',
                'currency' => 'USD',
                'title' => 'card',
                'model_name' => 'Card',
                'description' => null,
                'keys' => json_encode([]),
                'status' => 1,
                'test_mode' => 0,
                'is_addon' => 0,
            ],
        ]);
    }
}
