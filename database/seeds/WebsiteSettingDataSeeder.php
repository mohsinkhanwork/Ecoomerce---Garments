<?php

use Illuminate\Database\Seeder;
use App\WebsiteSetting;

class WebsiteSettingDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      WebsiteSetting::create([
            'name' => "Enable Free Shipping",
            'key' => "enable_free_shipping",
            'value' => "no"
      ]);

      WebsiteSetting::create([
            'name' => "Free Shipping from",
            'key' => "free_shipping_from",
            'value' => ""
      ]);

      WebsiteSetting::create([
            'name' => "Free Shipping to",
            'key' => "free_shipping_to",
            'value' => ""
      ]);
    }
}
