<?php

namespace App\Providers;

use App\Jobs\UserCreated;
use App\Jobs\CategoryCreated;
use App\Jobs\CategoryUpdated;
use App\Jobs\SubcategoryCreated;
use App\Jobs\UserAddress;
use App\Jobs\UserManagement;
use App\Jobs\CustomerExcelUpload;
use App\Jobs\AdminUserStatusUpdate;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
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
     *
     * @return void
     */
    public function boot()
    {
        \App::bindMethod(UserCreated::class . '@handle' , function($job) {
            return $job->handle();
       });

       \App::bindMethod(CategoryCreated::class . '@handle' , function($job) {
        return $job->handle();
       });

       \App::bindMethod(CategoryUpdated::class . '@handle' , function($job) {
        return $job->handle();
       });

       \App::bindMethod(SubcategoryCreated::class . '@handle' , function($job) {
        return $job->handle();
       });

       \App::bindMethod(UserAddress::class . '@handle' , function($job) {
        return $job->handle();
       });
       
       \App::bindMethod(UserManagement::class . '@handle' , function($job) {
        return $job->handle();
      });

      \App::bindMethod(CustomerExcelUpload::class . '@handle' , function($job) {
        return $job->handle();
      });
        // \App::bindMethod(UserCreated::class . '@handle', fn($job) => $job->handle());

        \App::bindMethod(AdminUserStatusUpdate::class . '@handle' , function($job) {
            return $job->handle();
          });
    }
}
