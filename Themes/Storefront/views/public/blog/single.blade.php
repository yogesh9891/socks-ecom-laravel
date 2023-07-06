@extends('public.layout')

@section('title', 'Blogs')


@section('content')

<section class="single-blog-content">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-12">
                <div class="blog-post__full-image">
                    @if ($blog->blog_img->exists)
                    <img src="{{ $blog->blog_img->path }}" height="200px;" class="img-fluid w-100">
                    @else
                    <img src="{{ asset('themes/storefront/public/images/image-placeholder.png') }}" class="image-placeholder img-fluid w-100"  height="200px;" alt="blog image">
                    @endif
                </div>
            </div>
            {{-- <div class="col-12 col-md-1">
                <div class="blog-share">
                    <p>SHARE:</p>
                    <ul class="list-unstyled">
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{url()->current()}}" target="_blank" class="fb">
                                <i class="lab la-facebook-f"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://twitter.com/intent/tweet?url={{url()->current()}}" class="twit">
                                <i class="lab la-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/sharing/share-offsite/?url={{url()->current()}}" class="lin">
                                <i class="lab la-linkedin-in"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div> --}}
            <div class="col-12 col-md-11">
                <article class="grid-item blog-post-single">
                    <div class="home-blog-content">
                        <div class="header-image-content-holder">
                            <h2 class="article__title mb-3">{{ $blog->title }}
                            </h2>
                            <div class="blog-meta mt-4">
                                <div class="namess">
                                    by <span>Rociindia</span>
                                </div>
                            </div>
                            <div class="d-sm-flex d-block align-items-center">
                                <div class="created-date"><i class="fa fa-clock-o"></i> {{ date('d M y',strtotime($blog->created_at)) }}</div>
                            </div>
                        </div>
                        {{-- <p>{{ date('M',strtotime($blog->created_at)) }}</p> --}}
                        {!! $blog->description !!}
                    </div>
                </article>
            </div>
        </div>
      {{--   <div class="row">
            <div class="col-12">
                <div class="blog-comment-section">
                    <div class="approved-comments">
                        <h4>Comments</h4>
                        @foreach($blog->comments as $c)
                        <div class="comm">
                            <h5>
                                <div class="user-name">{{ $c->name }}</div> <span>{{ $c->created_at->diffForHumans() }}</span>
                            </h5>
                            <p>{{ $c->comment }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="leave-a-comment">
                        <h4>Leave A Comment</h4>
                        <form method="post" action="{{ route('blogs.comments.store',$blog->id) }}">
                            @method('POST')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Your Name<span>*</span></label>
                                        <input type="text" name="name" placeholder="name" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email<span>*</span></label>
                                        <input type="text" name="email" placeholder="email" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="message">Comment<span>*</span></label>
                                        <textarea rows="5" name="message" id="message" class="form-control" placeholder="Enter your comment"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button type="submit" class="btn  btn-add-to-cart">Post Comment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
            </div>
        </div> --}}
     {{--    @if(count($moreBlog) > 0)
        <div class="row">
            <div class="col-12">
                <div class="related-blogs-wrapper">
                    <div class="products-header">
                        <h5 class="section-title" style="font-size: 28px; font-weight: 700;">More Blogs</h5>
                    </div>
                    <div class="loop owl-carousel owl-theme">
                        @foreach($moreBlog as $b)
                        <div class="item">
                            <div class="item-blog-grid">
                                <a href="{{ $b->url() }}" class="">
                                    <span class="thumb"><img src="{{ $b->blog_img->path }}" alt=""></span>
                                    <h2 class="title">{{ $b->title }}</h2>
                                    <span>Read More</span>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @endif --}}
    </div>
</section>



@endsection
