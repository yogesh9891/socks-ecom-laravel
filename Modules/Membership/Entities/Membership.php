<?php

namespace Modules\Membership\Entities;

use Modules\Support\Money;
use Modules\Media\Entities\File;
use Modules\Support\Eloquent\Model;
use Modules\Membership\Admin\MembershipTable;
use Modules\Media\Eloquent\HasMedia;
use Illuminate\Support\Facades\Cache;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;


class Membership extends Model
{

    use Translatable;

    protected $with = ['translations'];

    protected $fillable = ['is_active','price','days'];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public $translatedAttributes = ['title','description'];


    protected static function booted()
    {
        static::addActiveGlobalScope();
    }


    public static function list()
    {
        return Cache::tags('memberships')->rememberForever(md5('memberships.list:' . locale()), function () {
            return self::all()->sortBy('title')->pluck('title', 'id');
        });
    }



    public function table()
    {
        return new MembershipTable($this->newQuery()->withoutGlobalScope('active'));
    }


}
