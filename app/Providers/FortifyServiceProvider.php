<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use App\Models\Admin;
use App\Models\User;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\ServiceProvider;
use Laravel\Fortify\Fortify;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if (request()->is('admin/*')){
            config() ->set('fortify.guard','admin');
            config() ->set('fortify.home','admin/home');
            config() ->set('fortify.passwords','admins');
            config() ->set('fortify.username','email');
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            return Limit::perMinute(5)->by($request->email.$request->ip());
        });

        Fortify::loginView(function () {
            return view('auth.user.login');
        });

        Fortify::requestPasswordResetLinkView(function(){
            return view('auth.user.password.sms');
        });

        Fortify::confirmPasswordView(function(){
            Redirect::setIntendedUrl(url()->previous());
            return view('auth.user.password.confirm');
        });

        if (request()->is('admin/*')) {
            $this->app->singleton(
                \Laravel\Fortify\Contracts\PasswordResetResponse::class,
                \App\Http\Responses\PasswordResetResponse::class
            );
        }



    }
}
