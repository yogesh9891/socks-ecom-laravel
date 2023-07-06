@extends('public.layout')

@section('title', 'Blogs')


@section('content')


   
 @if($blogs)
    <section class="blog-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="heading-blog">
                        <h2>Latest Blogs</h2>
                    </div>
                </div>
            </div>

            <div class="row mt-3">

                @foreach($blogs as $blog)
                <div class="col-12 col-md-3">
                    <div class="blog-box">
                        <div class="blog-img">
                            <a href="{{ $blog->url()}}">
                                <img src="{{asset('themes/storefront/public/images/blog-1.jpg') }}" alt="{{ $blog->title }}">
                            </a>
                            <div class="blog-date">
                                <div class="date">{{ date('M d,Y',strtotime($blog->created_at)) }}</div>
                            </div>
                        </div>
                        <h4><a href="{{ $blog->url()}}">{{ $blog->title }}</a></h4>
                    </div>
                </div>
                @endforeach
                {{-- <div class="col-12 col-md-3">
                    <div class="blog-box">
                        <div class="blog-img">
                            <a href="#">
                                <img src="{{asset('themes/storefront/public/images/blog-2.jpg') }}" alt="">
                            </a>
                            <div class="blog-date">
                                <div class="date">Aug 12,2021</div>
                            </div>
                        </div>
                        <h4><a href="#">Anyway REPS is a NYC agency repres enting photographers</a></h4>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="blog-box">
                        <div class="blog-img">
                            <a href="#">
                                <img src="{{asset('themes/storefront/public/images/blog-3.jpg') }}" alt="">
                            </a>
                            <div class="blog-date">
                                <div class="date">Aug 12,2021</div>
                            </div>
                        </div>
                        <h4><a href="#">Anyway REPS is a NYC agency repres enting photographers</a></h4>
                    </div>
                </div>

                <div class="col-12 col-md-3">
                    <div class="blog-box">
                        <div class="blog-img">
                            <a href="#">
                                <img src="{{asset('themes/storefront/public/images/blog-4.jpg') }}" alt="">
                            </a>
                            <div class="blog-date">
                                <div class="date">Aug 12,2021</div>
                            </div>
                        </div>
                        <h4><a href="#">Anyway REPS is a NYC agency repres enting photographers</a></h4>
                    </div>
                </div> --}}
            </div>
        </div>
    </section>
    @endif


@endsection
