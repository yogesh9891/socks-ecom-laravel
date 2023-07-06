
@extends('public.layout')


@section('content')
    <section class="shopping-cart-wrap" style="height: 80vh;">
        <div class="shoping-cart-wrapper">
            <div class="fix-screen-width">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-center my-3">
                        <h1>Buy Membership </h1>
                    </div>
                    <div class="row align-items-center justify-content-center">
                    	<aside class="col-lg-8">
                    		<div>
                    			<div class="card">
                    				<div class="table-responsive">
                    					<table class="table table-borderless table-shopping-cart">
                    						<tbody>
                    							<tr>
                    								<td>
                    									<figcaption class="info">
                    										<h4><span>#</span> membership</h4> 
                    										<span>{{ $membership->title }} : <i class="fa fa-rupee"></i> {{ round($membership->price) }}</span>
                                                            <br>    
                                                            <span> Validity : {{ $membership->days }} Days</span>
                    									</figcaption>
                    								</td>
                    								<td>
                    									
                    								</td>
                    							</tr>
                    						</tbody>
                    					</table>
                    				</div>
                    			</div>
                    		</div>
                    	</aside>
                    	<aside class="col-lg-4">
                    		<div>
                    			<div class="card">
                    				<div class="card-header">
                    					Price Summary
                    				</div>
                    				<div class="card-body">
                    					<div class="order-summary-middle">
                    						<dl class="dlist-align">
                    							<dt>Subtotal</dt> 
                    							<dd class="text-right ml-3">₹{{ round($membership->price) }}</dd>
                    						</dl>
                    						<dl class="dlist-align">
                    							<dt>Total MRP (Incl. of taxes)</dt> 
                    							<dd class="text-right ml-3">₹{{ round($membership->price) }}</dd>
                    						</dl>
                    						<hr>
                    						<a href="javascript:void(0)" id="make_membership_purchase" data-abc="true" class="btn btn-primary btn-primary-custom d-block" style="font-weight: 400;">Make Purchase</a>
                    					</div>
                    				</div>
                    			</div>
                    		</div>
                    	</aside>
                    </div>
                </div>
            </div>
        </div>
    </section>


@endsection

@push('scripts')

    {{-- @if (setting('razorpay_enabled')) --}}
        <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

        <script>

            $('#make_membership_purchase').click(function(){


                        var name = '{{ Auth::user()->getFullNameAttribute() }}';
                        var email = '{{ Auth::user()->email }}';
                        var mobile = '{{ Auth::user()->phone }}';
                        var price = {{ round($membership->price) }};
                        let rid = '{{time()}}';
                          var payloads = {'total':price,'transaction_id':rid,'payment_mode':'razorpay'};

                           $.ajax({
                                        type: "POST",
                                        url: "/membership/{{ $membership->id }}/purchase",
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        data: payloads,
                                        success: function (res) {
                                            // var json = $.parseJSON(res); 
                                            if(res.status){
                                                window.location.href= '/success';
                                            }else{
                                                alert(res.message);
                                                window.location.href= '/membership';

                                            }
                                        }


                                });
                        // var options = {
                        //     "key": "{{ setting('razorpay_key_id') }}", 
                        //     "amount": price * 100, 
                        //     "name": "{{ setting('store_name') }}",
                        //     "description": "{{ setting('store_name') }}",
                        //     "image": "/storage/media/D2BfSaW2Wb9iCzOtaRujO0MK7WfHjthyVqlxHvPH.png",
                        //     "handler": function (response) {
                        //         var rid = response.razorpay_payment_id;
                        //          var payloads = {'total':price,'transaction_id':rid,'payment_mode':'razorpay'};
                        //          $.ajax({
                        //                 type: "POST",
                        //                 url: "/membership/{{ $membership->id }}/purchase",
                        //                 headers: {
                        //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        //                 },
                        //                 data: payloads,
                        //                 success: function (res) {
                        //                     // var json = $.parseJSON(res); 
                        //                     if(res.status){
                        //                         window.location.href= '/success';
                        //                     }else{
                        //                         alert(res.message);
                        //                         window.location.href= '/membership';

                        //                     }
                        //                 }


                        //         });
                        //     },
                        //     "prefill": {
                        //         "name": name,
                        //         "email": email,
                        //         "contact": mobile
                        //     },
                        //     "notes": {
                        //         "address": ''
                        //     },
                        //     "theme": {
                        //         "color": "#000"
                        //     }
                        // };
                        // var rzp1 = new Razorpay(options);

                        // rzp1.open();

            });
        </script>


    {{-- @endif --}}
@endpush