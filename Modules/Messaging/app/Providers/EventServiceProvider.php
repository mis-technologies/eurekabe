<?php

namespace Modules\Messaging\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Messaging\Events\MessageSentEvent;
use Modules\Messaging\Listeners\MessageSentEventListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        MessageSentEvent::class => [
            MessageSentEventListener::class
        ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     */
    protected function configureEmailVerification(): void
    {
        //
    }
}
