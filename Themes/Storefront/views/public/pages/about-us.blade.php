@extends('public.layout')

@section('title', 'About Us')

<style>
  .heaing_about h3 {
    font-size: 39px;
    font-weight: 700;
    position: relative;
  }
  .heaing_about h3:before {
    content: "";
    position: absolute;
    bottom: -17px;
    height: 4px;
    width: 182px;
    background-color: #f2d038;
  }
  .heaing_about1 h3 {
    font-size: 39px;
    font-weight: 700;
    position: relative;
  }
  .heaing_about1 h3:before {
    content: "";
    position: absolute;
    bottom: -17px;
    height: 4px;
    left: 0;
    right: 0;
    margin: auto;
    width: 200px;
    background-color: #f2d038;
  }
  /* .heaing_about1 h3 u{
        -webkit-text-decoration-color: #f2d038;
  text-decoration-color: #f2d038;
    } */
  .about_img {
    text-align: center;
  }
  .about_img img {
    width: 53%;
  }
  .align_contente {
    justify-content: center;
    display: flex;
    flex-direction: column;
  }
  .align_contente p {
    font-size: 17px;
    margin-bottom: 10px;
    line-height: 29px;
  }
  .heaing_about.mb50 {
    margin-bottom: 45px;
  }
  .heaing_about1.mb50 {
    margin-bottom: 45px;
  }
  @media (min-width: 992px) {
    .box_fro .col-lg-4 {
      max-width: 31% !important;
      flex: 31%;
    }
  }
  @media (max-width: 992px) {
    .box_fro .card_about {
      margin-bottom: 1pc;
    }
  }
  .box_fro .card_about img {
    height: 337px;
    width: 100%;
    object-fit: cover;
  }
  .shadowclass {
    box-shadow: 0px 3px 15px 0px rgb(0 0 0 / 10%);
    border-radius: 8px;
    overflow: hidden;
    padding: 50px 25px;
    background-color: #fff;
  }
  .box_fro .card_about {
    box-shadow: 0px 3px 15px 0px rgb(0 0 0 / 10%);
    border-radius: 8px;
    overflow: hidden;
    background-color: #fff;
    min-height: 550px;
  }
  .about_content_card {
    padding: 25px 20px;
  }
  .about_content_card h2 {
    font-size: 24px;
    font-weight: 600;
  }
  .padding50 {
    padding: 50px 0;
  }
  .founder_text p {
    text-align: center;
    font-size: 17px;
    margin-bottom: 10px;
    line-height: 29px;
  }
  .about_content_card p {
    font-size: 17px;
    margin-bottom: 10px;
    line-height: 29px;
  }
</style>


@section('content')
    <section class="custom-page-wrap">

        <div class='container'>
            <div class='row' style='align-items: center;justify-content: center;'>
                <div class='col-md-12 text-center heaing_about'>
                    <h3>About Us</h3>
                </div>
            </div>
        </div>

        <div class="padding50">
            <div class="container">
                <div class='row'>
                
                    <div class='col-md-6 align_contente'>
                        <p>Established in Delhi, this ready-to-wear brand with an experience surpassing two generations
                            believes in creating versatile yet powerful apparels that offers the best selection of <strong> Quirky, Bright
                            and Playful </strong> styles on the planet!</p>
                            <p>We, at Belmonk aim at weaving a safer tomorrow with sustainable hand-picked fabrics that bring
                            timeless elegance to our customers. Belmonk is known for its high-quality, luxurious and vibrant
                            clothing that not only look good but also feel good and super comfortable on your body.</p>
                            <p>With the Passion of Innovation and Sustainable Manufacturing Capabilities we strive hard to make
                            best and most comfortable apparels you could ever wear.</p>
                            <p>Our main focus has always been Customer Satisfaction and Comfort.</p>
                            <p>Every purchase from BELMONK is a step closer to Revamping your Closet and adding that Oomph
                            Factor to your look!</p>
                    </div>
                    <div class='col-md-6'>
                        <div class='about_img'>
                            <img src="{{asset('themes/storefront/public/images/Belmonk_Logo_about us.jpg') }}" alt="" class='img-fluid' >
                        </div>
                    </div>
                    
                </div>    
            </div>
        </div>

        <div class="padding50 pt-0">
            <div class='founder_text'>
                <div class='container'>
                    <div class="shadowclass">
                    <div class='text-center heaing_about1 mb50'>
                        <h3>Our Founder</h3>
                    </div>
                
                        <div>
                            <p>Ayush Gulgulia is a Chartered Accountant and Delhi University Graduate, Who with his bag full of
                            Dreams and Passion towards textile aka fashion laid the foundation of Belmonk. He has always been
                            a Finance Guy but passionate to build something around Tech. Since childhood he never fit in with a
                            thought of doing things conventionally as technology and so do people were Dynamically Changing.
                            Amidst all this, Belmonk was born to combine Tech with Textiles.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="padding50">
            <div class='box_fro'>
                <div class='container'>
                    <div class="row" style="display: flex;justify-content: center;">
                        <div class="col-md-12">
                            <div class='text-center heaing_about1 mb50'>
                                <h3>Key Focus </h3>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="display: flex;justify-content: center;">
                    
                        <div class='col-lg-4'>
                            <div class="card_about">
                                <img src="{{asset('themes/storefront/public/images/comfort.jpg') }}" alt="" class='img-fluid' >
                                <div class='about_content_card'>
                                    <h2>Superior Comfort</h2>
                                    <p>Premium Fabric and Comfort has always been the main ingredient in our products and designs. That’s why we always say to our customers, <br>  <i>Thinking comfort ?? – Think BELMONK.
                                    </i></p>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class="card_about">
                                <img src="{{asset('themes/storefront/public/images/durability.jpg') }}" alt="" class='img-fluid' >
                                <div class='about_content_card'>
                                    <h2>Formidable Durability</h2>
                                    <p>Premium fabrics and Technological Innovation are coupled in such a manner making our products enduring, reliable and long lasting.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class='col-lg-4'>
                            <div class="card_about">
                                <img src="{{asset('themes/storefront/public/images/innovation.jpg') }}" alt="" class='img-fluid' >
                                <div class='about_content_card'>
                                    <h2>Innovative & Futuristic Design</h2>
                                    <p>With a capable team and research we strive to bring such Designs, Fabrics, Colours and cuts that shall reflect <strong> Modern Vogue and Elegance. </strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
