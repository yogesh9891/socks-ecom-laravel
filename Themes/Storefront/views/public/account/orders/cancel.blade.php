@extends('public.layout')

@section('title', 'Cancel Order')

@section('breadcrumb')
    <li><a href="{{ route('account.dashboard.index') }}">{{ trans('storefront::account.pages.my_account') }}</a></li>
    <li><a href="{{ route('account.orders.index') }}">{{ trans('storefront::account.pages.my_orders') }}</a></li>
    <li class="active">Cancel Order</li>
@endsection

@section('content')
    <section class="order-details-wrap">
        <div class="container">

        	<div class="sec-head text-center bg-pyara_color mb-50 p-2">
        		<h3>Are you sure you want to cancel this order? </h3>
        	</div>
        	<form action="{{ route('account.orders.cancelsubmit', $order) }}" method="post">
        		@csrf
	        	<div class="order-list">
	        		<div class="row border-bottom m-0 mb-3 p-1 row">
	        			<div class="col-md-8 p-0">
	        				<h5>Items Ordered</h5>
	        			</div>
	        			<div class="col-md-4 text-right p-0">
	        				<h5>Price</h5>
	        			</div>
	        		</div>
	        		@foreach($order->products as $p)
		        		<div class="row border-bottom mb-2 pb-2">
		        			<div class="col-md-8" >
		        				<label for="cancel_{{ $p->id }}_checkbox">
		        					
		        				<img src="{{ $p->product->base_image->path }}" for="cancel_{{ $p->id }}_checkbox" width="50" height="50" alt="">
		        				<span class="productTitle" >	{{ $p->qty }} of: {{ $p->product->name }}</span>
		        				@if($p->status == 'canceled')

		        					<span class="badge {{ order_status_badge_class($p->status) }}"> {{ $p->status }} </span> 
		        				@endif
		        				</label>
		        			</div>
		        			<div class="col-md-4 text-right">
		        				<label for="cancel_{{ $p->id }}_checkbox"> {{ $p->line_total->convert($order->currency, $order->currency_rate)->format($order->currency) }}</label>

		        				@if($p->status != 'canceled')
		        				<input type="checkbox" name="cancel_checkbox[]"  value="{{ $p->id }}" checked id="cancel_{{ $p->id }}_checkbox">
		        				@endif
		        			</div>
		        		</div>
	        		@endforeach
					<div class="justify-content-end row">
						<div class="col-md-4 text-right">
							<label for="" class="d-block">Cancel Reason</label> 
							<textarea required name="cancel_reason" class="form-control"></textarea> 
							<button type="submit" class="btn  btn-primary btn-apply-coupon mb-4 mt-4">
								Cancel selected items in this order
							</button> 
							<a href="{{ route('account.orders.index') }}" class="btn-sm btn btn-default">Return to order summary</a>
						</div>
					</div>

	        	</div>

        	</form>
            
        </div>
    </section>

@endsection
