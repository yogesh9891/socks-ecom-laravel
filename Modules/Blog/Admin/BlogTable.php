<?php

namespace Modules\Blog\Admin;

use Modules\Admin\Ui\AdminTable;
use Modules\Blog\Entities\Blog;

class BlogTable extends AdminTable
{
    /**
     * Make table response for the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function make()
    {
        return $this->newTable()
            ->addColumn('blog_img', function (Blog $blog) {
                return view('admin::partials.table.image', [
                    'file' => $blog->blog_img,
                ]);
            });
    }
}
