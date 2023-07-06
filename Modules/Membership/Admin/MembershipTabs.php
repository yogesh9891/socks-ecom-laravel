<?php

namespace Modules\Membership\Admin;

use Modules\Admin\Ui\Tab;
use Modules\Admin\Ui\Tabs;

/**
 * 
 */
class MembershipTabs extends Tabs
{
	
	public function make()
	{
		 $this->group('membership_information', trans('membership::memberships.tabs.group.membership_information'))
            ->active()
            ->add($this->general())
            ->add($this->membershipPrice());
           
	}


	 public function general()
    {
        return tap(new Tab('general', trans('membership::memberships.tabs.general')), function (Tab $tab) {
            $tab->active();
            $tab->weight(5);
            $tab->fields([
                'title',
                'days',
                'description',
                'is_active',
            ]);

            $tab->view('membership::admin.memberships.tabs.general');
        });
    }

     private function membershipPrice()
    {
        return tap(new Tab('price', trans('membership::memberships.tabs.price')), function (Tab $tab) {
            $tab->fields(['price']);
            $tab->view('membership::admin.memberships.tabs.price');
        });
    }
}