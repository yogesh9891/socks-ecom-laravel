<template>
    <section class="banner-wrap two-column-banner">
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <a
                        :href="data.banner_1.call_to_action_url"
                        class="banner sale-banner1"
                        :target="data.banner_1.open_in_new_window ? '_blank' : '_self'"
                    >
                        <img :src="data.banner_1.image.path" alt="banner">
                        <!-- <div class="sale-content-box">
                            <div class="price-extra">
                                30% <span>off</span>
                            </div>
                            <div class="title-extra">On all lingerie</div>
                            <div class="text-extra">*Integer ut imperdiet erat. Quisque ultricies lectus tellus, eu tristique magna pharetra.</div>
                            <div class="button-extra">
                                <div>
                                    SHOP NOW
                                </div>
                            </div>
                        </div>  --> 
                    </a>
                </div>

                <div class="col-md-9">
                    <a
                        :href="data.banner_2.call_to_action_url"
                        class="banner sale-banner2"
                        :target="data.banner_2.open_in_new_window ? '_blank' : '_self'"
                    >
                        <img :src="data.banner_2.image.path" alt="banner">
                        <!-- <div class="sale-content-box">
                            
                            <div class="title-extra">
                                <div class="extra-center">&</div>
                                <div class="extra-top">Mix</div>
                                <div class="extra-bottom">Match</div>
                            </div>
                            <div class="text-extra">*Integer ut imperdiet erat. Quisque ultricies lectus tellus, eu tristique magna pharetra.</div>
                            <div class="button-extra">
                                <div>
                                    SHOP NOW
                                </div>
                            </div>
                        </div>  -->
                    </a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['data'],
    };
</script>
