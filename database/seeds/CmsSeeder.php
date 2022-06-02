<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CmsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("cms_pages")
        ->insert([
            "title" => "Privacy Policy",
            "description" => '<p>Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat.</p>'
        ]);
        DB::table("cms_pages")
        ->insert([
            "title" => "Terms and Condition",
            "description" => '<p>Vivamus magna justo, lacinia eget consectetur sed, convallis at tellus. Cras ultricies ligula sed magna dictum porta. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus nibh. Vivamus suscipit tortor eget felis porttitor volutpat.</p>'
        ]);
    }
}
