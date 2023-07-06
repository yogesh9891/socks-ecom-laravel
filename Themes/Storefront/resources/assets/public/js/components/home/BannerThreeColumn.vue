<template>
    <section class="banner-wrap three-column-banner">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <div class="three-banner-head">
                        <h2>FEATURED ARENA</h2>
                    </div>
                </div>
                <div class="col-md-4">
                    <a
                        :href="data.banner_1.call_to_action_url"
                        class="banner"
                        :target="data.banner_1.open_in_new_window ? '_blank' : '_self'"
                    >
                        <img :src="data.banner_1.image.path" alt="banner">
                        <div class="hh-text">
                            <h3>New Collection now in Stock</h3>
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a
                        :href="data.banner_2.call_to_action_url"
                        class="banner"
                        :target="data.banner_2.open_in_new_window ? '_blank' : '_self'"
                    >
                        <img :src="data.banner_2.image.path" alt="banner">
                        <div class="hh-text2">
                            <h3>Everything is on sale upto 45% off</h3>
                            
                        </div>
                    </a>
                </div>

                <div class="col-md-4">
                    <a
                        :href="data.banner_3.call_to_action_url"
                        class="banner"
                        :target="data.banner_3.open_in_new_window ? '_blank' : '_self'"
                    >
                        <img :src="data.banner_3.image.path" alt="banner">
                        <div class="hh-text">
                            <h3>Arrived A New & Fresh Collection</h3>
                        </div>
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
