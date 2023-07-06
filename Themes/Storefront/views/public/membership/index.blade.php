@extends('public.layout')


@section('content')


<section class="membership-slider">
	<div class="container">
		<div class="m-slider-content">
			<h3>SAVE BIG</h3>
			<p class="ms-p1">ON ALL PRODUCTS.EVERY DAY.</p>
		</div>
		<h4>Fun Facts</h4>
		<div class="m-slider">
			<div>
				<p class="mb-box">Most people save the membership fee on their first order.</p>
			</div>
			<div>
				<p class="mb-box">Most people become members and don’t pay full price.</p>
			</div>
			<div>
				<p class="mb-box">Add the membership to your cart<br>Add the membership to your cart</p>
			</div>
			<div>
				<p class="mb-box">The average exclusive member SAVES Rs. 2600/year.</p>
			</div>
		</div>
	</div>
</section>

<section class="mem-benefits">
	<div class="container">
		<h2 class="title">Exclusive Member Benefits</h2>
		<div class="row">
			<div class="col-12 col-md-4">
				<div class="mem-benefits-left">
					<div class="mem-benefit1">
						<img src="../../../../storage/media/wFAJLfxpBU2QJWzdeACXFlcHgpLpHYakY1qTfjMq.webp">
						<div>
							<h4>BIG DISCOUNTS</h4>
							<p>Save big on ALL products every day. Why wait for a sale?</p>
						</div>
					</div>
					<div class="mem-benefit1">
						<img src="../../../../storage/media/oxL7eZLEyGMXR4oK4mXQBb8jkjBcNB7wxtulE5Yp.webp">
						<div>
							<h4>FREE DELIVERY</h4>
							<p>Our shipping charges are on us.</p>
						</div>
					</div>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="mem-benefits-middle">
					<img src="../../../../storage/media/8Z8liLFapM8hZiCHN8WzP5fjCJxRYIVzBnTX0JT5.png">
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="mem-benefits-right">
					<div class="mem-benefit1">
						<img src="../../../../storage/media/bLay1Q2MClHj8a3gv5cSPeB0kikfkZulgZnk5LFZ.webp">
						<div>
							<h4>EARLY ACCESS</h4>
							<p>Get your hands on select products and designs before others do.</p>
						</div>
					</div>
					<div class="mem-benefit1">
						<img src="../../../../storage/media/W1hxlPpduDZldNr3VNPi1lI4QwtemoPEext2IPvs.webp">
						<div>
							<h4>PRIORITISED SHIPPING</h4>
							<p>We ship your orders before everyone else’s.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ex-member">
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="ec-mem-content">
					<h2 class="title">BECOME AN EXCLUSIVE MEMBER</h2>
					<p>Lorem khaled ipsum is a major key to success. It’s on you how you want to live your life. Always remember in the jungle there’s a lot of they in.</p>
					<a href="#" class="mem-btn btn">Add Membership to the Cart</a>
				</div>
			</div>
			<div class="col-md-6">
				<img src="../../../../storage/media/QJ4hDHcdxXvYdqgng2kjNGGs8sdWBLQbkAV7O8JY.jpg">
			</div>
		</div>
		<div class="row ex-member-box">

			@if($membership)
				@foreach($membership as $memberships)
					<div class="col-12 col-md-4">
						<a href="{{ url('membership/'.$memberships->id.'/checkout') }}" title="">
							
							<div class="member-box-inner">
								<h4>₹ {{ round($memberships->price) }}</h4>
								<h2 class="title">{{ $memberships->title }}</h2>
                            	<p class="mem-like"><strong>({{ $memberships->days }} Days)</strong></p>
								{{-- <p><span class="member-like">MOST POPULAR</span></p> --}}
								<p>{!! $memberships->description !!}</p>
								<a href="{{ url('membership/'.$memberships->id.'/checkout') }}" class="mem-price">Buy Now</a>
								{{-- <span>Save 87.5%</span> --}}
							</div>
						</a>
					</div>
				@endforeach
			@endif


			{{-- <div class="col-12 col-md-4">
				<div class="member-box-inner">
					<h3>3 Months</h3>
					<p class="mem-price">(₹ 83/Month)</p>
					<h4>₹ 249</h4>
					<span>Save 58%</span>
				</div>
			</div>
			<div class="col-12 col-md-4">
				<div class="member-box-inner">
					<h3>1 Months</h3>
					<p class="mem-price">(₹ 199/Month)</p>
					<h4>₹ 199</h4>
				</div>
			</div> --}}
		</div>
	</div>
