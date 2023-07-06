<?php

namespace Modules\Membership\Http\Controllers\Admin;;

use Modules\Membership\Entities\Membership;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Membership\Http\Requests\SaveMembershipRequest;

class MembershipController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Membership::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'membership::memberships.membership';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'membership::admin.memberships';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveMembershipRequest::class;
}
