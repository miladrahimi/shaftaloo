<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;
use Morilog\Jalali\Jalalian;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::share('jd', function (Carbon $carbon): string {
            return Jalalian::fromCarbon($carbon);
        });

        View::share('balance_color', function (int $balance): string {
            if ($balance > 0) {
                return 'success';
            } elseif ($balance < 0) {
                return 'warning';
            } else {
                return 'light';
            }
        });

        View::share('user_from_id', function (int $id): User {
            return User::findOrFail($id);
        });
    }
}
