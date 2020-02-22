<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        
        // We want to record which user made the create/change
        //to each model. However, if this is the initial seeding 
        //of the database with a model, just set lastChangedBy to 0
        \App\User::observe(\App\Observers\ModelObserver::class);
        \App\Project::observe(\App\Observers\ModelObserver::class);
        \App\Tool::observe(\App\Observers\ModelObserver::class);
        \App\AboutLink::observe(\App\Observers\ModelObserver::class);
        \App\Url::observe(\App\Observers\ModelObserver::class);
    }
}
