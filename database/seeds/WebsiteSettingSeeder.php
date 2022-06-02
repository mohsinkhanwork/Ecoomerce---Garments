<?php

use Illuminate\Database\Seeder;
use App\WebsiteSetting;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      WebsiteSetting::create([
            'name' => "Free Shipping Cart Amount",
            'key' => "free_shipping_cart_amount",
            'value' => "275"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From Name",
            'key' => "shipping_from_name",
            'value' => "Raymond Stancil"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From Company",
            'key' => "shipping_from_company",
            'value' => "Urban Enigma"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From Address",
            'key' => "shipping_from_street1",
            'value' => "200 Larkin Ct"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From City",
            'key' => "shipping_from_city",
            'value' => "Stratford"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From State",
            'key' => "shipping_from_state",
            'value' => "CT"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From Zip",
            'key' => "shipping_from_zip",
            'value' => "06615"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From Country",
            'key' => "shipping_from_country",
            'value' => "US"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From Phone",
            'key' => "shipping_from_phone",
            'value' => "+1 203 423 4484"
      ]);
      WebsiteSetting::create([
            'name' => "Shipping From Email",
            'key' => "shipping_from_email",
            'value' => "raymond.stancil@gmail.com"
      ]);
    }
}
