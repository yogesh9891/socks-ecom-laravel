<?php

namespace Modules\Blog\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        // $menu->group(trans('admin::sidebar.content'), function (Group $group) {
        //     $group->item(trans('blog::blogs.blogs'), function (Item $item) {
        //         $item->icon('fa fa-file');
        //         $item->weight(17);
        //         $item->route('admin.blogs.index');
        //         $item->authorize(
        //             $this->auth->hasAccess('admin.blogs.index')
        //         );
        //     });
        // });


        $menu->group(trans('admin::sidebar.content'), function (Group $group) {
            $group->item(trans('blog::blogs.blogs'), function (Item $item) {
                $item->icon('fa fa-file');
                $item->weight(10);
                $item->route('admin.blogs.index');
                $item->authorize(
                    $this->auth->hasAnyAccess([
                        'admin.blogs.index',
                        'admin.comments.index',
                    ])
                );

                $item->item(trans('blog::blogs.blogs'), function (Item $item) {
                    $item->weight(5);
                    $item->route('admin.blogs.index');
                    $item->authorize(
                        $this->auth->hasAccess('admin.blogs.index')
                    );
                });
            });
        });



    }
}
