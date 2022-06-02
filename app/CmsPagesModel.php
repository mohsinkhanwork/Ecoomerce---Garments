<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CmsPagesModel extends Model
{
    protected $table = "cms_pages";
    protected $fillable = ["title","description"];
}
