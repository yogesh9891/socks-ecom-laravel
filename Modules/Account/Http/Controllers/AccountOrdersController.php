<?php

namespace Modules\Account\Http\Controllers;
use Modules\Order\Entities\Order;
use Modules\Order\Entities\OrderProduct;
use Illuminate\Http\Request;
use Modules\Order\Events\OrderStatusChanged;

class AccountOrdersController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = auth()->user()
            ->orders()
            ->latest()
            ->paginate(20);

        return view('public.account.orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = auth()->user()
            ->orders()
            ->with(['products', 'coupon', 'taxes'])
            ->where('id', $id)
            ->firstOrFail();

        return view('public.account.orders.show', compact('order'));
    }

     public function cancelOrder(Request $request,$id){



        $o = Order::find($id);

        $o->status = 'canceled';
        $o->reason = $request->cancel_reason;
        $o->update();

        return redirect('account/orders')->with('flash_message','Order has been canceled successfully !!!');
    }


    public function cancel($id)
    {
        $order = auth()->user()
            ->orders()
            ->with(['products', 'coupon', 'taxes'])
            ->where('id', $id)
            ->firstOrFail();

        return view('public.account.orders.cancel', compact('order'));
    }





    public function cancel_submit(Request $request,$id){


        if($request->cancel_checkbox){

            $amount = 0;

            foreach ($request->cancel_checkbox as $value) {
                
                $d = OrderProduct::find($value);


                $d->status = 'canceled';
                $d->reason = $request->cancel_reason;
                $d->product->increment('qty', $d->qty);
                $d->update();
                $amount = $amount + $d->line_total->amount();

            }


            $order = Order::find($id);
            $check = OrderProduct::where('order_id',$id)->where('status','!=','canceled')->first();
          
            if($check){


                $order->sub_total = $order->sub_total->amount() - $amount; 
                $order->total = $order->total->amount()-$amount + $order->discount->amount(); 
                $order->discount = 0;
                $order->coupon_id = null;
            }else{
                $order->sub_total = 0; 
                $order->total = 0; 
                $order->discount = 0; 
                $order->shipping_cost = 0; 
                $order->status = 'canceled';
            }


          $order->update();


             event(new OrderStatusChanged($order));

        }else{
            return redirect()->back()->with('error','Please select a product first');
        }

        return redirect('account/orders')->with('flash_message','your order has been canceled successfully !!!');
    }

}
