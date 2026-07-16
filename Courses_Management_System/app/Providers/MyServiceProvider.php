<?php

namespace App\Providers;

use App\Services\HelperService;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class MyServiceProvider extends ServiceProvider implements DeferrableProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //تسجيل الخدمات يتم هنا

        // $this->app->bind("serviceName",function(){return new theClassCallPath\className});
        //Use case 1
        // $this->app->bind("Samhon", function () {
        //     return new \App\Services\HelperService;
        // });

        //use case 2
        $this->app->singleton(HelperService::class, function () {
            return new HelperService();
        });
    }

    /**
     * Edited MyServiceProvider.php
Viewed MyServiceProvider.php:31-48

Choosing between `bind` and `singleton` depends on whether the class needs to **share its state** and **how expensive it is to create**.

Here is a simple guide on when to use each:

---

### Use `singleton` when:

1. **The service is stateless (Utility/Helper classes)**:
     * If a class only contains functions that process input and return output (like your `HelperService`), there is no reason to create it multiple times. Using a singleton saves memory.
2. **The service is expensive to instantiate**:
     * If the constructor has to load heavy configuration files, make API connections, or perform complex setup (e.g., an external Payment Gateway client or an SDK wrapper).
3. **You need to share state during the request**:
     * If the class stores data that other classes need to read or modify during the same request.
     * *Example*: A `ShoppingCartService` or a `UserPermissionsCache`. You want every class in the app to access the same cart/permissions instance.

     **Common Singleton Examples**:
     * Database connections (`db`)
     * Mailers/SMS senders (`mailer`)
     * Cache managers (`cache`)
     * API client wrappers (`StripeClient`)

---

### Use `bind` when:

1. **The service maintains unique state per instance**:
     * If the object is modified by the code using it, and sharing that modified state with other parts of the application would cause bugs (state leakage).
2. **You need a new, clean instance every time**:
     * *Example*: A `PdfGenerator` or `ReportBuilder` service. You might run it multiple times with different files or settings, and you want to start fresh each time without settings from the previous report interfering.
3. **The service depends on dynamic constructor arguments**:
     * If the service needs to accept dynamic data during instantiation that changes depending on *who* resolves it.

     **Common Bind Examples**:
     * Document/HTML converters
     * Form/Query Builders
     * Report generators
     */

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //تنفيذ اي شي بعد التسجيل يتم هنا
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array<int, string>
     */
    public function provides(): array
    {
        return [HelperService::class];
    }
}
