<?php

namespace Modules\Blog\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Modules\Blog\Entities\Blog;

class BlogController extends Controller
{
    public function index()
    {
        return view('public.blog.index', [
            'blogs' => Blog::with('files')->latest()->get(),
		]);
	}



	public function singlePage($slug){

		$blog = Blog::where('slug',$slug)->first();

        $moreBlog = Blog::where('id','!=',$blog->id)->get();

        if ($blog) {
            
            return view('public.blog.single', [
                'blog' => $blog,
                'blogTitle' => $blog->title,
                'moreBlog' => $moreBlog,
            ]);
        }else{
            abort(404);
        }
	}



}
