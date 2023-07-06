<?php

namespace Modules\Membership\Providers;

use Modules\Membership\Admin\MembershipTabs;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class MembershipServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        TabManager::register('memberships', MembershipTabs::class);
    }
}
