<?php

namespace Modules\Blog\Entities;

use Modules\Support\Eloquent\TranslationModel;

class BlogTranslation extends TranslationModel
{
    protected $fillable = ['title','description','tag'];
}
