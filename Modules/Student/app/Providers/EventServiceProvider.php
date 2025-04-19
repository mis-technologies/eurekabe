<?php

namespace Modules\Student\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Modules\Student\Events\ChallengeAcceptedDeclined;
use Modules\Student\Events\ChallengeCreated;
use Modules\Student\Events\ChallengeSubmitted;
use Modules\Student\Listeners\ChallengeAcceptedDeclinedListener;
use Modules\Student\Listeners\ChallengeCreatedListener;
use Modules\Student\Listeners\ChallengeSubmittedListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event handler mappings for the application.
     *
     * @var array<string, array<int, string>>
     */
    protected $listen = [
        ChallengeCreated::class => [ChallengeCreatedListener::class ],
        ChallengeAcceptedDeclined::class => [ChallengeAcceptedDeclinedListener::class ],
        ChallengeSubmitted::class => [ChallengeSubmittedListener::class ],
    ];

    /**
     * Indicates if events should be discovered.
     *
     * @var bool
     */
    protected static $shouldDiscoverEvents = true;

    /**
     * Configure the proper event listeners for email verification.
     *
     * @return void
     */
    protected function configureEmailVerification(): void
    {

    }
}
