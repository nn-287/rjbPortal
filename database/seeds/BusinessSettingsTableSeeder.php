<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessSettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'key' => 'logo', 'value' => '2024-04-21-66251afed3f40.png', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 2, 'key' => 'store_name', 'value' => 'parcel-cross', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 3, 'key' => 'footer_text', 'value' => 'copyright', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 4, 'key' => 'email_verification', 'value' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 5, 'key' => 'mail_config', 'value' => '{"name":"Winji","host":"smtp.gmail.com","driver":"..."}', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 6, 'key' => 'phone', 'value' => '13213131', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 7, 'key' => 'email_address', 'value' => 'info@parcel-cross.com', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 8, 'key' => 'address', 'value' => 'spain', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 9, 'key' => 'currency', 'value' => 'EUR', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 10, 'key' => 'footer_text', 'value' => 'copyright', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 11, 'key' => 'delivery_charge', 'value' => '5', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 12, 'key' => 'email_verification', 'value' => '1', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 13, 'key' => 'store_open_time', 'value' => NULL, 'created_at' => '2021-01-06 07:55:51', 'updated_at' => '2021-01-06 07:55:51'],
            ['id' => 14, 'key' => 'store_close_time', 'value' => NULL, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 15, 'key' => 'logo', 'value' => '2024-03-28-66055791f1976.png', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 16, 'key' => 'ssl_commerz_payment', 'value' => '{"status":"0","store_id":null,"store_password":nul..."}', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 17, 'key' => 'paypal', 'value' => '{"status":"1","paypal_client_id":"AWL4EQTS0ujjptm2..."}', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 18, 'key' => 'stripe', 'value' => '{"status":"0","api_key":null,"published_key":null}', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 19, 'key' => 'cash_on_delivery', 'value' => '{"status":"1"}', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 20, 'key' => 'digital_payment', 'value' => '{"status":"1"}', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 21, 'key' => 'terms_and_conditions', 'value' => '<div class="ql-editor" data-gramm="false" contente...</div>', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 22, 'key' => 'fcm_topic', 'value' => NULL, 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 23, 'key' => 'fcm_project_id', 'value' => '', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 24, 'key' => 'push_notification_key', 'value' => '', 'created_at' => NULL, 'updated_at' => NULL],
            ['id' => 25, 'key' => 'order_pending_message', 'value' => '{"status":1,"message":"Your order has been placed ..."}', 'created_at' => NULL, 'updated_at' => NULL],
        ];

        DB::table('business_settings')->insert($data);
    }
}
