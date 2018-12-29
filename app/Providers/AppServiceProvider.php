<?php

namespace App\Providers;

use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Morilog\Jalali\Jalalian;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('jd', function(Carbon $carbon) {
            return Jalalian::fromCarbon($carbon);
        });

        View::share('is_admin', function(User $user) {
            return $user->username == 'milad';
        });
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
