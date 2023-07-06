<template>
    <section class="top-brands-wrap clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12 text-center">
                    <h2>Official Merchandise</h2>
                </div>
            </div>
            <div class="top-brands clearfix">
                <a
                    v-for="(topBrand, index) in topBrands"
                    :key="index"
                    class="top-brand-image"
                >
                <!-- :href="topBrand.url" -->
                    <img :src="topBrand.logo.path" alt="brand logo">
                </a>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['topBrands'],
    };
</script>
