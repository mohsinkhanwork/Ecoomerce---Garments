<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\BlogCategory;

class BlogMenuComposer
{
    public $categories;
    /**
     * Create a cart composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->categories = BlogCategory::orderBy("created_at", "asc")->get();
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('blog_menu_categories', $this->categories);
    }
}
