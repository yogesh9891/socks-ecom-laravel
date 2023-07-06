<?php

namespace Modules\Blog\Http\Controllers\Admin;

use Modules\Blog\Entities\Blog;
use Modules\Admin\Traits\HasCrudActions;
use Modules\Blog\Http\Requests\SaveBlogRequest;

class BlogController
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'blog::blogs.blog';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'blog::admin.blogs';

    /**
     * Form requests for the resource.
     *
     * @var array
     */
    protected $validation = SaveBlogRequest::class;
}
