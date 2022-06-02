<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class YoutubeVideo extends Model
{
    public $fillable = [
        'name',
        'thumbnail',
        'url',
        'display_order',
        'is_featured',
        'display_order_home',
        'status',
    ];
    public function image_url()
    {
        $filename = $this->thumbnail;
        if ($filename) {
            return asset("video_thumbnails/" . $filename);
        }
        return false;
    }
}
