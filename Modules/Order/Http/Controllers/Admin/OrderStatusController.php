<?php

namespace Modules\Order\Http\Controllers\Admin;

use Modules\Order\Entities\Order;
use Modules\Product\Entities\Product;
use Modules\Order\Entities\OrderProduct;
use Modules\Order\Events\OrderStatusChanged;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
// use Modules\Order\Mail\OrderTrackingMail;

class OrderStatusController
{
    /**
     * Update the specified resource in storage.
     *
     * @param \Modules\Order\Entities\Order $request
     * @return \Illuminate\Http\Response
     */
public function update(Order $order)
    {
        $message = '';
        if(request('status')=='processing' && !$order->tracking_id){
            try {

            //    $products = [];
            $prodcut_decription = "";
            	$count =count($order->products);
            foreach ($order->products as $key => $value) {
                // $products[$key]['name'] = $value->name;
                // $products[$key]['price'] = $value->unit_price->format();
                // $products[$key]['qty'] = $value->qty;
                    $product = Product::find($value->product_id);
                if( $value->product_id && $product) {
                 
                    $prodcut_decription .= $value->name .' - ( '.$product->sku.' )';
                
                } else {
                    $prodcut_decription .= $value->name;
                }
                  
            }
            
       $prodcut_decription=      str_ireplace( array( '\'', '"',
      ',' , ';', '<', '>' ,'(',')','-','/','&'), '', $prodcut_decription);
            
            //  $post = array();
            //   $this->http_build_query_for_curl($products, $post);
            // 	$payment_method = '';
            // dd($products);
            $cod = 0;;
              if($order->payment_method=='Cash On Delivery'){ $payment_method = 'COD';  $cod =round($order->total->amount()); }else{$payment_method = 'Prepaid'; }
            
              $body_data = 'format=json&data={
    "shipments": [
        {
            "add": "'.$order->shipping_address_1.'",
            "address_type": "home",
            "phone": "'.$order->customer_phone.'",
            "payment_mode": "'.$payment_method.'",
            "name": "'.$order->shipping_first_name.' '.$order->customer_last_name.'",
            "pin": "'.$order->shipping_zip.'",
            "order": "BB'.$order->created_at->format('Ymd').$order->id.'",
            "products_desc": "'.$prodcut_decription.'.",
            "cod_amount" :'.$cod.'
        }
    ],
    "pickup_location": {
        "name": "Belmonk Fashions"
    }
}';
            
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://track.delhivery.com/api/cmu/create.json',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'format=json&data={
    "shipments": [
        {
            "add": "'.$order->shipping_address_1.'",
            "address_type": "home",
            "phone": "'.$order->customer_phone.'",
            "payment_mode": "'.$payment_method.'",
            "name": "'.$order->shipping_first_name.' '.$order->customer_last_name.'",
            "pin": "'.$order->shipping_zip.'",
            "order": "BM'.$order->created_at->format('Ymd').$order->id.'",
            "products_desc": "'.$prodcut_decription.'",
            "cod_amount" :'.$cod.'
        }
    ],
    "pickup_location": {
        "name": "Belmonk Fashions"
    }
}',
  CURLOPT_HTTPHEADER => array(
    'Authorization: Token e97d8c3bb25b64ca17d94672bafcab76c0ed8c73',
    'Content-Type: text/plain'
  ),
));

$response = curl_exec($curl);
// dd($response);
// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://track.delhivery.com/api/cmu/create.json',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>'format=json&data={
//     "shipments": [
//         {
//             "add": '.$order->shipping_address_1.',
//             "address_type": "home",
//             "phone": '.$order->customer_phone.',
//             "payment_mode": "Prepaid",
//             "name": '.$order->shipping_first_name.',
//             "pin": '.$order->shipping_zip.',
//             "order": '.$order->id.'
//         }
//     ],
//     "pickup_location": {
//         "name": "BELMONKFASHIONSSURFACE-B2C"
//     }
// }',
//   CURLOPT_HTTPHEADER => array(
//     'Authorization: Token 6b18dfd06665019a9c9f09cb56e309c926c064d6',
//     'Content-Type: text/plain'
//   ),
// ));

