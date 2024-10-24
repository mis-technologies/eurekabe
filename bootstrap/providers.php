<?php

use Modules\Admin\Providers\AdminServiceProvider;
use Modules\Auth\Providers\AuthServiceProvider;
use Modules\Exam\Providers\ExamServiceProvider;
use Modules\Student\Providers\StudentServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
    App\Providers\FolioServiceProvider::class,
    AdminServiceProvider::class,
    AuthServiceProvider::class,
    ExamServiceProvider::class,
    StudentServiceProvider::class,
];
