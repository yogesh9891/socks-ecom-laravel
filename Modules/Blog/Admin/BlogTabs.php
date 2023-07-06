<?php

namespace Modules\Blog\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

class BlogTabs extends Tabs
{
    public function make()
    {
        $this->group('blog_information', trans('blog::blogs.tabs.group.blog_information'))
            ->active()
            ->add($this->general())
            ->add($this->images())
            ->add($this->seo());
    }

    private function general()
    {
        return tap(new Tab('general', trans('blog::blogs.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields(['name']);
            $tab->view('blog::admin.blogs.tabs.general');
        });
    }

    private function images()
    {
        if (! auth()->user()->hasAccess('admin.media.index')) {
            return;
        }

        return tap(new Tab('images', trans('blog::blogs.tabs.images')), function (Tab $tab) {
            $tab->weight(10);
            $tab->view('blog::admin.blogs.tabs.images');
        });
    }

    private function seo()
    {
        return tap(new Tab('seo', trans('blog::blogs.tabs.seo')), function (Tab $tab) {
            $tab->weight(15);
            $tab->fields(['slug']);
            $tab->view('blog::admin.blogs.tabs.seo');
        });
    }
}
