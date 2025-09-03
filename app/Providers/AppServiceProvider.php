<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use App\Helpers\FormatHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Register services
        $this->app->singleton(\App\Services\HomeService::class);
        $this->app->singleton(\App\Services\AdminService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Register Blade directives for helpers
        Blade::directive('formatDate', function ($expression) {
            return "<?php echo App\Helpers\FormatHelper::formatDate($expression); ?>";
        });

        Blade::directive('formatDateTime', function ($expression) {
            return "<?php echo App\Helpers\FormatHelper::formatDateTime($expression); ?>";
        });

        Blade::directive('formatNumber', function ($expression) {
            return "<?php echo App\Helpers\FormatHelper::formatNumber($expression); ?>";
        });

        Blade::directive('timeAgo', function ($expression) {
            return "<?php echo App\Helpers\FormatHelper::timeAgo($expression); ?>";
        });

        Blade::directive('truncate', function ($expression) {
            $params = explode(',', $expression, 2);
            $text = $params[0];
            $limit = $params[1] ?? 100;
            return "<?php echo App\Helpers\FormatHelper::truncate($text, $limit); ?>";
        });

        // Captcha helper directive
        Blade::directive('captchaEnabled', function () {
            return "<?php echo (app()->environment('local') && config('captcha.disable_in_local')) ? 'false' : 'true'; ?>";
        });
    }
}
