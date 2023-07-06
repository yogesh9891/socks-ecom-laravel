<?php

namespace Modules\Blog\Providers;

use Modules\Blog\Admin\BlogTabs;
use Modules\Support\Traits\AddsAsset;
use Illuminate\Support\ServiceProvider;
use Modules\Admin\Ui\Facades\TabManager;

class BlogServiceProvider extends ServiceProvider
{


    use AddsAsset;


    public function boot()
    {
        TabManager::register('blogs', BlogTabs::class);

        $this->addAdminAssets('admin.blogs.(create|edit)', [
            'admin.media.css', 'admin.media.js', 'admin.blog.js',
        ]);
	}
}


