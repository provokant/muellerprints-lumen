<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{    
    public function register()
    {
        // $this->app->singleton('mailer', function ($app) {
        //     $app->configure('services');
        //     return $app->loadComponent('mail', 'Illuminate\Mail\MailServiceProvider', 'mailer');
        //     });
        //     $this->app->alias('mailer','Illuminate\Mail\Mailer');
    }
}
