<?php

namespace Modules\Blog\Entities;


use Modules\Media\Entities\File;
use Modules\Blog\Admin\BlogTable;
use Modules\Support\Eloquent\Model;
use Modules\Media\Eloquent\HasMedia;
use Illuminate\Support\Facades\Cache;
use Modules\Meta\Eloquent\HasMetaData;
use Modules\Comment\Entities\Comment;
use Modules\Support\Eloquent\Sluggable;
use Modules\Support\Eloquent\Translatable;

class Blog extends Model
{

	use Translatable, Sluggable, HasMedia, HasMetaData;

	protected $with = ['translations'];


    protected $fillable = ['slug', 'is_active'];

    protected $casts = [
        'is_active' => 'boolean',
    ];


    public $translatedAttributes = ['title','description','tag'];


    protected $slugAttribute = 'title';


    protected static function booted()
    {
        static::addActiveGlobalScope();
    }


    public static function findBySlug($slug)
    {
        return self::where('slug', $slug)->firstOrNew([]);
    }


    public function url()
    {
        return route('blogs.single.index', $this->slug);
    }



    public static function list()
    {
        return Cache::tags('blogs')->rememberForever(md5('blogs.list:' . locale()), function () {
            return self::all()->sortBy('title')->pluck('title', 'id');
        });
    }


     public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getBlogImgAttribute()
    {
        return $this->files->where('pivot.zone', 'blog_img')->first() ?: new File;
    }




    public function table()
    {
        return new BlogTable($this->newQuery()->withoutGlobalScope('active'));
    }




}
