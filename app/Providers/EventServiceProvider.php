<?php
namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Mail; // Correct Mail import
use Illuminate\Auth\Events\Login;
use App\Mail\detectlog; // Correct import for your Mailable class

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for your application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot()
    {
        parent::boot();

        // Listen for successful login event
        Event::listen(Login::class, function ($event) {
            // Send the login notification email to the logged-in user
            Mail::to($event->user->email)->send(new detectlog($event->user));
        });
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
