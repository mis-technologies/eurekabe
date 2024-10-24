<?php

use Modules\Admin\Providers\AdminServiceProvider;
use Modules\Auth\Providers\AuthServiceProvider;
use Modules\Exam\Providers\ExamServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FolioServiceProvider::class,
    AdminServiceProvider::class,
    AuthServiceProvider::class,
    ExamServiceProvider::class
];
