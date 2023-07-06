<?php

namespace Modules\Membership\Entities;

use Modules\Support\Eloquent\TranslationModel;

class MembershipTranslation extends TranslationModel
{
    protected $fillable = ['title','description'];
}
