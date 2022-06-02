<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('money', function ($amount) {
            return "<?php echo '$' . number_format($amount, 0); ?>";
        });

        $this->app->bind(
            \WebDevEtc\BlogEtc\Controllers\BlogEtcCategoryAdminController::class,
            \App\Http\Controllers\BlogCategoryAdminController::class
        );
        $this->app->bind(
            \WebDevEtc\BlogEtc\Controllers\BlogEtcAdminController::class,
            \App\Http\Controllers\BlogAdminController::class
        );
        $this->app->bind(
            \WebDevEtc\BlogEtc\Controllers\BlogEtcReaderController::class,
            \App\Http\Controllers\BlogReaderController::class
        );
        $this->app->bind(
            WebDevEtc\BlogEtc\Requests\BaseBlogEtcPostRequest::class,
            \App\Http\Requests\BaseBlogEtcPostRequest::class
        );
        $this->app->bind(
            WebDevEtc\BlogEtc\Requests\CreateBlogEtcPostRequest::class,
            \App\Http\Requests\CreateBlogEtcPostRequest::class
        );
        $this->app->bind(
            WebDevEtc\BlogEtc\Requests\UpdateBlogEtcPostRequest::class,
            \App\Http\Requests\UpdateBlogEtcPostRequest::class
        );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
