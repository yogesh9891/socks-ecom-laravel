{{-- <div class="table-responsive">
    <table class="table table-borderless my-orders-table">
        <thead>
            <tr>
                <th>{{ trans('storefront::account.orders.order_id') }}</th>
                <th>{{ trans('storefront::account.date') }}</th>
                <th>{{ trans('storefront::account.status') }}</th>
                <th>{{ trans('storefront::account.orders.total') }}</th>
                <th>{{ trans('storefront::account.action') }}</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        {{ $order->id }}
                    </td>

                    <td>
                        {{ $order->created_at->toFormattedDateString() }}
                    </td>

                    <td>
                        <span class="badge {{ order_status_badge_class($order->status) }}">
                            {{ $order->status() }}
                        </span>
                    </td>

                    <td>
                        {{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                    </td>

                    <td>
                        <a href="{{ route('account.orders.show', $order) }}" class="btn btn-view">
                            <i class="las la-eye"></i>
                            {{ trans('storefront::account.orders.view') }}
                        </a>

                           @if($order->status == 'pending' || $order->status == 'on_hold' || $order->status == 'pending_payment')
                            
                            <a href="{{ route('account.orders.cancelview', $order) }}" class="btn btn-view ml-1 text-danger">
                                    <i class="las la-trash "></i>
                                  Cancel
                                </a>
                                   
                              @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
 --}}

<div class="orderTable">
    
     @foreach ($orders as $order)

    <div class="card mb-4">
        <div class="card-header">
            <div class="row">
                <div class="col-md-3">
                    <span>Order : <span class="badge {{ order_status_badge_class($order->status) }}"> {{ $order->status() }} </span> </span>
                    <br>
                    <span>{{ $order->created_at->toFormattedDateString() }}</span>
                </div>
                <div class="col-md-2">
                    <span>Total</span>
                     <br>  
                    <span> @if($order->hasTax())
                            {{ $order->taxes[0]->order_tax->amount->add($order->total)->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                            @else
                            {{ $order->total->convert($order->currency, $order->currency_rate)->format($order->currency) }}
                            @endif
                    </span>
                </div>
                <div class="col-md-3">
                    <span>Ship To</span>
                    <br>    
                    <span>{{ $order->shipping_first_name }} {{ $order->shipping_last_name }}</span>
                </div>
                <div class="col-md-4 text-right">
                    <span>ORDER Id: {{ $order->id }} </span>
                    <br>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
              <div class="col-md-6">

                @foreach($order->products as $p)
                  <div class="prCard row mb-2  ">
                      <div class="col-md-3">
                          <img src="{{ $p->product->base_image->path }}" width="50" height="50" alt="">
                      </div>
                      <div class="col-md-9">
                          <h6>
                            {{ $p->product->name }} 
                            @if($p->status == 'canceled' || $p->status == 'refunded' || $p->status == 'return_request')

                              <span class="badge {{ order_status_badge_class($p->status) }}"> {{ $p->status }} </span> 
                            @endif
                          </h6>
                          <span class="small">Qty : {{ $p->qty }}</span>
                      </div>
                  </div>
                  @endforeach
              </div>
              <div class="col-md-6 text-right  my-orders-table">
                  
                    <a href="{{ route('account.orders.show', $order) }}" class="btn btn-view">
                            <i class="las la-eye"></i>
                            {{ trans('storefront::account.orders.view') }}
                        </a>
                  <br>
                  <br>
                   @if($order->status == 'pending' || $order->status == 'on_hold' || $order->status == 'pending_payment')
                  <a href="{{ route('account.orders.cancelview', $order) }}" class="tn btn-view ml-1 text-danger">   <i class="las la-trash"></i>Cancel </a>
                  @endif



                  @if(!empty($order->tracking_id))
                        &nbsp; / &nbsp;

                            <a href="javascript:void(0)"  data-toggle="modal" data-target="#trackModal{{ $order->tracking_id }}" class="btn btn-view btnTrack"> <i class="fa fa-truck"></i> Track </a>

                            @php
                                
                                $tracking_url = 'https://track.delhivery.com/api/v1/packages/json/?waybill='.$order->tracking_id.'&token=e97d8c3bb25b64ca17d94672bafcab76c0ed8c73';
                                $tracking_data = json_decode(file_get_contents($tracking_url));


                                // print_r($tracking_data);

                            @endphp

                            <div class="modal fade" id="trackModal{{ $order->tracking_id }}" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="">Tracking Info</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                            
                                    @if(!empty($tracking_data->ShipmentData))

                                      <table class="table table-hover table-condense trackingTable table-responsive">
                                          <tr>
                                              <th>Status</th>
                                              <th>Info</th>
                                              <th>Remarks</th>
                                          </tr>
                                          @foreach(array_reverse($tracking_data->ShipmentData[0]->Shipment->Scans) as $d)

                                            <tr>
                                                <td>{{ $d->ScanDetail->Scan }}</td>
                                                <td>{{ $d->ScanDetail->ScannedLocation }} <br> {{ date('d-M-y h:i A',strtotime($d->ScanDetail->StatusDateTime)) }}</td>
                                                <td>{{ $d->ScanDetail->Instructions }}</td>
                                            </tr>
                                          @endforeach

                                      </table>

                                    @else
                                    
                                            <p> No Data Found !!! </p>    

                                    @endif

                                  </div>
                                </div>
                              </div>
                            </div>


                        @endif


        
              </div>
            </div>
        </div>
    </div>
    @endforeach
  
</div>