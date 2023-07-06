<?php

namespace Modules\Membership\Sidebar;

use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Maatwebsite\Sidebar\Group;
use Modules\Admin\Sidebar\BaseSidebarExtender;

class SidebarExtender extends BaseSidebarExtender
{
    public function extend(Menu $menu)
    {
        $menu->group(trans('admin::sidebar.content'), function (Group $group) {
            $group->item(trans('membership::memberships.memberships'), function (Item $item) {
                $item->icon('fa fa-rss');
                $item->weight(17);
                $item->route('admin.memberships.index');
                $item->authorize(
                    $this->auth->hasAccess('admin.memberships.index')
                );
            });
        });
    }
}
