<?php

namespace App;

class BlogCategory extends \WebDevEtc\BlogEtc\Models\BlogEtcCategory
{
    protected $table = 'blog_etc_categories';
    public $fillable = [
        'category_name',
        'slug',
        'category_description',
        'is_show_to_home',
        'home_layout',
        'created_by'
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(BlogPost::class, 'blog_etc_post_categories', 'blog_etc_category_id', 'blog_etc_post_id');
    }

    /**
     * Returns the public facing URL of showing blog posts in this category
     * @return string
     */
    public function url()
    {
        return route("blogetc.view_category", $this->slug);
    }

    /**
     * Returns the URL for an admin user to edit this category
     * @return string
     */
    public function edit_url()
    {
        return route("blogetc.admin.categories.edit_category", $this->id);
    }
}
