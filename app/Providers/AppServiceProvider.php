<?php

namespace App\Providers;

use App\Models\Baby;
use App\Observers\BabyObserver;
use Illuminate\Support\ServiceProvider;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        ResetPassword::createUrlUsing(function (object $notifiable, string $token) {
            return config('app.frontend_url') . "/password-reset/$token?email={$notifiable->getEmailForPasswordReset()}";
        });

        Baby::observe(BabyObserver::class);

        // Add custom Blade directive for radial gradient if needed
        Blade::directive('radialGradient', function ($expression) {
            return "background: radial-gradient<?php echo $expression; ?>;";
        });
    }
}