</section>


<div class="container">
	<section class="mem-test">
		<section class="mem-testi">
			<h2 class="title">What Clients Say</h2>
				<div class="mem-test-slider">
					<div>
						<p><i class="fas fa-quote-left"></i>The exclusive membership has definitely been worth the value. I've never had a bad experience with the membership and all these continuous discounts are very beneficial to the customer.</p>
						<div class="product-rating">
							<div class="back-stars">
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<div class="front-stars" style="width: 0%;">
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i>
								</div>
							</div> 
							<span class="rating-count">(0)</span>
						</div>
						<h4>Bhuvandeep, Bangalore</h4>
					</div>
					<div>
						<p><i class="fas fa-quote-left"></i>The exclusive membership is great, it helps save so much money. You not only recover the money you've spent on it, but save so much more!</p>
						<div class="product-rating">
							<div class="back-stars">
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<div class="front-stars" style="width: 0%;">
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i>
								</div>
							</div> 
							<span class="rating-count">(0)</span>
						</div>
						<h4>Atharva, Pune</h4>
					</div>
					<div>
						<p><i class="fas fa-quote-left"></i>The exclusive membership has been a real blessing, it gives you first preference for limited edition clothes, it also helps you save so much and it barely costs anything in comparison with what you save.</p>
						<div class="product-rating">
							<div class="back-stars">
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<i class="las la-star"></i> 
								<div class="front-stars" style="width: 0%;">
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i> 
									<i class="las la-star"></i>
								</div>
							</div> 
							<span class="rating-count">(0)</span>
						</div>
						<h4>Rahul, Pune</h4>
					</div>
				</div>
		</section>
	</section>
</div>

<section class="mem-banner">
		<div class="row mem-row1">
			<h2>HOMEGROWN INDIAN BRAND</h2>
		</div>
		<div class="row mem-row2">
			<h1>Over 3 Million Happy Customers</h1>
		</div>
</section>

{{-- 
	<section class="plan-sec" id="membershipPlan" style="background-color: #edf1f5;">
		<div class="container py-5">
			<div class="row align-items-center my-3 py-3">
				<div class="col text-center">
					<h3 class="text-center" style="color: #161a25;font-size: 34px;font-weight: 600;">Select a plan</h3>
				</div>
			</div>

			<div class="row row-cols-xl-3 row-cols-lg-3 row-cols-md-1 row-cols-sm-1 row-cols-1 plan-box-sec mr-3 ml-3 bg-light ">

				@if($membership)
				@foreach($membership as $memberships)
				<div class="col mb-3 card " >
					<div class="plan-box card-body">
						<h5 class="card-title"> {{ $memberships->title }}</h5>
						<span class="circle "><div></div></span>
						<h3><span class="fa fa-inr"></span>{{ round($memberships->price) }} <small>({{ $memberships->days }} Days)</small></h3>
						<p class="card-text">{!! $memberships->description !!}</p>
						<a href="{{ url('membership/'.$memberships->id.'/checkout') }}" class="btn btn-primary">join now</a>
					</div>
				</div>
				@endforeach
				@endif
			</div>
		</div>
	</section> --}}



@endsection


@push('scripts')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script>

	 $(document).ready(function(){
      $('.m-slider').slick({
        infinite: true,
  		slidesToShow: 1,
  		slidesToScroll: 1,
  		dots: true,
  		speed: 300,
  		autoplay: true,
  		arrows:false
      });

       $('.mem-test-slider').slick({
        infinite: true,
  		slidesToShow: 1,
  		slidesToScroll: 1,
  		dots: true,
  		speed: 300,
  		autoplay: true,
  		arrows:false
      });
    });

</script>

@endpush