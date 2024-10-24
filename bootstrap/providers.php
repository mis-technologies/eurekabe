<?php

use Modules\Admin\Providers\AdminServiceProvider;
use Modules\Auth\Providers\AuthServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FolioServiceProvider::class,
    AdminServiceProvider::class,
    AuthServiceProvider::class
];