// $response = curl_exec($curl);
// dd($body_data);

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => 'https://staging-express.delhivery.com/api/cmu/create.json',
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
//   CURLOPT_POSTFIELDS =>$body_data,
//   CURLOPT_HTTPHEADER => array(
//     'Content-Type: application/json',
//     'accept: application/json',
//     'Authorization: Token 6b18dfd06665019a9c9f09cb56e309c926c064d6'
//   ),
// ));
// $response = curl_exec($curl);

// curl_close($curl);
$result = json_decode($response);
// dd($result);
                 // $res = Http::withHeaders([
                 //          'Authorization' => 'Token 507c81c6157979b9adda174bd30eb1a3f77697fa34777',
                 //    ])->asForm()->post('https://staging-express.delhivery.com/api/cmu/create.json', 

                 //    [
                 //        'order' => $order->id,
                 //            'payment_method' => $payment_method,
                 //        'total_amount' => $order->total->amount(),
                 //        'name' => $order->shipping_first_name,
                 //        'phone' => $order->customer_phone,
                 //        'add' => $order->shipping_address_1,
                 //        'address_2' => $order->shipping_address_2,
                 //        'phone' => $order->customer_phone,
                 //        'city' => $order->shipping_city,
                 //        'state' => $order->shipping_state,
                 //        'country' => $order->shipping_country,
                 //        'pin' => $order->shipping_zip,
                 //        'products' => $products,
                 //        'consignee_gst_amount' => '5',
                 //        'integrated_gst_amount' => '5',
                 //        'ewbn' => '5ee',
                 //        'consignee_gst_tin' => '5',
                 //        'gst_cess_amount' => '5',
                 //        'cod_amount' => $cod,
                 //           "waybill": "waybillno.(trackingid)",
                 //          "order_date":$order->update_at,
                 //          'quantity':$count,

                 //    ]);


                // $result = $res->object();
                // dd($result->rmk);
                           
                if(isset($result->success) && $result->success == true){

                    $packages = $result->packages;
                    if(is_array($packages) && count($packages) > 0){
                        $trackingid = $packages[0]->waybill;
                     $order->update(['status' => request('status'),'tracking_id'=>$trackingid  ]);
                    }

                      $this->adjustStock($order);
                    event(new OrderStatusChanged($order));
                     return   $message = trans('order::messages.status_updated');
                }  else {

                	    $packages = $result->packages;
                  if(is_array($packages) && count($packages) > 0){
                        $remarks = implode(" ", $packages[0]->remarks);
						$message .= " ".$remarks;
               
                    }
                 return $message .= $result->rmk;

                }

                
            } catch (Exception $e) {
            
    
                $message =  $e->getMessage();
            }
        } else {
        	
        $order->update(['status' => request('status')]);

        $this->adjustStock($order);

        $message = trans('order::messages.status_updated');

        event(new OrderStatusChanged($order));
        }


        


        return $message;
    }

    private function adjustStock(Order $order)
    {
        if ($this->canceledOrRefunded(request('status'))) {
            $this->restoreStock($order);
        }

        if ($this->canceledOrRefunded($order->status)) {
            $this->reduceStock($order);
        }
    }

    private function canceledOrRefunded($status)
    {
        return in_array($status, [Order::CANCELED, Order::REFUNDED]);
    }

    private function restoreStock(Order $order)
    {
        $order->products->each(function (OrderProduct $orderProduct) {
            if ($orderProduct->product->manage_stock) {
                $orderProduct->product->increment('qty', $orderProduct->qty);
            }

            if ($orderProduct->product->qty === 1) {
                $orderProduct->product->markAsInStock();
            }
        });
    }

    private function reduceStock(Order $order)
    {
        $order->products->each(function (OrderProduct $orderProduct) {
            if (
                $orderProduct->product->manage_stock
                && $orderProduct->product->qty !== 0
            ) {
                $orderProduct->product->decrement('qty', $orderProduct->qty);
            }

            if ($orderProduct->product->qty === 0) {
                $orderProduct->product->markAsOutOfStock();
            }
        });
    }


        

    public function updateTracking(Order $order){

       $order = Order::find(request('pk'));

        $order->update(['tracking_id' => request('value')]);

        $message = "Tracking Id Updated Successfully";

        return $message;

    }


}
