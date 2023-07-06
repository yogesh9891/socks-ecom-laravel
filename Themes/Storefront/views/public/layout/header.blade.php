<header class="header-wrap">
    <div class="header-wrap-inner">
        <div class="container">
            <div class="up-head">
                <div class="row justify-content-between">
                    <div class="col-lg-4">
                        <marquee direction="right">
                            <div class="coupon_text">
                                <span>{{ setting('storefront_welcome_text') }}</span>
                            </div>
                        </marquee>
                    </div>
                
                    {{--    <div class="col-auto col-md-auto">
                        <ul class="list-unstyled">
                                @if (setting('store_phone') && ! setting('store_phone_hide'))
                                <li>
                                    <a href="#">
                                        <strong>Call Us:</strong>
                                        {{ setting('store_phone') }}
                                    </a>
                                </li>
                                @endif
                                @if (setting('store_email') && ! setting('store_email_hide'))
                                <li>
                                    <a href="#">

                                        <strong>Email:</strong>
                                        {{ setting('store_email') }}
                                    </a>
                                </li>
                                @endif
                            </ul> 
                            
                        </div>--}}

                    <div class="col-auto col-md-auto">
                        <div class="top-nav-right">
                        <ul class="list-inline top-nav-right-list">
                            {{-- <li>
                                <a href="{{ route('contact.create') }}">
                                    <i class="las la-phone"></i>
                                    {{ trans('storefront::layout.contact') }}
                                </a>
                            </li> --}}
                            <li>
                            <a href="{{ route('account.wishlist.index') }}" class="header-wishlist">
                                    <div class="icon-wrap">
                                        <i class="lar la-heart"></i>
                                        {{-- <div class="count" v-text="wishlistCount"></div> --}}
                                    </div>

                                    Wishlist
                                </a> 
                            </li>
                            

                            

                            @if (is_multilingual())
                                <li>
                                    <i class="las la-language"></i>
                                    <select class="custom-select-option arrow-black" onchange="location = this.value">
                                        @foreach (supported_locales() as $locale => $language)
                                            <option value="{{ localized_url($locale) }}" {{ locale() === $locale ? 'selected' : '' }}>
                                                {{ $language['name'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                            @endif

                            @if (is_multi_currency())
                                <li>
                                    <i class="las la-money-bill"></i>
                                    <select class="custom-select-option arrow-black" onchange="location = this.value">
                                        @foreach (setting('supported_currencies') as $currency)
                                            <option
                                                value="{{ route('current_currency.store', ['code' => $currency]) }}"
                                                {{ currency() === $currency ? 'selected' : '' }}
                                            >
                                                {{ $currency }}
                                            </option>
                                        @endforeach
                                    </select>
                                </li>
                            @endif

                            @auth
                                <li>
                                    <a href="{{ route('account.dashboard.index') }}">
                                        <i class="las la-user"></i>
                                        {{ trans('storefront::layout.account') }}
                                    </a>
                                </li>
                            @else
                                <li>
                                    <a href="{{ route('login') }}">
                                        <i class="las la-sign-in-alt"></i>
                                        {{ trans('storefront::layout.login') }}
                                    </a>
                                </li>
                            @endauth
                        </ul>
                    </div>
                    </div>
                </div>
                
            </div>
            <div class="row flex-nowrap justify-content-between position-relative align-items-center head-2">
                <div class="header-column-left">
                    <div class="sidebar-menu-icon-wrap">
                        <div class="sidebar-menu-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
                    </div>

                    <a href="{{ route('home') }}" class="header-logo">
                        @if (is_null($logo))
                            <h3>{{ setting('store_name') }}</h3>
                        @else
                            <img src="{{ $logo }}" alt="logo">
                        @endif
                    </a>
                </div>

                @include('public.layout.navigation')

                

                <div class="header-column-right d-flex">
                    <header-search
                        :categories="{{ $categories }}"
                        :most-searched-keywords="{{ $mostSearchedKeywords }}"
                        initial-query="{{ request('query') }}"
                        initial-category="{{ request('category') }}"
                    >
                    </header-search>
                    {{-- <a href="{{ route('account.wishlist.index') }}" class="header-wishlist">
                        <div class="icon-wrap">
                            <i class="lar la-heart"></i>
                            <div class="count" v-text="wishlistCount"></div>
                        </div>

                         <span>{{ trans('storefront::layout.favorites') }}</span> 
                    </a> --}}

                    <div class="header-cart">
                        <div class="icon-wrap">
                            <i class="las la-cart-arrow-down"></i>
                            <div class="count" v-text="cart.quantity"></div>
                        </div>

                        {{-- <span v-html="cart.subTotal.inCurrentCurrency.formatted"></span> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
