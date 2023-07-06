<?php

namespace Modules\Membership\Admin;

use Modules\Admin\Ui\AdminTable;

class MembershipTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable();
    }
}
