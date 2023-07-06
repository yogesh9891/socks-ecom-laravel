<footer class="footer-wrap">
    <div class="container">
        <div class="footer">
            <div class="footer-top">
                <div class="row">
                    <div class="col-12 col-md-3">
                        <div class="foot-cont">
                            <a href="#">
                                <img src="{{asset('themes/storefront/public/images/logo2.png') }}" alt="">
                            </a>
                            <p>At Belmonk we offer a Wide Range of Men&#39;s , Women&#39;s and Kids Apparel’s specially crafted with
Latest Technology and years of Experience.
Further with Innovation and Manufacturing Capabilities Belmonk is the Fastest Growing Fashion
Brand.
Our Main Focus is Customer Satisfaction and Quality.</p>
                        </div>
                    </div>

                    @if ($footerMenuOne->isNotEmpty())
                        <div class="col-lg-2 col-md-3">
                            <div class="footer-links">
                                <h4 class="title">{{ setting('storefront_footer_menu_one_title') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerMenuOne as $menuItem)
                                        <li>
                                            <a href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                    <div class="col-lg-2 col-md-3">
                        <div class="footer-links">
                            <h4 class="title">{{ trans('storefront::layout.my_account') }}</h4>

                            <ul class="list-inline">
                                <li>
                                    <a href="{{ route('account.dashboard.index') }}">
                                        {{ trans('storefront::account.pages.dashboard') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.orders.index') }}">
                                        {{ trans('storefront::account.pages.my_orders') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.reviews.index') }}">
                                        {{ trans('storefront::account.pages.my_reviews') }}
                                    </a>
                                </li>

                                <li>
                                    <a href="{{ route('account.profile.edit') }}">
                                        {{ trans('storefront::account.pages.my_profile') }}
                                    </a>
                                </li>

                                @auth
                                    <li>
                                        <a href="{{ route('logout') }}">
                                            {{ trans('storefront::account.pages.logout') }}
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-3">
                        <div class="contact-us">
                            <h4 class="title">{{ trans('storefront::layout.contact_us') }}</h4>

                            <ul class="list-inline contact-info">
                             {{--   @if (setting('store_phone') && ! setting('store_phone_hide'))
                                    <li>
                                        <i class="las la-phone"></i>
                                        <span>{{ setting('store_phone') }}</span>
                                    </li>
                                @endif
                                --}} 
                                <li><a href="https://belmonk.com/contact" style="color: #6e6e6e"> <i class="fa fa-phone" aria-hidden="true" style=" margin-top: 3px;color: #f5ce35; font-size: 17px;"></i> &nbsp;
                                     Contact Us</a></li>
                                @if (setting('store_email') && ! setting('store_email_hide'))
                                    <li>
                                        <i class="las la-envelope"></i>
                                        <span>{{ setting('store_email') }}</span>
                                    </li>
                                @endif

                            {{--    @if (setting('storefront_address'))
                                    <li>
                                        <i class="las la-map"></i>
                                        <span>{{ setting('storefront_address') }}</span>
                                    </li>
                                @endif
                                --}} 
                            </ul>

                            
                        </div>
                    </div>
                    <div class='col-lg-3'>
                    <div class="subscribe-field">
                    <h4 class="title">Newsletter</h4>
                    <div class="Footer__Content Rte mb-3">
                    <p>Subscribe to receive updates, access to exclusive deals, and more.</p>
                  </div>
                                        <form @submit.prevent="subscribe">
                                            <div class="form-group">
                                                <input 
                                                    type="text"
                                                    v-model="email"
                                                    class="form-control"
                                                    placeholder="{{ trans('storefront::layout.enter_your_email_address') }}"
                                                >
 <br>
                                                <button
                                                    type="submit"
                                                    class="btn btn-primary btn-subscribe"
                                                    v-if="subscribed"
                                                    v-cloak
                                                >
                                                    <i class="las la-check"></i>
                                                    {{ trans('storefront::layout.subscribed') }}
                                                </button>

                                                <button 
                                                    type="submit"
                                                    class="btn btn-primary btn-subscribe"
                                                    :class="{ 'btn-loading': subscribing }"
                                                    v-else
                                                    v-cloak
                                                >
                                                    {{ trans('storefront::layout.subscribe') }}
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                    </div>

                    

                    

                    

                    @if ($footerTags->isNotEmpty())
                        <div class="col-lg-4 col-md-7">
                            <div class="footer-links footer-tags">
                                <h4 class="title">{{ trans('storefront::layout.tags') }}</h4>

                                <ul class="list-inline">
                                    @foreach ($footerTags as $footerTag)
                                        <li>
                                            <a href="{{ $footerTag->url() }}">
                                                {{ $footerTag->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-4 col-sm-18">
                        <div class="footer-text">
                            {!! $copyrightText !!}  {{-- Designed & Developed by <a href="https://ebslon.com/" target="blank">Ebslon Infotech</a> --}}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-18">
                        <div class="footer-text">
                            @if ($acceptedPaymentMethodsImage->exists)
                            <div class="footer-payment">
                                <img src="{{ $acceptedPaymentMethodsImage->path }}" alt="accepted payment methods">
                            </div>
                          @endif
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-18 d-flex align-items-center justify-content-end">
                        Follow Us On:
                    @if (social_links()->isNotEmpty())
                                <ul class="list-inline social-links">
                                    <li><a href="https://wa.me/message/SBA6Y74HVRXRI1" target="_blank"><i class="fa fa-whatsapp" aria-hidden="true"></i> </a></li>
                                    <li><a href="https://www.linkedin.com/company/belmonk/" target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i> </a></li>
                                    @foreach (social_links() as $icon => $socialLink)
                                        <li>
                                            <a href="{{ $socialLink }}"  target="_blank">
                                                <i class="{{ $icon }}"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                    </div>
                    
                </div>
            </div>

            <div class="footer-bottom-menu">
                <div class="row justify-content-center">
                   
                        @if ($footerMenuTwo->isNotEmpty())
                        <div class="col-md-10 col-12">
                            <div class="footer-links">
                                {{-- <h4 class="title">{{ setting('storefront_footer_menu_two_title') }}</h4> --}}

                                <ul class="list-inline">
                                    @foreach ($footerMenuTwo as $menuItem)
                                        <li>
                                            <a href="{{ $menuItem->url() }}" target="{{ $menuItem->target }}">
                                                {{ $menuItem->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif

                  {{--   @if ($acceptedPaymentMethodsImage->exists)
                        <div class="col-12 col-sm-18">
                            <div class="footer-payment">
                                <img src="{{ $acceptedPaymentMethodsImage->path }}" alt="accepted payment methods">
                            </div>
                        </div>
                    @endif
                    --}}
                </div>
            </div>
        </div>
    </div>
</footer>
