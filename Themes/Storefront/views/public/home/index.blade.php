@extends('public.layout')

@section('title', setting('store_tagline'))

@section('content')

<svg style="display:none;">
<symbol id="one" viewBox="0 0 1440 320" preserveAspectRatio="none">
<path fill="white" d="M0,96L1440,320L1440,320L0,320Z"></path>
</symbol>
<symbol id="two" viewBox="0 0 1440 320" preserveAspectRatio="none">
<path fill="white" d="M0,32L48,37.3C96,43,192,53,288,90.7C384,128,480,192,576,197.3C672,203,768,149,864,138.7C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
</symbol>
<symbol id="three" viewBox="0 0 1440 320" preserveAspectRatio="none">
<path fill="white" d="M0,128L30,144C60,160,120,192,180,197.3C240,203,300,181,360,192C420,203,480,245,540,245.3C600,245,660,203,720,192C780,181,840,203,900,181.3C960,160,1020,96,1080,80C1140,64,1200,96,1260,122.7C1320,149,1380,171,1410,181.3L1440,192L1440,320L1410,320C1380,320,1320,320,1260,320C1200,320,1140,320,1080,320C1020,320,960,320,900,320C840,320,780,320,720,320C660,320,600,320,540,320C480,320,420,320,360,320C300,320,240,320,180,320C120,320,60,320,30,320L0,320Z"></path>
</symbol>
<symbol id="four" viewBox="0 0 1440 320" preserveAspectRatio="none">
<path fill="white" d="M0,192L120,192C240,192,480,192,720,165.3C960,139,1200,85,1320,58.7L1440,32L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</symbol>
<symbol id="five" viewBox="0 0 1440 320" preserveAspectRatio="none">
<path fill="white" d="M0,32L120,69.3C240,107,480,181,720,192C960,203,1200,149,1320,122.7L1440,96L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</symbol>
<symbol id="six" viewBox="0 0 1440 320" preserveAspectRatio="none">
<path fill="rgba(255, 255, 255, .8)" d="M0,32L120,64C240,96,480,160,720,160C960,160,1200,96,1320,64L1440,32L1440,320L1320,320C1200,320,960,320,720,320C480,320,240,320,120,320L0,320Z"></path>
</symbol>
</svg>
    @includeUnless(is_null($slider), 'public.home.sections.slider')

    <section class="main-pattern-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-box">
                        @if (setting('storefront_features_section_enabled'))
                            <home-features :features="{{ json_encode($features) }}"></home-features>
                        @endif

                        @if (setting('storefront_two_column_banners_enabled'))
                            <banner-two-column :data="{{ json_encode($twoColumnBanners) }}"></banner-two-column>
                        @endif

                        @if (setting('storefront_product_tabs_1_section_enabled'))
                            <product-tabs-one :data="{{ json_encode($productTabsOne) }}"></product-tabs-one>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    @if (setting('storefront_featured_categories_section_enabled'))
        <featured-categories :data="{{ json_encode($featuredCategories) }}"></featured-categories>
    @endif
    {{-- @if (setting('storefront_features_section_enabled'))
        <home-features :features="{{ json_encode($features) }}"></home-features>
    @endif --}}

    <section class="deals-pattern-sec">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="main-box">
                        @if (setting('storefront_flash_sale_and_vertical_products_section_enabled'))
                            <flash-sale-and-vertical-products :data="{{ json_encode($flashSaleAndVerticalProducts) }}"></flash-sale-and-vertical-products>
                        @endif

                        {{--  @include('public.home.sections.subscribe') --}}
                    </div>
                </div>
            </div>
        </div>
    </section>

      <section class="you-like">
        @if (setting('storefront_one_column_banner_enabled'))
        <banner-one-column :banner="{{ json_encode($oneColumnBanner) }}"></banner-one-column>
    @endif
        
    </section>

    @if (setting('storefront_three_column_banners_enabled'))
            <banner-three-column :data="{{ json_encode($threeColumnBanners) }}"></banner-three-column>
        @endif

    @if (setting('storefront_top_brands_section_enabled') && $topBrands->isNotEmpty())
        <top-brands :top-brands="{{ json_encode($topBrands) }}"></top-brands>
    @endif

    
    
    


    {{-- @if (setting('storefront_two_column_banners_enabled'))
        <banner-two-column :data="{{ json_encode($twoColumnBanners) }}"></banner-two-column>
    @endif --}}
    {{-- @if (setting('storefront_product_tabs_2_section_enabled'))
        <product-tabs-two :data="{{ json_encode($tabProductsTwo) }}"></product-tabs-two>
    @endif --}}

    

    

    

    {{-- <section class="testimonial-sec">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="testi-heading-img">
                        <img src="{{asset('themes/storefront/public/images/video-poster.jpg') }}" alt="">
                        <div class="heading-text">
                            <h3>What People Say <i class="icon-arrow-right2"></i></h3>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="testi-box">
                        <div class="testi-white-box">
                            <div class="testi-white-box-in">
                               <img src="{{asset('themes/storefront/public/images/testimonial-quote.png') }}" alt="">
                               <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomise...</p> 
                               <h6>- Mark Jekno</h6>
                           </div>
                           <div class="testi-white-box-in">
                               <img src="{{asset('themes/storefront/public/images/testimonial-quote.png') }}" alt="">
                               <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomise...</p> 
                               <h6>- Mark Jekno</h6> 
                           </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- @if (setting('storefront_three_column_full_width_banners_enabled'))
        <banner-three-column-full-width :data="{{ json_encode($threeColumnFullWidthBanners) }}"></banner-three-column-full-width>
    @endif --}}

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

    

    

   {{--  @if (setting('storefront_product_grid_section_enabled'))
        <product-grid :data="{{ json_encode($productGrid) }}"></product-grid>
    @endif --}}

    

    {{-- <section class="membership-bg">
        <svg class="position-absolute w-100">
            <use xlink:href="#three"></use>
        </svg>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="hed">
                        <h3>Exclusive Membership</h3>
                    </div>
                </div>
            </div>
        </div>  
    </section> --}}

    <section class="membership-bg">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Exclusive Membership</h3>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <a href="{{url('/membership')}}">
                        <img src="{{asset('themes/storefront/public/images/member-banner.jpg') }}" class="img-fluid w-100" alt="">
                    </a>
                </div>
            </div>
        </div>
    </section>

    
@endsection
