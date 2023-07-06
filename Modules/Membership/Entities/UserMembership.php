<?php

namespace Modules\Membership\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UserMembership extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [];
    
    // protected static function newFactory()
    // {
    //     return \Modules\Membership\Database\factories\UserMembershipFactory::new();
    // }
}
